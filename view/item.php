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

		extract($_POST);

		$update = $item->update_item($id, $item_name, $item_date);

		if($update)
		{
			header("Location:item.php");
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

	extract($_POST);

	$delete = $item->delete_item($del);
	
	if($delete)
	{
		$delete_sub_item_also = $item->delete_sub_item_also($del);

		if($delete_sub_item_also)
		{
			$delete_sub_sub_item_also  = $item->delete_sub_sub_item_also($del);
			if($delete_sub_sub_item_also)
			{
				$del_goods_also = $item->del_goods_also($del);
				header("Location:item.php");
				$_SESSION['msg'] = "Delete Successful";
			}
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
		extract($_POST);

		$create = $item->create_item($item_name,$item_date);
		
		if($create)
		{
			header("Location:item.php");	
			$_SESSION['msg'] = "Categoory Create Successful";
		}
		else
		{
			$msg = "Please Enter A Categoory Title";
		}

	}
}


include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
?>
<div class="main_body">
<!-------- starting form body-------->
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
					<h1>Create Your Main Category</h1>
				</div>
				<!-------- end Headline-------->

				<!-------- starting Form-------->
				<div class="col-sm-12 contact-form-message">
	 				<form action="#" method="post">
	 				<div class="form-group">
	 					<label class="input col-sm-12">
							<input id="name" type="text" name="item_name" placeholder="Title" value="<?php if(isset($_GET['id'])){ $item->show_items_title($_GET['id']); }  ?>">
						</label>
						<div id="name-message" class="message"></div>
					</div>
					
					<input id="date" type="hidden" name="item_date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">
						

						<?php 
						if(isset($_GET['edit']))
						{
							echo "<button type='submit' class='btn btn-info info' id='submit' name='update' >Update Main Category</button>";
						} 
						else
						{
							echo "<button type='submit' class='btn btn-info info' id='submit' name='submit' >Add Main Category</button>";
						}
						?>
							
				    </form>
	 			</div>
	 			<!-------- end form-------->

			</div>
			<!-------- end form body-------->


	<h4 class="col-md-10">Category List</h4>
	<div class="information_body col-md-12 none_for_from">
		<div class="table_head">
			<div class="title col-sm-4">Title</div>
			<div class="date col-sm-4">Date</div>
			<div class="edit_delete col-sm-4">Action</div>
		</div>
		<?php $item->show_items(); ?>
	</div>
</div>
<?php include 'layouts/footer.php'; ?>