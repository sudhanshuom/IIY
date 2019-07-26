<?php  include("afterlogin.php");
$ev=cleanTAG($_POST['ev']);

$path = "../download/";

$err="";	 


if($ev==""){$err=$err."<br />Please Enter Title ";}


if($err!="")
{
	$_SESSION['errors']=$err;
	header("location:download.php");
	exit;
}
	$valid_formats = array("PDF","JPG","PNG");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{

	for($x=0;$x<1;$x++)
			{
					$name = $_FILES['photoimg']['name'];
					$size = $_FILES['photoimg']['size'];

			if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array(strtoupper($ext),$valid_formats))
					{

					if($size<(1024*1024*1024))
						{
						$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
						$tmp = $_FILES['photoimg']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
$dt=date("Y-m-d",time());
	$_SESSION['errors']="File uploaded";
$dbh->exec("INSERT INTO stu_download(TP,IMAGE) VALUES('$ev','$actual_image_name')");
header("location:download.php");
exit;
								}					

	$_SESSION['errors']="Size Error";
	header("location:download.php");
	exit;

						}
	$_SESSION['errors']="Select .pdf file only";
	header("location:download.php");
	exit;
										
					}
	$_SESSION['errors']="Select .pdf file only";
	header("location:download.php");
	exit;
				
				}
	$_SESSION['errors']="unknown Errors";
	header("location:download.php");
	exit;
			}
	$_SESSION['errors']="unknown Error";
	header("location:download.php");
	exit;
}
	$_SESSION['errors']="unknown Error";
	header("location:download.php");
	exit;
?>