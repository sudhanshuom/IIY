<?php $ses=$_REQUEST['ses'];require_once '../conn.php';
$adminid=0;
include('../fun.php');
//include('../myfun.php');
$stuid=	cleanTAG($_REQUEST['stuid']);
$ps=cleanTAG($_REQUEST['ps']);

//$sql999 = "Select * from school_tech where ID='$stuid' and PASS1='$ps'";
$sql999="SELECT *FROM stu_teacher WHERE ID=".$stuid." AND PASS='".$ps."' AND TP=2";

    foreach ($dbh->query($sql999) as $row)
        {
		$adminad=$row['AD'];
     	$adminnm=$row['NM'];
     	$admindes=$row['DES'];
     	$adminimage=$row['IMAGE'];
		$adminmb=$row['PH'];
		$admintp=$row['TP'];
		 if($admintp=="ADMIN" || $admintp=="MANAGER" ||$admintp=="PRINCIPAL") $adminper=1;
     	$adminquali=$row['QUALI'];
     	$admindob=date("d-m-Y",strtotime($row['DOB']));
        $admindoj=date("d-m-Y",strtotime($row['DOJ']));
        $adminid=$row['ID'] ;
		 	//	$sql1="Select * from school_info";
   			//		foreach ($dbh->query($sql1) as $row1)
        		//		{
        				$schoolnm=$row1['NM'].', '.$row1['AD'];
        					$feewithvan_quarterly=$row1['QUARTERLY'] ;
						 $NoAnnualFundIfNewAdm=$row1['NOANNUALFUNDIFNEWADM'] ;
				//}

   		}
if($adminid==0){exit;}
$basicurl='http://aouji.com/iiy/';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap -->
 

    <![endif]-->
      <style>
      
      .bg_load {
    position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	background: #EEE;
}

.wrapper {
    /* Size and position */
	font-size: 25px; /* 1em */
    width: 8em;
	height: 8em;
    position: fixed;
    left: 50%;
    top: 50%;
    margin-top: -100px;
    margin-left: -100px;

    /* Styles */
	border-radius: 50%;
    background: rgba(255,255,255,0.1);
    border: 1em dashed rgba(138,189,195,0.5);
    box-shadow: 
        inset 0 0 2em rgba(255,255,255,0.3),
        0 0 0 0.7em rgba(255,255,255,0.3);
    animation: rota 3.5s linear infinite;

    /* Font styles */
    font-family: 'Racing Sans One', sans-serif;
    
    color: #444;
    text-align: center;
    text-transform: uppercase;
    text-shadow: 0 .04em rgba(255,255,255,0.9);
    line-height: 6em;
}

.wrapper:before,
.wrapper:after {
    content: "";
    position: absolute;
    z-index: -1;
    border-radius: inherit;
    box-shadow: inset 0 0 2em rgba(255,255,255,0.3);
    border: 1em dashed;
}

.wrapper:before {
    border-color: rgba(138,189,195,0.2);
	top: 0; right: 0; bottom: 0; left: 0;
}

.wrapper:after {
	border-color: rgba(138,189,195,0.4);
    top: 1em; right: 1em; bottom: 1em; left: 1em; 
}

.wrapper .inner {
    width: 100%;
    height: 100%;
    animation: rota 3.5s linear reverse infinite;
}

.wrapper span {
    display: inline-block;
    animation: placeholder 1.5s ease-out infinite;
}

.wrapper span:nth-child(1)  { animation-name: loading-1;  }
.wrapper span:nth-child(2)  { animation-name: loading-2;  }
.wrapper span:nth-child(3)  { animation-name: loading-3;  }
.wrapper span:nth-child(4)  { animation-name: loading-4;  }
.wrapper span:nth-child(5)  { animation-name: loading-5;  }
.wrapper span:nth-child(6)  { animation-name: loading-6;  }
.wrapper span:nth-child(7)  { animation-name: loading-7;  }

@keyframes rota {
    to { transform: rotate(360deg); }
}

@keyframes loading-1 {
    14.28% { opacity: 0.3; }
}

@keyframes loading-2 {
    28.57% { opacity: 0.3; }
}

@keyframes loading-3 {
    42.86% { opacity: 0.3; }
}

@keyframes loading-4 {
    57.14% { opacity: 0.3; }
}

@keyframes loading-5 {
    71.43% { opacity: 0.3; }
}

@keyframes loading-6 {
    85.71% { opacity: 0.3; }
}

@keyframes loading-7 {
    100% { opacity: 0.3; }
}
          
          #dd1{
              background-color: #ff5722;
          }
   #dd2{
              background-color:#283593;
          }
.panel-heading-aouji{
 padding-left:10px;
	}
.bx{
	border:1px #CCCCCC solid; 
	box-shadow:0px 2px 2px #999999;
	margin-bottom:5px;
	margin-top:5px;
	}
.rbdr{
	border-right:#CCC solid;
	}
	
	.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 2px 15px 2px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
}

.button1 {font-size: 10px;}			  
      </style>
  </head>
  