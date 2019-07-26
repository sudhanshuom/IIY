<?php  include("afterlogin.php");
$ev=cleanTAG($_POST['ev']);
$news=cleanTAG($_POST['news']);

if($eid!="")$bk='?id='.$eid;

			$_SESSION['stunm']=$stunm;
			$_SESSION['fnm']=$fnm;
			$_SESSION['mnm']=$mnm;
			
$err=0;
$errdt="<label>Error(s)</label>";
if(!$ev) {$errdt=$errdt."<br>Please Enter News"; $err=1;}
$eid=$adminid;
if($err==0) {
	$news1=md5($news);
		$dbh->exec("UPDATE stu_admin SET NAME='$ev' where ID=".$eid."");
		$dbh->exec("UPDATE stu_admin SET LOCKER='$news1' where ID=".$eid."");
		$dbh->exec("UPDATE stu_admin SET LOCKER1='$news' where ID=".$eid."");
		$_SESSION['lock_admin']=$news1;
			
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:profile.php");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:profile.php$bk");
			exit();
		}
	
	
?>