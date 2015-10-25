<?php
include "../controllers/item_class.php";
$item = new item;

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
		$id = $_GET['edit'];
		$xid = $_GET['id'];
		$mid = $_GET['mid'];
		extract($_POST);

		$update = $item->update_sub_item($id, $title, $details, $date, $mid);

		if($update)
		{
			header("Location:item_details.php?mid=$mid&id=$xid");
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

		$delete = $item->delete_sub_item($del);

		if($delete)
		{
			$delete_sub_sub_item_with_sub_also = $item->delete_sub_sub_item_with_sub_also($del);
			
			if($delete_sub_sub_item_with_sub_also)
			{
				$del_goods_with_sub_also = $item->del_goods_with_sub_also($cid);
				header("Location:item_details.php?mid=$mid&id=$id");
				$_SESSION['msg'] = "Delete Successful";
			}
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
		$i_id = $_GET['id'];
		$mid = $_GET['mid'];
		extract($_POST);

		$create = $item->create_sub_item($i_id, $title, $details, $date, $mid);

		if($create)
		{
			header("Location:item_details.php?mid=$mid&id=$i_id");
			$_SESSION['msg'] = 'Sub Categoory Create Successful';
		}
		else
		{
			$msg = "Please Enter A Sub Categoory Title";
		}
	}
}

// $xid = $_GET['id'];
include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">
	<div class="navigation"><h3><?php 
	if(isset($_GET['id']))
		{
			if(isset($_GET['mid']))
			{
				$mid = $_GET['mid'];
				$id = $_GET['id']; 
				$item->single_item($id, $mid); 
			}
		} 
		?></h3>
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
					<h1>Create Your Sub Category</h1>
				</div>
				<!-------- end Headline-------->

				<!-------- starting Form-------->
				<div class="col-sm-12 contact-form-message">
	 				<form action="#" method="post">
	 				<div class="form-group">
	 				<?php 
	 				if(isset($_GET['edit']))
	 				{
	 					$showedir = $_GET['edit'];
	 					$item->show_update_sub_item($showedir);
	 				}
	 				else
	 				{
	 					echo "<label class='input col-sm-12'>
							<input id='name' type='text' name='title' placeholder='Title'>
						</label>
					</div>

					<div class='form-group'>						
						<label class='input col-sm-12'>
							<input id='details' type='text' name='details' placeholder='Details'>
						</label>
					</div>";
	 				}
	 				 ?>

					<input id="date" type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">
						<?php 
						if(isset($_GET['edit']))
						{
							echo "<button type='submit' class='btn btn-info info' id='submit' name='update' >Update Sub-Category</button>";
						}
						else
						{
							echo "<button type='submit' class='btn btn-info info' id='submit' name='submit' >Add Sub-Category</button>";	
						} 
						?>

				    </form>
	 			</div>
	 			<!-------- end form-------->

			</div>
			<!-------- end form body-------->
	
	<h4 class="col-sm-12">Sub Category List</h4>
	<div class="information_body none_for_from col-md-12">	
		<div class="table_head">
			<div class="title col-sm-4">Title</div>
			<div class="date col-sm-4">Date</div>
			<div class="edit_delete col-sm-4">Action</div>
		</div>
	<p><?php if(isset($_GET['id']))
				{ 
					if(isset($_GET['mid']))
					{
						$mid = $_GET['mid'];
						$id = $_GET['id']; 
						$item->show_sub_item($id, $mid); 
					}
				} ?></p>
	</div>
</div>
<?php include 'layouts/footer.php'; ?>