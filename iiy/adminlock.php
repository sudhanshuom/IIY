<?php $ses=$_REQUEST['ses'];require_once './conn.php';
$adminid=0;
include('./fun.php');
//include('./myfun.php');
$stuid=	cleanTAG($_REQUEST['stuid']);
$ps=cleanTAG($_REQUEST['ps']);

$sql999 = "Select * from stu_teacher where ID='$stuid' and PASS='$ps'";
    foreach ($dbh->query($sql999) as $row)
        {
		$adminnm=$row['NM'];
  		$adminid=$row['ID'];
		$admincls=$row['CLS'];
		$adminsub="sub";//findnm("stu_class","SUB"," WHERE ID=".$row['CLS']."",$dbh);
							
     	$adminmb=$row['MB'];
     	$adminquali=$row['QUALI'];
     	//$admindob=date("d-m-Y",strtotime($row['DOB']));
       // $admindoj=date("d-m-Y",strtotime($row['DOJ']));
        $adminid=$row['ID'] ;
	    $adminclasses=$row['CLASSES'] ;
		 		
   		}
if($adminid==0){exit;}
?>