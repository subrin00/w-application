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

if(isset($_POST['submit']))
{
	extract($_POST);
	$bid = $_GET['id'];
	$bankinfo = $bank->add_bank_info($bid,$acname,$acnumber,$deposit,$withdrawal,$details,$date,$time);

		if($bankinfo)
		{
			header("bank_details.php?id=$bid");
			$msg = "Bank Information Create Successful";
		}
		else
		{
			$msg = "Bank Information Create Fail";
		}
}


include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>

<div class="main_body">

	<div class="col-sm-12" id="contact-background">

		<!-------- starting Headline-------->
		<div class="form-head col-sm-12">
		<a href="bank.php"><span class="go_back"><img src="../img/goback.png" width="50px"></span></a>
			<h1>Bank Information</h1>
		</div>

		<div class="col-sm-12 none">

		<form action="" method="POST">

		<div class="content_wrapper"> 
		<div class="add_form">
			<h4><?php if(isset($_GET['id'])){ $yid=$_GET['id']; $bank->show_bank_name($yid); } ?></h4>
			<input type="hidden" id="id" value="">
			<input id="mid" type="hidden" name="mid" value="<?php if(isset($_GET['id'])){ $m_id=$_GET['id']; echo $m_id; }  ?>">  

			<div class='inp-brand col-sm-2'>			
				<input id="acname" class="col-sm-12 form-control" type="text" name="acname" placeholder="AC Name">			
			</div>

			<div class='inp-brand col-sm-2'>
				<input id="acnumber" class="col-sm-12 form-control" type="text" name="acnumber" placeholder="AC Number">			
			</div>

			<div class='inp-brand col-sm-2'>
				<input id="deposit" class="col-sm-12 form-control" type="text" name="deposit" placeholder="Deposit">
			</div>

			<div class="inp-brand col-sm-2">
				<input id="withdrawal" class="col-sm-12 form-control" type="text" name="withdrawal" placeholder="Withdrawal">
			</div>

			<div class="col-sm-4">
				<input id="detail" class="col-sm-12 form-control" type="text" name="details" placeholder="Details">
			</div>		

			<input id="date" type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2)); echo $date; ?>">

			<input id="time" type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2)); echo $time; ?>">


			<button type='submit' class='col-sm-3 inp_submit' id='submit' name='submit'>Add Bank Information</button>

			<input type="button" id="update" class="col-sm-3 inp_submit" value="Update Bank Information">
			
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

			</div>
			
		<div id="data" class="form_style col-sm-12"> 
			<ul id="showdata">
			<div class="table_head">
			<div class="brand-hed col-sm-2">AC Name</div>
			<div class="sub-brand-hed col-sm-2">AC Number</div>
			<div class="items-hed col-sm-1">Deposit</div>
			<div class="quen-hed col-sm-1">Withdrawal</div>
			<div class="rate-hed col-sm-2">Details</div>
			<div class="rate-hed col-sm-1">Date</div>
			<div class="rate-hed col-sm-2">Time</div>
			<div class="tk-hed col-sm-1">Action</div>
		</div>
				<?php 
				if(isset($_GET['id']))
				{
					$mid=$_GET['id'];
					$bank->show_bank_info_list($mid);
				}
				?>
			</ul>
		</div>
		</div>
		</form>
		<?php 
			if(isset($_GET['id']))
			{
				$yid=$_GET['id'];
				$bank->show_bank_info_quantity($yid);
			}
		?>

		</div>
	</div>
</div>
<script type="text/javascript" src="../script/bank_and_customer.js"></script>
<?php include 'layouts/footer.php'; ?>