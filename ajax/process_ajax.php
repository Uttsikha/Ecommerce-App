<?php 
	$countries[]='US';
	$countries[]='UK';
	$countries[]='India';
	$countries[]='Nepal';
	$countries[]='Pakistan';
	$countries[]='Bangladesh';
	
	foreach($countries as $country){
	
	if (isset($_REQUEST['var1'])){
		if ($_REQUEST['var1']==$country){
			echo '<div style="color: red;">'.$_REQUEST['var1'].'is in the list.</div>';
			
			
		}
	}	
	
	}	
	
?>