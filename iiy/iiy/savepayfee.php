<?php  include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$amt=cleanTAG($_POST['amountsum']);
$mnths=cleanTAG($_POST['months']);
//$mnths=str_replace("Select Month(s),","",$mnths);
$cash=cleanTAG($_POST['cash']);
$dt=date("Y-m-d",strtotime($_POST['dt']));
$rem=cleanTAG($_POST['rem']);
$stuid=cleanTAG($_POST['stuid']);

if($eid!="")$bk='?id='.$eid;

			$_SESSION['stunm']=$stunm;
			$_SESSION['fnm']=$fnm;
			$_SESSION['mnm']=$mnm;

$errdt="<label>Error(s)</label>";
if(!$cash) {$errdt=$errdt."<br>Please Enter Fee"; $err=1;}

if($err==0) {
if($eid=="")
{	

	$dbh->exec("INSERT INTO stu_paid_fee(DATE1,SID,AMT,PAYBL,REM,REM2) VALUES ('$dt','$stuid','$cash','$amt','$rem','$mnths')");
}
else
{
	//	$dbh->exec("UPDATE stu_sub SET SUB='$ev' where ID=".$eid."");
		
}
			
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:payfee.php?user=$stuid");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:payfee.php?user=$stuid");
			exit();
		}
	
	
?>