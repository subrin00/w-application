<?php
include "../controllers/memo.php";
$memo = new memo;

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

if(isset($_GET['del']))
{
	$id = $_GET['id'];	
	$del = $_GET['del'];
	$delete = $memo->delete_customer($del);
	if($delete)
	{
		$delete_customer_info_also = $memo->delete_customer_info_also($del);
		header("Location:todaymemo.php?id=$id");
		$_SESSION['msg'] = "Customer Delete Successful";
	}
}
$cid = $_GET['id'];
if(isset($_POST['submit']))
{	
	extract($_POST);

	$mid = $_GET['id'];	
	
	$addcustomer = $memo->add_customer($mid,$name,$det,$ddate,$time);
	if($addcustomer)
	{
		header("Location:todaymemo.php?id=$mid");
		$_SESSION['msg'] = "Customer Create Successful";
	}
	else
	{
		$msg = "Please Enter A Customer Name";
	}
}
include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">
	<div class="headline"><?php $memo->show_today_or_not($cid); ?>
		<a href="costs.php?id=<?php echo "$cid"; ?>">Your Cost</a>
	</div>

	<div class="col-sm-12 cfrom">
	<h4>Add Your Customer</h4>
	<p class="session_msg f_none"><?php if(@$msg)
					{
						echo $msg;
						 if(@$_SESSION['msg'])
						 	{
						 		echo $_SESSION['msg']=""; 
						 	} 
						} 
						 ?>
					</p>	
		<form class="form-inline" action="" method="POST">
		    <div class="form-group">
			    <label for="cname">Name</label>
			    <input type="text" name="name" class="form-control" id="cname" placeholder="Customer Name">
		    </div>
		    <div class="form-group">
			    <label for="des">Details</label>
			    <input type="text" name="det" class="form-control" id="des" placeholder="Details">
		    </div>
		    <input type="hidden" name="ddate" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">

			<input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2));
echo $time; ?>">

		  <button type="submit" name="submit" class="btn btn-info csubmit">Add Customer</button>
		</form>
	</div>
	

	<div class="information_body co-md-12">
		<div class="table_head">
			<div class="brand-hed col-sm-3">Customer Name</div>
			<div class="sub-brand-hed col-sm-3">Details</div>
			<div class="items-hed col-sm-2">Date</div>
			<div class="quen-hed col-sm-2">Time</div>
			<div class="quen-hed col-sm-2">Action</div>
		</div>	
					 
			<?php $memo->show_customer($cid); ?>	
	</div>


</div>
<?php include 'layouts/footer.php'; ?>