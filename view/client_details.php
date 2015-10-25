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

if(isset($_POST['submit']))
{
	extract($_POST);
	$cid = $_GET['id'];
	$clientinfo = $client->create_client_info_list($cid,$item,$quantity,$ttk,$paytk,$bank_info,$details,$date,$time);

		if($clientinfo)
		{
			header("client_details.php?id=$cid");
			$msg = "Client Information Create Successful";
		}
		else
		{
			$msg = "Client Information Create Fail";
		}
}
include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>

<div class="main_body">

	<div class="col-sm-12" id="contact-background">

		<!-------- starting Headline-------->
		<div class="form-head col-sm-12">
		<a href="client.php"><span class="go_back"><img src="../img/goback.png" width="50px"></span></a>
			<h1>Client Information</h1>
		</div>

		<div class="col-sm-12 none">

		<form action="" method="POST">

		<div class="content_wrapper"> 
		<div class="add_form">
			<h4>Client : <?php if(isset($_GET['id'])){ $yid=$_GET['id']; $client->show_client_name($yid); } ?></h4>

			<input type="hidden" id="id" value="">
			<input id="mid" type="hidden" name="mid" value="<?php if(isset($_GET['id'])){ $m_id=$_GET['id']; echo $m_id; }  ?>">  

			<div class='inp-brand col-sm-2'>			
				<input id="item" class="col-sm-12 form-control" type="text" name="item" placeholder="Item">			
			</div>

			<div class='inp-brand col-sm-2'>
				<input id="quantit" class="col-sm-12 form-control" type="text" name="quantity" placeholder="Quantity">			
			</div>

			<div class='inp-brand col-sm-2'>
				<input id="ttk" class="col-sm-12 form-control" type="text" name="ttk" placeholder="Total Tk">
			</div>

			<div class="inp-brand col-sm-2">
				<input id="paytk" class="col-sm-12 form-control" type="text" name="paytk" placeholder="Pay Tk">
			</div>

			<div class="inp-brand col-sm-2">
				<input id="bank_info" class="col-sm-12 form-control" type="text" name="bank_info" placeholder="Bank Info">
			</div>

			<div class="col-sm-2">
				<input id="detail" class="col-sm-12 form-control" type="text" name="details" placeholder="Details">
			</div>		

			<input id="date" type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2)); echo $date; ?>">

			<input id="time" type="hidden" name="time" value="<?php $time=date('h:i:s', strtotime('now'-2)); echo $time; ?>">


			<button type='submit' class='col-sm-3 inp_submit' id='submit' name='submit'>Add Client Information</button>

			<input type="button" id="updatec" class="col-sm-3 inp_submit" value="Update Client Information">
			
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
			<div class="brand-hed col-sm-2">Item</div>
			<div class="sub-brand-hed col-sm-1">Quantity</div>
			<div class="items-hed col-sm-1">Total Tk</div>
			<div class="quen-hed col-sm-1">Pay Tk</div>
			<div class="rate-hed col-sm-2">Bank Info</div>
			<div class="rate-hed col-sm-2">Details</div>
			<div class="rate-hed col-sm-1">Date</div>
			<div class="rate-hed col-sm-1">Time</div>
			<div class="tk-hed col-sm-1">Action</div>
		</div>
				<?php 
				if(isset($_GET['id']))
				{
					$mid=$_GET['id'];
					$client->show_client_info_list($mid);
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
				$client->show_client_info_quantity($yid);
			}
		?>

		</div>
	</div>
</div>
<script type="text/javascript" src="../script/bank_and_customer.js"></script>
<?php include 'layouts/footer.php'; ?>