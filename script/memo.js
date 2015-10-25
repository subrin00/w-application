$(function(){	
	//dropdown menu category
	$(".category").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
	
		$.ajax
		({
			type: "GET",
			url  : "get/get_sub_category.php",
			data : dataString,
			cache: false,
			success: function(html)
			{
				$(".sub_category").html(html);
			} 
		});
	});
	//END dropdown menu category
	
	
	//dropdown menu sub-category
	$(".sub_category").change(function()
	{
		var id=$(this).val();
		var dataString = 'id='+ id;
	
		$.ajax
		({
			type: "GET",
			url  : "get/get_items.php",
			data : dataString,
			cache: false,
			success: function(html)
			{
				$(".items").html(html);
			} 
		});
	});
	//END dropdown menu sub-category


		//Delete data form data base
		$('body').delegate('.delete','click',function(){			
			var id = $(this).data('id');
			$.ajax({
				url	  : 'get/t_memo.php',
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
				url   : 'get/t_memo.php',
				type  : 'POST',
				async : false,
				data  : {
						'edit' : 1,
						'id' : id
				},
				success:function(e)
				{
					$('#id').val(e.id);
					$("#category").val(e.items);
					$("#sub_category").val(e.sub_item);
					$("#items").val(e.sub_sub_item);
					$("#f_quantity").val(e.quantity);
					$("#rate").val(e.rate);
					$("#f_tk").val(e.tk);
					showdata();
				}
			});
		});
		//END Click Edit Data


		//Edit and sent to database
		$('#update').click(function(){
			var id = 		   $('#id').val();
			var mid =          $('#mid').val();
			var mmid = 		   $('#mmid').val();
			var category =     $('#category').val();
			var sub_category = $('#sub_category').val();
			var items = 	   $('#items').val();
			var f_quantity =   $('#f_quantity').val();
			var rate = 		   $('#rate').val();
			var f_tk = 		   $('#f_tk').val();

			$.ajax({
				url : 'get/t_memo.php',
				type : 'POST',
				async : false,
				data : {
						'update'       : 1,
						'id' 		   : id,
						'category' 	   : category,
						'sub_category' : sub_category,
						'items' 	   : items,
						'f_quantity'   : f_quantity,
						'rate' 		   : rate,
						'f_tk'         : f_tk
				},
				success:function(u)
				{
					if(u==0)
					{
						$('#category').val('');
			 			$('#sub_category').val('');
				  		$('#items').val('');
				  		$('#f_quantity').val('');
				  		$('#rate').val('');
				  		$('#f_tk').val('');
				  		window.location = 'customermemo.php?id=' + mid + '&mmid=' + mmid;
				  		showdata(); 
					}
				}
			});
		});
		// END edit save to database


		//save to database
		$('#FormSubmit').click(function(){
			var mid = 		   $('#mid').val();
			var mmid = 		   $('#mmid').val();
			var category = 	   $('#category').val();
			var sub_category = $('#sub_category').val();
			var items = 	   $('#items').val();
			var f_quantity =   $('#f_quantity').val();
			var rate = 		   $('#rate').val();
			var f_tk = 		   $('#f_tk').val();
			var date = 		   $('#date').val();
			var time = 		   $('#time').val();

			$.ajax({
				url   : 'get/t_memo.php',
				type  : 'POST',
				async : false,
				data  : {
						'saverecord'   : 1,
						'mid' 		   : mid,
						'mmid'         : mmid,
						'category' 	   : category,
						'sub_category' : sub_category,
						'items' 	   : items,
						'f_quantity'   : f_quantity,
						'rate' 		   : rate,
						'f_tk' 		   : f_tk,
						'date'		   : date,
						'time'		   : time
				},
				success:function(re)
				{
					if(re==0)
					{
						$('#mid')	  	  .val('');
						$('#mmid')	  	  .val('');
						$('#category')	  .val('');
			 			$('#sub_category').val('');
				  		$('#items')		  .val('');
				  		$('#f_quantity')  .val('');
				  		$('#rate')		  .val('');
				  		$('#f_tk')		  .val('');
				  		$('#date')		  .val('');
				  		$('#time')		  .val('');
				  		window.location = 'customermemo.php?id=' + mid + '&mmid=' + mmid;
				  		showdata(); 
					}
				}
			});
		});
		// END save to database


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