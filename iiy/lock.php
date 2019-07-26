<?php $ses=$_REQUEST['ses'];require_once './conn.php';
$adminid=0;
include('./fun.php');
//include('./myfun.php');
$stuid=	cleanTAG($_REQUEST['stuid']);
$ps=cleanTAG($_REQUEST['ps']);

$sql999 = "Select * from stu_info where ID='$stuid' and PASS='$ps'";
    foreach ($dbh->query($sql999) as $row)
        {
		$adminnm=$row['NM'];
  		$adminid=$row['ID'];
		$admincls=$row['CLS'];
		$adminvan=$row['VAN'];
		$adminclass=findnm("stu_class","NM"," WHERE ID=".$row['CLS']."",$dbh);
		$adminsub=findnm("stu_class","SUB"," WHERE ID=".$row['CLS']."",$dbh);
							
     	$adminmb=$row['MB'];
     	$adminquali=$row['QUALI'];
     	//$admindob=date("d-m-Y",strtotime($row['DOB']));
       // $admindoj=date("d-m-Y",strtotime($row['DOJ']));
        $adminid=$row['ID'] ;
		 		
   		}
if($adminid==0){exit;}
?>