<?php require_once './adminlock.php'; 
$classid=cleanTAG($_GET['classid']);
if($_GET['eid']!="")
{
	$eid=cleanTAG($_GET['eid']);

$sql = "Select * from stu_hw WHERE ID=$eid";

    foreach ($dbh->query($sql) as $row)
        {
			$eid=$row['ID'];
			$sub=$row['SUB'];
			$classid=$row['CID'];
			$hw=$row['HW'];
		}
}

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
   
 <form method="POST" action="save_hw.php" enctype="multipart/form-data">
                       
    <div class="row">
          <div class="col-xs-12">
              <p style="text-align:center; font-weight:bold;color: #ff5722;">Class</p>
             	  	<select name="classid" class="form-control cls" >
                    	<option value="">-Class-</option>
						<?php
						createoptions("stu_class WHERE ID in(".$adminclasses.") ","ID","CLS",$classid,$dbh)
						
						?>
                        
                    </select>
               
  			 </div>
        <?php
		$classids=findnm("stu_class","SUB"," WHERE ID=$classid",$dbh);
		?>         
        <div class="col-xs-12">
               <p style="text-align:center; font-weight:bold;color: #ff5722;">Subject</p>
              	<select name="subid" class="form-control">
                    	<?php
						createoptions("stu_sub WHERE ID in(".$classids.")  ","ID","SUB",$seleced,$dbh)
						
						?>
                    </select>
        
      
        </div> 
         <div class="col-xs-12"><br>

               <p style="text-align:center; font-weight:bold;color: #ff5722;">Home work</p>
              	<input type="hidden" id="ses" name="ses" value="<?php echo $ses; ?>"/>
       <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>"/>
       <input type="hidden" id="ps" name="ps" value="<?php echo $ps; ?>"/>
       <input type="hidden" id="classid" name="classid" value="<?php echo $classid; ?>"/>
       <input type="hidden" id="eid" name="eid" value="<?php echo $eid; ?>"/>
       
       
       <textarea cols="25" rows="4" name="cmt" class="form-control"><?php echo $hw; ?></textarea>
        
      
        </div> 
        <div class="col-xs-12" align="center"><br>

        <input type="submit" class="btn btn-success" value="Save"/>
        </div>
        </div>     
    
      
 </form>      
      <div class="row">
          <div class="col-xs-12"><br>

              <p style="text-align:center; font-weight:bold;color: #ff5722;">Home Work</p>
	<table width="100%">
	   <?php
  $dt=date("Y-m-d"); 
$sql9 = "Select DISTINCT DATE from stu_hw WHERE CID IN ($classid)";
    foreach ($dbh->query($sql9) as $row9)
        {
			echo '<tr><th colspan=3><div align="center">'.date("d-m-Y",strtotime($row['DATE'])).'</div>';
		
 	$sql = "Select * from stu_hw where DATE='".$row9['DATE']."' and CID IN ($classid)";
		foreach ($dbh->query($sql) as $row)
			{
				$sub=findnm("stu_sub","SUB"," WHERE ID=".$row['SUB']."",$dbh);
	
				echo '<tr><td>'.$sub;
				echo '<td>'.$row['HW'];
				echo '<td><a href="?eid='.$row['ID'].'&ses='.$ses.'&stuid='.$stuid.'&ps='.$ps.'&classid='.$classid.'"><i class="fa fa-edit"></i></a>';
			}
		}
		?>
     </table>   
        </div>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 
 <script> 
   
   
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
				window.open("./?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&classid="+output,"_self")
			//	window.location.reload();
			}


		});

}); 

      $(window).load(function() {
    $(".bg_load").fadeOut("slow");
    $(".wrapper").fadeOut("slow");
})
      </script>
  </body>
</html>


   
     