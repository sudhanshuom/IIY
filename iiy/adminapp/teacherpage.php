<?php require_once './applock.php';
$ses=cleanTAG($_GET['ses']);
$stuid=cleanTAG($_GET['stuid']);
$ps=cleanTAG($_GET['ps']);
$tp=cleanTAG($_GET['tp']);
$classid=cleanTAG($_GET['classid']);
?> 
   <input type="hidden" id="ses" name="ses" value="<?php echo $ses; ?>"/>
       <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>"/>
       <input type="hidden" id="ps" name="ps" value="<?php echo $ps; ?>"/>
       <input type="hidden" id="classid" name="classid" value="<?php echo $classid; ?>"/>
       <input type="hidden" id="tp" name="tp" value="<?php echo $tp; ?>"/>
       
    <?php
	$link="?ses=".$ses."&stuid=".$stuid."&ps=".$ps."&tp=".$tp."&classid=".$classid."";
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
        
   <br>
   <?php
    $sql = "Select * from stu_teacher order by NM ASC";
  		foreach ($dbh->query($sql) as $row)
			{
			?>
    <a href="teacherpagedetail.php<?php echo $link; ?>&extraID=<?php echo $row['ID'] ?>" style="color:inherit">
    <div class="row" >
	    <div class="col-xs-3" style="border-right:1px #e0e0e0 solid;" >
		<?php
		$src=$basicurl.$adminimage;
		?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
        
      
       </div>
          <div  class="col-xs-9" style=" font-size:11px;">
         
              <div style="text-align:left; font-size:13px; font-weight:bold;color: #ff5722;"><?php echo $row['NM']; ?></div>
              <i class="fa fa-map-marker"></i> <?php echo $row['AD']; ?></a>
             <br>
		 <i class="fa fa-phone"></i> <a href="tel:<?php echo $row['PH']; ?>"><?php echo $row['PH']; ?></a>  <br>
		  <i class="fa fa-graduation-cap"></i> <?php echo $row['QUALI']; ?></h6>
     	 <i class="fa fa-tasks"></i> <?php echo $row['DES']; ?></h6>
     	      
			</div>
         
         </div>     
        
     <hr>  
     <?php
			}
	 
	 ?>

	
      

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


   
     