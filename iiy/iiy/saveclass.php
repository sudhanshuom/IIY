<?php $pg="savepatient.php"; include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$ev=cleanTAG($_POST['ev']);
$adfee=cleanTAG($_POST['adfee']);
$readm=cleanTAG($_POST['readm']);
$exam=cleanTAG($_POST['exam']);
$tf=cleanTAG($_POST['tf']);
$sub=cleanTAG($_POST['sub']);

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

	$dbh->exec("INSERT INTO stu_class(CLS,ADFEE,READM,EXAM,TF,SUB) VALUES ('$ev','$adfee','$readm','$exam','$tf','$sub')");
}
else
{
		$dbh->exec("UPDATE stu_class SET CLS='$ev' where ID=".$eid."");
		$dbh->exec("UPDATE stu_class SET ADFEE='$adfee' where ID=".$eid."");
		$dbh->exec("UPDATE stu_class SET READM='$readm' where ID=".$eid."");
		$dbh->exec("UPDATE stu_class SET EXAM='$exam' where ID=".$eid."");
		$dbh->exec("UPDATE stu_class SET TF='$tf' where ID=".$eid."");
		$dbh->exec("UPDATE stu_class SET SUB='$sub' where ID=".$eid."");
}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addclass.php");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addclass.php$bk");
			exit();
		}
	
	
?>