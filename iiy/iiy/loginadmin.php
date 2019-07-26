<?php	session_start();
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return $str;
	}
	
	$em = clean($_POST['emailid']);
	$pa = clean($_POST['lock']);
	
	if($em == '') {
		$errmsg_arr[] = '<span style="color:red">Login Email missing</span>';
		$errflag = true;
		$s=1;
	}
	if($pa == '') {
		$errmsg_arr[] = '<span style="color:red">Password missing</span>';
		$errflag = true;
		$s=0;
	}
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr[$s];
		session_write_close();
		header("location: login.php");
		exit();
	}

include("../conn.php");
$pas=md5($_POST['lock']);

$qry="SELECT * FROM stu_admin WHERE USERID='$em' AND LOCKER='$pas'";

	$f=0;
    foreach ($dbh->query($qry) as $row)
        {
			
			//Login Successful
			session_regenerate_id();
$_SESSION['email_admin']=$row['USERID'];
$_SESSION['lock_admin']= $row['LOCKER'];

		$f++;
		}
	
		if($f==1)
		{
			unset($_SESSION['ERRMSG_ARR']);
			header("location: index.php");
			exit();
		} else{
	unset($_SESSION['email_admin']);
	unset($_SESSION['lock_admin']);
	
		}
			$_SESSION['ERRMSG_ARR']="<span style='color:red'>Invalid user or password</span>";
			header("location: login.php");
			exit();
	
?>