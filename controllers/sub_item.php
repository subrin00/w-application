<?php

include 'db.php';

class sub_items
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
	
	public function show_sub_item_single($id, $mid)
	{
		$sql = "SELECT * FROM `sub_item` WHERE s_id='$id'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();

		$sqlt = "SELECT * FROM `items` WHERE id='$data[i_id]'";
		$resultt = $this->db->query($sqlt);
		$datat = $resultt->fetch_array();

		echo "<a href='item.php'>Category Type</a> : <a href ='item_details.php?mid=$mid&id=$datat[id]'>$datat[title]</a> >> <a href ='sub_item_single.php?mid=$mid&id=$data[s_id]'>$data[s_title]</a>";
	}
	public function create_sub_sub_item($s_id, $s_s_title, $time, $date, $mid)
	{
		if ($s_s_title == "") 
		{
			return false;
		}
		else
		{
			$sql = "insert into sub_sub_item values('', '$s_id', '$s_s_title', '$time', '$date', '$mid')";
			$result = $this->db->query($sql);
			return true;
		}
	}
	public function show_sub_sub_item($id, $mid)
	{
		$sql = "select * from sub_sub_item where s_id=$id";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{
			$single = $data['s_s_id'];
			echo "<div class='table_details'>
					<a href='sub_sub_single.php?mid=$mid&cid=$id&id=$single'><div class='title_d col-sm-4'>$data[s_s_title]</div>
					<div class='date_d col-sm-4'>$data[date]</div></a>
					<div class='edit_delete_d col-sm-4'><a href='sub_item_single.php?mid=$mid&id=$data[s_id]&edit=$data[s_s_id]'><img src='../img/edit.png' width='15px'></a> | <a href='sub_item_single.php?mid=$mid&id=$data[s_id]&del=$data[s_s_id]'><img src='../img/icon_del.gif'></a></div>
					</div>";
		}
	}

	public function update_sub_sub_item($edit, $s_s_title, $time, $date)
	{
		if ($s_s_title == "") 
		{
			return false;
		}
		else
		{
			$sql = "UPDATE `sub_sub_item` SET s_s_title = '$s_s_title', time = '$time', date = '$date' WHERE s_s_id = '$edit'";
			$result = $this->db->query($sql);
			return true;
		}
	}

	public function update_show_sub_sub_item($edit)
	{
		$sql = "SELECT * FROM `sub_sub_item` WHERE s_s_id = '$edit'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='s_s_title' value='$data[s_s_title]'>
						</label>
					</div>";
	}

	public function delete_sub_sub_item($del)
	{
		$sql = "DELETE FROM `sub_sub_item` WHERE s_s_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function delete_goods_with_sub_sub_also($del)
	{
		$sql = "DELETE FROM `goods_in` WHERE s_s_id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}

	public function sub_sub_single($id)
	{
		$sql = "select * from sub_sub_item where s_s_id=$id";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		{
			echo "<ul>";
			echo "<li>$data[s_s_title]</li>";
			echo "<li>$data[details]</li>";
			echo "</ul>";
		}
	}
}
?>