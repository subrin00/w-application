$(function(){

	//Delete data form data base
		$('body').delegate('.delete','click',function(){			
			var id = $(this).data('id');
			$.ajax({
				url	  : 'get/bankandcustomer.php',
				type  : 'POST',
				async : false,
				data  : {
						'delete' : 1,
						'id' : id
				},
				success:function(d)
				{
					showdata();	
				}				
			});
		});

		//END Delete data form data base

	
	//Click Edit Data
		showdata();
		$('body').delegate('.edit','click',function(){
			var id = $(this).data('id');
			$.ajax({
				url   : 'get/bankandcustomer.php',
				type  : 'POST',
				async : false,
				data  : {
						'edit' : 1,
						'id' : id
				},
				success:function(e)
				{
					$('#id').val(e.id);
					$('#acname').val(e.acname);
					$('#acnumber').val(e.acnum);
					$('#deposit').val(e.deposit);
					$('#withdrawal').val(e.withdrawal);
					$('#detail').val(e.details);
					showdata();
				}
			});
		});
		//END Click Edit Data


	//Edit and sent to database
		$('#update').click(function(){
			var id = 		   $('#id').val();
			var mid =          $('#mid').val();
			var acname =     $('#acname').val();
			var acnumber = $('#acnumber').val();
			var deposit = 	   $('#deposit').val();
			var withdrawal =   $('#withdrawal').val();
			var details = 		   $('#detail').val();

			$.ajax({
				url : 'get/bankandcustomer.php',
				type : 'POST',
				async : false,
				data : {
						'update'       : 1,
						'id' 		   : id,
						'acname' 	   : acname,
						'acnumber' : acnumber,
						'deposit' 	   : deposit,
						'withdrawal'   : withdrawal,
						'details' 		   : details
				},
				success:function(u)
				{
					if(u==0)
					{
						$('#acname').val('');
			 			$('#acnumber').val('');
				  		$('#deposit').val('');
				  		$('#withdrawal').val('');
				  		$('#detail').val('');
				  		window.location = "bank_details.php?id=" + mid;
				  		showdata(); 
					}
				}
			});
		});
		// END edit save to database


		//Delete data form data base client
		$('body').delegate('.deletec','click',function(){			
			var id = $(this).data('id');
			$.ajax({
				url	  : 'get/bankandcustomer.php',
				type  : 'POST',
				async : false,
				data  : {
						'deletec' : 1,
						'id' : id
				},
				success:function(d)
				{
					showdata();	
				}				
			});
		});

		//END Delete data form data base client


		//Click Edit Data client
		showdata();
		$('body').delegate('.editc','click',function(){
			var id = $(this).data('id');
			$.ajax({
				url   : 'get/bankandcustomer.php',
				type  : 'POST',
				async : false,
				data  : {
						'editc' : 1,
						'id' : id
				},
				success:function(e)
				{
					$('#id').val(e.id);
					$('#item').val(e.item);
					$('#quantit').val(e.quantity);
					$('#ttk').val(e.ttk);
					$('#paytk').val(e.paytk);
					$('#bank_info').val(e.bank_info);
					$('#detail').val(e.details);
					showdata();
				}
			});
		});
		//END Click Edit Data client


		//Edit and sent to database client
		$('#updatec').click(function(){
			var id = 		   $('#id').val();
			var mid =          $('#mid').val();
			var item =     $('#item').val();
			var quantit = $('#quantit').val();
			var ttk = 	   $('#ttk').val();
			var paytk =   $('#paytk').val();
			var bank_info =   $('#bank_info').val();
			var details = 		   $('#detail').val();

			$.ajax({
				url : 'get/bankandcustomer.php',
				type : 'POST',
				async : false,
				data : {
						'updatec'       : 1,
						'id' 		   : id,
						'item' 	   : item,
						'quantit' : quantit,
						'ttk' 	   : ttk,
						'paytk'   : paytk,
						'bank_info'   : bank_info,
						'details' 		   : details
				},
				success:function(u)
				{
					if(u==0)
					{
						$('#item').val('');
			 			$('#quantit').val('');
				  		$('#ttk').val('');
				  		$('#paytk').val('');
				  		$('#bank_info').val('');
				  		$('#detail').val('');
				  		window.location = "client_details.php?id=" + mid;
				  		showdata(); 
					}
				}
			});
		});
		// END edit save to database client


	// Show Data
		function showdata()
		{
			// var id = 11;
			// $.ajax({
			// 	url   : 'get/t_memo.php',
			// 	type  : 'POST',
			// 	async : false,
			// 	data  : {
			// 			'show' : 1,
			// 			'id' : id
			// 	},
			// 	success:function(r)
			// 	{
			// 		$('#showdata').html(r);
			// 	}
			// });
		};
		// END Show Data

});