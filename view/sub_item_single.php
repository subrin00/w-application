<?php
include '../controllers/sub_item.php';
$sub_item = new sub_items;

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
		extract($_POST);

		$update = $sub_item->update_sub_sub_item($edit, $s_s_title, $time, $date, $mid);

		if($update)
		{
			header("Location:sub_item_single.php?mid=$mid&id=$id");
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

		$delete = $sub_item->delete_sub_sub_item($del);

		if($delete)
		{
			$delete_goods_with_sub_sub_also = $sub_item->delete_goods_with_sub_sub_also($del);
			header("Location:sub_item_single.php?mid=$mid&id=$id");
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
		extract($_POST);

		$create = $sub_item->create_sub_sub_item($s_id, $s_s_title, $time, $date, $mid);

		if($create)
		{
			header("Location:sub_item_single.php?mid=$mid&id=$s_id");
			$_SESSION['msg'] = "Item Create Successful";
		}
		else
		{
			$msg = "Item Create Fail";
		}
	}
}


$id = $_GET['id'];
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
				$sub_item->show_sub_item_single($id, $mid);
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
					<h1>Create Your Item</h1>
				</div>
				<!-------- end Headline-------->

				<!-------- starting Form-------->
				<div class="col-sm-12 contact-form-message">
	 				<form action="#" method="post">
	 				<?php 
	 					if(isset($_GET['edit']))
	 					{
	 						$edit = $_GET['edit'];
	 						$sub_item->update_show_sub_sub_item($edit);
	 					}
	 					else
	 					{
	 						echo "<div class='form-group'>
					 					<label class='input col-sm-12'>
											<input id='name' type='text' name='s_s_title' placeholder='Title'>
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
							echo "<button type='submit' class='btn btn-info info' id='submit' name='update' >Update Item</button>";
						}
						else
						{
							echo "<button type='submit' class='btn btn-info info' id='submit' name='submit' >Add Item</button>";	
						} 
						?>
				    </form>
	 			</div>
	 			<!-------- end form-------->

			</div>
			<!-------- end form body-------->



	
	<h4>Item's List</h4>
	<div class="information_body none_for_from col-md-12">
	
		<div class="table_head">
			<div class="title col-sm-4">Title</div>
			<div class="date col-sm-4">Date</div>
			<div class="edit_delete col-sm-4">Edit | Delete</div>
		</div>
		<?php 
			if(isset($_GET['id']))
			{
				if(isset($_GET['mid']))
				{
					$id = $_GET['id'];
					$mid = $_GET['mid'];
					$sub_item->show_sub_sub_item($id, $mid); 
				}
			}
			?>

	</div>
</div>
	
<?php include 'layouts/footer.php'; ?>