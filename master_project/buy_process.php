<?php
	session_start(); 
	include 'includes/db.php';
	if (isset($_REQUEST['chk_del_id'])){
		$chk_del_sql="DELETE FROM checkout WHERE chk_id='$_REQUEST[chk_del_id]'";
		$chk_del_run=mysqli_query($conn,$chk_del_sql);
	}

	if (isset($_REQUEST['up_chk_qty'])){
		$up_chk_qty_sql="UPDATE checkout SET chk_qty='$_REQUEST[up_chk_qty]' WHERE chk_id='$_REQUEST[up_chk_id]'";
		$up_chk_qty_run=mysqli_query($conn,$up_chk_qty_sql);
	}

	$c=1;
	$total=0;
	$delivery_charge=0;
	$chk_sel_sql="SELECT * FROM checkout c JOIN items i ON c.chk_item=i.item_id WHERE c.chk_ref='$_SESSION[ref]'";
	$chk_sel_run=mysqli_query($conn,$chk_sel_sql);
	while($chk_sel_rows=mysqli_fetch_assoc($chk_sel_run)){
		$discounted_price=$chk_sel_rows['item_price']-$chk_sel_rows['item_discount'];
		$sub_total= $discounted_price * $chk_sel_rows['chk_qty'];
		$total += $sub_total;
		$delivery_charge+= $chk_sel_rows['item_delivery'];

		echo"	
			<tr>
				<td>$c</td>
				<td>$chk_sel_rows[item_title]</td>"; ?>
				<td><input type='number' style='width: 45px;' min=1 onblur="up_chk_qty(this.value, '<?php echo $chk_sel_rows['chk_id']; ?>');"value='<?php echo $chk_sel_rows['chk_qty'];?>'></input></td>
				<td><button class='btn btn-danger btn-sm' onclick="del_func(<?php echo $chk_sel_rows['chk_id'];?>);"> Delete</button></td>
				<?php echo"
				<td class='text-right'>$discounted_price</td>
				<td class='text-right'>$sub_total</td>
			</tr>
				
			";
		$c++;
	}
	$_SESSION['grand_total']=$final_total=$total+$delivery_charge;
echo "
		</tbody>
		</table>
		<table class='table'>
					<thead>
						<tr colspan=2>
							<th class='text-center'>Order Summary</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class=''>Sub Total</td>
							<td class='text-right'><b>
								$total/-
							</b></td>
						</tr>
						<tr>
							<td class=''>Delivery Charges</td>
							<td class='text-right'><b>$delivery_charge/-</b></td>
						</tr>
						<tr>
							<td class=''>Grand Total</td>
							<td class='text-right'><b>$_SESSION[grand_total]/-</b></td>
						</tr>
					</tbody>
				</table>
	"
?>