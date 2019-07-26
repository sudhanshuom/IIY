<?php session_start(); $css="ok"; require_once './applock.php';
if($ses!="")
{ 
	$tp=cleanTAG($_REQUEST['tp']);
	$id=cleanTAG($_REQUEST['id']);
	switch($tp)
	{
		case 1:
		$x=cleanTAG($_REQUEST['x']);
			$today=date("Y-m-d");
	$url='?stuid='.$_GET['stuid'].'&ps='.$_GET['ps'].'&ses='.$_GET['ses'];

			$stts=findnm("stu_att_tech","STTS","WHERE DATE='$today'",$dbh);	
			$stts=explode(",",$stts);	
			$val=ArrayReplace($stts, $x, $id);
			$val=implode(",",$val);	
			
				$q="UPDATE stu_att_tech SET STTS='".$val."' WHERE DATE='$today'";
				$dbh->exec($q);
		
			header("Location:viewtatt.php".$url);
			exit;
		break;
	
	}
}
?>
