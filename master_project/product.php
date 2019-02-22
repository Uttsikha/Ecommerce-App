<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	<link rel="stylesheet" href="css/style.css" type="text/css">
	
	
</head>
<body>
	<?php include"includes/header.php";?>
	<?php include"includes/db.php"?>
</body>
	<div class="container">
		<div class="col-md-12">
			<ol class="breadcrumb">

				<li class="breadcrumb-item"><a href="home.php">Home</a></li>
				<?php
					if (isset($_GET['item_id'])){
						$sql="SELECT * FROM items WHERE item_id='$_GET[item_id]'";
						$run=mysqli_query($conn,$sql);
						while ($rows=mysqli_fetch_assoc($run)){
							$item_cat=ucwords($rows['item_cat']);
							$item_id=$rows['item_id'];
							echo "
								<li class='breadcrumb-item'><a href='category.php?category=$item_cat'>$item_cat</a></li>
								<li class='active'><a href=''>$rows[item_title]</a></li>
				
							";
										
					

				?>
			
			</ol>
		</div>
		<div class="row">
			<?php
						echo"
							<div class='col-md-8'>
								<h1 class='pro_title'>$rows[item_title]</h1>
								<img src='$rows[item_image]' class='img-responsive'>
								<h4 class='pro_desc_title'>Description</h4>
								<div class='pro_desc'>$rows[item_description]
								</div>
							</div>
						";
					}

				}
			?>
			
			<aside class="col-md-4">
				<a href="shopping_cart.php?chk_item_id=<?php echo $item_id; ?>" class="btn btn-lg button-style">Buy</a>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-3"><i class="fa fa-truck fa-2x"></i></div>
							<div class="col-md-9">Delivery within 5 days</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-3"><i class="fa fa-sync fa-2x"></i></div>
							<div class="col-md-9">Return within 7 days</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-3"><i class="fa fa-money-bill fa-2x"></i></div>
							<div class="col-md-9">Cash on delivery</div>
						</div>
					</li>
				</ul>
			</aside>
		</div>	
		<div class="clearfix"></div>

		<div class="page-header">
			<h2>Related Items</h2>
		</div>
		<section class="row">
			<?php
				$rel_sql="SELECT * FROM items ORDER BY rand() LIMIT 2";
				$rel_run=mysqli_query($conn, $rel_sql);
				while ($rel_rows=mysqli_fetch_assoc($rel_run)){
					$discounted_price=$rel_rows['item_price']-$rel_rows['item_discount'];
					$item_title=str_replace(' ', '-', $rel_rows['item_title']);
					echo"
						<div class='col-md-3'>
							<div class='col-md-12  single-item noPadding'>
								<div class='top'><img src='$rel_rows[item_image]' class='img-responsive' style='height:200px;'></div>
								<div class='bottom'>
									<h3 class='item-title'><a href='product.php?item_id=$rel_rows[item_id]&$item_title=$item_title'>$rel_rows[item_title]</a></h3>
									<div class='pull-right cutted-price text-muted'><del>$ $rel_rows[item_price]/=</del></div>
									<div class='clearfix'></div>
									<div class='pull-right discounted-price'>$ $discounted_price/=</div>
								</div>
							</div>
						</div>
					";
				}
			?>
		</section>

	</div>	
	<br>	
	<br>	
	<br>	
	<br>	
	<?php include"includes/footer.php";?>
</body>
</html>