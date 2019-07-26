<?php $pg="savepatient.php"; include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$ev=cleanTAG($_POST['ev']);
$adfee=cleanTAG($_POST['adfee']);
$readm=cleanTAG($_POST['readm']);
$exam=cleanTAG($_POST['exam']);
$tf=cleanTAG($_POST['tf']);
$des=cleanTAG($_POST['des']);
$sub=cleanTAG($_POST['sub']);
$dob=cleanTAG($_POST['dob']);
$gender=cleanTAG($_POST['gender']);
$pass1=cleanTAG($_POST['pass']);
$classes=cleanTAG($_POST['classes']);
$pass=md5($pass1);
$tp=cleanTAG($_POST['tp']);

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

	$dbh->exec("INSERT INTO stu_teacher(NM,AD,PH,EML,QUALI,DES,SUB,DOB,GENDER,PASS,PASS1,TP,CLASSES) VALUES ('$ev','$adfee','$readm','$exam','$tf','$des','$sub','$dob','$gender','$pass','$pass1','$tp','$classes')");
}
else
{
		$dbh->exec("UPDATE stu_teacher SET NM='$ev' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET AD='$adfee' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET PH='$readm' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET EML='$exam' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET QUALI='$tf' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET DES='$des' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET SUB='$sub' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET DOB='$dob' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET GENDER='$gender' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET PASS='$pass' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET PASS1='$pass1' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET TP='$tp' where ID=".$eid."");
		$dbh->exec("UPDATE stu_teacher SET CLASSES='$classes' where ID=".$eid."");
}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addteacher.php");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addteacher.php$bk");
			exit();
		}
	
	
?>