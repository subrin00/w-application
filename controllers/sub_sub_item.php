<?php

include 'db.php';

class sub_sub_items
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
	public function show_sub_sub_item()	
	{
		$sql = "SELECT * FROM `sub_sub_item` ORDER BY `time` DESC";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			$sqlsub = "SELECT SUM(quantity) AS goodsin FROM `goods_in` WHERE s_s_id = '$data[s_s_id]'";
			$resultsub = $this->db->query($sqlsub);
			$datasub = $resultsub->fetch_array();

			$sql1 = "SELECT SUM(quantity) AS goodsout FROM `sub_memo` WHERE sub_sub_item = '$data[s_s_id]'";
			$result1 = $this->db->query($sql1);
			$data1 = $result1->fetch_array();

			$sqlsubitem = "SELECT * FROM `sub_item` WHERE s_id = '$data[s_id]'";
			$resultsubitem = $this->db->query($sqlsubitem);
			$datasubitem = $resultsubitem->fetch_array();

			$sqlitem = "SELECT * FROM `items` WHERE id = '$datasubitem[i_id]'";
			$resultitem = $this->db->query($sqlitem);
			$dataitem = $resultitem->fetch_array();

			$cal = $datasub['goodsin'] - $data1['goodsout'];

			$sqlsux = "SELECT * FROM `goods_in` WHERE s_s_id = '$data[s_s_id]'";
			$resultx = $this->db->query($sqlsux);
			$datax = $resultx->fetch_array();

			echo "<div class='table_details'>
					<a href='sub_sub_single.php?mid=$datax[mid]&cid=$datax[sid]&id=$datax[s_s_id]'><div class='title_d col-sm-3'>$dataitem[title]</div>
					<div class='date_d col-sm-3'>$datasubitem[s_title]</div>
					<div class='date_d col-sm-3'>$data[s_s_title]</div>		
					<div class='title_d col-sm-3'>$cal Pic's</div></a>
					</div>";
		}		
	}
	public function total_goods_overview()
	{
		$sqlout = "SELECT SUM(quantity) AS outquantity FROM sub_memo";
		$resultout = $this->db->query($sqlout);
		$dataout = $resultout->fetch_array();

		$sqlin = "SELECT SUM(quantity) AS inquantity FROM goods_in";
		$resultin = $this->db->query($sqlin);
		$datain = $resultin->fetch_array();
		$total_quantity_cal = $datain['inquantity'] - $dataout['outquantity'];
		echo "<div class='total-body col-sm-4'>
				Total Quantity: $total_quantity_cal
				</div>";
	}

	public function sub_sub_single($id)
	{
		$sql = "select * from sub_sub_item where s_s_id=$id";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		{
			echo "Add Your Good's On : $data[s_s_title]";
		}
	}

	public function goodsin($s_id, $quantity, $tk, $details, $date, $time, $mid, $cid)
	{
		if($quantity == "" || $tk == "")
		{
			return false;
		}
		else
		{
			$sql = "INSERT INTO `goods_in` VALUES('', '$s_id', '$quantity', '$tk', '$details', '$date', '$time', '$mid', '$cid')";
			$result = $this->db->query($sql);
			return true; 
		}
	}

	public function update_goods($edit, $quantity, $tk, $details, $date, $time, $mid, $cid)
	{
		if($quantity == "" || $tk == "")
		{
			return false;
		}
		else
		{
			$sql = "UPDATE `goods_in` SET quantity = '$quantity', tk = '$tk', details = '$details', date = '$date', time = '$time', mid = $mid, sid = '$cid' WHERE g_id = '$edit'";
			$result = $this->db->query($sql);
			return true; 
		}
	}

	public function delete_goods($del)
	{
		$sql = "DELETE FROM `goods_in` WHERE g_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function update_goods_show($id)
	{
		$sql = "SELECT * FROM `goods_in` WHERE g_id = '$id'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='quantity' value='$data[quantity]'>
						</label>
					</div>

					<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='tk' value='$data[tk]'>
						</label>
					</div>

					<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='details' value='$data[details]'>
						</label>
					</div>";
	}

	public function goods_show($g_id, $mid, $cid)
	{
		$sql = "SELECT * FROM `goods_in` WHERE s_s_id = '$g_id'  ORDER BY `date` DESC";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{	
			echo "<div class='table_details'>
				<div class='cost col-sm-2'>$data[quantity]</div>
				<div class='cost col-sm-2'>$data[tk]</div>
				<div class='cost col-sm-2'>$data[details]</div>
				<div class='cost col-sm-2'>$data[date]</div>
				<div class='cost col-sm-2'>$data[time]</div>
				<div class='cost col-sm-2'><a href='sub_sub_single.php?mid=$mid&cid=$cid&id=$data[s_s_id]&edit=$data[g_id]'><img src='../img/edit.png' width='15px'></a> || <a href='sub_sub_single.php?mid=$mid&cid=$cid&id=$data[s_s_id]&del=$data[g_id]'><img src='../img/icon_del.gif'></a></div>
			</div>";
		}
	}

	public function show_all_sirl($id, $mid, $cid)
	{
		$sqls = "SELECT * FROM `sub_sub_item` WHERE s_s_id = '$id'";
		$results = $this->db->query($sqls);
		$datas = $results->fetch_array();

		$sql = "SELECT * FROM `sub_item` WHERE s_id = '$datas[s_id]'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();

		$sqlt = "SELECT * FROM `items` WHERE id = '$data[i_id]'";
		$resultt = $this->db->query($sqlt);
		$datat = $resultt->fetch_array();

		echo "<a href='item.php'>Category Type</a> : <a href ='item_details.php?mid=$mid&id=$datat[id]'>$datat[title]</a> >> <a href ='sub_item_single.php?mid=$mid&id=$data[s_id]'>$data[s_title]</a> >> <a href ='sub_sub_single.php?mid=$mid&cid=$cid&id=$datas[s_s_id]'>$datas[s_s_title]</a>";
	}

}
?>