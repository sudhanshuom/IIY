<?php if($_REQUEST['tp']==3) require_once './adminlock.php'; else require_once './lock.php';
if($ses!="")
{
	$response["products"] = array();
	$product = array();
		$eid=cleanTAG($_REQUEST['extrapid']);
		$fdt=date("Y-m-d",strtotime($_REQUEST['fdt']));
		$tdt=date("Y-m-d",strtotime($_REQUEST['tdt']));
		$cmt=cleanTAG($_REQUEST['cmt']);
		$rltion=cleanTAG($_REQUEST['rltion']);

$dt=date("Y-m-d",time());
$tm=date("h:i:s",time());
		
		   
					$pid =1;	
if($_REQUEST['tp']==3){$sentbyT=$stuid;}else {$sentbyS=$stuid;}
	$dbh->exec("INSERT INTO stu_leave_request(STUID,TECHID,CLID,DATE1,FDATE,TDATE,TM,CMT,RLTION) VALUES ('$sentbyS','$sentbyT','$clid','$dt','$fdt','$tdt','$tm','$cmt','$rltion')");

	



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
