<?php  include("afterlogin.php");
$eid=cleanTAG($_POST['eid']);

$path = "../uploads/";

$err="";	 


//if($ev==""){$err=$err."<br />Please Enter Title ";}


if($err!="")
{
	$_SESSION['errors']=$err;
	header("location:uploaddr.php?id=$eid");
	exit;
}
	$valid_formats = array("JPG","PNG");
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

	$_SESSION['errors']="File uploaded";
//$dbh->exec("UPDATE stu_info SET IMAGE='$actual_image_name' WHERE ID=$eid)");
$dbh->exec("UPDATE stu_driver SET IMAGE='$actual_image_name' where ID=".$eid."");
		
header("location:uploaddr.php?id=$eid");
exit;
								}					

	$_SESSION['errors']="Size Error";
	header("location:uploaddr.php?id=$eid");
	exit;

						}
	$_SESSION['errors']="Select .pdf file only";
	header("location:uploaddr.php?id=$eid");
	exit;
										
					}
	$_SESSION['errors']="Select .pdf file only";
	header("location:uploaddr.php?id=$eid");
	exit;
				
				}
	$_SESSION['errors']="unknown Errors";
	header("location:uploaddr.php?id=$eid");
	exit;
			}
	$_SESSION['errors']="unknown Error";
	header("location:uploaddr.php?id=$eid");
	exit;
}
	$_SESSION['errors']="unknown Error";
	header("location:uploaddr.php?id=$eid");
	exit;
?>