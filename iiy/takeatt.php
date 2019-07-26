<?php require_once './adminlock.php'; 
$classid=cleanTAG($_GET['classid']);
$subid=cleanTAG($_GET['subid']);

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
          <div class="col-xs-12">
              <p style="text-align:center; font-weight:bold;color: #ff5722;">Class</p>
             	  	<select name="classid" class="form-control cls" >
                    	<option value="">-Class-</option>
						<?php
						createoptions("stu_class WHERE ID in(".$adminclasses.") ","ID","CLS",$classid,$dbh)
						
						?>
                        
                    </select>
               
  			 </div>
        
        
        </div>     
    
<form method="POST" action="save_att.php" enctype="multipart/form-data">
     <br>
<?php
$dt=date("Y-m-d");

//$tot=findnm("stu_dmarks","TOTM"," WHERE DATE='".$dt."' AND SUBID=".$subid." LIMIT 1",$dbh);
?>
              <p style="text-align:center; font-weight:bold;color: #ff5722;">Date</p>
       <input type="text" id="date" readonly class="form-control" name="date" value="<?php echo $dt; ?>"/>
       <input type="hidden" id="ses" name="ses" value="<?php echo $ses; ?>"/>
       <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>"/>
       <input type="hidden" id="ps" name="ps" value="<?php echo $ps; ?>"/>
       <input type="hidden" id="classid" name="classid" value="<?php echo $classid; ?>"/>
       <input type="hidden" id="subid" name="subid" value="<?php echo $subid; ?>"/>
       
     
      <div class="row">
          <div class="col-xs-12"><br>

              <p style="text-align:center; font-weight:bold;color: #ff5722;">Students List</p>
	<table width="100%" border="0" class="table">
 
	   <?php
if($classid!="")
{		
 $sql = "Select * from stu_info WHERE CLS='$classid'";
  		foreach ($dbh->query($sql) as $row)
			{
				
$sid=findnm("stu_attendence","STUID"," WHERE DATE='".$dt."' AND CID=".$classid."",$dbh);
$att=findnm("stu_attendence","ATT"," WHERE DATE='".$dt."' AND CID=".$classid."",$dbh);

	$sid=explode(",",$sid);	
	$att=explode(",",$att);	
	$key=array_search($row['ID'], $sid);
	//print_r($sid);	
				$cls=findnm("stu_class","CLS"," WHERE ID=".$row['CLS']."",$dbh);
				
				echo '<tr>';
				echo '<td>'.$row['NM'];
				echo '/'.$row['FNM'];
				echo '<br>Roll No:'.$row['ROLLNO'];
				echo '&nbsp; Class:'.$cls;
				echo '<td>';
				
				echo '<select class="form-control" name="mrks[]">';
				$arr=array("P","A","L");
				for($x=0;$x<3;$x++)
				{
					if($att[$key]==$x)
					echo '<option value="'.$x.'" selected>'.$arr[$x].'</option>';
					else
					echo '<option value="'.$x.'">'.$arr[$x].'</option>';
				}
				echo '</select>';
				
				
				echo '<input type="hidden" size=3 value="'.$row['ID'].'" name="ids[]">';
				$f=1;
			
			}
}
		?>
     </table>
     <?php if($f!=""){ ?>   
         <input type="submit" class="btn btn-success" value="Save"/>
         <?php } ?>  
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
<?php if($_GET['done']!=""){ ?>     
alert("Attendence Taken");
<?php } ?>     
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
				window.open("./takeatt.php?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&classid="+classid+"&subid="+output,"_self")
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
				window.open("./takeatt.php?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&classid="+output,"_self")
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


   
     