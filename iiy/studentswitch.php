<?php $pid=$_REQUEST['pid'];
$user=$_REQUEST['46f653456fgfjggfh'];
require_once './conn.php';
require_once './fun.php';
//$gc=$_POST['gc'];
//$fcm=$_POST['fcm'];
$response = array();
$found=0;

if($pid!="" && $user!="")
{
$tbl="reg";
$sql="SELECT *FROM $tbl WHERE ID=".$pid."";
		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row)
        	{
			$product = array();
					//$dbh->exec("UPDATE $tbl SET GCODE='$fcm' where ID=".$row['ID']."");
					$found= $row['ID'];			
					$product["id"] =  $row['ID'];			
				//	$product["nm"] =  $row['NM'];			
					$product["ps"] =  $row['PASS1'];			
//	$lnk='<body bgcolor="#007945"><img src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$row['IMAGE'].'" width=70 style="border-radius: 50%;"></body>';
					$product["img"] =  $lnk; 
					
				//	$product["subnm"] =  $row['DES'];
				//	$nm=findnm("school_info","NM","",$dbh);			
				//	$nm2=findnm("school_info","AD","",$dbh);			
				//	$product["insti"] =  $nm;			
				//	$product["instiad"] =  $nm2;			
				//	$product["im"] =  $row['IMAGE'];			
					$product["ses"] =  $user;//rand(000000,99999999);			

				//	$sql2="SELECT *FROM state";
				//	$x=0;
//					$cls=array("class");
				 //   	foreach ($dbh->query($sql2) as $row2)
				  //      	{
				//				$product[$x] =  $row2['STATE'];
				//				$x++;			
                 //        	}
				//	$product["classcount"] =  $x;//rand(000000,99999999);			

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
