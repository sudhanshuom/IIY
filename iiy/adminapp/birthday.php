<?php require_once './applock.php';

?> 
<style>
	i{
		font-size:9px;
		}
</style>
  <body>
  <div class="bg_load"> <p style="text-align:center; margin-top:80px; font-size:20px; font-weight:bold;">Loading</p></div>
<div class="wrapper">
    <div class="inner">
      <span style="font-weight:bold;">Loading</span>
    </div>
     
</div>    
     <br>
      <div class="container">
        	<div align="center" style="color: #ff5722; font-size:18px">Happy Birthday</div> <hr> 
    
    <?php
	$today=date("m-d");
	$sql="Select * from stu_teacher WHERE DOB LIKE '%".$today."'";
				foreach ($dbh->query($sql) as $row)
					{
	
	?><div class="row" style="margin:5px;border-bottom:1px #e0e0e0 solid;">
   			<div class="col-xs-4" >
					<?php
						$src=$basicurl.$adminimage;
					?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
	      </div>
          <div  class="col-xs-8" style=" font-size:12px;">
         
              <div style="text-align:left; font-size:12px; font-weight:bold;color: #ff5722;"><?php echo $row['NM']; ?></div>
              <i class="fa fa-map-marker"></i> <?php echo $row['AD']; ?></h6>
             <br>
             	 <i class="fa fa-graduation-cap"></i> <?php echo $adminquali; ?></h6>
     	 <i class="fa fa-tasks"></i> <?php echo $admindes; ?></h6>
      <br>

	 <i class="fa fa-birthday-cake"></i> <?php echo date("d-m-Y",strtotime($row['DOB'])); ?>	 <br>
<i class="fa fa-phone"></i> <a href="tel:<?php echo $row['PH']; ?>"><?php echo $row['PH']; ?></a></h6>
              
		   </div>
           </div> 
  <?php
					}
  ?>       
     
   
    <?php
		$sql="Select * from stu_info WHERE DOB LIKE '%".$today."'";
				foreach ($dbh->query($sql) as $row)
					{
	$cls=findnm("stu_class","CLS","WHERE ID=".$row['CLS']."",$dbh);
	?><div class="row" style="margin:5px;border-bottom:1px #e0e0e0 solid;">
   			
          <div align="right"  class="col-xs-8"  style=" font-size:12px;">
         
              <div  style="text-align:right; font-size:12px; font-weight:bold;color: #ff5722;"><?php echo $row['NM'].' / '.$row['FNM']; ?></div>
              <i class="fa fa-map-marker"></i> <?php echo $row['AD']; ?></h6>
             <br>
             
              Class: <?php echo $cls; ?> 
             <br>

	 <i class="fa fa-birthday-cake"></i> <?php echo date("d-m-Y",strtotime($row['DOB'])); ?>
    
     </h6>
              
		   </div>
           <div class="col-xs-4"  >
					<?php
						$src=$basicurl.$adminimage;
					?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
	      </div>
           </div> 
  <?php
					}
  ?>       
   
    <hr>      
    
   
   
   
   
   
   
   
   
   
   
   
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


   
     