<?php
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "gobs";

try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	$e->getMessage();
}

if($_GET['id'])
{
	$id=$_GET['id'];
	
	$stmt = $DB_con->prepare("SELECT * FROM sub_sub_item WHERE s_id=:id");
	$stmt->execute(array(':id' => $id));
	?><option selected="selected">--Item's--</option><?php
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $row['s_s_id']; ?>"><?php echo $row['s_s_title']; ?></option>
		<?php
	}
}
?>