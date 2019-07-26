<?php include("afterlogin.php");
$id=cleanTAG($_POST['id']);
$tp=cleanTAG($_POST['tp']);
switch($tp)
{
case "1":
		$dbh->exec("DELETE from stu_info where ID='".$id."'");
break;
case "2":
		$dbh->exec("DELETE from stu_calendar where ID='".$id."'");
break;
case "3":
		$dbh->exec("DELETE from stu_class where ID='".$id."'");
break;
case "4":
		$dbh->exec("DELETE from stu_driver where ID='".$id."'");
break;
case "5":
		$dbh->exec("DELETE from stu_teacher where ID='".$id."'");
break;
case "6":
		$dbh->exec("DELETE from stu_hw where ID='".$id."'");
break;
case "7":
		$dbh->exec("DELETE from stu_news where ID='".$id."'");
break;
case "8":
		$dbh->exec("DELETE from stu_sub where ID='".$id."'");
break;
case "9":
		$dbh->exec("DELETE from stu_paid_fee where ID='".$id."'");
break;
}

?>