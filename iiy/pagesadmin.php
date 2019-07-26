<?php require_once './adminlock.php'; 
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
      </style>
  </head>
  <body>
  <div class="bg_load"> <p style="text-align:center; margin-top:80px; font-size:20px; font-weight:bold;">Loading Page</p></div>
<div class="wrapper">
    <div class="inner">
      <span style="font-weight:bold;">Loading</span>
    </div>
     
</div>    
     <br>
      <div class="container">
	      <div class="row">
          <div class="col-xs-12"><br>


	   <?php
$clss="border-bottom:1px gray solid;width:100%; padding:5px 0 5px 5px;";

switch($_REQUEST['u'])
{
case 13:

	$sql="Select * from stu_sms_tech where SID=$adminid order by ID DESC";
  		foreach ($dbh->query($sql) as $row)
        	{
				
		echo '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$row['MB'].'</b><td> <div align=right style="color:black">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		echo '<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['MSG'].'</b></div>';	

		echo '</center></table>';			

			}
break;
case "14":
$basic="";
$sql="Select * from news order by ID DESC";
    	foreach ($dbh->query($sql) as $row)
        	{
			$pid =  $row['ID'];			
		
		
		echo '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$row['TTL'].'</b><td> <div align=right style="color:gray">'.date("d-m-Y",strtotime($row['DATE1'])).'</div></div>';
		echo '<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['DETAIL'].'</b></div>';	

		echo '</center></table>';			
			}
		
if($pid=="") $basic = "Nothing in News";
break;
case 15:
 
if($_GET['date']!="")$dts=date("d-m-Y",strtotime($_GET['date'])); else $dts=date("d-m-Y");
echo '<table width="100%">';
echo '<tr><td><input type="text" id="dt" value="'.$dts.'" placeholder="dd-mm-yyyy" class="form-control">';
echo '<td><input type="submit" value="View"  class="btn btn-success dmark">';
echo '</table>';
if($_GET['date']!="")
{
	$dt=date("Y-m-d",strtotime($_GET['date']));
	$sql9 = "Select DISTINCT DATE from stu_hw WHERE CID IN ($adminclasses) AND DATE='".$dt."'";
}else{
	$sql9 = "Select DISTINCT DATE from stu_hw WHERE CID IN ($adminclasses)";
	}
    foreach ($dbh->query($sql9) as $row9)
        {
			echo '<tr><th colspan=3><div align="center">'.date("d-m-Y",strtotime($row9['DATE'])).'</div>';
		
 	$sql = "Select * from stu_hw where DATE='".$row9['DATE']."' and CID IN ($adminclasses)";
		foreach ($dbh->query($sql) as $row)
			{
				$sub=findnm("stu_sub","SUB"," WHERE ID=".$row['SUB']."",$dbh);
			
				$aid=findnm("stu_teacher","NM"," WHERE ID=".$row['AID']."",$dbh);
			if($aid=="")$aid="Operator";
				
				echo '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td ><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.$sub.'</b><td> <div align=right style="color:black">'.$aid.'</div></div>';
		echo '<tr><td colspan=2><div style=" color:black; font-size:0.8em;margin-bottom:6px"><b>'.$row['HW'].'</b></div>';	

		echo '</center></table>';	
			}
		}
break;
case 16:
if($_GET['date']!="")$dts=date("d-m-Y",strtotime($_GET['date'])); else $dts=date("d-m-Y");

echo '<table width="100%">';
echo '<tr><td><input type="text" id="dt" value="'.$dts.'" placeholder="dd-mm-yyyy" class="form-control">';
echo '<td><input type="submit" value="View"  class="btn btn-success dmark">';
echo '</table>';
if($_GET['date']!="")
{
	$dt=date("Y-m-d",strtotime($_GET['date']));
$sql9 = "Select DISTINCT DATE from stu_dmarks WHERE DATE='".$dt."' order by DATE DESC";
}else{
$sql9 = "Select DISTINCT DATE from stu_dmarks order by DATE DESC";
	}
    foreach ($dbh->query($sql9) as $row9)
        {


echo '<table border="0"  style="'.$clss.' width:100%; font-family:calibri"><tr><td  align=center colspan=3><div style="text-transform:uppercase; color:black; font-size:1em; margin-bottom:6px"><b>'.date("d-m-Y",strtotime($row9['DATE'])).'</b>';	
$sql = "Select * from stu_info WHERE CLS IN ($adminclasses)";
  		foreach ($dbh->query($sql) as $row)
			{
		
			echo '<tr><td width=50% colspan=3><div style=" color:black; font-size:1.2em;margin-bottom:6px"><b>'.$row['NM'].', Roll No:'.$row['ROLLNO'].'</b></div>';	
	
	$q="Select * from stu_dmarks WHERE DATE='".$row9['DATE']."' AND SID=".$row['ID']."";				
  		foreach ($dbh->query($q) as $ro)
			{
		$sub=findnm("stu_sub","SUB"," WHERE ID=".$ro['SUBID']."",$dbh);
			
		
		echo '<tr><td width=50%><div style=" color:black; font-size:0.8em;margin-bottom:6px">'.$sub.'</div>';	
		echo '<td  width=25%><div style=" color:black; font-size:0.8em;margin-bottom:6px">'.$ro['TOTM'].'</div>';	
		echo '<td><div style=" color:black; font-size:0.8em;margin-bottom:6px">'.$ro['OBM'].'</div>';	

			}
			}
echo '</center></table>';				
		}
break;
}

		?>
     </table>
     <br>
<br>
<br>
<br>
<br>
  
        </div>
        
  </div>  
  </form>    
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 
 <script> 
      
    $(".sub").change(function(){
	var id=$(this).val();
	var ses=$("#ses").val();
	var ps=$("#ps").val();
	var stuid=$("#stuid").val();
	var classid=$("#classid").val();
	$.ajax({
		url:"getdata.php",
		data:{id:id,tp:"2",ses:ses,stuid:stuid,ps:ps},
		type:'post',
		cache:false,
			success:function(output){
				window.open("./dailymarks.php?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&classid="+classid+"&subid="+output,"_self")
			//	window.location.reload();
			}


		});

});
   
    $(".cls").change(function(){
	var id=$(this).val();
	var ses=$("#ses").val();
	var ps=$("#ps").val();
	var stuid=$("#stuid").val();
	$.ajax({
		url:"getdata.php",
		data:{id:id,tp:"1",ses:ses,stuid:stuid,ps:ps},
		type:'post',
		cache:false,
			success:function(output){
				window.open("./dailymarks.php?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&classid="+output,"_self")
			//	window.location.reload();
			}

 
		});
 
}); 



    $(".dmark").click(function(){
	var id=$("#dt").val();
	
				window.open("./pagesadmin.php?ses=<?php echo $_GET['ses']; ?>&stuid=<?php echo $_GET['stuid']; ?>&ps=<?php echo $_GET['ps']; ?>&u=<?php echo $_GET['u']; ?>&date="+id,"_self")
			//	window.location.reload();
	
}); 






      $(window).load(function() {
    $(".bg_load").fadeOut("slow");
    $(".wrapper").fadeOut("slow");
})
      </script>
  </body>
</html>


   
     