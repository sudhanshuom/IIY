<?php  require_once './lock.php';
$response = array();
if($ses!="")
{		$dt1=date("m-d");
$sql="Select * from stu_appmenu WHERE TP=0 order by ID ASC";
		$response["products"] = array();
    	foreach ($dbh->query($sql) as $row) 
        	{
			$product = array();
			
							$pid =  $row['ID'];			
	 						$product["id"] =  $row['ID'];			
							$product["nm"] =  $row['NM'];			
							$product["cls"] =  "";			
				$cnt="";
					switch($row['NM'])
						{
						case "Feedback":
							$cnt=countnm("feedback"," where STUID=$stuid and NOTI=1",$dbh);	
							$dbh->exec("UPDATE feedback SET NOTI='0' where STUID=$stuid");
							$i=str_replace(" ","",$row['NM']);	
					$lnk="http://aoujieduapp.aouji.com/erp/gallery/dipsmlt/".$i.'.png';

						break;
						case "Profile":
							$im=findnm("stu_info","IMAGE"," where ID=$stuid",$dbh);	
					$lnk="http://aouji.com/iiy/images/".$im;

						break;
					
						case "Homework":
							$q2=" where NOTI LIKE '%[".$stuid."]%' ";
							$cnt=countnm("homework",$q2,$dbh);
							$nm=findnm("homework","NOTI",$q2,$dbh);
							$newnm=str_replace("[".$stuid."]","",$nm);
							$dbh->exec("UPDATE homework SET NOTI='$newnm' ".$q2);	
							$i=str_replace(" ","",$row['NM']);	
					$lnk="http://aoujieduapp.aouji.com/erp/gallery/dipsmlt/".$i.'.png';
					
			  
						break;
						
							case "Child Space":
							$q2=" where NOTI LIKE '%[".$stuid."]%' ";
							$cnt=countnm("childspace",$q2,$dbh);
							$i=str_replace(" ","",$row['NM']);	
					$lnk="http://aoujieduapp.aouji.com/erp/gallery/dipsmlt/".$i.'.png';
					
			  
						break;	
				
						case "Managing Director":
						case "Secretary":
						case "Principal":
						$i=str_replace(" ","",$row['NM']);	
					$lnk="http://aoujieduapp.aouji.com/erp/gallery/".$ses."/".$i.'.png';
		
						break;
						default:
					$i=str_replace(" ","",$row['NM']);	
					$lnk="http://aoujieduapp.aouji.com/erp/gallery/dipsmlt/".$i.'.png';

						break;
							}
								if($cnt!="") 	
							$product["subnm"] = $cnt;
							else
							$product["subnm"] = "";
							

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
