<?php require_once './applock.php';
require_once '../css/bootstrap.php';
$tab1=$data;
$tab2=$data;
$tab3=$data;
$tab4=$data;
$tab5=$data;
$tab6=$data;
$clss="border:1px gray solid;box-shadow: 3px 3px 10px grey; margin:0; overflow:hidden; border:1px gray solid; padding:3px;";

$response = array();

//$ses=1;
$data.='<meta name="viewport" content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;" />';

$data.='<body bgcolor='.$adminbg.'><center><div align="center" >';

$lmt=5;
//$login_name="unique";

if($ses!="")
{
	$response["products"] = array();
	$product = array();
$eid=cleanTAG($_REQUEST['extrapid']);

$dt1=date("m-d");
	$sql="Select * from stu_info WHERE ID=".$eid."";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
$src='http://aouji.com/iiy/images/'.$row['IMAGE'];
$data.='<div class="col-sm-3 col-xs-3"  align="center"  > <div class="pasnel panel-default">
        <div class="panel-body" align="center"><span><img src="'.$src.'" width=100% height=90 style="'.$clss.'"/></span></div>
    </div></div>';	
$data.='<div class="col-sm-7 col-xs-7" align="center" style="border:0px red solid;"> <div class="pasnel panel-default">';
 $data.='<div class="panel-body" align="left">';


 $data.='<div style="color:white;font-weight:bold;">'.$row['NM'].'</div>';
 $data.='<div style="color:white;font-weight:bold;font-size:10px; margin-top:5px;">'.$row['FNM'].' - '.$row['MNM'].'</div>';
 $cls=findnm("stu_class","CLS"," WHERE ID=".$row['CLS']."",$dbh);
 $data.='<div style="color:white;font-weight:bold;font-size:12px; margin-top:5px;">Class: '.$cls.'</div>';
 //$data.='<div style="color:white;font-weight:bold;font-size:12px; margin-top:5px;">Date of Birth: '.date("d-m-Y",strtotime($row['DOB'])).'</div>';
  $data.='</div></div></div>';
  	
	
	
	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/father.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Father Name';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['FNM'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';

	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/mother.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Mother Name';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['MNM'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';


	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/address.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Address';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['AD'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';

	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/phone.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-6 col-xs-6" >Contact Number';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['MB'].'</div></div>';
	
	$tab1.='<div class="col-sm-2 col-xs-2" align="right" >';
	$tab1.='<a href="tel:'.$row['MB'].'"><img src="http://a-school.aouji.com/images/call.png" width=30 style="margin:5px;"/></a></div>';
	$tab1.='<hr class="col-sm-12">';

	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/birthday.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Date of Birth';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.date("d-m-Y",strtotime($row['DOB'])).'</div></div>';
	$tab1.='<hr class="col-sm-12">';
	
	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/gender.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Gender';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['GENDER'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';
	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/admissiondate.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Admission Date';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.date("d-m-Y",strtotime($row['ADMDATE'])).'</div></div>';
	$tab1.='<hr class="col-sm-12">';
	
	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/admission.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >Admission Number';
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$row['ADMNO'].'</div></div>';
	$tab1.='<hr class="col-sm-12">';


	$tab1.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/app.png" width=30 style="margin:5px;"/></div>';
	$tab1.='<div class="col-sm-9 col-xs-9" >App Installed';
	if($row['GCODE']=="") $ap="No"; else $ap="Yes";
	$tab1.='<div style="font-size:12px; margin-top:5px;">'.$ap.'</div></div>';
	$tab1.='<hr class="col-sm-12">';
	
	//Tab 2
	 $grpid=findnm("stu_class","SUB"," WHERE ID=".$row['CLS']."",$dbh);

		$sql2="Select * from stu_sub WHERE ID IN (".$grpid.")";
    	foreach ($dbh->query($sql2) as $row2)
        	{
			$tab2.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;">';
			$tab2.='<img src="http://a-school.aouji.com/images/subject.png" width=30 style="margin:5px;"/></div>';
			$tab2.='<div class="col-sm-9 col-xs-9" >'.$row2['SUB'].'';
			$tab2.='</div>';
			$tab2.='<hr class="col-sm-12">';
			}
		
// Tab 3
$found=0;
	$sql2="Select * from stu_driver WHERE TROOT='".$row['VAN']."'";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$found=1;
			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Driver Name';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['NM'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';
			
			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Address';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['AD'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';

			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Route No.';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['TROOT'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';

			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-9 col-xs-9" >Bus No.';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['BUSNO'].'</div></div>';
			$tab3.='<hr class="col-sm-12">';

			$tab3.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;"><img src="http://a-school.aouji.com/images/login.png" width=30 style="margin:5px;"/></div>';
			$tab3.='<div class="col-sm-6 col-xs-6" >Contact No.';
			$tab3.='<div style="font-size:12px; margin-top:5px;">'.$row2['PH'].'</div></div>';
			$tab3.='<div class="col-sm-2 col-xs-2" align="right" >';
			$tab3.='<a href="tel:'.$row2['PH'].'"><img src="http://a-school.aouji.com/images/call.png" width=30 style="margin:5px;"/></a></div>';
			$tab3.='<hr class="col-sm-12">';

			}
			if($found==0) $tab3.='No VAN Route set';	
 	
	
	//Tab 4
	$found=0;
	$sql2="Select * from stu_attendence WHERE CID=".$row['CLS']."";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				
			$val=explode(",",$row2['STUID']);
			$attval=explode(",",$row2['ATT']);
			
			for($cc=0;$cc<count($val);$cc++)
					{
					if($val[$cc]==$eid){
						$found=1;
			
if($attval[$cc]>0)
{
		$tab4.='<div class="col-sm-1 col-xs-1" style="border:0px red solid;">';
			if($attval[$cc]==1){ $re="On Leave"; $im="leave.png";} 
			if($attval[$cc]==2){$re="Absent"; $im="absent.png";}
			$tab4.='<img src="http://a-school.aouji.com/images/'.$im.'" width=30 style="margin:5px;"/></div>';
			$tab4.='<div class="col-sm-9 col-xs-9" >'.$re.'<br>'.date("d-m-Y",strtotime($row2['DATE']));
			$tab4.='</div>';
			$tab4.='<hr class="col-sm-12">';
}
					}
					}
			}
		if($found==0) $tab4.='No Leave or Absent marked';	
	
//Tab 5
/*
$found=0;
$tab5.='<table border="0" width="100%">';
$sql8="Select DISTINCT DATE from stu_dmarks WHERE CID=$admincls  order by ID DESC";
   	foreach ($dbh->query($sql8) as $row8)
        	{
$tab5.='<tr><td colspan=3 align=center>'.date("d-m-Y",strtotime($row8['DATE']));
$tab5.='<tr><td style="padding:8px;>Subject<td>Total<td>Obtain';

 	$sql99="Select * from stu_sub WHERE ID IN($adminsub) order by ID DESC";
  		foreach ($dbh->query($sql99) as $row99)
        		{
			 $mrks=findnm("stu_daily_marks","MARKS"," WHERE DATE='".$row8['DATE']."' AND SUB=".$row99['ID']."",$dbh);
			 if($mrks>0)
			 {		
			 $tab5.='<tr><td style="backgrsound:blue;border:0px red solid; coldor:whfite; font-weight:bold; padding:8px;">'.$row99['SUB'].'</div>';
		
			 $totmrks=findnm("stu_daily_marks","TOTMARKS"," WHERE DATE='".$row8['DATE']."' AND SUB=".$row99['ID']."",$dbh);
	
			  $tab5.='<td style="backgrsound:blue;border:0px red solid; coldor:whfite; font-weight:bold; padding:8px;">'.$totmrks.'</div>';		

			
	
			  $tab5.='<td style="backgrsound:blue;border:0px red solid; coldor:whfite; font-weight:bold; padding:8px;">'.$mrks.'</div>';		
			 }
				}
			
	$found=1;
	
	 
	  }
	  $tab5.='</table>';
	if($found==0) $tab5.='No Marks updated ';	
*/
//Tab 6

$found=0;
//$eid=29;
$clsid=findnm("stu_info","CLS"," WHERE ID=".$eid."",$dbh);
 		
$sql2="Select * from stu_paid_fee where SID=$eid order by ID ASC";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$paidvanamt+=$row2['VANFEEAMT'];
				$paidamt+=$row2['AMT'];
				$paidocamt+=$row2['OCAMT'];
				$paiddt[]=$row2['DATE1'];
		if($p=="")$paidvanrem=$row2['VANFEE']; else $paidvanrem.=','.$row2['VANFEE'];
				if($p=="")$paidrem2=$row2['REM2']; else $paidrem2.=','.$row2['REM2'];
				if($p=="")$paidrem=$row2['REM']; else $paidrem.=','.$row2['REM'];
				$p=1;;
			}
	//	$paidrem2=str_replace('-',' ',$paidrem2);	
		$paidrem2=explode(',',$paidrem2);
$tab6.='<table border="0" width="100%">';

$totpaidamt=0;
//$sql2="Select * from feetype WHERE CLM!='' order by ID ASC";
if($admfee==1){
 if($NoAnnualFundIfNewAdm!=1)
    $sql2 = "SELECT * FROM stu_feetype order by ID ASC";
    else
	$sql2 = "SELECT * FROM stu_feetype  WHERE CLM!='READM'  order by ID ASC";
}else{
   $sql2 = "SELECT * FROM stu_feetype WHERE CLM!='ADFEE' order by ID ASC"; 
}
    	foreach ($dbh->query($sql2) as $row2)
        	{
			$feelist='border-bottom:0px gray solid;';		
			$found=1;
			$tab6.='<div class="col-sm-12 col-xs-12" align="center" style="margin:0;" > <div class=" panel-default">';
			$cls=findnm("stu_class",$row2['CLM']," WHERE ID=".$clsid."",$dbh);
 			
if($cls>0 ){
			$tab6.='<div class="col-sm-12" style="'.$feelist.'; width:97%; padding:0;border:1px gray solid; margin:2px 0 2px 0;" align="left" > ';
			$tab6.='<div class="col-sm-7" style="'.$feemnth.'" align="left" > ';
		
		if(in_array($row2['NM'],$paidrem2))
			{
			$totpaidamt+=$cls;
			$feemnth='color:green; font-weight:bold'; $im='<img src="http://a-school.aouji.com/images/yes.png" width=16 style="margin-top:3px;"/>';
			}else {
			$feemnth='';$im='<img src="http://a-school.aouji.com/images/no.png" width=16 style="margin-top:3px;"/>';
			}
			$tab6.=$im.' '.$row2['NM'];
			$tab6.='</div>';
			$tab6.='<div class="col-sm-3" style="'.$feemnth.'; padding:0" align="right" > ';
			$tab6.=$cls;
			$tab6.='</div>';
}
			$tab6.='</div>';
			$tab6.='</div>';
			$tab6.='</div>';
			}
//monthly tuition fee
$sql2="Select * from stu_mnth order by ID ASC";
    	foreach ($dbh->query($sql2) as $row2)
        	{
			$feelist='border-bottom:0px gray solid;';		
			$found=1;
			$tab6.='<tr><TD>';
			$tf=findnm("reg","TF"," WHERE ID=".$eid."",$dbh);
 			if($tf==1)$fee='TFD'; else $fee='TF';
			$cls=findnm("state",$fee," WHERE ID=".$clsid."",$dbh);
 		
			if(in_array($row2['YR'],$paidrem2))
			{
				$totpaidamt+=$cls;$im='<img src="http://a-school.aouji.com/images/yes.png" width=16 style="margin-top:3px;"/>'; 
				$feemnth='color:green; font-weight:bold'; }else {$feemnth=''; $im='<img src="http://a-school.aouji.com/images/no.png" width=16 style="margin-top:3px;"/>';
			}

			$tab6.='<div class="col-sm-7" style="'.$feemnth.'" align="left" > ';
			$tab6.=$im.' '.$row2[$yr0];
			$tab6.='</div>';
			$tab6.='<td><div class="col-sm-3" style="'.$feemnth.'; padding:0" align="right" > ';			$tab6.=$cls;
			$tab6.='</div>';
			
			$tab6.='</div>';
			$tab6.='</div>';
		
			}	

$tab6.='<tr><td colspan=3><div class="col-sm-12 col-xs-12" align="center" style="margin:0;" > <div class=" panel-default">';
			$tab6.='<div class="col-sm-12" style="'.$feelist.'; width:97%; padding:0;border:1px gray solid; margin:5px 0 5px 0;" align="left" > ';	
	
	 		$tab6.='<div class="col-sm-7" align="left" > ';
			$tab6.='Total';
			if($paidocamt!=0)$tab6.='<br><span style="font-size:9px">'.$paidrem.'</span>';
			$tab6.='<br>VAN Fee<br>Payable<br>Paid<br>Balance';
			$tab6.='</div>';
			$tab6.='<div class="col-sm-3" style=" padding:0" align="right" > ';						
			$tab6.=$totpaidamt;
			if($paidocamt!=0)$tab6.='<br>'.$paidocamt;
			//$tab6.='<br>'.($totpaidamt+$paidocamt);
			$tab6.='<br>'.$paidvanamt;
			$tab6.='<br>'.($totpaidamt+$paidocamt+$paidvanamt);
			$tab6.='<br>'.$paidamt;
			$tab6.='<br>'.($totpaidamt+$paidocamt+$paidvanamt-$paidamt);
		
			$tab6.='</div>';
	$tab6.='</div>';
$tab6.='</div>';
$tab6.='<tr><td colspan=2 align=center>';

$tab6.='<a href="http://aouji.com" target="_blank">PayNow</a>';

			$tab6.='</div></table>';
	if($found==0) $tab6.='No Marks updated ';		
	
	}

$data.='</div></center>';	
$product["nm"]=$data;
$product["tab1"]=$tab1;
$product["tab2"]=$tab2;
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
