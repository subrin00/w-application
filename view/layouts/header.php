<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Company Name</title>
	<link rel="icon" size="40x40" href="../img/logo.png">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script type="text/javascript" src="../script/jquery-1.11.3.min.js"></script>
	
</head>
<body leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div class="top_head">
	<div class="top-one col-sm-6"><p><img src="../img/logo.png" width="40px"><span>Company Name</span></p></div>
	<div class="top-two col-sm-6"><p><?php if($username) { echo $username; } else{ echo "User Name"; } ?> <img src="<?php if($pic == '../img/'){ echo "../img/user.png"; }else{ echo $pic; } ?>" width="40px"></p>
	<div class="log_out">
		<li class="col-sm-12">
			<a class="logout" href="dashboard.php">Dashbord</a>
		</li>
		<li class="col-sm-12">
			<a class="logout" href="admin.php">Admin List</a>
		</li>
		<li class="col-sm-12">
			<a class="logout" href="Registration.php">Registration</a>
		</li>
		<li class="col-sm-12">
			<a class="logout" href="get/logout.php">Logout</a>
		</li>
	</div>
	</div>
</div>
<!-- <a href="javascript:history.back(1)">Back</a> -->