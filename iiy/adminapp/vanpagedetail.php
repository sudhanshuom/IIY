<?php require_once './applock.php';
$ses=cleanTAG($_GET['ses']);
$stuid=cleanTAG($_GET['stuid']);
$ps=cleanTAG($_GET['ps']);
$tp=cleanTAG($_GET['tp']);
$classid=cleanTAG($_GET['classid']);
$extraID=cleanTAG($_GET['extraID']);
?> 
   <input type="hidden" id="ses" name="ses" value="<?php echo $ses; ?>"/>
       <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>"/>
       <input type="hidden" id="ps" name="ps" value="<?php echo $ps; ?>"/>
       <input type="hidden" id="classid" name="classid" value="<?php echo $classid; ?>"/>
       <input type="hidden" id="tp" name="tp" value="<?php echo $tp; ?>"/>
       <input type="hidden" id="extraID" name="extraID" value="<?php echo $extraID; ?>"/>
       
    <?php
	$link="?ses=".$ses."&stuid=".$stuid."&ps=".$ps."&tp=".$tp."&classid=".$classid."&extraID=".$extraID."";
	
	$sql="Select * from stu_driver WHERE ID=".$extraID."";
     	foreach ($dbh->query($sql) as $row)
        	{
				$uid=$row['ID'];
				$troot=$row['TROOT'];
				$nm=$row['NM'];
				$ad=$row['AD'];
				$mb=$row['PH'];
				$bus=$row['BUSNO'];
				$van=$row['TROOT'];
				}
	?>   
  <body>
  <div class="bg_load"> <p style="text-align:center; margin-top:80px; font-size:20px; font-weight:bold;">Loading</p></div>
<div class="wrapper">
    <div class="inner">
      <span style="font-weight:bold;">Loading</span>
    </div>
     
</div>    
     <br>
      <div class="container">
 
    <div class="row">
          <div style="border-right:1px #e0e0e0 solid;"  class="col-xs-7">
         
              <p style="text-align:center; font-weight:bold;color: #ff5722;"><?php echo $nm; ?></p>
             
             
              <h6 style="text-align:left;" ><small>Address</small><br><?php echo $ad; ?></h6>
              <h6 style="text-align:left;" ><small>Mobile Number</small><br><?php echo $mb; ?></h6>  
              <h6 style="text-align:left;" ><small>Bus Number</small><br><?php echo $bus; ?></h6>  
              <h6 style="text-align:left;" ><small>Route Number</small><br><?php echo $van; ?></h6>
             
			</div>
         
        <div class="col-xs-5	">
		<?php
		
		$src='http://aoujieduapp.aouji.com/erp/stuimages/'.$login_name.'/'.$adminimage;
		
		?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
        
      
       </div> </div>     
       
 	
    <div class="panel panel-info">
      <div style="font-weight:bold;" class="panel-heading">VAN Students</div>
      <div class="panel-body">
      <table class="table">
<?php  
		$sql2="Select * from stu_info WHERE VAN=".$troot."";
		foreach ($dbh->query($sql2) as $row2)
        	{
		  echo '<tr><td>'.$row2['NM'];
		  echo '<td>'.$row2['NM'].'/'.$row2['FNM'];
		  echo '<br>'.$row2['AD'].', '.$row2['MB'];

			}
		?>
        </table>
         </div>
    </div>   
      
      </div>
      
      
      

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 
 <script> 
      
      $(window).load(function() {
    $(".bg_load").fadeOut("slow");
    $(".wrapper").fadeOut("slow");
})
      </script>
  </body>
</html>


   
     