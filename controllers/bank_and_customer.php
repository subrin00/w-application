<?php
 
include 'db.php';

class bankandcustomer
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

	public function create_bank_name($name, $actype, $details, $date, $time)
	{
		if($name == "")
		{
			return false;
		}
		else
		{
			$sql = "INSERT INTO `bank_name` VALUES('', '$name', '$actype', '$details', '$date', '$time')";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function show_bank_list()
	{
		$sql = "SELECT * FROM `bank_name`  ORDER BY `date` DESC";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			echo "<div class='table_details'>
				<a href='bank_details.php?id=$data[id]'><div class='cost col-sm-2'>$data[name]</div>
				<div class='cost col-sm-2'>$data[ac_type]</div>
				<div class='cost col-sm-2'>$data[details]</div>
				<div class='cost col-sm-2'>Amount</div>
				<div class='cost col-sm-1'>$data[date]</div>
				<div class='cost col-sm-2'>$data[time]</div></a>
				<div class='date col-sm-1'><a href='bank.php?edit=$data[id]'><img src='../img/edit.png' width='15px'></a></a> || <a href='bank.php?del=$data[id]'><img src='../img/icon_del.gif'></a></div>
			</div>";
		}
	}

	public function update_bank_list($edit, $name, $actype, $details, $time, $date)
	{
		if($name == "")
		{
			return false;
		}
		else
		{
			$sql = "UPDATE `bank_name` SET name = '$name', ac_type = '$actype', details = '$details', date = '$date', time = '$time' WHERE id = '$edit'";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function show_update_bank_list($edit)
	{
		$sql = "SELECT * FROM `bank_name` WHERE id = '$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='name' value='$data[name]'>
				</label>
			</div>

			<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='actype' value='$data[ac_type]'>
				</label>
			</div>

			<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='details' value='$data[details]'>
				</label>
			</div>";
	}

	public function delete_bank_list($del)
	{		
		$sql = "DELETE FROM `bank_name` WHERE id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function delete_bank_info_also($del)
	{		
		$sql = "DELETE FROM `bank_info` WHERE b_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function add_bank_info($bid,$acname,$acnumber,$deposit,$withdrawal,$details,$date,$time)
	{
		$sql = "INSERT INTO `bank_info` VALUES('', '$bid', '$acname', '$acnumber', '$deposit', '$withdrawal', '$details', '$date', '$time')";
		$result = $this->db->query($sql);
		return true;
	}

	public function show_bank_name($mid)
	{
		$sql = "SELECT * FROM `bank_name` WHERE id = '$mid'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "Bank: $data[name], Account Type: $data[ac_type]";
	}

	public function show_bank_info_list($mid)
	{
		$sql = "SELECT * FROM `bank_info` WHERE b_id = '$mid' ORDER BY `date` DESC";
		$result = $this->db->query($sql);
		while ($data = $result->fetch_array()) 
		{
			echo "<li id='cat' class='inp-brand col-sm-2'>			
					$data[acname]
				</li>

				<li class='inp-brand col-sm-2'>
					$data[acnum]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[deposit]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[withdrawal]
				</li>

				<li class='inp-brand col-sm-2'>
					$data[details]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[date]
				</li>

				<li class='inp-brand col-sm-2'>
					$data[time]
				</li>

				<li class='inp-brand col-sm-1'>
					<a href='#' class='edit' data-id='$data[id]'><img src='../img/edit.png' width='15px'></a> || <a href='' class='delete' data-id='$data[id]'><img src='../img/icon_del.gif'></a>
				</li>";
		}
	}

	public function show_bank_info_quantity($yid)
	{
		$sql = "SELECT SUM(deposit) AS deposit, SUM(withdrawal) AS withdrawal FROM bank_info WHERE b_id = '$yid'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();

		$totalTk = $data['deposit']- $data['withdrawal'];

		echo "<div class='total-body col-sm-2'>
					Total Tk: $totalTk
				</div>";
	}

	public function create_client_name($name,$details,$date,$time)
	{
		if($name == "")
		{
			return false;
		}
		else
		{
			$sql = "INSERT INTO `add_client` VALUES('', '$name', '$details', '$date', '$time')";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function show_client_list()
	{
		$sql = "SELECT * FROM `add_client`  ORDER BY `date` DESC";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			echo "<div class='table_details'>
				<a href='client_details.php?id=$data[id]'><div class='cost col-sm-2'>$data[name]</div>
				<div class='cost col-sm-4'>$data[details]</div>
				<div class='cost col-sm-2'>$data[date]</div>
				<div class='cost col-sm-2'>$data[time]</div></a>
				<div class='date col-sm-2'><a href='client.php?edit=$data[id]'><img src='../img/edit.png' width='15px'></a></a> || <a href='client.php?del=$data[id]'><img src='../img/icon_del.gif'></a></div>
			</div>";
		}
	}

	public function show_update_client_list($edit)
	{
		$sql = "SELECT * FROM `add_client` WHERE id = '$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='name' value='$data[name]'>
				</label>
			</div>

			<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='details' value='$data[details]'>
				</label>
			</div>";
	}

	public function update_client_list($edit,$name,$details,$date,$time)
	{
		if($name == "")
		{
			return false;
		}
		else
		{
			$sql = "UPDATE `add_client` SET name = '$name', details = '$details', date = '$date', time = '$time' WHERE id = '$edit'";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function delete_client_list($del)
	{
		$sql = "DELETE FROM add_client WHERE id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function del_client_info_also($del)
	{
		$sql = "DELETE FROM client_details WHERE c_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function create_client_info_list($cid,$item,$quantity,$ttk,$paytk,$bank_info,$details,$date,$time)
	{
		$sql = "INSERT INTO `client_details` VALUES('', '$cid', '$item', '$quantity', '$ttk', '$paytk', '$bank_info', '$details', '$date', '$time')";
		$result = $this->db->query($sql);
		return true;
	}

	public function show_client_info_list($mid)
	{
		$sql = "SELECT * FROM `client_details` WHERE c_id = '$mid'  ORDER BY `date` DESC";
		$result = $this->db->query($sql);
		while ($data = $result->fetch_array()) 
		{
			echo "<li id='cat' class='inp-brand col-sm-2'>			
					$data[item]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[quantity]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[ttk]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[paytk]
				</li>

				<li class='inp-brand col-sm-2'>
					$data[bank_info]
				</li>

				<li class='inp-brand col-sm-2'>
					$data[details]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[date]
				</li>

				<li class='inp-brand col-sm-1'>
					$data[time]
				</li>

				<li class='inp-brand col-sm-1'>
					<a href='#' class='editc' data-id='$data[id]'><img src='../img/edit.png' width='15px'></a> || <a href='' class='deletec' data-id='$data[id]'><img src='../img/icon_del.gif'></a>
				</li>";
		}
	}
	public function show_client_name($mid)
	{
		$sql = "SELECT * FROM `add_client` WHERE id = '$mid'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "$data[name]";
	}

	public function show_client_info_quantity($c_id)
	{
		$sql = "SELECT SUM(ttk) AS ttk, SUM(paytk) AS paytk FROM `client_details` WHERE c_id = '$c_id'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		$total = $data['ttk']-$data['paytk'];
		echo "<div class='total-body col-sm-4'>
				Due To Payment : $total
				</div>";
	}
}
