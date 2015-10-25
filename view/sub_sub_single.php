<?php
include "../controllers/sub_sub_item.php";
$sub = new sub_sub_items;

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
		$mid = $_GET['mid'];
		$cid = $_GET['cid'];
		extract($_POST);

		$update = $sub->update_goods($edit, $quantity, $tk, $details, $date, $time, $mid, $cid);

		if($update)
		{
			header("Location:sub_sub_single.php?mid=$mid&cid=$cid&id=$id");
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
		$mid = $_GET['mid'];
		$cid = $_GET['cid'];
		extract($_POST);

		$delete = $sub->delete_goods($del);

		if($delete)
		{
			header("Location:sub_sub_single.php?mid=$mid&cid=$cid&id=$id");
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
		$s_id = $_GET['id'];
		$mid = $_GET['mid'];
		$cid = $_GET['cid'];
		extract($_POST);

		$create = $sub->goodsin($s_id, $quantity, $tk, $details, $date, $time, $mid, $cid);

		if($create)
		{
			header("Location:sub_sub_single.php?mid=$mid&cid=$cid&id=$s_id");
			$_SESSION['msg'] = "Good's In Your House Successfully";
		}
		else
		{
			$msg = "Please Enter Your Good's Quantity And Total TK";
		}
	}
}

include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">

	<div class="navigation"><h3><?php 
					if(isset($_GET['id']))
						{ 
							if(isset($_GET['mid']))
							{
								$id = $_GET['id'];
								$mid = $_GET['mid'];
								$cid = $_GET['mid'];  
								$sub->show_all_sirl($id, $mid, $cid); 
							}
						} ?></h3>
	
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

	</div>
<!-------- starting form body-------->
			<div class="col-sm-12" id="contact-background">

				<!-------- starting Headline-------->
				<div class="form-head col-sm-12">
					<h1><?php if(isset($_GET['id']))
							{
								$id = $_GET['id'];
								$sub->sub_sub_single($id);
							} 
							 ?></h1>
				</div>
				<!-------- end Headline-------->

				<!-------- starting Form-------->
				<div class="col-sm-12 contact-form-message">

	 			<form action="#" method="post">
	 			<?php
				if(isset($_GET['edit']))
				{
	 				$uid = $_GET['edit'];
	 				$sub->update_goods_show($uid);
	 			}
	 			else
	 			{
	 				echo "<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='quantity' placeholder='Quantity'>
						</label>
					</div>

					<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='tk' placeholder='Total Tk'>
						</label>
					</div>

					<div class='form-group'>
	 					<label class='input col-sm-12'>
							<input id='name' type='text' name='details' placeholder='Details'>
						</label>
					</div>";
				}
				?>
									
					<input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">

					<input type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2));
echo $time; ?>">	
				<?php
				if(isset($_GET['edit']))
				{
					echo "<button type='submit' class='btn btn-info info' id='submit' name='update' >Update Your Good's</button>";
				}
				else
				{
					echo "<button type='submit' class='btn btn-info info' id='submit' name='submit' >Add Your Good's</button>";
				}
				?>
				</form>
	 			</div>
	 			<!-------- end form-------->

			</div>
			<!-------- end form body-------->

				
	<h4>Good's Information Of This Item</h4>
	<div class="information_body col-md-12 none_for_from">
		<div class="table_head">
			<div class="title col-sm-2">Quantity</div>
			<div class="date col-sm-2">Tk</div>
			<div class="edit_delete col-sm-2">Details</div>
			<div class="edit_delete col-sm-2">Date</div>
			<div class="edit_delete col-sm-2">Time</div>
			<div class="edit_delete col-sm-2">Action</div>
		</div>
		<?php 
		if(isset($_GET['id']))
		{ 
			if(isset($_GET['mid']))
			{
				$id = $_GET['id'];
				$mid = $_GET['mid'];
				$cid = $_GET['cid'];
				$sub->goods_show($id, $mid, $cid);
			}							 
		}
		?>
	</div>
</div>
<?php include 'layouts/footer.php'; ?>