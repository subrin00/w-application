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
if(isset($_POST['edit']))
{
	$sql = mysqli_query($mysqli, "SELECT * FROM `bank_info` WHERE id = '{$_POST['id']}'");
	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
	header("Content-type: text/x-json");
	echo json_encode($row);
	exit();
}

if(isset($_POST['update']))
{
	$insert_row = mysqli_query($mysqli, "UPDATE `bank_info` SET `acname` = '{$_POST['acname']}', `acnum` = '{$_POST['acnumber']}', `deposit` = '{$_POST['deposit']}', `withdrawal` = '{$_POST['withdrawal']}', `details` = '{$_POST['details']}' WHERE id = '{$_POST['id']}'");
		if($insert_row)
		{
			$_SESSION['msg'] = "Bank Information Update Successful";
		}
		echo 0;
		exit();
}

if(isset($_POST['delete']))
{
	$sql = mysqli_query($mysqli, "DELETE FROM `bank_info` WHERE id = '{$_POST['id']}'");
	if($sql)
		{
			$_SESSION['msg'] = "Bank Information Delete Successful";
		}
	exit();
}





if(isset($_POST['editc']))
{
	$sql = mysqli_query($mysqli, "SELECT * FROM `client_details` WHERE id = '{$_POST['id']}'");
	$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
	header("Content-type: text/x-json");
	echo json_encode($row);
	exit();
}

if(isset($_POST['updatec']))
{
	$insert_row = mysqli_query($mysqli, "UPDATE `client_details` SET `item` = '{$_POST['item']}', `quantity` = '{$_POST['quantit']}', `ttk` = '{$_POST['ttk']}', `paytk` = '{$_POST['paytk']}', `bank_info` = '{$_POST['bank_info']}', `details` = '{$_POST['details']}' WHERE id = '{$_POST['id']}'");
		if($insert_row)
		{
			$_SESSION['msg'] = "Client Information Update Successful";
		}
		echo 0;
		exit();
}

if(isset($_POST['deletec']))
{
	$sql = mysqli_query($mysqli, "DELETE FROM `client_details` WHERE id = '{$_POST['id']}'");
	if($sql)
		{
			$_SESSION['msg'] = "Client Information Delete Successful";
		}
	exit();
}
