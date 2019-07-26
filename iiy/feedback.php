<?php $tp=$_REQUEST['tp'];
	if($tp=="3") {require_once './adminlock.php'; $techid=$stuid;} else{require_once './lock.php'; $studentid=$stuid;} 


if($ses!="")
{
	$response["products"] = array();
	$product = array();
		$cmt=cleanTAG($_REQUEST['cmt']);

$dt=date("Y-m-d",time());
$tm=date("h:i:s",time());
		
		   
					$pid =  $row['ID'];	
	$dbh->exec("INSERT INTO stu_feedback(STUID,TECHID,DATE1,FEED,TM,STTS,TP) VALUES ('$studentid','$techid','$dt','$cmt','$tm','0','$tp2')");
		
	



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
