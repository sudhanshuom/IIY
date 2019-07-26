<?php include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);
$ids=$_POST['ids'];
$att=$_POST['att'];
$dt=date("Y-m-d",strtotime($_POST['dt']));
$class=cleanTAG($_POST['class']);

if($eid!="")$bk='?id='.$eid;
$ids=implode(",",$ids);
$att=implode(",",$att);
	
$err=0;
$errdt="<label>Error(s)</label>";
if(!$class) {$errdt=$errdt."<br>Please Enter Class"; $err=1;}

if($err==0) {
if($eid=="")
{	

	$dbh->exec("INSERT INTO stu_attendence(CID,DATE,STUID,ATT) VALUES ('$class','$dt','$ids','$att')");
}
else
{
		$dbh->exec("UPDATE stu_attendence SET STUID='$ids' where ID=".$eid."");
		$dbh->exec("UPDATE stu_attendence SET ATT='$att' where ID=".$eid."");
		
}
			unset($_SESSION['nm']);
			unset($_SESSION['fnm']);
			unset($_SESSION['ad']);
			unset($_SESSION['ph']);
			unset($_SESSION['em']);
			unset($_SESSION['rem']);
			unset($_SESSION['dep']);
		
			unset($_SESSION['form_error'])		;
			header("Location:addattendance.php?cid=$class");
			exit();
			
		} else {

			$_SESSION['form_error']	=$errdt;	
			unset($_SESSION['form_success'])	;	
			header("Location:addattendance.php?cid=$class");
			exit();
		}
	
	
?>