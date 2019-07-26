<?php session_start(); require_once './adminlock.php';
if($ses!="")
{
	$tp=cleanTAG($_POST['tp']);
	$id=cleanTAG($_POST['id']);
	switch($tp)
	{
		case 1:
			
			echo $id;
		break;
		case 2:
			
			echo $id;
		break;
	}
}
?>
