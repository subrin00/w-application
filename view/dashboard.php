<?php
include_once"../controllers/dashbord_overview.php";
$overview = new overview;

session_start();
$username = $_SESSION['username'];
$stat = $_SESSION['stat'];
$admin = $_SESSION['admin'];
$pic = $_SESSION['pic'];

if ($admin == "") 
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized";
}
elseif($stat == 0 || $stat == "") 
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Inactive Admin";
}
elseif ($admin == 2 || $admin == 3) 
{
	header("Location:http://localhost/gobs/view/overview.php");
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
include "layouts/header.php";
include "layouts/sidebar_layout.php";
?>

<div class="main_body">
	<div class="form-head"><h1>DashBord</h1><h4>All Of Your Total Information</h4>
	</div>

	<div class="information_body none_for_from col-sm-12">
		<div class="table_head">
			<div class="title col-sm-2">Goods On House</div>
			<div class="title col-sm-2">Bank Account</div>
			<div class="title col-sm-2">Bank Balance</div>
			<div class="title col-sm-2">Client</div>
			<div class="title col-sm-2">Client's Due</div>
			<div class="title col-sm-2">Today Your Hand</div>
		</div>
		<?php $overview->dashbord(); ?>
	</div>
</div>

<?php include 'layouts/footer.php'; ?> 