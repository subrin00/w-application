<?php
include('../controllers/auth.php');
$auth = new auth;

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
	echo "";
}
else
{
	header("Location:http://localhost/gobs/");
	$_SESSION['msg'] = "You Are Not Authorized ";
}

if(isset($_POST['submit']))
{
	extract($_POST);
	$reg = $auth->auth_reg($name,$firstname,$lastname,$gender,$bday,@$imgupload,$email,$password,$admin,$status,$date,$time);
	
	if ($reg) 
	{
		header("Location:http://localhost/gobs/view/admin.php");
		$_SESSION['msg'] = "Admin Create Successful";
	}
	else
	{
		$msg = "Choose A Different Email";
	}
}
if(isset($_GET['id']))
{	
	if(isset($_POST['update']))
	{
		extract($_POST);
		$id = $_GET['id'];
		$update = $auth->auth_update($id,$name,$firstname,$lastname,$gender,$bday,$imgupload,$email,$password,$admin,$status,$date,$time);

		if($update)
		{
			header("Location:http://localhost/gobs/view/admin.php");
			$_SESSION['msg'] = "Admin Update Successful";
		}
		else
		{
			$msg = "Choose A Different Email";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">	
	<link rel="stylesheet" href="../css/auth.css">
	<script type="text/javascript" src="../script/jquery-1.11.3.min.js"></script>
	
</head>
<body>
	<div id="form-main" class="col-sm-12">
		<div class="shadow col-sm-5 col-md-offset-4">

			<!-------- starting form body-------->
			<div class="col-sm-12" id="contact-background">

				<!-------- starting Headline-------->
				<div class="form-head col-sm-12">
				<a href="admin.php"><span class="go_back"><img src="../img/goback.png" width="50px"></span></a>				
					<h1>Registration Form</h1>
				</div>
				<!-------- end Headline-------->


				<div id="contact_form_errorloc" class="error_strings">
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


				<!-------- starting Form-------->
				<div class="col-sm-12 contact-form">
	 				<form action="#" id="contact_form" name="contact_form" method="POST" enctype="multipart/form-data">

	 				<?php 
	 					if(isset($_GET['id']))
	 						{ 
	 							$id = $_GET['id'];
	 							$auth->show_edit_admin($id); 
	 						} 
	 						else
	 							{?>
		 				<div class='form-group'>
		 					<label for='name'>User Name<span> *</span></label>	
		 					<label class='input'>
								<i class='form-icon reg'><img src='../img/user.png'></i>
								<input id='name' class='form-control' type='text' name='name'>
							</label>
						</div>

						<div class='form-group'>	
							<label for='email'>Email<span> *</span></label>					
							<label class='input'>
								<i class='form-icon reg'><img src='../img/email.png'></i>
								<input id='email' type='email' name='email' class='form-control'>
							</label>
						</div>

						<div class='form-group'>
							<label for='password'>Password<span> *</span></label>							
							<label class='input'>
								<i class='form-icon reg'><img src='../img/lock.png'></i>
								<input id='password' class='form-control' type='password' name='password'>
							</label>
						</div>

						<div class='form-group'>
					    	<label for='imgupload'>Picture Upload</label>
					    	<input type='file' id='imgupload' name='imgupload'>
					   		<p class='help-block'>Example block-level help text here.</p>
						</div>
							
						<div class='form-group col-half'>
							<label for='first-name'>First-Name</label>	
							<label class='input'>
								<i class='form-icon reg'><img src='../img/user.png'></i>
								<input id='first-name' class='form-control' type='text' name='firstname'>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='last-name'>Last-Name</label>	
							<label class='input'>
								<i class='form-icon reg'><img src='../img/user.png'></i>
								<input id='last-name' class='form-control' type='text' name='lastname'>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='gender'>Gender<span> *</span></label>	
							<label class='input'>							
								<select id='gender' name='gender' class='form-control'>
									<option selected value=""> --Select Your Gender-- </option>
									<option value='male'>Male</option>
									<option value='femail'>Femail</option>
									<option value='other'>Other</option>
								</select>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='bday'>Birth Day</label>	
							<label class='input'>
								<i class='form-icon reg'><img src='../img/birthday.png'></i>
								<input id='bday' class='form-control' type='date' name='bday' min='1900-01-01'>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='admin'>Admin<span> *</span></label>	
							<label class='input'>							
								<select id='admin' name='admin' class='form-control'>
									<option value='' selected> --Select Admin-- </option>
									<option value='1'>Super Admin</option>
									<option value='2'>Admin</option>
									<option value='3'>Visitor</option>
								</select>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='status'>Status<span> *</span></label>	
							<label class='input'>							
								<select id='status' name='status' class='form-control'>
									<option value='' selected> --Admin Status-- </option>
									<option value='1'>Active</option>
									<option value='0'>Inactive</option>
								</select>
							</label>
						</div>           

						<input type="submit" class="btn btn-default submit" id="submit" name="submit" value="Add Your Admin">
						<?php } ?>

						<input type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2));
echo $date; ?>">

						<input type="hidden" name="time" value="<?php $time=date('h:i:s', strtotime('now'-2));
echo $time; ?>"> 
						
						
				    </form>
	 			</div>
	 			<!-------- end form-------->

			</div>
			<!-------- end form body-------->

		</div>
		
	</div>
	<script language="JavaScript" src="../script/gen_validatorv4.js" type="text/javascript" xml:space="preserve"></script>
	
	<script language="JavaScript" type="text/javascript">
     var frmvalidator  = new Validator("contact_form");
	 frmvalidator.EnableOnPageErrorDisplaySingleBox();
	 frmvalidator.EnableMsgsTogether();
	 
	 frmvalidator.addValidation("name","req","Please enter your User Name");
	  frmvalidator.addValidation("name","maxlen=20",	"Max length for FirstName is 20");
	  frmvalidator.addValidation("name","alpha_s","Name can contain alphabetic chars only");
	  
	  frmvalidator.addValidation("email","req","Please enter your Email");
	  frmvalidator.addValidation("email","maxlen=20","For LastName, Max length is 20");

	  frmvalidator.addValidation("password","req","Please enter your Password");
	  frmvalidator.addValidation("password","maxlen=50","For LastName, Max length is 20");

	  frmvalidator.addValidation("gender","req","Please select your gender");
	  frmvalidator.addValidation("gender","maxlen=50","For LastName, Max length is 20");

	  frmvalidator.addValidation("admin","req","Please select your Admin");

	  frmvalidator.addValidation("status","req","Please select your Admin Status");
	 
    </script>
</body>
</html>