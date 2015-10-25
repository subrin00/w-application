<?php
define("db_host", "127.0.0.1");
define("db_user", "root");
define("db_name", "gobs");
define("db_password", "");

$mysqli = new mysqli(db_host, db_user, db_password, db_name);
if(mysqli_connect_errno())
		{
			echo "database connect error";
			exit;
		}

session_start();
if(isset($_POST['update']))
{
	$insert_row = mysqli_query($mysqli, "UPDATE `sub_memo` SET `items` = '{$_POST['category']}', `sub_item` = '{$_POST['sub_category']}', `sub_sub_item` = '{$_POST['items']}', `quantity` = '{$_POST['f_quantity']}', `rate` = '{$_POST['rate']}', `tk` = '{$_POST['f_tk']}' WHERE id = '{$_POST['id']}'");
		
		$_SESSION['msg'] = "Update Customer Memo Successful";
		echo 0;
		exit();
}

if(isset($_POST['edit']))
{
	$sql = mysqli_query($mysqli, "SELECT * FROM `sub_memo` WHERE id = '{$_POST['id']}'");
	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
	header("Content-type: text/x-json");
	echo json_encode($row);
	exit();
}

if(isset($_POST['delete']))
{
	$sql = mysqli_query($mysqli, "DELETE FROM `sub_memo` WHERE id = '{$_POST['id']}'");
	$_SESSION['msg'] = "Delete Customer Memo Successful";
	exit();
}

if(isset($_POST['saverecord']))
{	
	$insert_row = mysqli_query($mysqli, "INSERT INTO `sub_memo` (`m_id`, `items`, `sub_item`, `sub_sub_item`, `quantity`, `rate`, `tk`, `ddate`, `time`, `m_m_id`) VALUES ('{$_POST['mid']}', '{$_POST['category']}', '{$_POST['sub_category']}', '{$_POST['items']}', '{$_POST['f_quantity']}', '{$_POST['rate']}', '{$_POST['f_tk']}', '{$_POST['date']}', '{$_POST['time']}', '{$_POST['mmid']}')");		
		
		$_SESSION['msg'] = "Customer Memo Create Successful";
		echo 0;
		exit();
}