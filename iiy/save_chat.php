<?php require_once './adminlock.php';
if($ses!="")
{
	$response["products"] = array();
	$product = array();
		$eid=cleanTAG($_REQUEST['extrapid']);
		$fdt=date("Y-m-d",strtotime($_REQUEST['fdt']));
		$cmt=cleanTAG($_REQUEST['cmt']);
		$subid=cleanTAG($_REQUEST['subid']);
		$classid=cleanTAG($_REQUEST['classid']);
	
		$ses=cleanTAG($_REQUEST['ses']);
		$ps=cleanTAG($_REQUEST['ps']);
		$stuid=cleanTAG($_REQUEST['stuid']);
		$eid=cleanTAG($_REQUEST['eid']);

$dt=date("Y-m-d h:i:s",time());
$err=0;
$errdt="<label>Error(s)</label>";
if(!$cmt) {$errdt=$errdt."<br>Please Enter Chat"; $err=1;}

if($err==0) {	   
					$pid =1;	
if($eid=="")
{
	$dbh->exec("INSERT INTO stu_chat(DATE,CID,TID,MSG,BY1) VALUES ('$dt','$subid','$stuid','$cmt','TID')");
}else {
		$dbh->exec("UPDATE stu_chat SET HW='$cmt' WHERE ID=".$eid."");
	}
}
	header("location:./chat.php?ses=".$ses."&stuid=".$stuid."&ps=".$ps."&classid=".$classid."&subid=".$subid);
	exit;
}
	header("location:./");
	exit;




?>
