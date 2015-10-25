<div class="admin_menu">
	<ul>
		<li class='layer'></li>
		<li class='menu'><h1>Admin Menu</h1></li>
		<?php 
		if($admin == 1)
		{
			echo "<a href='http://localhost/gobs/view/dashboard.php'><li>Dashboard</li></a>
				<a href='http://localhost/gobs/view/overview.php'><li>Overview</li></a>
				<a href='http://localhost/gobs/view/quentity_overview.php'><li>Good's On House</li></a>
				<a href='http://localhost/gobs/view/memo.php'><li>Memo</li></a>
				<a href='http://localhost/gobs/view/item.php'><li>Main Category</li></a>
				<a href='http://localhost/gobs/view/bank.php'><li>Bank Info</li></a>
				<a href='http://localhost/gobs/view/client.php'><li>Client Info</li></a>		
				<a href='http://localhost/gobs/view/admin.php'><li>Admin</li></a>";
		}
		elseif ($admin == 2) 
		{
			echo "<a href='http://localhost/gobs/view/overview.php'><li>Overview</li></a>
				<a href='http://localhost/gobs/view/quentity_overview.php'><li>Good's On House</li></a>
				<a href='http://localhost/gobs/view/quentity_overview.php'><li>Good's On House</li></a>
				<a href='http://localhost/gobs/view/memo.php'><li>Memo</li></a>
				<a href='http://localhost/gobs/view/item.php'><li>Main Category</li></a>";
		}
		elseif ($admin == 3) 
		{
			echo "<a href='http://localhost/gobs/view/overview.php'><li>Overview</li></a>
				<a href='http://localhost/gobs/view/quentity_overview.php'><li>Good's On House</li></a>";
		}

		?>
		<li class='layer_two'></li>		
	</ul>
</div>