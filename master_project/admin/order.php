<!DOCTYPE html>
<html>
<head>
	<title>Order | Admin Panel | Online Shopping</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../css/admin-style.css" type="text/css">
	<script type="text/javascript">
		function get_order_list(){
			xmlhttp= new XMLHttpRequest();
			xmlhttp.onreadystatechange= function (){
				if(xmlhttp.readyState = 4 && xmlhttp.status == 200){
					document.getElementById('get_order_list_data').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','order_list.php',true);
			xmlhttp.send();
		}
		function order_status(order_status,order_id){
			if (order_status==1){
				order_status=0;
			}else{
				order_status=1;
			}
			xmlhttp.onreadystatechange= function (){
				if(xmlhttp.readyState = 4 && xmlhttp.status == 200){
					document.getElementById('get_order_list_data').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','order_list.php?order_status='+order_status+'&order_id='+order_id,true);
			xmlhttp.send();
		}
		function return_status(order_return_status,order_id){
			if (order_return_status==1){
				order_return_status=0;
			}else{
				order_return_status=1;
			}
			xmlhttp.onreadystatechange= function (){
				if(xmlhttp.readyState = 4 && xmlhttp.status == 200){
					document.getElementById('get_order_list_data').innerHTML=xmlhttp.responseText;
				}
			}
			xmlhttp.open('GET','order_list.php?order_return_status='+order_return_status+'&order_id='+order_id,true);
			xmlhttp.send();
		}
	</script>
</head>
<body onload="get_order_list();">

	<?php include "includes/header.php";?>
	<div class="container">
		<div id="get_order_list_data"></div>
	</div>
	<?php include "includes/footer.php";?>
	
</body>
</html>