<?php  $tp=$_REQUEST['tp'];
	if($tp=="3") {require_once './adminlock.php'; $techid=$stuid;} else{require_once './lock.php'; $studentid=$stuid;} 
if($ses!="")
{
	$response["products"] = array();
	$product = array();
		$ops1=cleanTAG($_REQUEST['ops1']);
		$nps1=cleanTAG($_REQUEST['nps1']);
		$cps1=cleanTAG($_REQUEST['cps1']);
			   
	if(md5($ops1)==$ps && $nps1==$cps1)	
	{
	
			$p=md5($nps1);
			if($tp=="3"){
				$dbh->exec("UPDATE stu_teacher SET PASS1='$nps1' where ID=".$stuid."");
				$dbh->exec("UPDATE stu_teacher SET PASS='$p' where ID=".$stuid."");
			}else{
				$dbh->exec("UPDATE stu_info SET PASS1='$nps1' where ID=".$stuid."");
				$dbh->exec("UPDATE stu_info SET PASS='$p' where ID=".$stuid."");
	
				}
			$pid =  "1";
			$output=md5($nps1);
	} else {
		$pid="";
		
		}


array_push($response["products"], $product);

	
		if($pid!="")
		{
				$response["success"] = 1;
				$response["nps"] = $output;
				echo json_encode($response);
		}else{
				$response["success"] = 0;
				$response["nps"] = "";
				echo json_encode($response);
		}

}
else{
		$response["success"] = 0;
		echo json_encode($response);

}
?>
