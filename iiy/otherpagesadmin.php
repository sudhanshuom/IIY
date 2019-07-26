<?php require_once './adminlock.php';
$clss="border:1px gray solid;box-shadow: 0px 3px 10px black; width:100%; padding:5px 0 5px 5px;";

$response = array();


$lmt=6;
if($adminid!="" && $ses!="")
{
	$response["products"] = array();
	$product = array();

switch($_REQUEST['u'])
{
case 12:
$basic="";
	$sql="Select * from stu_sms_tech where SID=$adminid order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$row['MB'].'</b><td> <div align=right style="color:black">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		$basic.='<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['MSG'].'</b></div>';	

		$basic.='</center></table>';			

			}
break;
case 3:
$basic="";
//84 
$sql8="Select DISTINCT DATE from stu_hw WHERE CID=$admincls  order by ID DESC";
   	foreach ($dbh->query($sql8) as $row8)
        	{  
$basic.= '<table border="0"   style="width:100%; font-family:calibri; background:white; border-bottom:2px gray Solid"><tr><td colspan=2 align=center><b>'.date("d-m-Y",strtotime($row8['DATE'])).'</b>';		
	
		$sql99="Select * from stu_sub WHERE ID IN($adminsub) order by ID DESC";
		
    		foreach ($dbh->query($sql99) as $row99)
        		{
						
$sql="Select * from stu_hw WHERE CID=$admincls AND SUB=".$row99['ID']." AND DATE='".$row8['DATE']."' order by ID DESC";
$basicc="";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
			$date=$row['DATE'];
		$basic.='<tr><td width=35%>'.$row99['SUB'];	
		$basic.='<td>'.$row['HW'];	

			}
		
				}
		$basic.='</center></table>';
			
}
						$q2=" where NOTI LIKE '%[".$stuid."]%' ";
							$nm=findnm("homework","NOTI",$q2,$dbh);
							if($nm!=""){
								$newnm=str_replace("[".$stuid."]","",$nm);
								$dbh->exec("UPDATE homework SET NOTI='$newnm' ".$q2);	
							}
			
if($pid=="") $basic = "No homework uploaded ";

break;
case 4:
$basic="";
	$pid=1;
	include('studentatt.php'); 
	$basic= $data;
	

break;
case 5:
$basic="";
	$pid=1;
	include('studentreportcard.php');
	$basic= $data;

break;
case "NoticeBoard":
$basic="14";
	$sql="Select * from stu_news order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$row['TTL'].'</b><td> <div align=right style="color:gray">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		$basic.='<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['DETAIL'].'</b></div>';	

		$basic.='</center></table>';			

			}
if($pid=="") $basic = "No Notice Published";
break;
case "Download":
case "6":
$basic="";
	$sql="Select * from download order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$row['TP'].'</b><td> <div align=right style="color:gray">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		$basic.='<tr><td><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['NM'].'</b></div><td align=right><a href="http://aoujieduapp.aouji.com/erp/gallery/'.$login_name.'/'.$row['IMAGE'].'">Download</a></div>';	

		$basic.='</center></table>';			

			}
if($pid=="") $basic = "Nothing in download ";

break;
case "7":
$basic="";

  $sql="Select * from childspace WHERE CLS=0 order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
				$ars=explode(',',$row['SIDS']);
				if(in_array($stuid,$ars))
				$spaceID[]=$row['ID'];
			}
	for($w=0;$w<count($spaceID);$w++)
		{
	$sql="Select * from childspace WHERE ID=".$spaceID[$w]." order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		$basic.= '<table border="0">';
		if($row['NM']!="")$basic.='<tr><td><b>'.$row['NM'].'</b>';
	
		if($row['IMAGE']!="")$basic.='<tr><td align=left><img src="http://aoujieduapp.aouji.com/erp/gallery/'.$login_name.'/'.$row['IMAGE'].'" width=100%/></div>';	

		$basic.='<div align="right">'.date("d-m-Y",strtotime($row['DATE1'])).'</div>';			
		$basic.='</center></table>';			

			}
							$q2=" where NOTI LIKE '%[".$stuid."]%' ";
							$nm=findnm("childspace","NOTI",$q2,$dbh);
							if($nm!=""){
								$newnm=str_replace("[".$stuid."]","",$nm);
								$dbh->exec("UPDATE childspace SET NOTI='$newnm' ".$q2);	
							}
		}
if($pid=="") $basic = "Nothing in Childspace";
//echo $basic;
break;
case "8":
$basic="";
$cls=findnm("reg","COURSE","WHERE ID=".$stuid."",$dbh);
	$sql="Select * from childspace WHERE CLS=".$cls." order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri">';
		if($row['NM']!="")$basic.='<tr><td><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['NM'].'</b></div>';
		if($row['IMAGE']!="")$basic.='<tr><td align=left><img src="http://aoujieduapp.aouji.com/erp/gallery/'.$login_name.'/'.$row['IMAGE'].'" width=100%/></div>';	

		$basic.='<div align="right">'.date("d-m-Y",strtotime($row['DATE1'])).'</div>';			
		$basic.='</center></table>';			

			}
		
if($pid=="") $basic = "Nothing in Activity Corner";

break;
case "9":
$basic="";
	$cls=findnm("reg","COURSE","WHERE ID=".$stuid."",$dbh);

$sql2="Select DISTINCT DATE1 from dailymarks WHERE CID=".$cls." and SID=".$stuid." order by DATE1 DESC";
    	foreach ($dbh->query($sql2) as $row2)
        	{
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri">';
		$basic.='<tr bgcolor="blue"><td colspan=2><div align="center" style="color:white">'.date("d-m-Y",strtotime($row2['DATE1'])).'</div>';			
$tot=0;
	$sql="Select * from dailymarks WHERE DATE1='".$row2['DATE1']."' and  CID=".$cls." and SID=".$stuid."  order by DATE1 DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
	$sub=findnm("sub","NM","WHERE ID=".$row['SUBID']."",$dbh);
	
		$basic.='<tr><td><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$sub.'</b></div>';
		$basic.='<td><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['MRKS'].'</b></div>';

	$tot+=$row['MRKS'];	
			}

		$basic.='<tr bgcolor="gray"><td>Total Marks<td><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$tot.'</b></div>';

		$basic.='</center></table>';			

			}

if($pid=="") $basic = "Nothing in Activity Corner";

break;

case "11":
$basic="";
			$basic.= '<table border="0"  cellpadding="5" style="'.$clss.' width:100%; font-family:calibri">';

$sql2="Select * from holi order by DATE1 ASC";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$pid=1;
		$basic.='<tr><td colspan=2 width=30% style="border-bottom:1px gray solid"><div align="center" >'.date("d-m-Y",strtotime($row2['DATE1'])).'</div>';			
$tot=0;
	
		$basic.='<td width=35% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.$row2['NM'].'</b></div>';
		$basic.='<td width=35% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.$row2['EVENT'].'</b></div>';


			}
		$basic.='</center></table>';			

if($pid=="") $basic = "Nothing in schedule";

break;
case "12":

 $hostname1 = 'localhost';
$username1 = 'sasiti_bbk';
$password1 = 'f13.+5E-aH8c';

try {
	GLOBAL $dbh;
   $dbh = new PDO("mysql:host=$hostname;dbname=sasiti", $username1, $password1);
//require_once"fun.php";
}
catch(PDOException $e1)
{
    echo "Error: ".$e1->getMessage();
} 	



$basic="";
			$basic.= '<table border="0"  cellpadding="5" style="'.$clss.' width:100%; font-family:calibri">';
$sql = "SELECT * FROM ppr_test order by ID ASC";
    	foreach ($dbh->query($sql) as $row)
        	{
	$basic.='<tr bgcolor="'.$adminbg.'"><td colspan=6 width=30% style="border-bottom:1px gray solid"><div align="center" style="color:white">'.$row['NM'].'</div>';
	
		$basic.='<tr>';
		$basic.='<td width=5% style="border-bottom:1px gray solid">';
		$basic.='<div style="font-size:0.8em;margin-bottom:6px"><b>Attmpt</b></div>';			
		$basic.='<td width=30% style="border-bottom:1px gray solid">';
		$basic.='<div style="font-size:0.8em;margin-bottom:6px"><b>Date</b></div>';			
		$basic.='<td width=30% style="border-bottom:1px gray solid">';
		$basic.='<div style="font-size:0.8em;margin-bottom:6px"><b>Crt Ans.</b></div>';			
		$basic.='<td width=30% style="border-bottom:1px gray solid">';
		$basic.='<div style="font-size:0.8em;margin-bottom:6px"><b>Wrng Ans.</b></div>';			
		$basic.='<td width=30% style="border-bottom:1px gray solid">';
		$basic.='<div style="font-size:0.8em;margin-bottom:6px"><b>Skp Ans.</b></div>';			
$solveid="";
$sql2 = "SELECT * FROM ppr_test_done WHERE  STUID='".$stuid."' AND TSTID=".$row['ID']." order by ID ASC";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$pid=1;
				$solveid=1;

		$tot=0;	
		$basic.='<tr><td  width=30% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.++$s.'</b></div>';			
$tot=0;
	
	$basic.='<td  width=35% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.date("d-m-Y",strtotime($row2['DATE1'])).'</b></div>';

	
		$basic.='<td  width=35% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.$row2['CANS'].'</b></div>';
		$basic.='<td width=35% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.$row2['WRNG'].'</b></div>';
	$basic.='<td width=35% style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>'.$row2['SKP'].'</b></div>';

			}
if($solveid!="")
{			
			$qs="";
			$nm=$row["QIDS"];
			$ar=explode(",",$nm);	
						//$y=$y. '<td>'; 
						for($m=0;$m<count($ar);$m++)
							{
			$cans=findnm("ppr_test_done","CANS1"," WHERE STUID=".$stuid,$dbh);
		$cans=array_filter(explode(",",$cans));
			$wrng=findnm("ppr_test_done","WRNG1"," WHERE STUID=".$stuid,$dbh);
		$wrng=array_filter(explode(",",$wrng));
			$skp=findnm("ppr_test_done","SKP1"," WHERE STUID=".$stuid,$dbh);
		$skp=array_filter(explode(",",$skp));
		$result="";	
			
		if(in_array($ar[$m],$cans)){$result="<span style='color:green'>Correct</span>";}
		if(in_array($ar[$m],$wrng)){$result="<span style='color:red'>Wrong</span>";}
		if(in_array($ar[$m],$skp)){$result="<span style='color:blue'>Skip</span>";}
		$qno=$m+1;								
		$qs.='Q.'.$qno.'.'.findnm("ppr_q","QUES"," WHERE ID=".$ar[$m],$dbh).' ['.$result.']';
		$choice='<br>(A) '.findnm("ppr_q","AA"," WHERE ID=".$ar[$m],$dbh);
		$choice.=' (B) '.findnm("ppr_q","AB"," WHERE ID=".$ar[$m],$dbh);
		$choice.=' (C) '.findnm("ppr_q","AC"," WHERE ID=".$ar[$m],$dbh);
		$choice.=' (D) '.findnm("ppr_q","AD"," WHERE ID=".$ar[$m],$dbh);
		$choice.='<br>Correcr Answer: '.findnm("ppr_q","CANS"," WHERE ID=".$ar[$m],$dbh);
		
		$qs.='<br>'.$choice.'<hr>';
					
$qs="";							
					
							}			
}else{
	$qs="Go to Quiz option from the left side menu and solve the quiz";
} 
		$basic.='<tr><td colspan="5" style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px">'.$qs.'</div>';
	
		
		
			
			$hi=findnm("ppr_test_done","CANS","WHERE TSTID=".$row['ID']." order by CANS DESC LIMIT 1",$dbh);
			$selectschl=findnm("ppr_test_done","SCHOOL","WHERE TSTID=".$row['ID']." order by CANS DESC LIMIT 1",$dbh);
			//$selectschl=$row2['SCHOOL'];
			include("../../erp/includes/quizeconn.php");
			
	$basic.='<tr><td colspan=5 style="border-bottom:1px gray solid"><div style="font-size:0.8em;margin-bottom:6px"><b>Highest Marks ['.$hi.'] scored by '.$schoolnm.'</b></div>';

	
			
	}
		$basic.='</center></table>';			

if($pid=="") $basic = "Go to Quiz option from the left side menu and solve the quiz";

break;
case "13":
$basic="";
$sql="Select * from news order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		
		$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$row['TTL'].'</b><td> <div align=right style="color:gray">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		$basic.='<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['DETAIL'].'</b></div>';	

		$basic.='</center></table>';			
			}
		
if($pid=="") $basic = "Nothing in News";



break;
case "14":
if($ses=='bgs'){
$im[0]="http://bgsbhadaur.com/image/raman.jpg";
$nam[0]="Mr. Ranpreet Singh Rai (Managing Director)";
$msg1[0]="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I am indebted to the people of the area to which the school caters in imparting education for giving me all the support to move ahead. The school which is the brainchild of Baba Gurbachan Singh Ji has come up as an institution in itself. I find pride in associating myself with this prestigious institution. 
Thank you.";
	$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td >';
	$basic.='<img src="'.$im[0].'" width="100%">';
	
	$basic.='<tr><td colspan=2><div style=" color:black; font-size:1.2em;margin-bottom:6px">'.$nam[0].'<b>
</b></div>';	
	$basic.='<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$msg1[0].'</b></div>';	
	$basic.='</center></table>';
}
if($ses=='unique'){
	
	$basic.='<iframe src="http://www.protrack365.com/mobile/?_p=devices&id=176058" frameborder="1" width="100%" height="600"></iframe>';
	
}


break;
case "15":
if($ses=='bgs'){
$im[1]="http://bgsbhadaur.com/image/drector.jpg";

$nam[1]="
S.Narpinder Singh Dhillon (Secretary)";
$msg1[1]="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I find immense pleasure in saying that BGS Bhadaur is moving ahead in a well orchestrated method. More and more stress is layed on latest technology oriented methods of imparting education. Equal importance is being given to sports and games. Boxing has been introduced and I am feeling proud to say that even girls are choosing boxing as a field. I am on cloud nine after getting overwhelming support of the Staff and the Parents in the run-up to make BGS Bhadaur an institution to reckon with."; 
	$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td >';
	$basic.='<img src="'.$im[1].'" width="100%">';
	
	$basic.='<tr><td colspan=2><div style=" color:black; font-size:1.2em;margin-bottom:6px">'.$nam[1].'<b>
</b></div>';	
	$basic.='<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$msg1[1].'</b></div>';	
	$basic.='</center></table>';
}
break;
case "16":
if($ses=='bgs'){

$im[2]="http://bgsbhadaur.com/image/principal.png";
$nam[2]="Joshi Joseph Thoundassery (PRINCIPAL)<br>M.A.(Eng), M.A.(His), M. Phil. Eng., B. Ed.";
$msg1[2]="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Any noble enterprise devoid of sublime mission is like a flower without fragrance. Today there is an overwhelming trend of making school a profit oriented enterprise without any proper erudition. A quality holistic education is imparted for the development of each child. The child here is not a beast of burden. Every child experiences the thrill and joy through various activities and learns his lessons without stress or phobias. The students not only trained to be the bread earner but also they learn here the basic qualities which are needed for their fruitful life. Our commitment in this line is writing on the wall for the people of this region. We will pursue our expressed aims and objectives for which we solicit the cooperation of all concerned and the blessings of Almighty God. 'Education, said Anon, does not commence with the alphabet; it begins with mother's look , with father's nod of appreciation or sign of rebuke; with a sister's gentle pressure of forbearance; with handful of flower, on hills and daisy meadows........."; 

	
	$basic.= '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td >';
	$basic.='<img src="'.$im[2].'" width="100%">';
	
	$basic.='<tr><td colspan=2><div style=" color:black; font-size:1.2em;margin-bottom:6px">'.$nam[2].'<b>
</b></div>';	
	$basic.='<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$msg1[2].'</b></div>';	
	$basic.='</center></table>';
	
}
break;
}

$product["news"] = $basic;
if($_GET['xxx']==1)echo $basic;
	
array_push($response["products"], $product);
	//	}


//echo $nm2data;
//exit;
			$response["success"] = 1;
				echo json_encode($response);
	
}
else{
		$response["success"] = 0;
		echo json_encode($response);

}
?>
