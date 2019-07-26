<?php require_once './lock.php';
$clss="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; width:100%; padding:5px 0 5px 5px;";
$response = array();
if($stuid!="" && $ses!="")
{
	$response["products"] = array();
	$product = array();
	$sql="Select * from stu_info WHERE ID='$stuid' and PASS='$ps'";

    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
			//$product["newversion"] = "5";
			$product["username"] = $row['NM'];
			$product["usersubname"] = $row['FNM'];
			$product["usersubsubname"] ="Class: ".findnm("stu_class","CLS","WHERE ID='".$row['CLS']."'",$dbh);
			$product["useradress"] ="Date of Birth: ".date("d-m-Y",strtotime($row['DOB']));
			
			//$login_name2=getURL($row['IMAGE']);
		

$product["usersimage"] = '<body bgcolor="'.$adminbg.'"><img src="http://aouji.com/iiy/images/'.$row['IMAGE'].'" width=60 style="border-radius: 50%;">';
//$product["usersimage"] = 'httsp://aouji.com/iiy/images/'.$row['IMAGE'].'"';

$src="http://aoujieduapp.aouji.com/erp/gallery/".$login_name."/logo.png";
	//block 1
			
			
$product["schoolnm"] = "Gowtham Model Schools";
$product["schoolname"] = "West Marredpally";

if($facebook!="")$product["fb"]=$facebook; else $product["fb"]='https://facebook.com';
if($twitter!="")$product["tw"]=$twitter; else $product["tw"]='https://twitter.com';
if($youtube!="")$product["yt"]=$youtube; else $product["yt"]="https://youtube.com";
$product["appnm"]=$appnm;
	



			$sql2="SELECT *FROM stu_info where MB='".$adminmb."' AND ID!=".$stuid."";
		//	$sql2="SELECT *FROM reg ";
						$x=0;
					$cls=array("class");
				    	foreach ($dbh->query($sql2) as $row2)
				        	{
								$product[$x] =  $row2['NM'];
								$product["id".$x] =  $row2['ID'];
								$product["ps".$x] =  $row2['PASS'];
								$x++;			
                         	}

					$product["classcount"] =  $x;//rand(000000,99999999);	
	
	
	
array_push($response["products"], $product);
		}


//echo $nm2data;
//exit;
	
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
