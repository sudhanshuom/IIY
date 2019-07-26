<?php $pg="savepatient.php"; include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$dt=cleanTAG($_POST['dt']);
$ev=cleanTAG($_POST['ev']);
$tp=cleanTAG($_POST['tp']);

if($eid!="")$bk='?id='.$eid;

			$_SESSION['stunm']=$stunm;
			$_SESSION['fnm']=$fnm;
			$_SESSION['mnm']=$mnm;
			
$err=0;
$errdt="<label>Error(s)</label>";
if(!$dt) {$errdt=$errdt."<br>Please Enter Name"; $err=1;}
if(!$ev) {$errdt=$errdt."<br>Please Enter Father Name"; $err=1;}

if($err==0) {
$dt=date("Y-m-d",strtotime($dt));
if($eid=="")
{	

	$dbh->exec("INSERT INTO stu_calendar(DATE,NM,HOLY) VALUES ('$dt','$ev','$tp')");
}
else
{
		$dbh->exec("UPDATE stu_calendar SET NM='$ev' where ID=".$eid."");
		$dbh->exec("UPDATE stu_calendar SET DATE='$dt' where ID=".$eid."");
		$dbh->exec("UPDATE stu_calendar SET HOLY='$tp' where ID=".$eid."");
}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addcalendar.php");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addcalendar.php$bk");
			exit();
		}
	
	
?>