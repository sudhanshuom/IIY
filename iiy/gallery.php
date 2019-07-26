<?php  $tp=$_REQUEST['tp'];
	if($tp=="3") {require_once './adminlock.php'; $techid=$stuid;} else{require_once './lock.php'; $studentid=$stuid;} 
	
require_once './css/bootstrap.php';
$clss="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px 5px;border-radius: 50%; overflow:hidden";

$response = array();
$data.='<style>.caption1{font-size:12px; font-weight:bold;color:#0000ff;margin-top:4px; padding:5px;}.caption2{font-size:10px;margin-top:4px;padding:5px;}</style>';
$data2=$data;

$ses=1;
//$data.='<link rel="stylesheet" href="css/styles.css">';
$data.='<meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;" />';

$data.='<center><div align="center">';

$lmt=5;
//$login_name="unique";

if($stuid!="" && $ses!="")
{
	$response["products"] = array();
	$product = array();
$cid=cleanTAG($_REQUEST['cid']);


$dt1=date("m-d");

	$sql="Select * from stu_gallery where CID=$cid";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
			$img =  $row['IMAGE'];			
$src='http://aouji.com/iiy/download/'.$img;
$data.='<div align="center"  >';
$data.='<img src="'.$src.'" width=100% alt="" style="border:5px #cccccc solid;"/>';
$data.='</div><br>';		

			}



$data.='</div></center>';	
$product["nm"]=$data;
$product["nm2"]=$data2;

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
