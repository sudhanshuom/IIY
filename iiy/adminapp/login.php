<?php $pid=$_REQUEST['pid'];
require_once '../conn.php';
require_once '../fun.php';

$pass1=md5(cleanTAG($_REQUEST['pass']));
$gc=$_POST['gc'];
$fcm=$_POST['fcm'];
$response = array();
$found=0;

if($pid!="" && $pass1!="")
{

$sql="SELECT *FROM stu_teacher WHERE ID=".$pid." AND PASS='".$pass1."' AND TP=2";
		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row)
        	{
			$product = array();
					$dbh->exec("UPDATE stu_teacher SET GCODE='$fcm' where ID=".$row['ID']."");
					$found= $row['ID'];			
					$product["id"] =  $row['ID'];			
					$product["ps"] =  $row['PASS'];			
					$product["img"] =  $lnk; 
					
					$product["ses"] =  rand(000000,99999999);			
	

				array_push($response["products"], $product);
			}
	
		if($found>0)
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
