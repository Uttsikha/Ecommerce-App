<!DOCTYPE html>
<html>
<head>
	<title>Front Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
	<?php include"includes/header.php";?>
	<?php include "includes/db.php"?>
	<div class="container">
		<div class="row">
			<?php
			if (isset($_GET['category'])){
				$sql="SELECT * FROM items WHERE item_cat='$_GET[category]'";
				$run=mysqli_query($conn,$sql);
				while ($rows=mysqli_fetch_assoc($run)) {
					$discounted_price=$rows['item_price']-$rows['item_discount'];
					$item_title=str_replace(' ', '-', $rows['item_title']);
					echo"
						<div class='col-md-3'>
							<div class='col-md-12  single-item noPadding'>
								<div class='top'><img src='$rows[item_image]' class='img-responsive' style='height:200px;'></div>
								<div class='bottom'>
									<h3 class='product_title'><a href='product.php?item_title=$item_title&item_id=$rows[item_id]'>$rows[item_title]</a></h3>
									<div class='original_price pull-right'><del>$rows[item_price]/-</del>
									</div><br>
									<div class='clearfix'></div>
									<div class='current_price pull-right'>$$discounted_price/-</div>
									<div class='clearfix'></div>
								</div>
							</div>
						</div>			";
				}
			}
			?>
							
		</div>
	</div>
	<div class="clearfix"></div>
	<?php include"includes/footer.php";?>
	
</body>
</html>