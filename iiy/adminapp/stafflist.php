<?php  require_once './applock.php';
$response = array();
if($ses!="")
{		$dt1=date("m-d");
$q=cleanTAG($_GET['q']);


	$sql="Select * from school_tech WHERE DES!='ADMIN' order by NM ASC";


		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row) 
        	{
			$product = array();
			
							$pid =  $row['ID'];			
	 						$product["id"] =  $row['ID'];			
							$product["nm"] =  $row['NM'];	
							
							$product["cls"] =$row['DES'];
							if($adminper==1)
								$product["subnm"] = $row['QUALI'];
							else
								$product["subnm"] = "";

        					$im=$row['IMAGE'];
											
if($im=="") $im="teacher.png";
$lnk="http://aoujieduapp.aouji.com/erp/stuimages/".$login_name."/".$im;

if(file_exists($lnk))
{			
				
			$product["imgall"] =  $lnk;			
			
}else{
			$product["imgall"] = "";			
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
