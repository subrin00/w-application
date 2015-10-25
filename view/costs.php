<?php 
include "../controllers/memo.php";
$item = new memo;

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

if(isset($_GET['edit']))
{
	if(isset($_POST['update']))
	{
		$edit = $_GET['edit'];
		$id = $_GET['id'];
		extract($_POST);

		$update = $item->update_costs($edit, $title, $details, $amount, $time, $date);

		if($update)
		{
			header("Location:costs.php?id=$id");
			$_SESSION['msg'] = "Update Successful";
		}
		else
		{
			$msg = "Update Fail";
		}
	}
}
elseif (isset($_GET['del'])) 
{
		$del = $_GET['del'];
		$id = $_GET['id'];

		$delete = $item->delete_cost($del);

		if($delete)
		{
			header("Location:costs.php?id=$id");
			$_SESSION['msg'] = "Delete Successful";
		}
		else
		{
			$msg = "Delete Fail";
		}
}
else
{
	if(isset($_POST['submit']))
	{
		extract($_POST);
		$m_id = $_GET['id'];

		$create = $item->create_costs($m_id, $title, $details, $amount, $time, $date);

		if($create)
		{
			header("Location:costs.php?id=$m_id");
			$_SESSION['msg'] = "Cost Item Create Successful";
		}
		else
		{
			$msg = "Please Enter A Cost Title";
		}
	}
}
	include 'layouts/header.php';
	include 'layouts/sidebar_layout.php';
?>

<div class="main_body">
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
<!-------- starting form body-------->
			<div class="col-sm-12" id="contact-background">

				<!-------- starting Headline-------->				
				<div class="form-head col-sm-12">
				<a href="todaymemo.php?id=<?php echo $_GET['id']; ?>"><span class="go_back"><img src="../img/goback.png" width="50px"></span></a>
					<h1>Cost Details</h1>
				</div>
				<!-------- end Headline-------->

				<!-------- starting Form-------->
				<div class="col-sm-12 contact-form-message">
	 				<form action="#" method="post">

	 				<?php 
	 				if(isset($_GET['edit']))
	 				{
	 					$edit = $_GET['edit'];
	 					$item->show_from_edit($edit);
	 				} 
	 				else {?>
	 				<div class="form-group">
	 					<label class="input col-sm-12">
							<input id="name" type="text" name="title" placeholder="Title">
						</label>
						<div id="name-message" class="message"></div>
					</div>

					<div class="form-group">						
						<label class="input col-sm-12">
							<input id="details" type="text" name="amount" placeholder="Amount">
						</label>
					</div>

					<div class="form-group">						
						<label class="input col-sm-12">
							<input id="details" type="text" name="details" placeholder="Details">
						</label>
					</div>					

						<button type="submit" class="btn btn-default submit" id="submit" name="submit" >Add Your Cost</button>
				    <?php } ?>

				    <input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">

					<input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2));
echo $time; ?>">
				    </form>
	 			</div>
	 			<!-------- end form-------->
			</div>
			<!-------- end form body-------->


		<h4>Cost List</h4>		
		<div class="information_body none_for_from col-md-12">
			<div class="table_head">
				<div class="brand-hed col-sm-2">Title</div>
				<div class="quen-hed col-sm-2">Details</div>
				<div class="rate-hed col-sm-2">Amount</div>
				<div class="tk-hed col-sm-2">Date</div>			
				<div class="sub-brand-hed col-sm-2">Time</div>
				<div class="sub-brand-hed col-sm-2">Action</div>
			</div>
			<?php if(isset($_GET['id'])){ $m_id = $_GET['id']; $item->show_cost($m_id); } ?>
		</div>
</div>
<?php include 'layouts/footer.php'; ?>