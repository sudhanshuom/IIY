<?php include('userlock.php');
$target_dir = "../ads/";
$target_file =basename($_FILES["fileToUpload"]["name"]);
list($txt, $ext1) = explode(".", $target_file);
$ext=strtolower($ext1);
if($ext=="jpg" ||$ext=="jepg" ||$ext=="gif" ||$ext=="png")
{
		$target_file ="baea-".rand(0000,999999).".".$ext1;
	
	$target_path = $target_dir .$target_file ;
	$id=$_POST['eid'];
	$lnk=$_POST['lnk'];
	$lnk=str_replace("http://","",$lnk);
	$lnk=str_replace("https://","",$lnk);
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_path);
			$dbh->exec("INSERT INTO ads(IMAGE,LNK,CATID,STTS) VALUES ('$target_file','$lnk','$id','1')");
		//		$dbh->exec("UPDATE ads SET IMAGE='$target_file' where ID=".$id."");
		
			$_SESSION['err']=0;
			header("Location:ads.php?ads=$id");
			exit();
			
		} else {
			$_SESSION['err']=1;
			header("Location:ads.php?ads=$id");
			exit();
		}
	}
} else {
			$_SESSION['err']=2;
			header("Location:ads.php");
			exit();
}
	
?>