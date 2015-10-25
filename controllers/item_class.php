<?php
	include('db.php');

	class item
	{
		public $db;
		public function __construct()
		{
			$this->db = new mysqli(db_host, db_user, db_password, db_name);
			if(mysqli_connect_errno())
			{
				echo "Database connect fail";
				exit;
			} 
		}

		public function create_item($title, $date)
		{
			if($title == "")
			{
				return false;
			}
			else
			{
				$sql = "INSERT INTO `items` VALUES('','$title','$date')";
				$query = $this->db->query($sql);
			}	return true;
		}

		public function update_item($id, $title, $item_date)
		{
			if ($title == "") 
			{
				return false;			
			}
			else
			{
				$sql = "UPDATE `items` SET title = '$title', date='$item_date' WHERE id = '$id'";
				$result = $this->db->query($sql);
				return true ; 
			}
		}

		public function show_items_title($id)
		{
			$sql = "SELECT * FROM `items` WHERE id = '$id'";
			$result = $this->db->query($sql);
			$data = $result->fetch_array();
			echo $data['title'];
		}

		// public function delete_item($del)
		// {
		// 	$sql = "DELETE FROM items.*, sub_item.*, sub_sub_item.*, goods_in.* USING items INNER JOIN sub_item INNER JOIN sub_sub_item INNER JOIN goods_in WHERE items.id = '$del' AND sub_item.i_id = items.id AND sub_sub_item.s_id = sub_item.s_id AND goods_in.s_s_id = sub_sub_item.s_s_id ";
		// 	$result = $this->db->query($sql);
		// 	return true;
		// }

		public function delete_item($del)
		{
			$sql = "DELETE FROM items WHERE id = '$del'";
			$result = $this->db->query($sql);
			return true;
		}

		public function delete_sub_item_also($del)
		{
			$sql = "DELETE FROM sub_item WHERE mid = '$del'";
			$result = $this->db->query($sql);
			return true;
		}

		public function delete_sub_sub_item_also($del)
		{
			$sql = "DELETE FROM sub_sub_item WHERE mid = '$del'";
			$result = $this->db->query($sql);
			return true;
		}

		public function del_goods_also($del)
		{
			$sql = "DELETE FROM goods_in WHERE mid = '$del'";
			$result = $this->db->query($sql);
			return true;
		}

		public function delete_sub_sub_item_with_sub_also($del)
		{
			$sql = "DELETE FROM sub_sub_item WHERE s_id = '$del'";
			$result = $this->db->query($sql);
			return true;
		}

		public function del_goods_with_sub_also($cid)
		{
			$sql = "DELETE FROM goods_in WHERE sid = '$cid'";
			$result = $this->db->query($sql);
			return true;
		}

		public function show_items()
		{
			$sql = "SELECT * FROM `items`";
			$result = $this->db->query($sql);
			while($data = $result->fetch_array())
			{
				echo "<a href='item_details.php?mid=$data[id]&id=$data[id]'><div class='table_details'>
					<div class='title_d col-sm-4'><li>$data[title]</li></div>
					<div class='date_d col-sm-4'><li>$data[date]</div></li></a>
					<div class='edit_delete_d col-sm-4'><a href='item.php?id=$data[id]&edit=$data[id]'><img src='../img/edit.png' width='15px'></a> || <a href='item.php?id=$data[id]&del=$data[id]'><img src='../img/icon_del.gif'></a></div>
					</div>";
			}
		}
		public function single_item($id, $mid)
		{
			$sql = "SELECT * FROM `items` WHERE id='$id'";
			$result = $this->db->query($sql);
			$data = $result->fetch_array();
			echo "<a href='item.php'>Category Type</a> : <a href='item_details.php?mid=$mid&id=$data[id]'>$data[title]</a>";
		}

		public function create_sub_item($i_id, $s_title, $details, $date, $mid)
		{
			if ($s_title == "") 
			{
				return false;
			}
			else
			{
				$sql="insert into sub_item values('', '$i_id', '$s_title', '$details', '$date', '$mid')";
				$result = $this->db->query($sql);
				return true;
			}
		}

		public function update_sub_item($id, $title, $details, $date, $mid)
		{
			if ($title == "") 
			{
				return false;
			}
			else
			{
				$sql = "UPDATE `sub_item` SET s_title = '$title', details = '$details', date = '$date', mid = '$mid' WHERE s_id = '$id'";
				$result = $this->db->query($sql);
				return true;
			}
		}

		public function show_update_sub_item($id)
		{
			$sql = "SELECT * FROM `sub_item` WHERE s_id = '$id'";
			$result = $this->db->query($sql);
			$data = $result->fetch_array();
			{
				echo "<label class='input col-sm-12'>
							<input id='name' type='text' name='title' value='$data[s_title]'>
						</label>
					</div>

					<div class='form-group'>						
						<label class='input col-sm-12'>
							<input id='details' type='text' name='details' value='$data[details]'>
						</label>
					</div>";
			}
		}

		public function delete_sub_item($del)
		{
			$sql = "DELETE FROM `sub_item` WHERE s_id = '$del'";
			$result = $this->db->query($sql);
			return true;
		}

		public function show_sub_item($id, $mid)
		{
			$sql = "SELECT * FROM `sub_item` WHERE i_id='$id'";
			$result = $this->db->query($sql);
			while($data = $result->fetch_array())
			{
				echo "<a href='sub_item_single.php?mid=$mid&id=$data[s_id]'><div class='table_details'>
					<div class='title_d col-sm-4'>$data[s_title]</div>
					<div class='date_d col-sm-4'>$data[date]</div></a>
					<div class='edit_delete_d col-sm-4'><a href='item_details.php?mid=$mid&id=$data[i_id]&edit=$data[s_id]'><img src='../img/edit.png' width='15px'></a> | <a href='item_details.php?mid=$mid&cid=$data[s_id]&id=$data[i_id]&del=$data[s_id]'><img src='../img/icon_del.gif'></a></div>
					</div>";
			}
		}
	}
?>