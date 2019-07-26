<?php require_once './applock.php';

?> 
 <?php            	
 $url='?stuid='.$_GET['stuid'].'&ps='.$_GET['ps'].'&ses='.$_GET['ses'];
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
    <div class="col-xs-3" style="border-right:1px #e0e0e0 solid;" >
		<?php
		
		
		$src=$basicurl.$adminimage;
		
		?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
        
      
       </div>
          <div  class="col-xs-9">
         
              <div style="text-align:left; font-size:10px; font-weight:bold;color: #ff5722;"><?php echo $adminnm; ?></div>
              <i class="fa fa-map-marker"></i> <?php echo $adminad; ?></h6>
             <br>
		 <i class="fa fa-graduation-cap"></i> <?php echo $adminquali; ?></h6>
     	 <i class="fa fa-tasks"></i> <?php echo $admindes; ?></h6>
              
			</div>
         
         </div>     
    <hr>      
     <?php
		$sql2="Select * from stu_teacher";
				foreach ($dbh->query($sql2) as $row2)
					{	
						if($row2['GENDER']=='Female')$femaleT++; 
						if($row2['GENDER']=='Male')$maleT++; 
						if(date("m-d",strtotime($row2['DOB']))==date("m-d"))$birthT++;
						}
		$sql2="Select * from stu_info";
				foreach ($dbh->query($sql2) as $row2)
					{	
						
						if($row2['GENDER']=='Female')$femaleS++; 
						if($row2['GENDER']=='Male')$maleS++; 
						if(date("m-d",strtotime($row2['DOB']))==date("m-d"))$birth++;

					}
			$sql2="Select * from stu_driver";
				foreach ($dbh->query($sql2) as $row2)
					{	
						if($row2['GENDER']=='Female')$femaleD++; 
						if($row2['GENDER']=='Male')$maleD++; 
						if(date("m-d",strtotime($row2['DOB']))==date("m-d"))$birthD++;
						}

			?>
	 <div class="bs" style="padding:0px;">
      <div style="font-weight:bold;" class="panel-heading-aouji" align="left">Staff / Student Status</div>
      <div class="panel-body bx" >
			<div class="col-xs-12" align="center">    
                 <table width="100%" border="0">
                 	<tr><td width="25%" class="rbdr" align="center">
                 	<td width="25%" class="rbdr" align="center">Male
                	 <td width="25%" class="rbdr" align="center">Female
              		<td width="25%" class="nbdr" align="center">Total
 
 
                 	<tr><td class="rbdr">Staff
                 	<td class="rbdr" align="center"><?php echo $maleT; ?>
                	 <td class="rbdr" align="center"><?php echo $femaleT; ?>
              		<td  class="nbdr" align="center"><?php echo ($maleT+$femaleT); ?>
 
  					<tr><td class="rbdr">Student
                 	<td class="rbdr" align="center"><?php echo $maleS; ?>
                	 <td class="rbdr" align="center"><?php echo $femaleS; ?>
              		<td  class="nbdr" align="center"><?php echo ($maleS+$femaleS); ?>
 				<!--	<tr><td class="rbdr">Driver
                 	<td class="rbdr" align="center"><?php echo $maleD; ?>
                	 <td class="rbdr" align="center"><?php echo $femaleD; ?>
              		<td  class="nbdr" align="center"><?php echo ($maleD+$femaleD); ?>-->
 
                 </table>  
				
			</div>
			
		     
        </div>
    </div>
    <?php
	$today=date("Y-m-d");
	$sql="Select * from stu_att_tech WHERE DATE='$today'";
				foreach ($dbh->query($sql) as $row)
					{
						if($att=="")$att=$row['ATT']; else $att.=",".$row['ATT'];	
				
					}

		$att=explode(",",$att);	
		$attT=array_count_values($att);
		$att="";
	$sql="Select * from stu_attendence WHERE DATE='$today'";
				foreach ($dbh->query($sql) as $row)
					{
						if($att=="")$att=$row['ATT']; else $att.=",".$row['ATT'];	
				
					}

		$att=explode(",",$att);	
		$att=array_count_values($att);
	?>
    
	 <div class="bs" style="padding:0px;">
      <div style="font-weight:bold;" class="panel-heading-aouji" align="left">Staff / Student Attendace Status</div>
      <div class="panel-body bx" >
			<div align="center">    
                 <table width="100%" border="0">
                 	<tr><td width="18%" class="rbdr" align="center">
                 	<td width="16%" class="rbdr" align="center">Prsnt
                	 <td width="16%" class="rbdr" align="center">Ab.
              		<td width="16%" class="nbdr" align="center">Lv.
              		<td width="16%" class="nbdr" align="center">Total
              		<td width="16%" class="nbdr" align="center">%age
 
 
                 	<tr><td class="rbdr"><a style="width:65px" href="viewtatt.php<?php echo $url; ?>" class="button button1">Staff</a>
                 	<td class="rbdr" align="center"><?php if($attT[0]=="")echo '0'; else echo $attT[0]; ?>
                	 <td class="rbdr" align="center"><?php if($attT[1]=="")echo '0'; else  echo $attT[1]; ?>
              		<td  class="nbdr" align="center"><?php if($attT[2]=="")echo '0'; else  echo $attT[2]; ?>
   					<td  class="nbdr" align="center"><?php echo array_sum($attT); ?>
 				<?php
				$ab=$attT[0];
				$sum=array_sum($attT);
				$per=round(($ab/$sum)*100,0);
				?>
                	<td  class="nbdr" align="center"><?php echo $per; ?>%
 
  					<tr><td class="rbdr"><a style="width:65px"  href="viewsatt.php<?php echo $url; ?>" class="button button1">Student</a>
                 	<td class="rbdr" align="center"><?php  if($att[0]=="")echo '0'; else echo $att[0]; ?>
                	 <td class="rbdr" align="center"><?php  if($att[1]=="")echo '0'; else  echo $att[1]; ?>
              		<td  class="nbdr" align="center"><?php   if($att[2]=="")echo '0'; else echo $att[2]; ?>
   					<td  class="nbdr" align="center"><?php echo array_sum($att); ?>
 				<?php
				$ab=$att[0];
				$sum=array_sum($att);
				$per=round(($ab/$sum)*100,0);
				?>
                	<td  class="nbdr" align="center"><?php echo $per; ?>%
 
                 </table>  
				
			</div>
			
		     
        </div>
    </div>
  <?php
	$collection=sumcolm("stu_paid_fee","AMT"," WHERE DATE1='$today'",$dbh);		
	if($collection=="")$collection=0;

 	$hw=countnm("stu_hw"," WHERE DATE='$today'",$dbh);		
	if($hw=="")$hw=0;
	
	$chat=countnm("stu_chat"," WHERE DATE LIKE '".$today."%'",$dbh);		
	if($chat=="")$chat=0;

  ?>  
 <!--   
		<div class="bs" style="padding:0px;">
      <div class="panel-body bx" >
			<div align="center">    
<table width="100%" border="0">
         	<tr><td width="60%" class="rbdr">Fee Collection
                 	<td width="20%"  class="rbdr" align="center"><?php echo $collection; ?>
                	<td align="center"><a href="birthday.php<?php echo $url; ?>" class="button button1">View</a>
                
  					<tr><td class="rbdr">Homework
                 	<td class="rbdr" align="center"><?php echo $hw; ?> Class
                  <td align="center"><a href="birthday.php<?php echo $url; ?>" class="button button1">View</a>
                
            		<tr><td class="rbdr">Student and Staff Chat
                 	<td class="rbdr" align="center"><?php echo $chat; ?> times
                  <td align="center"><a href="birthday.php<?php echo $url; ?>" class="button button1">View</a>  	
                 </table>  

            </div>
      </div>
   </div> 
-->
	<div class="bs" style="padding:0px;">
      <div style="font-weight:bold;" class="panel-heading-aouji" align="left">Happy Birthday	
      </div>
      <div class="panel-body bx" >
			<div align="center">    
<table width="100%" border="0">
    <?php            	
         ?>        	<tr><td width="33%" class="rbdr">Staff
                 	<td width="33%"  class="rbdr" align="center"><?php echo $birthT; ?>
                	<td align="center"><a href="birthday.php<?php echo $url; ?>" class="button button1">View</a>
                
  					<tr><td class="rbdr">Student
                 	<td class="rbdr" align="center"><?php echo $birth; ?>
                  <td align="center"><a href="birthday.php<?php echo $url; ?>" class="button button1">View</a>
                
              	
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


   
     