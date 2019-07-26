<?php require_once './adminlock.php';
if($ses!="")
{
		$ids=$_POST['ids'];
		$mrks=$_POST['mrks'];
		//$dt=date("Y-m-d",strtotime($_REQUEST['fdt']));
		$dt=date("Y-m-d");
		$cmt=cleanTAG($_REQUEST['cmt']);
		$subid=cleanTAG($_REQUEST['subid']);
		$classid=cleanTAG($_REQUEST['classid']);
		$tot=cleanTAG($_REQUEST['tot']);
	
		$ses=cleanTAG($_REQUEST['ses']);
		$ps=cleanTAG($_REQUEST['ps']);
		$stuid=cleanTAG($_REQUEST['stuid']);
		$eid=cleanTAG($_REQUEST['eid']);

for($x=0;$x<count($ids);$x++)
	{
		$qry=" WHERE DATE='".$dt."' AND SID=".$ids[$x]." AND SUBID=".$subid."";
			$q="UPDATE stu_dmarks SET TOTM='".$tot."'".$qry;
		$dbh->exec($q);
			$q="UPDATE stu_dmarks SET OBM='".$mrks[$x]."'".$qry;
		$dbh->exec($q);
	
	}

	header("location:./dailymarks.php?ses=".$ses."&stuid=".$stuid."&ps=".$ps."&classid=".$classid."&subid=".$subid);
	exit;
}
	header("location:./");
	exit;




?>
