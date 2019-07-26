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

$dt=date("Y-m-d",time());
$tm=date("h:i:s",time());
	   
					$pid =1;	 
if($eid=="")
{
	$dbh->exec("INSERT INTO stu_hw(DATE,CID,SUB,HW,AID) VALUES ('$dt','$classid','$subid','$cmt','$stuid')");
		
	//	$dbh->exec("INSERT INTO stu_appmenu(NM,TP) VALUES ('Communication','3')");
}else {
		$dbh->exec("UPDATE stu_hw SET HW='$cmt' WHERE ID=".$eid."");
	}

	header("location:./?ses=".$ses."&stuid=".$stuid."&ps=".$ps."&classid=".$classid);
	exit;
}
	header("location:./");
	exit;




?>
