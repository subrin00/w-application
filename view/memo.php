<?php
include "../controllers/memo.php";

session_start();
$username = $_SESSION['username'];
$stat = $_SESSION['stat'];
$admin = $_SESSION['admin'];
$pic = $_SESSION['pic'];
@$msg = $_SESSION['msg'];

if($admin == 3 || $admin == "")
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}
elseif($stat == 0 || $stat == "")
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Inactive Admin";
}
elseif($admin == 1 || $admin == 2)
{
	echo "&nbsp;";
}
else
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}


$memo = new memo;
if(isset($_GET['del']))
{
	$del = $_GET['del'];
	$mmid = $_GET['mmid'];
	$delete = $memo->delete_memo($del);

	if($delete)
	{
		$delete_cost_also = $memo->delete_cost_also($del);
		$delete_customer_also = $memo->delete_customer_also($del);
		if($delete_customer_also)
		{
			$delete_sub_memo_also = $memo->delete_sub_memo_also($mmid);
			header("Location:memo.php");
			$_SESSION['msg'] = "Memo Delete Successfull";
		}
	}
	else
	{
		$msg = "Memo Delete Fail";
	}
}

if(isset($_POST['submit']))
{
	extract($_POST);
	$create = $memo->memo($date, $time);
	if($create)
	{
		header('Location:memo.php');
		$_SESSION['msg'] = "Memo Create Successful";
	}
	else
	{
		$msg = "Memo Create Fail";
	}
}
include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">
	<div class="headline"><h1>Memo</h1>
	<form action="" method="post">
		<input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">

		<input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2));
echo $time; ?>">
	<button type="submit" class="btn btn-info info" id="submit" name="submit">Add To Day's Memo</button>	
	</form>
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
	</div>


	<div class="information_body">
		<div class="table_head">
			<div class="title col-sm-3">Date</div>
			<div class="date col-sm-3">Time</div>
			<div class="edit_delete col-sm-3">Total Tk</div>
			<div class="edit_delete col-sm-3">Action</div>
		</div>
		<?php $memo->show_memo(); ?>
	</div>
</div>
<?php include 'layouts/footer.php'; ?>