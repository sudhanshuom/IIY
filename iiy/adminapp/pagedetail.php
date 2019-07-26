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
	
	$sql="Select * from stu_info WHERE ID=".$extraID."";
     	foreach ($dbh->query($sql) as $row)
        	{
				$nm=$row['NM'];
				$fnm=$row['FNM'];
				$ad=$row['AD'];
				$mb=$row['MB'];
				$cls=$row['CLS'];
				$dob=date("d-m-Y",strtotime($row['DOB']));
				$gender=$row['GENDER'];
					$admdate=date("d-m-Y",strtotime($row['ADMDATE']));
				$admno=$row['ADMNO'];
				$van=$row['VAN'];
				if($row['GCODE']=="") $app="No"; else $app='Yes';
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
          <div style="border-right:1px #e0e0e0 solid;"  class="col-xs-6">
         
              <p style="text-align:center; font-weight:bold;color: #ff5722;"><?php echo $nm; ?></p>
              <h6 style="text-align:left;" ><small>Father Name</small><br><?php echo $fnm; ?></h6>
             
              <h6 style="text-align:left;" ><small>Address</small><br><?php echo $ad; ?></h6>
              <h6 style="text-align:left;" ><small>Mobile Number</small><br><?php echo $mb; ?></h6>
             
			</div>
         
        <div class="col-xs-6">
		<?php
		
		$src='http://aoujieduapp.aouji.com/erp/stuimages/'.$login_name.'/'.$adminimage;
		
		?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
        
      
       </div> </div>     
    <hr>      
     
	 <div class="panel panel-info">
      <div style="font-weight:bold;" class="panel-heading">Basic Detail</div>
      <div class="panel-body">
			<div class="col-xs-6">           
					  <h6 style="text-align:left;" ><small>Date of Birth</small><br><?php echo $dob; ?></h6>
					  <h6 style="text-align:left;" ><small>Gender</small><br><?php echo $gender; ?></h6>
					  <h6 style="text-align:left;" ><small>Admission Date</small><br><?php echo $admdate; ?></h6>
					 </div>
			<div class="col-xs-6">
                      <h6 style="text-align:left;" ><small>Admission Number</small><br><?php echo $admno; ?></h6>
			
					 
					  
					  <h6 style="text-align:left;" ><small>Login ID</small><br><?php echo $stuid; ?></h6>
					  <h6 style="text-align:left;" ><small>App Installed</small><br><?php echo $app; ?></h6>
			</div>	
		     
        </div>
    </div>
	
	
	 <div class="panel panel-info">
      <div style="font-weight:bold;" class="panel-heading">School VAN Detail</div>
      <div class="panel-body">
			<div class="col-xs-12">           
	<?php
	
	$sql2="Select * from stu_driver WHERE TROOT=".$van."";
    	foreach ($dbh->query($sql2) as $row2)
        	{
				$found=1;
			
			echo '<h6 style="text-align:left;" ><small>Driver Name</small><br>'.$row2['NM'].'</h6>';
			echo '<h6 style="text-align:left;" ><small>Address</small><br>'.$row2['AD'].'</h6>';
			
			echo '<h6 style="text-align:left;" ><small>Route No.</small><br>'.$row2['TROOT'].'</h6l>';
			
			echo '<h6 style="text-align:left;" ><small>Bus No.</small><br>'.$row2['BUSNO'].'</h6>';
			echo '<h6 style="text-align:left;" ><small>Contact No.</small><br><a href="tel:'.$row2['PH'].'">'.$row2['PH'].'</a></h6>';
			
		
			}
			if($found!=1) echo 'No van Selected';
	?>

			
			</div>	
		     
        </div>
    </div>
	
	  <div class="panel panel-info">
      <div style="font-weight:bold;" class="panel-heading">Adbsent / Leave</div>
      <div class="panel-body">
<?php

  	$sql2="Select * from stu_attendence WHERE CID=".$cls."";
   	foreach ($dbh->query($sql2) as $row2)
        	{
			$val=explode(",",$row2['STUID']);
			$attval=explode(",",$row2['ATT']);
			for($cc=0;$cc<count($val);$cc++)
					{
					if($val[$cc]==$stuid){
						$found=1;
			
			if($attval[$cc]>0)
						{
					if($attval[$cc]==1){ $re="On Leave"; $im="leave.png";} 
					if($attval[$cc]==2){$re="Absent"; $im="absent.png";}
					echo '<h6 style="text-align:left;" class="col-xs-6" ><small>'.$re.'</small><br>'.date("d-m-Y",strtotime($row2['DATE'])).'</h6l>';
					
						}
					}
			}
			}
		if($found==0) echo 'No Leave or Absent marked';	
		?>
         </div>
    </div>  
	
	
    <div class="panel panel-info">
      <div style="font-weight:bold;" class="panel-heading">Subjects</div>
      <div class="panel-body">
<?php  $subs=findnm("stu_class","SUB"," WHERE ID=".$cls."",$dbh);

		$sql2="Select * from stu_sub WHERE ID IN(".$subs.")";
		foreach ($dbh->query($sql2) as $row2)
        	{
		  echo '<p class="col-xs-6"><i class="fa fa-circle"></i>&nbsp;'.$row2['SUB'].'</p>';

			}
		?>
         </div>
    </div>   
      

      
 <div class="panel panel-info">
      <div style="font-weight:bold;" class="panel-heading">Fee</div>
      <div class="panel-body">
      <table width="100%" class="table">
<?php 
$sql2="Select * from stu_paid_fee WHERE SID=$extraID order by ID ASC";
		foreach ($dbh->query($sql2) as $row2)
        	{
				if($months=="")$months=$row2['REM2']; else $months.=','.$row2['REM2'];
			}
$months=explode(",",$months);
//	print_r($months);
		$sql2="Select * from stu_mnth order by ID ASC";
		foreach ($dbh->query($sql2) as $row2)
        	{
		 $fee=findnm("stu_class",$row2['FLD']," WHERE ID=".$cls."",$dbh);

		if($fee>0) 
		{ 
		
			if(in_array($row2['YR'],$months))
			{$icon='<i class="fa fa-check"></i>'; $green='<p style="color:green">';}else{$icon='<i class="fa fa-times"></i>'; $green='<p>';}
			
			echo '<tr><td>'.$green.$icon.'&nbsp;'.$row2['YR'].'</p></td>';
   	        echo '<td align="right">'.$green.'<i class="fa fa-rupee"></i>&nbsp;'.$fee.'</td>';
		}
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


   
     