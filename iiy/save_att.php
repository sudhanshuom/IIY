<?php require_once './adminlock.php';
if($ses!="")
{
		$mrks=implode(",",$_POST['mrks']); 
		$ids=implode(",",$_POST['ids']); 
		//$dt=date("Y-m-d",strtotime($_REQUEST['fdt']));
		$dt=date("Y-m-d",strtotime($_REQUEST['date']));
		$cmt=cleanTAG($_REQUEST['cmt']);
		$subid=cleanTAG($_REQUEST['subid']);
		$classid=cleanTAG($_REQUEST['classid']);
		$tot=cleanTAG($_REQUEST['tot']);
	
		$ses=cleanTAG($_REQUEST['ses']);
		$ps=cleanTAG($_REQUEST['ps']);
		$stuid=cleanTAG($_REQUEST['stuid']);
		$eid=cleanTAG($_REQUEST['eid']);
		

 
	$found=findnm("stu_attendence","ID"," WHERE DATE='".$dt."' AND CID=".$classid."",$dbh);
	if($found>0)
	{
		$dbh->exec("UPDATE stu_attendence SET STUID='$ids' WHERE ID=".$found."");
		$dbh->exec("UPDATE stu_attendence SET ATT='$mrks' WHERE ID=".$found."");
	}else{

			$dbh->exec("INSERT INTO stu_attendence(DATE,CID,STUID,ATT) VALUES ('$dt',$classid,'$ids','$mrks')");
	}


	header("location:./takeatt.php?ses=".$ses."&stuid=".$stuid."&ps=".$ps."&classid=".$classid."&done=1");
	exit;
}
	header("location:./");
	exit;




?>
