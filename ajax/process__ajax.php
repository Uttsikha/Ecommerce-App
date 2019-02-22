<?php 
	include'db.php';
	if(isset($_REQUEST['submit_form'])){
		$name=mysqli_real_escape_string($conn,strip_tags ($_REQUEST['name']));
		$email=mysqli_real_escape_string($conn, strip_tags ( $_REQUEST['email']));
		$contact=mysqli_real_escape_string($conn,strip_tags ( $_REQUEST['contact']));
		$notes=mysqli_real_escape_string($conn, strip_tags ($_REQUEST['notes']));
		$ins_sql="INSERT INTO users (u_name, u_email, u_number, u_notes) VALUES ('$name','$email', '$contact' ,'$notes')";
		$run_sql=mysqli_query($conn,$ins_sql);
	}
	if(isset($_REQUEST['del_id'])){
		$del_sql="DELETE FROM users WHERE u_id = '$_REQUEST[del_id]'";
		$run_sql=mysqli_query($conn,$del_sql);
	}
	if(isset($_REQUEST['edit_form'])){
		$edit_name=mysqli_real_escape_string($conn,strip_tags ($_REQUEST['edit_name']));
		$edit_email=mysqli_real_escape_string($conn, strip_tags ( $_REQUEST['edit_email']));
		$edit_contact=mysqli_real_escape_string($conn,strip_tags ( $_REQUEST['edit_contact']));
		$edit_notes=mysqli_real_escape_string($conn, strip_tags ($_REQUEST['edit_notes']));
		
		$edit_sql="UPDATE users SET u_name = '$edit_name', u_email = '$edit_email' , u_number = '$edit_contact' ,u_notes = '$edit_notes' WHERE u_id = '$_REQUEST[edit_id]'";
				$run_sql=mysqli_query($conn,$edit_sql);
	}
	$sql="SELECT * FROM users";
	$run=mysqli_query($conn,$sql);
	$c=1;
	while ($rows=mysqli_fetch_assoc($run)){
		echo"
			<tr> 
			<td>$c</td>
			<td>$rows[u_id]</td>
			<td>$rows[u_name]</td>
			<td>$rows[u_email]</td>
			<td>$rows[u_number]</td>
			<td>$rows[u_notes]</td>
			<td class='text-left'>
				<button class='btn btn-success' data-toggle='modal' data-target='#edit_person$rows[u_id]' data-backdrop='static'>Edit</button>
				<button class='btn btn-danger' onclick=delete_func('$rows[u_id]');>Delete</button>
				<div class='modal fade' id='edit_person$rows[u_id]'>
					<div class='modal-dialog'>
						<div class='modal-content'>
							<div class='modal-header'>
									<button class='close' data-dismiss='modal'>&times;</button>
							</div>
							<h4>   Edit person</h4>
							<div class='modal-body'>
							<form id='edit_form$rows[u_id]' onsubmit=' return edit_form($rows[u_id]);'>
									<div class='form-group'>
										<label for=''>Name</label>
										<input type='text' value='$rows[u_name]' class='form-control' id='edit_uname$rows[u_id]' required>
									</div>
									<div class='form-group'>
										<label for=''>Email</label>
										<input type='email' value='$rows[u_email]' class='form-control' id='edit_uemail$rows[u_id]' required>
									</div>
									<div class='form-group'>
										<label for=''>Contact Number</label>
										<input type='text' class='form-control' value='$rows[u_number]'id='edit_ucontact$rows[u_id]' required> 
									</div>
									<div class='form-group'>
										<label for=''>Notes</label>
										<textarea class='form-control' id='edit_unotes$rows[u_id]'   value='$rows[u_notes]' cols='30' rows='10'></textarea>
									</div>
									<div class='form-group'>
										<button class='btn btn-block btn-lg btn-info'>Done Editing</button>
									</div>
							
							</form></div>
							<div class='modal-footer'>
							<div class='text-right'>
								<button class='btn btn-danger' data-dismiss='modal'>Close</button>
							</div>
</div>
						</div>
					</div>
				</div>
			</td>
			
			</tr>
		";
		$c++;	
	}

	
?>