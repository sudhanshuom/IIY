<?php include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$ids=$_POST['ids'];
$marks=$_POST['marks'];
$dt=date("Y-m-d",strtotime($_POST['dt']));
$class=cleanTAG($_POST['cls']);
$tp=cleanTAG($_POST['tp']);
$sub=cleanTAG($_POST['sub']);
$mm=cleanTAG($_POST['mm']);

if($eid!="")$bk='?id='.$eid;

$err=0;
$errdt="<label>Error(s)</label>";
if(!$class) {$errdt=$errdt."<br>Please Enter Class"; $err=1;}

if($err==0) {
for($z=0;$z<count($ids);$z++)
{	
		$dbh->exec("UPDATE stu_dmarks SET OBM='".$marks[$z]."' where SID=".$ids[$z]." AND  SUBID=".$sub." AND EXAMTP=".$tp."");
		$dbh->exec("UPDATE stu_dmarks SET TOTM='".$mm."' where SID=".$ids[$z]." AND  SUBID=".$sub." AND EXAMTP=".$tp."");
}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addmarks.php?cid=$class&tp=$tp&sub=$sub&p=1");  
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addmarks.php?cid=$class&tp=$tp&sub=$sub&p=1");
			exit();
		}
	
	
?>