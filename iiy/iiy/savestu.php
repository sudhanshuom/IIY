<?php $pg="savepatient.php"; include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$stunm=cleanTAG($_POST['stunm']);
$fnm=cleanTAG($_POST['fnm']);
$mnm=cleanTAG($_POST['mnm']);
$class=cleanTAG($_POST['class']);
$rno=cleanTAG($_POST['rno']);
$dob=cleanTAG($_POST['dob']);
$ano=cleanTAG($_POST['ano']);
$adt=cleanTAG($_POST['adt']);
$tf=cleanTAG($_POST['tf']);
$dtf=cleanTAG($_POST['dtf']);
$ad=cleanTAG($_POST['ad']);
$gender=cleanTAG($_POST['gender']);
$pno=cleanTAG($_POST['pno']);

if($eid!="")$bk='?id='.$eid;

			$_SESSION['stunm']=$stunm;
			$_SESSION['fnm']=$fnm;
			$_SESSION['mnm']=$mnm;
			$_SESSION['class']=$class;
			$_SESSION['rno']=$rno;
			$_SESSION['dob']=$dob;
			$_SESSION['ano']=$ano;
			$_SESSION['adt']=$adt;
			$_SESSION['tf']=$tf;
			$_SESSION['dtf']=$dtf;
			$_SESSION['ad']=$ad;
			$_SESSION['gender']=$gender;
			$_SESSION['pno']=$pno;
			
$err=0;
$errdt="<label>Error(s)</label>";
if(!$stunm) {$errdt=$errdt."<br>Please Enter Name"; $err=1;}
if(!$fnm) {$errdt=$errdt."<br>Please Enter Father Name"; $err=1;}
if(!$ad) {$errdt=$errdt."<br>Please Enter Address"; $err=1;}
if(!$pno) {$errdt=$errdt."<br>Please Enter Phone Number"; $err=1;}
//if(!$em) {$errdt=$errdt."<br>Please Enter Email "; $err=1;}

if($err==0) {
$adnm=findnm("vpo","NM"," WHERE ID=".$ad."",$dbh);

if($eid=="")
{	

$p=md5($p1);
	$dbh->exec("INSERT INTO stu_info(NM,FNM,MNM,CLS,ROLLNO,DOB,ADMNO,ADMDATE,TF,DTF,AD,GENDER,MB,PASS1,PASS) VALUES ('$stunm','$fnm','$mnm','$class','$rno','$dob','$ano','$adt','$tf','$dtf','$ad','$gender','$mb','$p1','$p')");
}
else
{
		$dbh->exec("UPDATE stu_info SET NM='$stunm' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET FNM='$fnm' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET MNM='$mnm' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET CLS='$cls' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET ROLLNO='$rno' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET DOB='$dob' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET ADMNO='$ano' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET ADMDATE='$adt' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET TF='$tf' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET DTF='$dtf' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET AD='$ad' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET GENDER='$gender' where ID=".$eid."");
		$dbh->exec("UPDATE stu_info SET MB='$pno' where ID=".$eid."");
}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:viewstudent.php");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addstudent.php$bk");
			exit();
		}
	
	
?>