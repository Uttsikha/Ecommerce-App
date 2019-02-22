<?php 
	session_start();
	include "includes/db.php";
	if (isset($_GET['chk_item_id'])){
		$date=date('Y-m-d h:i:s');
		$rand_number=mt_rand();
		if (isset($_SESSION['ref'])){}
		else{
		$_SESSION['ref']=$date.'_'.$rand_number;
		}
		$chk_sql="INSERT INTO checkout (chk_item, chk_ref, chk_timing, chk_qty) values('$_GET[chk_item_id]','$_SESSION[ref]','$date',1)";
		if ($chk_run=mysqli_query($conn, $chk_sql)){
			?> <script type="text/javascript"> window.location="shopping_cart.php";</script> <?php
		}
		
	}
	if (isset($_POST['order_submit'])){
		$name=mysqli_real_escape_string($conn,strip_tags($_POST['name']));
		$email=mysqli_real_escape_string($conn,strip_tags($_POST['email']));
		$contact=mysqli_real_escape_string($conn,strip_tags($_POST['contact']));
		$state=mysqli_real_escape_string($conn,strip_tags($_POST['state']));
		$delivery_address=mysqli_real_escape_string($conn,strip_tags($_POST['delivery_address']));

		$ord_ins_sql="INSERT INTO orders (order_name,order_email,order_contact,order_state, order_delivery_address,order_checkout_ref,order_total)
		VALUES ('$name','$email','$contact','$state','$delivery_address','$_SESSION[ref]','$_SESSION[grand_total]')";
		mysqli_query($conn,$ord_ins_sql);
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script type="text/javascript">
		function ajax_func(){
			xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange= function(){
				if (xmlhttp.readyState==4 && xmlhttp.status == 200){
					document.getElementById('get_processed_data').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','buy_process.php',true);
			xmlhttp.send();
		}
		function del_func(chk_id){
			xmlhttp= new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status == 200){
					document.getElementById('get_processed_data').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','buy_process.php?chk_del_id='+chk_id,true);
			xmlhttp.send();
		}
		function up_chk_qty(chk_qty,chk_id){
			xmlhttp= new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
				if (xmlhttp.readyState==4 && xmlhttp.status == 200){
					document.getElementById('get_processed_data').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','buy_process.php?up_chk_qty='+chk_qty+'&up_chk_id='+chk_id,true);
			xmlhttp.send();
		}
	</script>
</head>
<body onload="ajax_func()">
	<?php include"includes/header.php";?>
	<div class="container">
		<div class="page-header">
			<h2 class=" pull-left">CheckOut</h2>
			<div class="pull-right">
				<button class="btn btn-success" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false">Proceed</button>
			</div>
			<div id="modal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label for="name">Name</label>
									<input type="text" name="name" class="form-control" placeholder="Full Name">
								</div>
								<div class="form-group">
									<label for="mail">Email Address</label>
									<input type="email" name="email" class="form-control" placeholder="Email ID">
								</div>
								<div class="form-group">
									<label for="contact">Contact Number</label>
									<input type="text" name="contact" class="form-control" placeholder="Contact Number">
								</div>
								<div class="form-group">
									<label for="state">State</label>
									<input list="states"  name = "state" id="state" class="form-control">
									<datalist id="states">
										<option>Washington</option>
										<option>New York</option>
										<option>Florida</option>
										<option>Indiana</option>
										<option>Ohio</option>
										<option>Origon</option>
									</datalist>
								</div>
								<div class="form-group">
									<label for="address">Delivery Address</label>
									<textarea class="form-control" name="delivery_address"></textarea>
								</div>
								<div class="form-group">
									<input type="submit" name="order_submit" class="btn btn-danger btn-block btn-lg">
								</div>
								
							</form>
						</div>
						<div class="modal-footer">
							<button class="btn btn-default" data-dismiss="modal">CLose</button>
						</div>		
					</div>
				</div>	
			</div>
			<div class="clearfix"></div>
		</div>	
		<div class="panel panel-default">
			<div class="panel-heading">Order Details</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Item</th>
							<th>Qty</th>
							<th>Delete</th>
							<th class="text-right">Price</th>
							<th class="text-right">Total</th>
						</tr>
					</thead>
					<tbody id="get_processed_data">
					</tbody>
				</table>
				
			</div>
		</div>
	</div>

	<?php include"includes/footer.php";?>
</body>
</html>