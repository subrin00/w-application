<?php
include '../controllers/bank_and_customer.php';
$bank = new bankandcustomer;

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

		$update = $bank->update_bank_list($edit, $name, $actype, $details, $time, $date);

		if($update)
		{
			header("Location:bank.php");
			$_SESSION['msg'] = "Update Successful";
		}
		else
		{
			$msg = "Update Fail";
		}
	}
}
elseif(isset($_GET['del']))
{
	$del = $_GET['del'];
	$delete = $bank->delete_bank_list($del);
	if($delete)
	{
		$del_bank_info = $bank->delete_bank_info_also($del);
		header("Location:bank.php");
		$_SESSION['msg'] = "Delete Successful";
	}
}
else
{
	if(isset($_POST['submit']))
	{
	extract($_POST);
	$bankname = $bank->create_bank_name($name,$actype,$details,$date,$time);

		if($bankname)
		{
			header("Location:bank.php");
			$_SESSION['msg'] = "Bank Name Create Successful";
		}
		else
		{
			$msg = "Please Enter A Bank Name";
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
	<div class="col-sm-12" id="contact-background">

		<!-------- starting Headline-------->
		<div class="form-head col-sm-12">
		<h1>Bank Name</h1>
		</div>

		<div class="col-sm-12 contact-form-message">

		<form action="" method="POST">
		<?php
		if(isset($_GET['edit']))
		{
			$edit = $_GET['edit'];
			$bank->show_update_bank_list($edit);
		}
		else
		{
			echo "<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='name' placeholder='Bank Name'>
				</label>
			</div>

			<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='actype' placeholder='Bank Account Type'>
				</label>
			</div>

			<div class='form-group'>
	 			<label class='input col-sm-12'>
					<input id='name' type='text' name='details' placeholder='Bank Details'>
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
			echo "<button type='submit' class='btn btn-info info' id='submit' name='update'>Update Bank</button>";
		}
		else
		{
			echo "<button type='submit' class='btn btn-info info' id='submit' name='submit'>Add A Bank Name</button>";
		}
		?>
		</form>
		</div>
	</div>

	<h4>Your Bank Account's</h4>
	<div class="information_body col-sm-12 none_for_from">
		<div class="table_head">
			<div class="title col-sm-2">Bank Name</div>
			<div class="title col-sm-2">AC Type</div>
			<div class="title col-sm-2">Details</div>
			<div class="title col-sm-2">Amount</div>
			<div class="date col-sm-1">Date</div>
			<div class="date col-sm-2">Time</div>
			<div class="date col-sm-1">Action</div>
		</div>
		<?php $bank->show_bank_list(); ?>
	</div>
</div>

<?php include 'layouts/footer.php'; ?>