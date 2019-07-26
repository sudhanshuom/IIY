<?php session_start(); require_once '../conn.php';
require_once './fun.php';
$fnd=0;
$adminperm="";
$us=$_SESSION['email_admin'];
$pswd=$_SESSION['lock_admin'];
if($us=="" || $pswd==""){header("Location:login.php");}
$sql999="SELECT * FROM stu_admin WHERE USERID='$us' AND LOCKER='$pswd'";
    foreach ($dbh->query($sql999) as $row)
        {
		$adminnm=$row['NAME'];
        $adminid=$row['ID'] ;
        $admindel=$row['DELPRM'] ;
		$fnd=1;
		}

if($fnd!=1){header("Location:login.php");}
?>