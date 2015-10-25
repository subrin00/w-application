<?php

include 'db.php';

class overview
{
	public $db;
	public function __construct()
	{
		$this->db = new mysqli(db_host, db_user, db_password, db_name);
		if(mysqli_connect_errno())
		{
			echo "database connect error";
			exit;
		}
	}

	public function total_overview()
	{
		$sqlout = "SELECT SUM(tk) AS outtk, SUM(quantity) AS outquantity FROM sub_memo";
		$resultout = $this->db->query($sqlout);
		$dataout = $resultout->fetch_array();

		$sqlin = "SELECT SUM(tk) AS intk, SUM(quantity) AS inquantity FROM goods_in";
		$resultin = $this->db->query($sqlin);
		$datain = $resultin->fetch_array();

		$sqlcost = "SELECT SUM(amount) AS amount FROM costs";
		$resultcost = $this->db->query($sqlcost);
		$datacost = $resultcost->fetch_array();

		$total_tk_cal = $dataout['outtk'] - $datain['intk']-$datacost['amount'];
		$total_quantity_cal = $datain['inquantity'] - $dataout['outquantity'];

		echo "<div class='col-sm-12'><h3 class='col-sm-6'>Total Transition</h3><h3 class='col-sm-5'>Total Goods Transition</h3></div>
			  <div class='table_head col-sm-5 memo_transition'>
		 	  Total Sell = $dataout[outtk] TK<br>
				Total Buy = $datain[intk] TK<br>
				Total Cost = $datacost[amount] TK<hr>
				<strong>Total Transition = $total_tk_cal TK</strong>
				</div>";

		echo "<div class='table_head col-sm-5 memo_goods_transition'>
			  Total Goods Sell = $dataout[outquantity] Pic's<br>
			  Total Goods Bye = $datain[inquantity] Pic's<hr>
			  <strong>Now In Your House = $total_quantity_cal Pic's</strong>
			  </div>";		
	}

	public function to_day_post()
	{
		$date = date('d-m-Y', strtotime('now'-2));
		$sql1 = "SELECT * FROM `sub_memo` WHERE ddate = '$date'";
		$result1 = $this->db->query($sql1);
		while ($row1 = $result1->fetch_array())
		{

			$sql = "SELECT items.title, sub_item.s_title, sub_sub_item.s_s_title FROM `items`, `sub_item`, `sub_sub_item` WHERE $row1[items]=items.id AND $row1[sub_item]=sub_item.s_id AND $row1[sub_sub_item]=sub_sub_item.s_s_id";
			$result = $this->db->query($sql);
			$row = $result->fetch_array();

			 echo "<div class='brand-hed col-sm-2'>$row[title]</div>
					<div class='sub-brand-hed col-sm-2'>$row[s_title]</div>
					<div class='items-hed col-sm-2'>$row[s_s_title]</div>
					<div class='quen-hed col-sm-2'>$row1[quantity]</div>
					<div class='tk-hed col-sm-2'>$row1[tk]</div>
					<div class='tk-hed col-sm-2'>$row1[time]</div>";			  
		}		
	}

	public function to_day_cost()
	{
		$date=date('d-m-Y', strtotime('now'-2));
		$sqlcost = "SELECT * FROM `costs` WHERE ddate = '$date'";
		$resultcost = $this->db->query($sqlcost);
		while($datacost = $resultcost->fetch_array())
		{
			echo "<div class='brand-hed col-sm-4'>$datacost[title]</div>
				  <div class='sub-brand-hed col-sm-3'>$datacost[amount]</div>
				  <div class='items-hed col-sm-5'>$datacost[time]</div>";
		}
	}
	public function total_to_day()
	{
		$date=date('d-m-Y', strtotime('now'-2));

		$todaysell = "SELECT SUM(tk) AS tk FROM sub_memo WHERE ddate = '$date'";
		$resulttodaysell = $this->db->query($todaysell);
		$rowtodaysell = $resulttodaysell->fetch_array();

		$todaycost = "SELECT SUM(amount) AS amount FROM costs WHERE ddate = '$date'";
		$resulttodaycost = $this->db->query($todaycost);
		$rowtodaycost = $resulttodaycost->fetch_array();

		$totalcal = $rowtodaysell['tk'] - $rowtodaycost['amount'];

		echo "<strong class='col-sm-7 total_sell'><h4>Today Total Sell : $rowtodaysell[tk] TK</h4></strong><br>";
		echo "<strong class='col-sm-5 total_co'><h4>Today Total Cost : $rowtodaycost[amount] TK</h4></strong><br>";
		echo "<strong class='col-sm-5 total_calculation'><h2>Your Hand $totalcal</h2></strong>";
	}

	public function dashbord()
	{
		$date=date('d-m-Y', strtotime('now'-2));

		//------------Today sell Information -------------
		$todaysell = "SELECT SUM(tk) AS tk FROM sub_memo WHERE ddate = '$date'";
		$resulttodaysell = $this->db->query($todaysell);
		$rowtodaysell = $resulttodaysell->fetch_array();

		$todaycost = "SELECT SUM(amount) AS amount FROM costs WHERE ddate = '$date'";
		$resulttodaycost = $this->db->query($todaycost);
		$rowtodaycost = $resulttodaycost->fetch_array();

		$todayhand = $rowtodaysell['tk'] - $rowtodaycost['amount'];
		//------------End Today sell Information -------------


		//------------Bank Information -------------
		$sql = "SELECT SUM(deposit) AS deposit, SUM(withdrawal) AS withdrawal FROM bank_info";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();

		$sqlac = "SELECT COUNT(id) AS bankid FROM bank_name";
		$resultac = $this->db->query($sqlac);
		$dataac = $resultac->fetch_array();

		$totalbankac = $dataac['bankid'];

		$totalbankTk = $data['deposit']- $data['withdrawal'];
		//------------End Bank Information -------------


		//------------client Information -------------
		$sqlclient = "SELECT SUM(ttk) AS ttk, SUM(paytk) AS paytk FROM `client_details`";
		$resultclient = $this->db->query($sqlclient);
		$dataclient = $resultclient->fetch_array();

		$sqlc = "SELECT COUNT(id) AS clid FROM add_client";
		$resultc = $this->db->query($sqlc);
		$datac = $resultc->fetch_array();

		$totalclientnumber = $datac['clid'];

		$totalclient = $dataclient['ttk']-$dataclient['paytk'];
		//------------End client Information -----------


		//------------Goods Information -------------
		$sqlout = "SELECT SUM(quantity) AS outquantity FROM sub_memo";
		$resultout = $this->db->query($sqlout);
		$dataout = $resultout->fetch_array();

		$sqlin = "SELECT SUM(quantity) AS inquantity FROM goods_in";
		$resultin = $this->db->query($sqlin);
		$datain = $resultin->fetch_array();
		
		$total_quantity_goods = $datain['inquantity'] - $dataout['outquantity'];
		//------------End Goods Information -------------

		echo "<strong><div class='title dash col-sm-2'>$total_quantity_goods pic's</div>
				<div class='title dash col-sm-2'>$totalbankac</div>
				<div class='title dash col-sm-2'>$totalbankTk TK</div>
				<div class='title dash col-sm-2'>$totalclientnumber</div>
				<div class='title dash col-sm-2'>$totalclient TK</div>
				<div class='title dash col-sm-2'>$todayhand TK</div></strong>";
	}

}
?>
