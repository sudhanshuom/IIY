<?php require_once './applock.php';
$clss="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; width:100%; padding:5px 0 5px 5px;";

$response = array();

$ses="2";
$lmt=6;
//$login_name="unique";
if($stuid!="" && $ses!="")
{
	$response["products"] = array();
	$product = array();

	$sql="Select * from stu_teacher WHERE ID='$stuid' and PASS='$ps'";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			


$src='http://a-school.aouji.com/stuimages/'.$login_name.'/'.$row['IMAGE'];
//$src="http://www.smalsaruniqueschool.com/image/logo.png";
$src="http://a-school.aouji.com/gallery/".$login_name."/logo.png";
	//block 1
		$nm=findnm("school_info","NM","",$dbh);			
		$nm2=findnm("school_info","AD","",$dbh);			
				
		$basic= '<table border="0"  style="'.$clss.' width:100%"><tr><td width=25%><center><img src="'.$src.'" width=80% /><td ><div style="text-transform:uppercase; color:#000000; font-size:1em; margin-bottom:6px"><b>'.$nm.'</b></div>';
		$basic.='<div style="text-transform:uppercase; color:#000000; font-size:0.8em;margin-bottom:6px"><b>'.$nm2.'</b></div>';	
		//$basic.='<div style="text-transform:uppercase; color:#000000; font-size:0.6em;margin-bottom:6px"><b>'.$admindes.'</b></div>';	
	//	$basic.='<div style="text-transform:uppercase; color:#000000; font-size:0.8em;margin-bottom:6px"><b>D.O.B. '.$admindob.'</b></div>';	

		$basic.='</center></table>';			
$product["nm"] = $basic;
	//Staff Birthday

$nm2data='';
$dt1=date("m-d");
$tots=0;$morestaff=0;
$morestu=0;
		$sql="WHERE DOB LIKE '%".$dt1."'";
		$tots=countnm("school_tech",$sql,$dbh);
		
		$sql="Select * from school_tech WHERE DOB LIKE '%".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
			if($morestaff<$lmt)$nm2data.='<img width="30" height="40" src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$row['IMAGE'].'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
			$morestaff++;
			}
					
	//Student Birthday
		$sql="WHERE DOB LIKE '%".$dt1."'";
		$tots=countnm("reg",$sql,$dbh);
		$sql="Select * from reg WHERE DOB LIKE '%".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
		
			if($morestu<$lmt)$nm2data.='<img width="30" height="40" src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$row['IMAGE'].'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';	$morestu++;
			}
		
	
			if($nm2data==""){
				$product["nm2"]='<center>No Birthday Today</center>';	
			}else {
				if(($morestaff-$lmt)<0) $stf=0; else $stf=($morestaff-$lmt);		
					if(($morestu-$lmt)<0) $stu=0; else $stu=($morestu-$lmt);
				$more=$stf+$stu;	
				if($more>0)	$nm2data.='<span style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:0px 5px 5px -15px;border-radius: 50%; padding:10px 8px 10px 8px; position:absolute; background:#1f3cec; color:#ffffff">+'.$more.'</span>';
				$product["nm2"]='<div align="center" style="'.$clss.'">'.$nm2data.'</div>';	
			}
if($more>0)			
$product["nm2more"]=$stf.'+'.$stu.' More';
else
$product["nm2more"]=' View';



	//Staff Leave

$nm2data='';
$dt1=date("Y-m-d");
$tots=0; $more=0;
$morestaff=0;
$morestu=0;
	$sql="Select * from attteacher WHERE DATE1 LIKE '".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
				$sid=explode(",",$row['SID']);
				$att=explode(",",$row['ATT']);
				for($x=0;$x<count($sid);$x++)
				{
			if($att[$x]>0){
		
				$img=findnm("school_tech","IMAGE"," WHERE ID=".$sid[$x]."",$dbh);	
			if($morestaff<$lmt)$nm2data.='<img width="30" height="40" src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$img.'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
				$morestaff++;

					}
				}
				
							
			}
			//Student leave

	$sql="Select * from att WHERE DATE1 LIKE '".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
				$sid=explode(",",$row['SID']);
				$att=explode(",",$row['ATT']);
			for($x=0;$x<count($sid);$x++)
				{
		
			if($att[$x]>0){
					
				$img=findnm("reg","IMAGE"," WHERE ID=".$sid[$x]."",$dbh);	
			if($morestu<$lmt)$nm2data.='<img width="30" height="40" src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$img.'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
						$morestu++;;
		
					}
				}
				
							
			}
			if($nm2data==""){
				$product["nm3"] ='<center>Staff Attendance not Taken</center>';	
			}else {
					if(($morestaff-$lmt)<0) $stf=0; else $stf=($morestaff-$lmt);		
					if(($morestu-$lmt)<0) $stu=0; else $stu=($morestu-$lmt);
				$more=$stf+$stu;	
				
				if($more>0)	$nm2data.='<span style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:0px 5px 5px -15px;border-radius: 50%; padding:10px 8px 10px 8px; position:absolute; background:#1f3cec; color:#ffffff">+'.$more.'</span>';
				$product["nm3"] ='<div align="center" style="'.$clss.'">'.$nm2data.'</div>';	
			}

if($more>0){	
		
$product["nm3more"]=$stf.'+'.$stu.' More';
}else {
$product["nm3more"]=' View';
}
////////// Staff leave request ///////////////////////

$nm2data='';
$morestaff=0;
$morestu=0;
$stf=0;
$stu=0;
$more=0;	
	$sql=" WHERE FDATE <= '".$dt1."' AND  TDATE >= '".$dt1."'";
		$tots=countnm("tech_leave_request",$sql,$dbh);

$sql="Select * from tech_leave_request WHERE FDATE <= '".$dt1."' AND  TDATE >= '".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
			$img=findnm("school_tech","IMAGE"," WHERE ID=".$row['STUID']."",$dbh);	
			if($morestaff<$lmt)$nm2data.='<img width="30" height="40" src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$img.'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
			$morestaff++;
			}
			
////////// student leave request ///////////////////////			
	$sql=" WHERE FDATE <= '".$dt1."' AND  TDATE >= '".$dt1."'";
		$tots=countnm("tech_leave_request",$sql,$dbh);

$sql="Select * from leave_request WHERE FDATE <= '".$dt1."' AND  TDATE >= '".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{

			$img=findnm("reg","IMAGE"," WHERE ID=".$row['STUID']."",$dbh);	
			if($morestu<$lmt)$nm2data.='<img width="30" height="40" src="http://a-school.aouji.com/stuimages/'.$login_name.'/'.$img.'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
			$morestu++;
			}
			
			if($nm2data==""){
				$product["nm4"] ='<center>No leave Request</center>';
				
			}else {
				if(($morestaff-$lmt)<0) $stf=0; else $stf=($morestaff-$lmt);		
					if(($morestu-$lmt)<0) $stu=0; else $stu=($morestu-$lmt);
				$more=$stf+$stu;	
			
				if($more>0)	$nm2data.='<span style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:0px 5px 5px -15px;border-radius: 50%; padding:10px 8px 10px 8px; position:absolute; background:#1f3cec; color:#ffffff">+'.$more.'</span>';
				$product["nm4"] ='<div align="center" style="'.$clss.'">'.$nm2data.'</div>';	
			}

			
if($more>0){	
		
$product["nm4more"]=$stf.'+'.$stu.' More';
}else {
$product["nm4more"]=' View';
}	
//attendance staff


function getatt($tbl,$sql,$tp,$dbh)
{
			$ab=0;
			$lv=0;
			$p=0;
	
    	foreach ($dbh->query($sql) as $row)
        	{
				$sid=explode(",",$row['SID']);
				$att=explode(",",$row['ATT']);
		
				for($x=0;$x<count($sid);$x++)
				{
					//echo '<br>'.$att[$x];
				switch($att[$x])
				{
					case 2: $ab++; break;	
					case 1: $lv++; break;	
					default: $p++; break;	
				}
				
				}
				//echo '<br>'.$ab;
			$fnt='font-size:9px;';	
			$td='border-right:1px #ccc solid;';	
			$tot=findcount($tbl,"",$dbh);
			$p=$tot-$ab-$lv;
			$pr=round(($p/$tot)*100,0);
			}
			$nm2data='<table border="0" width=100% style=" background:#f9f9f9"><tr><td  style="'.$td.'" align=center width=20%><div style="'.$fnt.'">'.$tp.'</div><td align=center  style="'.$td.'"  width=15%><div style="'.$fnt.' color:red">Absent</div>'.$ab.'<td align=center style="'.$td.'" width=15%><div style="'.$fnt.' color:#9da301" >Leave</div>'.$lv.'<td align=center style="'.$td.'" width=15%><div style="'.$fnt.' color:green">Present</div>'.$p.'<td align=center style="'.$td.'" width=15%><div style="'.$fnt.'">Total</div>'.$tot.'<td align=center width=20%><div style="'.$fnt.'">Present %</div>'.$pr.' %</table>';
return	$nm2data;							
}
	
 $nm2data=getatt('school_tech',"Select * from attteacher WHERE DATE1 LIKE '".$dt1."'","Staff",$dbh);
$nm2data.=getatt('reg',"Select * from att WHERE DATE1 LIKE '".$dt1."'","Student",$dbh);
	
	
			
			if($nm2data==""){
				$product["nm5"] ='';	
			}else {
				$product["nm5"] ='<div align="center" style="'.$clss.'">'.$nm2data.'</div>';	
			}
//echo $product["nm5"];
//exit;
//block 6


function strength($sql,$tp,$dbh)
{		

    	foreach ($dbh->query($sql) as $row)
        	{
				switch($row['GENDER'])
				{
					case "Male":
					case "male":
						 $m++; 
					break;	
					case "Female":
					case "female":
						 $f++; 
					break;	
					default: $fm++;
					break;	
				}
					
			$fnt='font-size:9px;';	
			$td='border-right:1px #ccc solid;';	
			$tot=$m+$f+$fm;
		//	$pr=round(($p/$tot)*100,2);
			$nm2data='<table border="0" width=100% style=" background:#f9f9f9"><tr><td align=center  style="'.$td.'" width=25%><div style="'.$fnt.'">'.$tp.'</div><td align=center  style="'.$td.'"  width=25%><div style="'.$fnt.'">Male</div>'.$m.'<td align=center style="'.$td.'" width=25%><div style="'.$fnt.'">Female</div>'.$f.'<td align=center  width=25%><div style="'.$fnt.'">Total</div>'.$tot.'</table>';
			}
			return $nm2data;
}
$nm2data=strength("Select * from school_tech  order by ID","Staff &nbsp; ",$dbh);
$nm2data.=strength("Select * from reg  order by ID","Student",$dbh);

			if($nm2data==""){
				$product["nm6"] ='';	
			}else {
				
				$product["nm6"] ='<div align="center" style="'.$clss.'">'.$nm2data.'</div>';	
			}
	

	
	
	
	
	
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
