<?php

include 'db.php';

class memo
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
	public function memo($date,$time)
	{
		$sql = "INSERT INTO `memo` VALUES('', '$date', '$time')";
		$result = $this->db->query($sql);
		return true;
	}
	public function show_memo()
	{
		$date=date('d-m-Y', strtotime('now'-2));
		$sql = "SELECT * FROM `memo` ORDER BY `date` DESC LIMIT 50";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			$sqlmemo = "SELECT SUM(tk) as tk FROM sub_memo WHERE m_id='$data[id]'";
			$resultmemo = $this->db->query($sqlmemo);
			$datamemo = $resultmemo->fetch_array();

			$sqlcosts = "SELECT SUM(amount) as amount FROM costs WHERE m_id='$data[id]'";
			$resultcosts = $this->db->query($sqlcosts);
			$datacosts = $resultcosts->fetch_array();

			$cost = $datamemo['tk'] - $datacosts['amount'];

			if($date ==  $data['date'])
			{ 
			echo "<div class='table_details today_row_hilight'>
					<a href='todaymemo.php?id=$data[id]'><div class='title_d col-sm-3'>Today</div>
					<div class='date_d col-sm-3'>$data[time]</div>
					<div class='date_d col-sm-3'>$cost</div></a>
					<div class='edit_delete_d col-sm-3'><a href='memo.php?del=$data[id]&mmid=$data[id]'><img src='../img/icon_del.gif'></a></div>
					</div>";
			} 
			else 
			{ 
			echo "<div class='table_details'>
					<div class='title_d col-sm-3'><a href='todaymemo.php?id=$data[id]'>$data[date]</a></div>
					<div class='date_d col-sm-3'><a href='todaymemo.php?id=$data[id]'>$data[time]</a></div>
					<div class='date_d col-sm-3'><a href='todaymemo.php?id=$data[id]'>$cost</a></div>
					<div class='edit_delete_d col-sm-3'><a href='memo.php?del=$data[id]'><img src='../img/icon_del.gif'></a></div>
					</div>";
					 }
		}
	}

	public function delete_memo($id)
	{
		$sql = "DELETE FROM `memo` WHERE id = '$id'";
		$result = $this->db->query($sql);
		return true;
	}

	public function delete_cost_also($del)
	{
		$sql = "DELETE FROM `costs` WHERE m_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}
	
	public function delete_customer_also($del)
	{
		$sql = "DELETE FROM `add_customer` WHERE m_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function delete_sub_memo_also($mmid)
	{
		$sql = "DELETE FROM `sub_memo` WHERE m_m_id = '$mmid'";
		$result = $this->db->query($sql);
		return true;
	}

	public function create_costs($m_id, $title, $details, $amount, $time, $date)
	{
		if ($title == "") 
		{
			return false;
		}
		else
		{
			$sql = "INSERT INTO `costs` VALUES('', '$m_id', '$title', '$details', '$amount', '$time', '$date')";
			$result = $this->db->query($sql);
		}	return true;
	}

	public function update_costs($edit, $title, $details, $amount, $time, $date)
	{
		if ($title == "") 
		{
			return false;
		}
		else
		{
			$sql = "UPDATE `costs` SET title = '$title', details = '$details', amount = '$amount', time = '$time', ddate = '$date' WHERE id = '$edit'";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function delete_cost($del)
	{
		$sql = "DELETE FROM `costs` WHERE id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function show_from_edit($edit)
	{
		$sql = "SELECT * FROM `costs` WHERE id = '$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='title' value='$data[title]'>
						</label>
						<div id='name-message' class='message'></div>
					</div>

					<div class='form-group'>						
						<label class='input col-sm-12'>
							<input id='details' type='text' name='amount' value='$data[amount]'>
						</label>
					</div>

					<div class='form-group'>						
						<label class='input col-sm-12'>
							<input id='details' type='text' name='details' value='$data[details]'>
						</label>
					</div>
					<button type='update' class='btn btn-default submit' id='submit' name='update' >Update Your Cost</button>";
	}

	public function show_cost($m_id)
	{
		$sql = "SELECT * FROM costs WHERE m_id='$m_id'";
		$result = $this->db->query($sql);
		while ($data = $result->fetch_array()) 
		{
			echo "<div class='table_details'>
				<div class='cost col-sm-2'>$data[title]</div>
				<div class='cost col-sm-2'>$data[details]</div>
				<div class='cost col-sm-2'>$data[amount]</div>
				<div class='cost col-sm-2'>$data[ddate]</div>
				<div class='cost col-sm-2'>$data[time]</div>
				<div class='edit_delete_d col-sm-2'><a href='costs.php?id=$data[m_id]&edit=$data[id]'><img src='../img/edit.png' width='15px'></a> | <a href='costs.php?id=$data[m_id]&del=$data[id]'><img src='../img/icon_del.gif'></a></div>
			</div>";
		}
	}

	public function memo_show($m_id)
	{
		$sql = "SELECT * FROM `sub_memo` WHERE m_id = '$m_id' ORDER BY `time` DESC";
		$result = $this->db->query($sql);
		while ($row=$result->fetch_array())
		{		
			$sqlw = "SELECT items.title, sub_item.s_title, sub_sub_item.s_s_title FROM `items`, `sub_item`, `sub_sub_item` WHERE $row[items]=items.id AND $row[sub_item]=sub_item.s_id AND $row[sub_sub_item]=sub_sub_item.s_s_id";

			$resultw = $this->db->query($sqlw);
			$roww = $resultw->fetch_array();

			echo "<li id='cat' class='inp-brand col-sm-2'>			
					$roww[title]
				</li>

				<li class='inp-brand col-sm-2'>
					$roww[s_title]
				</li>

				<li class='inp-brand col-sm-2'>
					$roww[s_s_title]
				</li>

				<li class='inp-brand col-sm-1'>
					$row[quantity]
				</li>

				<li class='inp-brand col-sm-2'>
					$row[rate]
				</li>

				<li class='inp-brand col-sm-2'>
					$row[tk]
				</li>
				<li class='inp-brand edit col-sm-1'>
					<a href='#' class='edit' data-id='$row[id]'><img src='../img/edit.png' width='15px'></a> || <a href='' class='delete' data-id='$row[id]'><img src='../img/icon_del.gif'></a>
				</li>";
		}
	}

	public function customer_name($m_id)
	{
		$sql = "SELECT * FROM `add_customer` WHERE id = '$m_id'";
		$result = $this->db->query($sql);
		$row=$result->fetch_array();
		echo "<h4>Customer Name : $row[name]</h4>";
	}

	public function total_quantity($m_id)
	{
		$sql = "SELECT SUM(tk) as tk FROM sub_memo WHERE m_id='$m_id'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();

		$sqlq = "SELECT SUM(quantity) as quantity FROM sub_memo WHERE m_id='$m_id'";
		$resultq = $this->db->query($sqlq);
		$dataq = $resultq->fetch_array();

		echo "<div class='total-body col-sm-2'>
			Total Tk: $data[tk]
		</div>

		<div class='total-body col-sm-2'>
			Quantity: $dataq[quantity]
		</div>";
	}

	public function add_customer($mid, $name, $des ,$ddate, $time)
	{
		if($name == "")
		{
			echo "";
		}
		else
		{
			$sql = "INSERT INTO `add_customer` VALUES('', '$mid', '$name', '$des', '$ddate', '$time')";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function show_customer($mid)
	{
		$sql = "SELECT * FROM `add_customer` WHERE m_id = '$mid' ORDER BY `time` DESC";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			echo "<div class='table_details col-sm-12'>
				  <a href='customermemo.php?id=$data[id]&mmid=$data[m_id]'><div class='cus_row col-sm-3'>$data[name]</div>
				  <div class='cus_row col-sm-3'>$data[details]</div>
				  <div class='cus_row col-sm-2'>$data[ddate]</div>
				  <div class='cus_row col-sm-2'>$data[time]</div></a>
				  <div class='cus_row col-sm-2'><a href='todaymemo.php?id=$data[m_id]&del=$data[id]'><img src='../img/icon_del.gif'></a></div>
				  </div>";
		}
	}

	public function delete_customer($del)
	{
		$sql = "DELETE FROM add_customer WHERE id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function delete_customer_info_also($del)
	{
		$sql = "DELETE FROM sub_memo WHERE m_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function select_category()
	{
		$sql = "SELECT * FROM items";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			echo " <option value='$data[id]'>$data[title]</option>";
		}
	}

	public function show_today_or_not($m_id)
	{
		$sql = "SELECT * FROM `memo` WHERE id = '$m_id'";
		$result = $this->db->query($sql);
		$data=$result->fetch_array();
		$date=date('d-m-Y', strtotime('now'-2));
		if($data['date'] == $date)
		{
			echo "<h1>TO Day's Memo</h1>";
		}
		else
		{
			echo "<h1>$data[date] Memo</h1>";
		}
	}	
}
?>