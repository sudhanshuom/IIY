<?php  require_once './applock.php';
$response = array();
if($ses!="")
{		$dt1=date("m-d");
$q=cleanTAG($_GET['q']);

if($q=='All'){
	$sql="Select * from stu_info order by NM ASC limit 10";
}else{
	$q=findnm("stu_class","ID","WHERE CLS='".$q."'",$dbh);			
	$sql="Select * from stu_info WHERE CLS=".$q." order by NM ASC";
}

		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row) 
        	{
			$product = array();
			
							$pid =  $row['ID'];			
	 						$product["id"] =  $row['ID'];			
							$product["nm"] =  $row['NM'];			
							$product["cls"] = findnm("stu_class","CLS","WHERE ID=".$row['CLS']."",$dbh);			
							$product["subnm"] = date("d-m-Y",strtotime($row['DATE1']));

        					$im=$row['IMAGE'];
											
//$lnk="http://aouji.com/schoolapp/college_app/kulwant.jpg";
//$lnk="http://a-school.aouji.com/stuimages/".$ses."/".$im;
$lnk="http://aoujieduapp.aouji.com/erp/stuimages/".$login_name."/".$im;

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
