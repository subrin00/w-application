<?php
include "../controllers/sub_sub_item.php";
$sub_sub_item = new sub_sub_items;

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
	<div class="headline"><h1>All Of Your Good's</h1>
	</div>

	<div class="information_body">
		<div class="table_head">
			<div class="title col-sm-3">Category</div>
			<div class="date col-sm-3">Sub-Category</div>
			<div class="title col-sm-3">Item's</div>
			<div class="date col-sm-3">Good's On Your House</div>
		</div>
		<?php $sub_sub_item->show_sub_sub_item();
			$sub_sub_item->total_goods_overview(); ?>
	</div>
</div>
<?php include 'layouts/footer.php'; ?>