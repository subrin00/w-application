<?php
include "../controllers/memo.php";
$memo = new memo;

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

$m_id = $_GET['id'];

include 'layouts/header.php';
include 'layouts/sidebar_layout.php';
$date=date('d-m-Y', strtotime('now'-2));
$time=date('h:i:s A', strtotime('now'-2));
?>
<div class="main_body">
<div class="col-sm-12" id="contact-background">
	<div class="form-head col-sm-12">
		<h1><a href="todaymemo.php?id=<?php echo $_GET['mmid']; ?>"><span class="go_back"><img src="../img/goback.png" width="50px"></span></a>Customer Memo</h1>
	</div>
	<div class="col-sm-12 none">
		<div class="content_wrapper">
			<div class="add_form">
				<div id="customer_name">
				<?php $memo->customer_name($m_id); ?>		
				</div>
				<input type="hidden" id="id" value="">
				<input id="mid" type="hidden" name="mid" value="<?php echo $m_id; ?>">
				<input id="mmid" type="hidden" name="mmid" value="<?php echo $_GET['mmid']; ?>">			    

				<div class='inp-brand col-sm-2'>			
					<select id="category" name="category" class="category form-control col-sm-12">
						<option selected="selected">--Category--</option>
						<?php
							$memo->select_category();
						?>
					</select>
				</div>

				<div class='inp-brand col-sm-2'>
					<select id="sub_category" name="sub_category" class="sub_category form-control col-sm-12">
						<option selected="selected">--Sub Category--</option>
					</select>
				</div>

				<div class='inp-brand col-sm-2'>
					<select id="items" name="items" class="items form-control col-sm-12">
						<option selected="selected">--Item's--</option>
					</select>
				</div>

				<div class="inp-brand col-sm-2">
					<input id="f_quantity" class="col-sm-12 form-control" type="text" name="f_quantity" oninput="calculate()" placeholder="Quantity">
				</div>

				<div class="inp-brand col-sm-2">
					<input id="rate" class="col-sm-12 form-control" type="text" name="rate" oninput="calculate()" placeholder="Rate">
				</div>

				<div class="col-sm-2">
					<input id="f_tk" class="col-sm-12 form-control" type="text" name="f_tk" placeholder="TK">
				</div>			

				<input id="date" type="hidden" name="date" value="<?php $date=date('d-m-Y', strtotime('now'-2)); echo $date; ?>">

				<input id="time" type="hidden" name="time" value="<?php $time=date('h:i:s A', strtotime('now'-2)); echo $time; ?>">

				<input type="button" id="FormSubmit" class="col-sm-2 inp_submit" value="Add A Item" name="submit">
				<input type="button" id="update" class="col-sm-2 inp_submit" value="Update">

				<input type="button" class="inp_submit print" value="print" onclick="PrintDiv();" />	
				
				<p class="session_msg f_none col-md-12"><?php if(@$msg)
					{
						echo $msg;
						 if(@$_SESSION['msg'])
						 	{
						 		echo $_SESSION['msg']=""; 
						 	} 
						} ?>
					</p>

			</div>
			<div id="data" class="form_style col-sm-12">
				<ul id="showdata">
					<div class="table_head">
						<div class="brand-hed hed col-sm-2">Category</div>
						<div class="sub-brand-hed hed col-sm-2">Sub-Category</div>
						<div class="items-hed hed col-sm-2">Item</div>
						<div class="quen-hed hed col-sm-1">Quantity</div>
						<div class="rate-hed hed col-sm-2">Rate</div>
						<div class="tk-hed hed col-sm-2">TK</div>
						<div class="tk-hed edit col-sm-1">Action</div>
					</div>		
						 
					<?php $m_id=$_GET['id'];  $memo->memo_show($m_id); ?>
					<?php $memo->total_quantity($m_id); ?>
				 </ul>
				 
			</div>			
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	function calculate() {
	        var myBox1 = document.getElementById('f_quantity').value; 
	        var myBox2 = document.getElementById('rate').value;
	        var result = document.getElementById('f_tk'); 
	        var myResult = myBox1 * myBox2;
	        result.value = myResult;     
	        }


	        function PrintDiv() {    
           var divToPrint = document.getElementById('showdata');
           var name = document.getElementById('customer_name');
           var popupWin = window.open('', '_blank', 'width=600,height=600');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()"><style>.table_head, .table_details{	width: 100%; float: left; border-bottom: 1px solid #eeecec; margin-top:20px;} li{ width: 16%; float: left; line-height:50px; } .hed{ width: 16%; float:left; } .edit{ display: none; } .auth-hed{ width:40%; margin:auto; text-align:center; } .head{ font-size: 20px; text-decoration: underline; color: #81bc41; } span.founder { color: #81BC41; font-weight: bold; } .dealer { color: #FF3826; font-weight: bold; border: 1px solid #000; border-radius: 5px; font-size: 16px; padding: 5px; margin: 5px; line-height: 50px; } .bottom_address { font-size: 18px; letter-spacing: 2px;  word-spacing: 2px; } .total-body{ width:25%; float:right; padding: 30px 0; font-size:22px; border-top:2px solid #000; text-align:center; }</style><div class="auth-hed"><span class="head">Company Name</span><br><span class="founder">Your Founder Name(Founder), Phone : ??????</span><br><span class="details">Some Of Your Company Information And Description</span><br> Retail and wholesale <br><span class="dealer">Dealer : Some LTD.</span><br> <span class="bottom_address">Arjotpara, Mohakhali, Dhaka</span></div>' + name.innerHTML + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }

</script>
<script type="text/javascript" src="../script/memo.js"></script>
<?php include 'layouts/footer.php'; ?>