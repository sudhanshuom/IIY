<?php require_once './lock.php'; 
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
          }.tm{
			  background:#CCC;
			  font-size:9px;
			  padding:0 5px 0 5px;
			   border-radius: 25px;
			  
			  }
		.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   margin-bottom:8px;
   width: 100%;
    color: white;
   text-align: center;
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
              
               
        <?php
		$subnm=findnm("stu_teacher","NM"," WHERE ID=$subid",$dbh); 
	
		?>         
        <div class="col-xs-12">

               <p style="text-align:center; font-weight:bold;color: #ff5722;">Student</p>
              	<select name="subid" class="form-control sub">
                         	<option value="">-Select-</option>
				<?php
						createoptions("stu_teacher order by NM","ID","NM",$subid,$dbh)
						
						?>
                    </select>
        
      
        </div> 
         
        
        </div>     
    
<form method="POST" action="save_chatstudent.php" enctype="multipart/form-data">
  
<?php
?>
            
      
       <input type="hidden" id="ses" name="ses" value="<?php echo $ses; ?>"/>
       <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>"/>
       <input type="hidden" id="ps" name="ps" value="<?php echo $ps; ?>"/>
       <input type="hidden" id="classid" name="classid" value="<?php echo $classid; ?>"/>
       <input type="hidden" id="subid" name="subid" value="<?php echo $subid; ?>"/>
       
     
      <div class="row">
          <div class="col-xs-12">

              <p style="text-align:center; font-weight:bold;color: #ff5722;">Chat With <?php echo $subnm; ?></p>
   <div id="containerDiv" style="border:0px red solid; height:300px; overflow:auto">           
	<table width="100%" border="0" class="table" >
 
	   <?php
		
 $sql = "Select * from stu_chat WHERE CID='$stuid' AND TID='$subid' order by ID ASC";
  		foreach ($dbh->query($sql) as $row)
			{
				
				if($row['BY1']=="TID")
					{
						echo '<tr>';
						echo '<td align="justify">';
						echo '<span class="tm" align="left">'.$subnm.'</span>';
						echo '<span class="tm" align="left">'.date("d-m-Y H:i:s",strtotime($row['DATE'])).'</span>';
						echo '<br>'.$row['MSG'];
						
					}else {
						
						echo '<tr>';
						echo '<td align="justify"  style="padding-left:40px">';
						echo '<span class="tm" align="left">You</span>';
						echo '<span class="tm" align="left">'.date("d-m-Y H:i:s",strtotime($row['DATE'])).'</span>';
						echo '<br>'.$row['MSG'];

						}
			
			}

		?>
     </table>
     </div>
     <div class="col-xs-12 footer">
		     <div class="col-xs-9">
      <input type="test" id="tot" class="form-control" name="cmt" value=""/></div>
		     <div class="col-xs-3">
         <input type="submit" class="btn btn-success" value="Send"/>
         
         </div>
       </div>
        
  </div>  
  </form>    
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 
 <script> 
 
 $("#containerDiv").animate({ scrollTop: 100000 }, "fast");

    $(".sub").change(function(){
	var id=$(this).val();
	var ses=$("#ses").val();
	var ps=$("#ps").val();
	var stuid=$("#stuid").val();

	window.open("./chatstudent.php?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&subid="+id,"_self")
		
			

});
   
   

      $(window).load(function() {
    $(".bg_load").fadeOut("slow");
    $(".wrapper").fadeOut("slow");
})
      </script>
  </body>
</html>


   
     