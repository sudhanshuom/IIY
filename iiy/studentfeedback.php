<?php require_once './studentapplock.php';

if($ses!="")
{
	$response["products"] = array();
	$product = array();
		$cmt=cleanTAG($_REQUEST['cmt']);

$dt=date("Y-m-d",time());
$tm=date("h:i:s",time());
		
		   
					$pid =  1;	
	$dbh->exec("INSERT INTO feedback(STUID,DATE1,FEED,TM,STTS,TP) VALUES ('$stuid','$dt','$cmt','$tm','1','Teacher')");
		
	



array_push($response["products"], $product);

	
		if($pid!="")
		{
				$response["success"] = 1;
				echo json_encode($response);
		}else{
				$response["success"] = 0;
				echo json_encode($response);
		}

}
else{
		$response["success"] = 0;
		echo json_encode($response);

}
?>
