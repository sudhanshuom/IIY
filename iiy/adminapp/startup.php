<?php $ses=$_REQUEST['ses'];require_once '../conn.php';
$adminid=0;
include('../fun.php');
$clss="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; width:100%; padding:5px 0 5px 5px;";
$stuid=	cleanTAG($_REQUEST['stuid']);
$ps=cleanTAG($_REQUEST['ps']);
$response = array();
function getURL($img)
{	
	global $login_name;
	switch($img)
				{
					 case "Male.png":
					 case "male.png":
						$login_name2='';
					 break;	
					 case "Female.png":
					 case "female.png":
						$login_name2='';
					 break;	
					 case "teacher.png":
						$login_name2='';
					 break;	
					 default:
						$login_name2=$login_name.'/';
			
				}
				return $login_name2;
	}

function getDetail($tbl,$pid,$dbh)
	{
		global $clss,$login_name;
		$img=findnm($tbl,"IMAGE"," WHERE ID=".$pid."",$dbh);	
				$nm=findnm($tbl,"NM"," WHERE ID=".$pid."",$dbh);	
			$dob=date("d-m-Y",strtotime(findnm($tbl,"DOB","WHERE ID=".$pid."",$dbh)));	
				if($tbl=='reg'){
					$ph=findnm($tbl,"MB"," WHERE ID=".$pid."",$dbh);	
					$cls=findnm($tbl,"CLS"," WHERE ID=".$pid."",$dbh);	
					$des=findnm('stu_class',"CLS"," WHERE ID=".$cls."",$dbh);	
					$ad=findnm($tbl,"AD"," WHERE ID=".$pid."",$dbh);	
				}else{
					$ph=findnm($tbl,"PH"," WHERE ID=".$pid."",$dbh);	
					$des=findnm($tbl,"DES"," WHERE ID=".$pid."",$dbh);	
					$ad=findnm($tbl,"AD"," WHERE ID=".$pid."",$dbh);	
				}
				$login_name2=getURL($img);
				$src='http://aoujiedu.app/erp/stuimages/'.$login_name2.$img;
				$data.='<table width=100% border="0" style="'.$clss.'">';
				$data.='<tr><td width=25%><img src="'.$src.'" width=100% class="pdhoto" />';
				$data.='<td style="border:0px red solid; margin:0x; padding:0px">';
				$data.='<div style="font-weight:bold;color:#c81954">'.$nm.'</div>';
				$data.='<div style="font-size:10px">'.$ad.'</div>';
				$data.='<div style="font-size:10px">'.$des.'</div>';
				$data.='<div  style="font-size:10px">'.$dob.'</div>';
				$data.='<div><a href="tel:+91'.$ph.'">';
				$data.='<img src="https://aoujiedu.app/erp/images/call.png" width=20 style="margin-right:5px"></a>';
				$data.='</div>';		
				$data.='</table>';
				return $data;
	}
function getBirthday($tbl,$dt1,$dbh)
	{
	$sql="Select * from $tbl WHERE DOB LIKE '%".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
			//$login_name2=getURL($row['IMAGE']);
			$login_name2=getURL($row['IMAGE']);
			if($morestaff<6)$nm2data.='<img width="30" height="40" src="https://aoujiedu.app/erp/stuimages/'.$login_name2.$row['IMAGE'].'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
			$morestaff++;
			
				$pid=$row['ID'];
				$data.=getDetail($tbl,$pid,$dbh);		
			}
return array($morestaff,$nm2data,$data);
	}
	
function OnLeave($tbl,$dt1,$dbh)
	{	
	if($tbl=="att") $tbl2='reg'; else $tbl2='school_tech';
		$sql="Select * from $tbl WHERE DATE LIKE '".$dt1."'";
    	foreach ($dbh->query($sql) as $row)
        	{
				$sid=explode(",",$row['SID']);
				$att=explode(",",$row['ATT']);
				for($x=0;$x<count($sid);$x++)
				{
			if($att[$x]>0){
		
				$img=findnm($tbl2,"IMAGE"," WHERE ID=".$sid[$x]."",$dbh);
				if($tbl2=='school_tech'){if($img=="")$img='teacher.png';}
				//$login_name2=getURL($img);	
			if($morestaff<6)$nm2data.='<img width="30" height="40" src="https://aoujiedu.app/erp/stuimages/'.$login_name2.$img.'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
				$morestaff++;
				$pid=$sid[$x];
					$data3.=getDetail($tbl2,$pid,$dbh);

					}
				}
				
							
			}
		return array($morestaff,$nm2data,$data3);
	}
	
function LeaveRequest($tbl,$sql,$dbh)
	{	
	if($tbl=="leave_request") $tbl2='reg'; else $tbl2='school_tech';	
	
	$sql="Select * from $tbl ".$sql."";
    	foreach ($dbh->query($sql) as $row)
        	{
			$img=findnm($tbl2,"IMAGE"," WHERE ID=".$row['STUID']."",$dbh);	
			$login_name2=getURL($img);
			if($morestaff<6)$nm2data.='<img width="30" height="40" src="https://aoujiedu.app/erp/stuimages/'.$login_name2.$img.'" style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:-3px 5px 5px -15px;border-radius: 50%;"/>';
			$pid=$row['STUID'];

			$data3.=getDetail($tbl2,$pid,$dbh);
			
			$morestaff++;
			}
			return array($morestaff,$nm2data,$data3);
	}
		
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
			$nm2data='<table border="0" width=100% style=" background:#f9f9f9; font-size:12px;"><tr><td  style="'.$td.'" align=center width=20%><div style="'.$fnt.'">'.$tp.'</div>&nbsp;<td align=center  style="'.$td.'"  width=15%><div style="'.$fnt.' color:red">Absent</div>'.$ab.'<td align=center style="'.$td.'" width=15%><div style="'.$fnt.' color:#9da301" >Leave</div>'.$lv.'<td align=center style="'.$td.'" width=15%><div style="'.$fnt.' color:green">Present</div>'.$p.'<td align=center style="'.$td.'" width=15%><div style="'.$fnt.'">Total</div>&nbsp;'.$tot.'<td align=center width=20%><div style="'.$fnt.'">Present %</div>'.$pr.' %</table>';
return	$nm2data;							
}


$lmt=6;
if($stuid!="" && $ses!="")
{
	$response["products"] = array();
	$product = array();
	$sql="Select * from stu_teacher WHERE ID='$stuid' and PASS='$ps'";
    	foreach ($dbh->query($sql) as $row)
        	{
				$dv=md5(rand(000000,9999999));
			$product["dv"] = $dv;
			$dbh->exec("UPDATE stu_teacher SET DV='$dv' where ID=".$row['ID']."");
			$pid =  $row['ID'];			
			$product["username"] = $row['NM'];
			$teachertp = $row['TP'];
			//$classes=findnm("teacher_per","CLASSES"," WHERE TID=".$row['ID']."",$dbh);
			$product["usersubname"] = $row['DES'];
			$product["usersubsubname"] =$adminquali;
			if($row['TP']=='ADMIN')
			$product["useradress"] ="Management";
			else
			$product["useradress"] ="Joining Date: ".$admindoj;
			//$login_name2=getURL($row['IMAGE']);
			
			if($row['IMAGE']=="") $im='teacher.png'; else $im=$row['IMAGE'];
			
			$product["usersimage"] = '<body bgcolor="#990406"><img src="http://aoujiedu.app/erp/stuimages/'.$login_name2.$im.'" width=70 style="border-radius: 50%;">';


$src="http://aoujiedu.app/erp/gallery/".$login_name."/logo.png";
	//block 1
		$nm=findnm("school_info","NM","",$dbh);			
		$nm2=findnm("school_info","AD","",$dbh);			
				
		$basic= '<table border="0"  style="'.$clss.' width:100%"><tr><td width=25%><center><img src="'.$src.'" width=80% /><td ><div style="text-transform:uppercase; color:#000000; font-size:1em; margin-bottom:6px"><b>'.$nm.'</b></div>';
		$basic.='<div style="text-transform:uppercase; color:#000000; font-size:0.8em;margin-bottom:6px"><b>'.$nm2.'</b></div>';	

		$basic.='</center></table>';			
$product["schoolnm"] = $basic;
$product["schoolname"] = $nm;


	//Staff Birthday

$nm2data='';
$dt1=date("m-d");
$tots=0;$morestaff=0;
$morestu=0;
$found=0;
list($morestaff,$nm2data,$data)=getBirthday('school_tech',$dt1,$dbh);
	$found=$morestaff;
	$list=$nm2data;
list($morestaff,$nm2data,$data2)=getBirthday('reg',$dt1,$dbh);
	$found+=$morestaff;
	$list.=$nm2data;

$product["teacherbirthday"]=$data;					
$product["studentbirthday"]=$data2;		
		if($found==0){
				$product["nm2"]='<center>No Birthday Today</center>';	
			}else {
				if(($morestaff-$lmt)<0) $stf=0; else $stf=($morestaff-$lmt);		
					if(($morestu-$lmt)<0) $stu=0; else $stu=($morestu-$lmt);
				$more=$stf+$stu;	
				if($more>0)	$nm2data.='<span style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:0px 5px 5px -15px;border-radius: 50%; padding:10px 8px 10px 8px; position:absolute; background:#1f3cec; color:#ffffff">+'.$more.'</span>';
				$product["nm2"]='<div align="center" style="'.$clss.'">'.$list.'</div>';	
			}

if($product["nm2"]=="<center>No Birthday Today</center>")
{
	$product["nm2more"]="";
}else{
			if($more>0)			
			$product["nm2more"]=$stf.'+'.$stu.' More';
			else
			$product["nm2more"]=' View';
}

	//Staff Leave

$nm2data='';
$dt1=date("Y-m-d");
$tots=0; $more=0;
$morestaff=0;
$morestu=0;
$found=0;
$list="";
list($morestaff,$nm2data,$data3)=OnLeave('attteacher',$dt1,$dbh);
	$found=$morestaff;
	$list=$nm2data;
//list($morestaff,$nm2data,$data4)=OnLeave('att',$dt1,$dbh);
		$found+=$morestaff;
	$list.=$nm2data;					
	
			if($found==""){
				$product["nm3"] ='<center>Staff Attendance not Taken</center>';	
			}else {
					if(($morestaff-$lmt)<0) $stf=0; else $stf=($morestaff-$lmt);		
					if(($morestu-$lmt)<0) $stu=0; else $stu=($morestu-$lmt);
				$more=$stf+$stu;	
				
				if($more>0)	$nm2data.='<span style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:0px 5px 5px -15px;border-radius: 50%; padding:10px 8px 10px 8px; position:absolute; background:#1f3cec; color:#ffffff">+'.$more.'</span>';
				$product["nm3"] ='<div align="center" style="'.$clss.'">'.$list.'</div>';	
			}

$product["teacheronleave"]=$data3;
$product["studentonleave"]=$data4;
if($product["nm3"]=="<center>Staff Attendance not Taken</center>")
{
	$product["nm3more"]="";
}else{
		if($more>0){	
		$product["nm3more"]=$stf.'+'.$stu.' More';
		}else {
		$product["nm3more"]=' View';
		}
}

////////// Staff leave request ///////////////////////

$nm2data='';
$morestaff=0;
$morestu=0;
$stf=0;
$stu=0;
$more=0;	
$data3="";
$data4="";
	$sql=" WHERE FDATE <= '".$dt1."' AND  TDATE >= '".$dt1."'";
list($morestaff,$nm2data,$data3)=LeaveRequest('tech_leave_request',$sql,$dbh);
	$found=$morestaff;
	$list=$nm2data;
list($morestaff,$nm2data,$data4)=LeaveRequest('leave_request',$sql,$dbh);
		$found+=$morestaff;
	$list.=$nm2data;		


			if($found==""){
				$product["nm4"] ='<center>No leave Request</center>';
				
			}else {
				if(($morestaff-$lmt)<0) $stf=0; else $stf=($morestaff-$lmt);		
					if(($morestu-$lmt)<0) $stu=0; else $stu=($morestu-$lmt);
				$more=$stf+$stu;	
			
				if($more>0)	$nm2data.='<span style="border:1px #cccccc solid;box-shadow: 0px 3px 10px grey; margin:0px 5px 5px -15px;border-radius: 50%; padding:10px 8px 10px 8px; position:absolute; background:#1f3cec; color:#ffffff">+'.$more.'</span>';
				$product["nm4"] ='<div align="center" style="'.$clss.'">'.$list.'</div>';	
			}

$product["teacherleaver"]=$data3;
$product["studentleaver"]=$data4;			

if($product["nm4"]=="<center>No leave Request</center>")
{
	$product["nm4more"]="";
}else{

			if($more>0){	
					
			$product["nm4more"]=$stf.'+'.$stu.' More';
			}else {
			$product["nm4more"]=' View';
			}	
}

	
// $nm2data=getatt('school_tech',"Select * from attteacher WHERE DATE1 LIKE '".$dt1."'","Staff",$dbh);
//$nm2data.=getatt('reg',"Select * from att WHERE DATE1 LIKE '".$dt1."'","Student",$dbh);
	
	
			
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
					case "MALE":
						 $m++; 
					break;	
					case "Female":
					case "FEMALE":
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
	
$basic="";
	$sql="Select * from stu_news order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:#c81954; font-size:1em; margin-bottom:6px"><b>'.$row['TTL'].'</b><td> <div align=right style="color:#cccccc">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		$basic.='<tr><td colspan=2><div style=" color:#000000; font-size:0.8em;margin-bottom:6px"><b>'.$row['DETAIL'].'</b></div>';	

		$basic.='</center></table>';			

			}

$product["news"] = $basic;


$basic="";
	$sql="Select * from stu_download order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$download =  $row['ID'];			
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:#c81954; font-size:1em; margin-bottom:6px"><b>'.$row['TP'].'</b><td> <div align=right style="color:#cccccc">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		$basic.='<tr><td><div style=" color:#000000; font-size:0.8em;margin-bottom:6px"><b>'.$row['NM'].'</b></div><td align=right><a href="https://aoujiedu.app/erp/gallery/'.$login_name.'/'.$row['IMAGE'].'">Download</a></div>';	

		$basic.='</center></table>';			

			}
if($download=="")
$product["download"] = "Nothing in download ";
else
$product["download"] = $basic;











		




$product["fb"]=$facebook;
$product["tw"]=$twitter;
$product["yt"]=$youtube;
	

//if($adminper==1)
			$sql2="SELECT *FROM stu_class order by CLS ASC";
//else
	//		$sql2="SELECT *FROM stu_class WHERE ID in($classes)  order by CLS ASC";
						$x=0;
					$cls=array("class");
				    	foreach ($dbh->query($sql2) as $row2)
				        	{
								$product[$x] =  $row2['CLS'];
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
