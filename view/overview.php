<?php
include "../controllers/dashbord_overview.php";
$over = new overview;

session_start();
$username = $_SESSION['username'];
$stat = $_SESSION['stat'];
$admin = $_SESSION['admin'];
$pic = $_SESSION['pic'];

if($admin == "")
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}
elseif($stat == 0 || $stat == "")
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Inactive Admin";
}
elseif($admin == 1 || $admin == 2 || $admin == 3)
{
	echo "&nbsp;";
}
else
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}
include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">
<?php $over->total_overview(); ?>

    
    <div class="col-sm-12"><h2 class="col-sm-8 none">To Day Sell</h2> <h2>To Day Cost</h2></div>
	<div class="information_body col-sm-7 none">
		<div class="table_head">
			<div class="brand-hed col-sm-2">Cat</div>
			<div class="sub-brand-hed col-sm-2">S_Cat</div>
			<div class="items-hed col-sm-2">Items</div>
			<div class="quen-hed col-sm-2">Quan</div>
			<div class="tk-hed col-sm-2">TK</div>
			<div class="tk-hed col-sm-2">Time</div>
		</div>
		<?php $over->to_day_post(); ?>
	</div>

	<div class="information_body col-sm-4 none today_cost">
		<div class="table_head">
			<div class="brand-hed col-sm-4">Title</div>
			<div class="sub-brand-hed col-sm-3">Amount</div>
			<div class="items-hed col-sm-5">Time</div>
		</div>
		<?php $over->to_day_cost(); ?>
	</div>
	
	<?php $over->total_to_day(); ?>

</div>

<?php include 'layouts/footer.php'; ?>