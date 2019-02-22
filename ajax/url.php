<?php 
echo 'This is the PHP page';
echo '<br>';
echo '<br>';
echo '<b>This is the PHP page</b>';
echo '<br>';

$names[]="Mark";
$names[]="John";
$names[]="Shaun";
$names[]="Harry";
$names[]="Walton";
$names[]="Lara";
$c =1;
foreach( $names as $name){
	if($_REQUEST['var1']==$name){
		echo $c.' '.$name.' is the important name<br><br>';
		
	}else
	{
			
	echo $c.' '.$name.'<br><br>';
		
	}
	$c++;
	
}
if (isset($_REQUEST['var2'])){
	if($_REQUEST['var2']== ''){
		echo 'Empty variable';
	}else{
	echo 'We have some'.$_REQUEST['var2'].'.We will eat them';
	}
}
	else 
	{
		echo"Variable not present.";
	}
?>