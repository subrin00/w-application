<?php
include "../controllers/auth.php";
$auth = new auth;

session_start();
$username = $_SESSION['username'];
$stat = $_SESSION['stat'];
$admin = $_SESSION['admin'];
$pic = $_SESSION['pic'];
@$msg = $_SESSION['msg'];

if($admin == 2 || $admin == 3 || $admin == "")
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}
elseif($stat == 0 || $stat == "")
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Inactive Admin";
}
elseif($admin == 1)
{
	echo "&nbsp;";
}
else
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}

if(isset($_GET['del']))
{
	$del = $_GET['del'];
	$auth->auth_delete($del);
	if($del)
	{
		header("Location:http://localhost/gobs/view/admin.php");
		$_SESSION['msg'] = "Admin Delete Successful";
	}
	else
	{
		$msg = "Admin Delete Fail";
	}
}

include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">
	<div class="headline"><h1>Admin List</h1>
	<a href="http://localhost/gobs/view/Registration.php">Create A Admin</a>
	</div>

	<p class="session_msg f_none col-sm-11"><?php if(@$msg)
					{
						echo $msg;
						 if(@$_SESSION['msg'])
						 	{
						 		echo $_SESSION['msg']=""; 
						 	} 
						} 
						 ?>
					</p>

	<div class="information_body">
		<div class="table_head">
			<div class="title col-sm-2">User Name</div>
			<div class="title col-sm-1">First Name</div>
			<div class="title col-sm-1">Last Name</div>
			<div class="title col-sm-1">Gender</div>
			<div class="title col-sm-1">Date Of Birth</div>
			<div class="title col-sm-2">Email</div>
			<div class="title col-sm-1">Admin</div>
			<div class="title col-sm-1">Status </div>
			<div class="title col-sm-1">Picture</div>
			<div class="title col-sm-1">Action</div>
		</div>
		<?php $auth->show_admin_list(); ?>
	</div>
</div>
<?php include 'layouts/footer.php'; ?>