<?php  include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$ev=cleanTAG($_POST['ev']);
$news=cleanTAG($_POST['news']);

if($eid!="")$bk='?id='.$eid;

			$_SESSION['stunm']=$stunm;
			$_SESSION['fnm']=$fnm;
			$_SESSION['mnm']=$mnm;
			
$err=0;
$errdt="<label>Error(s)</label>";
if(!$ev) {$errdt=$errdt."<br>Please Enter News"; $err=1;}

if($err==0) {
if($eid=="")
{	

	$dbh->exec("INSERT INTO stu_news(DATE1,TTL,DETAIL) VALUES ('$dt','$ev','$news')");
}
else
{
		$dbh->exec("UPDATE stu_news SET TTL='$ev' where ID=".$eid."");
		$dbh->exec("UPDATE stu_news SET DETAIL='$news' where ID=".$eid."");
		
}
			
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addnews.php");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addnews.php$bk");
			exit();
		}
	
	
?>