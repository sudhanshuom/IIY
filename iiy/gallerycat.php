<?php  $tp=$_REQUEST['tp'];
	if($tp=="3") {require_once './adminlock.php'; $techid=$stuid;} else{require_once './lock.php'; $studentid=$stuid;} 
	 $response = array();
if($ses!="")
{		$dt1=date("m-d");
$q=cleanTAG($_GET['q']);

//if($q=='All'){
	$sql="Select * from stu_gallerycat order by ID DESC";
//}else{
//	$q=findnm("state","ID","WHERE STATE='".$q."'",$dbh);			
	//$sql="Select * from reg WHERE COURSE=".$q." LIMIT 10";
//}

		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row) 
        	{
			$product = array();
			
							$pid =  $row['ID'];			
	 						$product["id"] =  $row['ID'];			
							$product["nm"] =  $row['ALB'];			
							$product["cls"] =  "";			
									
							$product["subnm"] ="";// date("d-m-Y",strtotime($row['DATE1']));
$im=findnm("stu_gallery","IMAGE","WHERE CID=".$row['ID']." LIMIT 1",$dbh);	
        				//	$im=$row['IMAGE'];
											

$lnk="http://aouji.com/iiy/download/".$im;

if(file_exists($lnk))
{			
				
			$product["imgall"] =  $lnk;			
			
}else{
			$product["imgall"] = "http://aouji.com/newdemoschool_144c0ee4c5c0db518b476553401ead33_202cb962ac59075b964b07152d234b701/uploads/wait.png";			
}
$product["imgall"] =$lnk;

				array_push($response["products"], $product);
			}
	
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
