<?php $tp=$_REQUEST['tp'];
	require_once './adminlock.php'; 
	 $response = array();
if($ses!="")
{		$dt1=date("m-d");
$classid=cleanTAG($_GET['classid']);
		$classsub=findnm("stu_class","SUB"," WHERE ID=".$classid."",$dbh);

	$sql="Select * from stu_sub WHERE ID in(".$classsub.") order by ID DESC";
		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row) 
        	{
			$product = array();
			
							$pid =  $row['ID'];			
	 						$product["id"] =  $row['ID'];			
							$product["nm"] =  $row['SUB'];			
							$product["cls"] =  "";			
									
							$product["subnm"] = date("d-m-Y",strtotime($row['DATE1']));
$im=findnm("gallery","IMAGE","WHERE CID=".$row['ID']." LIMIT 1",$dbh);	
        				//	$im=$row['IMAGE'];
											

$lnk="http://aoujieduapp.aouji.com/erp/gallery/".$login_name."/".$im;

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
