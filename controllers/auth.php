<?php
 
include 'db.php';

class auth
{
	public $db;
	public function __construct()
	{
		$this->db = new mysqli(db_host, db_user, db_password, db_name);
		if(mysqli_connect_errno())
		{
			echo "database connect error";
			exit;
		}
	}

	public function auth_reg($name,$firstname,$lastname,$gender,$bday,$img,$email,$password,$admin,$status,$date,$time)
	{
			$target_dir = "../img/";
			$img = $target_dir . basename($_FILES["imgupload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($img,PATHINFO_EXTENSION);
		
			if ($uploadOk == 0) {
				echo "";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["imgupload"]["tmp_name"], $img)) {
				} else {
					echo "";
				}
			}
			$sql = "INSERT INTO `admin` VALUES('', '$name', '$firstname', '$lastname', '$gender', '$bday', '$img','$email', '$password', '$admin', '$status', '$date', '$time')";
			$result = $this->db->query($sql);
			return true;		
	}

	public function auth_login($email,$password)
	{
		$sql = "SELECT * FROM `admin` WHERE email = '$email' AND pass = '$password'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		$row= $result->num_rows;
		if($row == 1)
		{
			session_start();
			$_SESSION['auth_login']=true;
			$_SESSION['username']=$data['username'];
			$_SESSION['pass']=$data['pass'];
			$_SESSION['email']=$data['email'];
			$_SESSION['pic']=$data['pic'];
			$_SESSION['admin']=$data['admin'];
			$_SESSION['stat']=$data['stat'];
			return true;
		}
		else
		{
			return false;
		}
	}

	public function get_session()
	{
		return $_SESSION['auth_login'];
	}

	public function log_out()
	{
		session_start();
		if(session_destroy())
		{
			header("Location:http://localhost/gobs/");
		}
	}

	public function show_admin_list()
	{
		$sql = "SELECT * FROM `admin`";
		$result = $this->db->query($sql);
		while($data = $result->fetch_array())
		{

			echo "<div class='table_details'>
					<div class='title no_overflow col-sm-2'>$data[username]</div>
					<div class='title no_overflow col-sm-1'>$data[fname]</div>
					<div class='title no_overflow col-sm-1'>$data[lname]</div>
					<div class='title no_overflow col-sm-1'>";if ($data['gender'] == "male"){ echo "Male"; }
																elseif ($data['gender'] == "femail"){ echo "Female"; }
																elseif ($data['gender'] == "other"){ echo "Other"; }
																else { echo ""; }
																 echo "</div>
					<div class='title no_overflow col-sm-1'>$data[dbirth]</div>
					<div class='title no_overflow col-sm-2'>$data[email]</div>
					<div class='title no_overflow col-sm-1'>";if ($data['admin'] == 1){ echo "Super Admin"; }
																elseif ($data['admin'] == 2){ echo "Admin"; }
																elseif ($data['admin'] == 3){ echo "Visitor"; } 
																else{ echo "Not Found"; }
																echo "</div>
					<div class='title no_overflow col-sm-1'>";if ($data['stat'] == 0){ echo "Inactive"; }
																elseif ($data['stat'] == 1){ echo "Active"; }
																else{ echo "Not Found"; }
																echo "</div>
					<div class='title no_overflow col-sm-1'><img src='";
																if($data['pic'] == "../img/")
																{
																	echo "../img/user.png";																	
																}
																else
																{
																	echo $data['pic'];
																}
					echo "' width='70px'></div>
					<div class='title no_overflow col-sm-1'><a href='Registration.php?id=$data[id]' class='edit'><img src='../img/edit.png' width='15px'></a> || <a href='admin.php?del=$data[id]' class='delete'><img src='../img/icon_del.gif'></a></div>
					</div>";
		}
	}

	public function show_edit_admin($id)
	{
		$sql = "SELECT * FROM `admin` WHERE id = '$id'";
		$result = $this->db->query($sql);
		$data = $result->fetch_array();
		echo "<div class='form-group'>
		 					<label for='name'>User Name<span> *</span></label>	
		 					<label class='input'>
								<i class='form-icon reg'><img src='../img/user.png'></i>
								<input id='name' class='form-control' type='text' name='name' value='$data[username]'>
							</label>
						</div>

						<div class='form-group'>	
							<label for='email'>Email<span> *</span></label>					
							<label class='input'>
								<i class='form-icon reg'><img src='../img/email.png'></i>
								<input id='email' class='form-control' type='email' name='email' value='$data[email]'>
							</label>
						</div>

						<div class='form-group'>
							<label for='password'>Password<span> *</span></label>							
							<label class='input'>
								<i class='form-icon reg'><img src='../img/lock.png'></i>
								<input id='password' class='form-control' type='password' name='password' value='$data[pass]'>
							</label>
						</div>

						<div class='form-group'>
					    	<label for='imgup'>Picture Upload</label>
					    	<input type='file' id='imgup' name='imgupload' value='$data[pic]'>";
					    	if($data['pic'] == '../img/')
								{									
									echo "<img src='../img/user.png' width='80px'>";
								}
								else
								{
									echo "<img src='$data[pic]' width='100px'>";
								}					   		
						echo "</div>
							
						<div class='form-group col-half'>
							<label for='first-name'>First-Name</label>	
							<label class='input'>
								<i class='form-icon reg'><img src='../img/user.png'></i>
								<input id='first-name' class='form-control' type='text' name='firstname' value='$data[fname]'>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='last-name'>Last-Name</label>	
							<label class='input'>
								<i class='form-icon reg'><img src='../img/user.png'></i>
								<input id='last-name' class='form-control' type='text' name='lastname' value='$data[lname]'>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='gender'>Gender<span> *</span></label>	
							<label class='input'>							
								<select id='gender' name='gender' class='form-control'>
									<option value='$data[gender]' selected='$data[gender]'>";
									if($data['gender'] == 'male')
									{
										echo "Male";
									}
									elseif($data['gender'] == 'femail')
									{
										echo "Female";
									}
									elseif($data['gender'] == 'other')
									{
										echo "Other";
									}
									else
									{
										echo " --Select Your Gender-- ";
									}

									echo "</option>
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
								<input id='bday' class='form-control' type='date' name='bday' min='1900-01-01' value='$data[dbirth]'>
							</label>
						</div>

						<div class='form-group col-half'>
							<label for='admin'>Admin<span> *</span></label>	
							<label class='input'>							
								<select id='admin' name='admin' class='form-control'>
									<option value='$data[admin]' selected='$data[admin]'>";
									if($data['admin'] == 1)
									{
										echo "Super Admin";
									}
									elseif($data['admin'] == 2)
									{
										echo "Admin";
									}
									elseif($data['admin'] == 3)
									{
										echo "Visitor";
									}
									else
									{
										" --Select Your Admin-- ";
									}
									echo "</option>
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
									<option value='$data[stat]' selected='$data[stat]'>";
									if($data['stat'] == 1)
									{
										echo "Active";
									}
									elseif($data['stat'] == 0)
									{
										echo "Inactive";
									}
									else
									{
										" --Select Your Status-- ";
									}
									echo "</option>
									<option value='1'>Active</option>
									<option value='0'>Inactive</option>
								</select>
							</label>
						</div>
						<input type='submit' class='btn btn-default submit' id='submit' name='update' value='Update Your Admin'>
						";
	}

	public function auth_update($id,$name,$firstname,$lastname,$gender,$bday,$img,$email,$password,$admin,$status,$date,$time)
	{
		$target_dir = "../img/";
		$img = $target_dir . basename($_FILES["imgupload"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($img,PATHINFO_EXTENSION);
		// Check if file already exists
		if (file_exists($img)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["imgupload"]["tmp_name"], $img)) {
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		$sql = "UPDATE `admin` SET username = '$name', fname = '$firstname', lname = '$lastname', gender = '$gender', dbirth = '$bday', pic = '$img', email = '$email', pass = '$password', admin = '$admin', stat = '$status', date = '$date', time = '$time' WHERE id = '$id'";
		$result = $this->db->query($sql);
		return true;
	}

	public function auth_delete($del)
	{
		$sql = "DELETE FROM `admin` WHERE id = '$del'";
		$result = $this->db->query($sql);
		return true;
	}
}