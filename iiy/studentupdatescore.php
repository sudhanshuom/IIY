<?php require_once './studentapplock.php';
if($ses!="")
{
	$response["products"] = array();
	$product = array();
 require_once './quizconn.php';
		$tstid=cleanTAG($_REQUEST['tst']);
		$cans=cleanTAG($_REQUEST['cor']);
		$wrng=cleanTAG($_REQUEST['wro']);
		$skp=cleanTAG($_REQUEST['sk']);
		$cans1=cleanTAG($_REQUEST['cor1']);
		$wrng1=cleanTAG($_REQUEST['wro1']);
		$skp1=cleanTAG($_REQUEST['sk1']);
		

$dt=date("Y-m-d",time());
	
		   
					$pid =  1;	
		$qr=" WHERE STUID=".$adminid." and TSTID=".$tstid." order by ID DESC LIMIT 1";						
		$fnd=findnm("ppr_test_done","ID",$qr,$dbh);
		if($fnd=="")
		{
	
	$dbh->exec("INSERT INTO ppr_test_done(DATE1,STUID,STUNM,STUCLS,TSTID,CANS,WRNG,SKP,CANS1,WRNG1,SKP1,SCHOOL) VALUES ('$dt','$adminid','$adminnm','$adminclass','$tstid','$cans','$wrng','$skp','$cans1','$wrng1','$skp1','$ses')");
		}



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
