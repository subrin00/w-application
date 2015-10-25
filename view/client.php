<?php
include '../controllers/bank_and_customer.php';
$client = new bankandcustomer;

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

if(isset($_GET['edit']))
{
	if(isset($_POST['update']))
	{
		$edit = $_GET['edit'];
		extract($_POST);

		$update = $client->update_client_list($edit,$name,$details,$date,$time);

		if($update)
		{
			header("Location:client.php");
			$_SESSION['msg'] = "Client Name Update Successful";
		}
		else
		{
			$msg = "Client Name Update Fail";
		}
	}
}
elseif(isset($_GET['del']))
{
	$del = $_GET['del'];
	$delete = $client->delete_client_list($del);
	if($delete)
	{
		$del_client_info_also = $client->del_client_info_also($del);
		header("Location:client.php");
		$_SESSION['msg'] = "Client Delete Successful";
	}
}
else
{
	if(isset($_POST['submit']))
	{
	extract($_POST);
	$clientname = $client->create_client_name($name,$details,$date,$time);

		if($clientname)
		{
			header("Location:client.php");
			$_SESSION['msg'] = "Client Name Create Successful";
		}
		else
		{
			$msg = "Please Enter A Client Name";
		}
	}
}

include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>

<div class="main_body">

<p class="session_msg f_none col-sm-12"><?php if(@$msg)
					{
						echo $msg;
						 if(@$_SESSION['msg'])
						 	{
						 		echo $_SESSION['msg']=""; 
						 	} 
						} 
						 ?>
					</p>

	<div class="col-sm-12" id="contact-background">

		<!-------- starting Headline-------->
		<div class="form-head col-sm-12">
		<h1>Client Name</h1>
		</div>

		<div class="col-sm-12 contact-form-message">

		<form action="" method="POST">
		<?php
		if(isset($_GET['edit']))
		{
			$edit = $_GET['edit'];
			$client->show_update_client_list($edit);
		}
		else
		{
			echo "<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='name' placeholder='Client Name'>
				</label>
			</div>

			<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='details' placeholder='Client Details'>
				</label>
			</div>";
		}
	?>

			<input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
	echo $date; ?>">

			<input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2));
	echo $time; ?>">

		<?php if(isset($_GET['edit']))
		{
			echo "<button type='submit' class='btn btn-info info' id='submit' name='update'>Update Client</button>";
		}
		else
		{
			echo "<button type='submit' class='btn btn-info info' id='submit' name='submit'>Add A Client Name</button>";
		}
		?>
		</form>
		</div>
	</div>

	<h4>Your Client's</h4>
	<div class="information_body col-sm-12 none_for_from">
		<div class="table_head">
			<div class="title col-sm-2">Client Name</div>
			<div class="title col-sm-4">Details</div>
			<div class="date col-sm-2">Date</div>
			<div class="date col-sm-2">Time</div>
			<div class="date col-sm-2">Action</div>
		</div>
		<?php $client->show_client_list(); ?>
	</div>
</div>

<?php include 'layouts/footer.php'; ?>