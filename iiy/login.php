<?php
require_once './conn.php';
require_once './fun.php';
 $usr=cleanTAG($_REQUEST['userid']);
$pass1=md5(cleanTAG($_REQUEST['pass']));

$tp=$_REQUEST['tp'];
$fcm=$_REQUEST['fcm'];
$response = array();
$found=0;

if($usr!="" && $pass1!="")
{
if($tp==3)
{
	$sql="SELECT *FROM stu_teacher WHERE ID=".$usr." AND PASS='".$pass1."' AND TP=3";
}else if($tp==2)
{
	$sql="SELECT *FROM stu_teacher WHERE ID=".$usr." AND PASS='".$pass1."' AND TP=2";
}else {
	$sql="SELECT *FROM stu_info WHERE ID=".$usr." AND PASS='".$pass1."'";
}
	$response["products"] = array();
    	foreach ($dbh->query($sql) as $row)
        	{
			$product = array();
				$dv=md5(rand(0000,9999999));
					$dbh->exec("UPDATE $tbl SET GCODE='$fcm' where ID=".$row['ID']."");
					$dbh->exec("UPDATE $tbl SET TOKEN='$dv' where ID=".$row['ID']."");
					$found= $row['ID'];			
					$product["id"] =  $row['ID'];			
					$product["ps"] =  $row['PASS'];			
					$product["ses"] =  md5(rand(000000,99999999));			
				array_push($response["products"], $product);
			}
	
		if($found>0)
		{
				$response["success"] = 1;
				echo json_encode($response);
		}else{
			//	$success = array();
				//$success["succ"]=0;
				//$response["products"] = array();
				//array_push($response["success"], $success);
				$response["success"] = 0;
				echo json_encode($response);
		}

}
else{
		$response["success"] = 0;
		echo json_encode($response);

}
?>
