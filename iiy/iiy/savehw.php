<?php $pg="savepatient.php"; include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$ev=cleanTAG($_POST['ev']);
$classid=cleanTAG($_POST['classid']);
$subid=cleanTAG($_POST['subid']);
$cid=cleanTAG($_POST['cid']);


if($eid!="")$bk='?id='.$eid;

			$_SESSION['stunm']=$stunm;
			$_SESSION['fnm']=$fnm;
			$_SESSION['mnm']=$mnm;
			
$err=0;
$errdt="<label>Error(s)</label>";
if(!$ev) {$errdt=$errdt."<br>Please Enter Class"; $err=1;}

if($err==0) {
if($eid=="")
{
	$dt=date("Y-m-d");

	$dbh->exec("INSERT INTO stu_hw(DATE,CID,SUB,HW,AID) VALUES ('$dt','$classid','$subid','$ev','0')");
}else {
		$dbh->exec("UPDATE stu_hw SET HW='$ev' WHERE ID=".$eid."");
	}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addhw.php?cid=$cid");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addhw.php?cid=$cid");
			exit();
		}
	
	
?>