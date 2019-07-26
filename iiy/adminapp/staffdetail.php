<?php require_once './applock.php';
require_once '../css/bootstrap.php';
$tab1=$data;
$tab2=$data;
$tab3=$data;
$tab4=$data;
$tab5=$data;
$clss="border:1px #cccccc solid;box-shadow: 3px 3px 10px grey; margin:0; overflow:hidden; border:1px #cccccc solid; padding:3px;";

$response = array();

$ses=1;
$data.='<meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;" />';

$data.='<body bgcolor=#990406><center><div align="center" >';

$lmt=5;
//$login_name="unique";

if($ses!="")
{
	$response["products"] = array();
	$product = array();
$eid=cleanTAG($_REQUEST['extrapid']);

$dt1=date("m-d");
	$sql="Select * from stu_teacher WHERE ID=".$eid."";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];		
				if($row['IMAGE']!="") $img=$row['IMAGE']; else $img='teacher.png';		
$src='https://aoujiedu.app/erp/stuimages/'.$login_name.'/'.$img;
$data.='<div class="col-sm-3 col-xs-3"  align="center"  > <div class="pasnel panel-default">
        <div class="panel-body" align="center"><span><img src="'.$src.'" width=100% height=90 style="'.$clss.'"/></span></div>
    </div></div>';	
$data.='<div class="col-sm-7 col-xs-7" align="center" style="border:0px red solid;"> <div class="pasnel panel-default">';
 $data.='<div class="panel-body" align="left">';


 $data.='<div style="color:white;font-weight:bold;">'.$row['NM'].'</div>';
 $data.='<div style="color:white;font-weight:bold;font-size:10px; margin-top:5px;">'.$row['DES'].'</div>';
 if($adminper==1)
	$data.='<div style="color:white;font-weight:bold;font-size:12px; margin-top:5px;">'.$row['QUALI'].'</div>';
 else
	 $data.='<div style="color:white;font-weight:bold;font-size:12px; margin-top:5px;"></div>';

  $data.='</div></div></div>';
  	
	


	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/address.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Address';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['AD'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';

	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/phone.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-6 col-xs-6" >Contact Number';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['PH'].'</div></div>';
	
	$tab1.='<div class="col-sm-2 col-xs-2" align="right" >';
	$tab1.='<a href="tel:'.$row['PH'].'"><img src="https://aoujiedu.app/erp/images/call.png" width=30 style="margin:5px;"/></a></div>';
	$tab1.='<hr class="col-sm-12">';
	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/address.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Email';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['EML'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';

	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/birthday.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Date of Birth';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.date("d-m-Y",strtotime($row['DOB'])).'</div></div>';
	$tab1.='<hr class="col-sm-12">';
	
	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/gender.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Gender';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['GENDER'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';
	
	//Tab 2
	
	$tab2.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/app.png" width=30 style="margin:5px;"/></div>';
	$tab2.='<div class="col-sm-9 col-xs-9" >Qualification';
	$tab2.='<div style="font-size:12px; margin-top:5px;">'.$row['QUALI'].'</div></div>';
	$tab2.='<hr class="col-sm-12">';
	
	$tab2.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/subject.png" width=30 style="margin:5px;"/></div>';
	$tab2.='<div class="col-sm-9 col-xs-9" >Subject';
	$tab2.='<div style="font-size:12px; margin-top:5px;">'.$row['SUB'].'</div></div>';
	$tab2.='<hr class="col-sm-12">';
	
	$tab2.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/admissiondate.png" width=30 style="margin:5px;"/></div>';
	$tab2.='<div class="col-sm-9 col-xs-9" >Date of Joining';
	$tab2.='<div style="font-size:12px; margin-top:5px;">'.date("d-m-Y",strtotime($row['DOJ'])).'</div></div>';
	$tab2.='<hr class="col-sm-12">';
	

	$tab2.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/login.png" width=30 style="margin:5px;"/></div>';
	$tab2.='<div class="col-sm-9 col-xs-9" >Login ID';
	$tab2.='<div style="font-size:12px; margin-top:5px;">'.$row['ID'].'@'.$login_name.'</div></div>';
	$tab2.='<hr class="col-sm-12">';


	$tab2.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/app.png" width=30 style="margin:5px;"/></div>';
	$tab2.='<div class="col-sm-9 col-xs-9" >App Installed';
	if($row['GCODE']=="") $ap="No"; else $ap="Yes";
	$tab2.='<div style="font-size:12px; margin-top:5px;">'.$ap.'</div></div>';
	$tab2.='<hr class="col-sm-12">';
	

/*	 
// Tab 3
$found=0;
	$sql2="Select * from stu_driver WHERE ID=".$row['ROUTE']."";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$found=1;
			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Driver Name';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['NM'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';
			
			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Address';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['AD'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';

			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Route No.';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['TROOT'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';

			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Bus No.';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['BUSNO'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';

			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="https://aoujiedu.app/erp/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-6 col-xs-6" >Contact No.';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['PH'].'</div></div>';
			$tab3.='<div class="col-sm-2 col-xs-2" align="right" >';
			$tab3.='<a href="tel:'.$row2['PH'].'"><img src="https://aoujiedu.app/erp/images/call.png" width=30 style="margin:5px;"/></a></div>';
			$tab3.='<hr class="col-sm-12">';

			}
			if($found==0) $tab3.='No Subject set';	
*/
	//Tab 4
/*
	$found=0;
	$sql2="Select * from attteacher order by ID ASC";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				
			$val=explode(",",$row2['SID']);
			$attval=explode(",",$row2['ATT']);
			for($cc=0;$cc<count($val);$cc++)
					{
			
					if($val[$cc]==$eid){
						$found=1;
				if($attval[$cc]==1)
			{ $re="On Leave"; $im="leave.png";} 
			else if($attval[$cc]==2)
			 {$re="Absent"; $im="absent.png";}
				else {$re="";}
			if($re!=""){
			$tab4.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;">';
			$tab4.='<img src="https://aoujiedu.app/erp/images/'.$im.'" width=30 style="margin:5px;"/></div>';
			$tab4.='<div class="col-sm-9 col-xs-9" >'.$re.'<br>'.date("d-m-Y",strtotime($row2['DATE1']));
			$tab4.='</div>';
			$tab4.='<hr class="col-sm-12">';
			}
					}
					}
			}
		if($found==0) $tab4.='No Leave or Absent marked';		
*/
//Tab 5
/*
$found=0;
	 $grpid=findnm("state","GRPID"," WHERE ID=".$row['COURSE']."",$dbh);
$sql3="Select * from term WHERE STTS=1 order by ID ASC";
   foreach ($dbh->query($sql3) as $row3)
      {
		  $tab5.='<div class="col-sm-12 col-xs-12" align="center" style="backgrdound:#3f51b5;border:0px red solid; codlor:white; font-weight:bold; padding:8px;">';
			$tab5.=$row3['TERM'].' (Total: '.$row3['PER'].' )</div>';
		$tot=0;	
		$sql2="Select * from sub WHERE TP=".$grpid."";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$found=1;
			 $marks=findnm("marks",$row3['CLM']," WHERE SID=".$eid." AND SUBID=".$row2['ID']."",$dbh);

		
			$tab5.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;">';
			if($marks!="") $im='resulty.png'; else  $im='resultn.png';
			$tab5.='<img src="https://aoujiedu.app/erp/images/'.$im.'" width=30 style="margin:5px;"/></div>';
			$tab5.='<div class="col-sm-5 col-xs-5" >'.$row2['NM'].'</div>';
			$tab5.='<div class="col-sm-3 col-xs-3" >'.$marks.'</div>';
			$tab5.='<hr class="col-sm-12">';
			$tot=$tot+$marks;
			}
	
	 $tab5.='<div class="col-sm-5 col-xs-5" align="center" style="backgrsound:#3f51b5;border:0px red solid; coldor:whfite; font-weight:bold; padding:8px;">Obtained Marks.</div>';
	  $tab5.='<div class="col-sm-5 col-xs-5" align="center" style="backgrsound:#3f51b5;border:0px red solid; coldor:whfite; font-weight:bold; padding:8px;">'.$tot.'</div>';
	  }
	if($found==0) $tab5.='No Marks updated ';	
	
*/	

	}
$pid=1;
$data.='</div></center>';	
$product["nm"]=$data;
$product["tab1"]=$tab1;
 if($adminper==1)
		$product["tab2"]=$tab2;
	else
		$product["tab2"]="No Permission to view Official Detail";
	
$product["tab3"]=$tab3;
$product["tab4"]=$tab4;
$product["tab5"]=$tab5;
$product["tab6"]=$tab6;
if($_GET['xxx']==1)
{
	
	echo $data;
	echo $tab1;
	echo $tab2;
	echo $tab3;
	echo $tab4;
	echo $tab5;
	echo $tab6;
}
array_push($response["products"], $product);
//echo $tab4;
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
