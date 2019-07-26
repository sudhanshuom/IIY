<?php require_once './applock.php';

$today=date("Y-m-d");
$url='?stuid='.$_GET['stuid'].'&ps='.$_GET['ps'].'&ses='.$_GET['ses'];
 
?>    <input type="hidden" id="ses" name="ses" value="<?php echo $ses; ?>"/>
       <input type="hidden" id="stuid" name="stuid" value="<?php echo $stuid; ?>"/>
       <input type="hidden" id="ps" name="ps" value="<?php echo $ps; ?>"/>
      
<style>
	i{
		font-size:9px;
		}
</style>
  <body><br>
<br>

  <div class="bg_load"> <p style="text-align:center; margin-top:80px; font-size:20px; font-weight:bold;">Loading</p></div>
<div class="wrapper">
    <div class="inner">
      <span style="font-weight:bold;">Loading</span>
    </div>
     
</div>    
     <br>
      <div class="container">
        	<div align="center" style="color: #ff5722; font-size:18px">Attendance Status
            
            <br>Date: 

<?php echo date("d-m-Y",strtotime($today)); ?>
            </div> <hr> 
    
    <?php
	
	
	
	
	$sql="Select * from stu_att_tech WHERE DATE='$today'";
				foreach ($dbh->query($sql) as $row)
					{
						$att=$row['ATT'];	
						$studentid=$row['STUID'];	
						$stts=$row['STTS'];	
				
					}

		$att=explode(",",$att);	
		$uid=explode(",",$studentid);	
		$stts=explode(",",$stts);	
		
	
	//print_r($stts);
	//print_r($att);
	//print_r($uid);

	//$val=ArrayReplace($stts, 1, 1);
	//print_r($val);
	$today=date("m-d");
	$x=0;
if($studentid!="")
{
	$sql="Select * from stu_teacher WHERE ID IN(".$studentid.") order by ID ASC";

				foreach ($dbh->query($sql) as $row)
					{
					if($att[$x]==2 || $att[$x]==1){
				if($att[$x]==2){$on="On Leave";} else {$on="Absent";}
				
			
	?><div class="row" style="margin:5px;border-bottom:1px #e0e0e0 solid;">
   			<div class="col-xs-3" >
					<?php
						$src=$basicurl.$adminimage;
					?>
			<img src="<?php echo $src ?>" class="img-thumbnail">	
	      </div>
          <div  class="col-xs-6" style=" font-size:12px;">
         
              <div style="text-align:left; font-size:12px; font-weight:bold;color: #ff5722;"><?php echo $row['NM']; ?></div>
              <i class="fa fa-map-marker"></i> <?php echo $row['AD']; ?></h6>
             <br>
     
	 
<i class="fa fa-phone"></i> <a href="tel:<?php echo $row['PH']; ?>"><?php echo $row['PH']; ?></a></h6>
              
		   </div> 
           <div class="col-xs-3" >
				<?php if($stts[$x]==1){ ?>	
				<a style="width:60px; padding:0px" href="getdata.php<?php echo $url; ?>&x=<?php echo $x; ?>&tp=1&id=0" class="button button1">Approved</a>	
				<?php }elseif($stts[$x]==2){ ?>
                
                 <a style="width:60px; padding:0px;background:red" href="getdata.php<?php echo $url; ?>&x=<?php echo $x; ?>&tp=1&id=0"  class="button button1">Rejected</a>	
                 <?php }else{ ?>
               
				<a style="width:60px; padding:0px;background:red" href="getdata.php<?php echo $url; ?>&x=<?php echo $x; ?>&tp=1&id=1" class="button button1">Approve</a>
                <a style="width:60px; padding:0px;background:red" href="getdata.php<?php echo $url; ?>&x=<?php echo $x; ?>&tp=1&id=2"  class="button button1">Reject</a>	
				<?php } ?>	
					
	      </div>
           </div> 
  <?php

				}
				  $x++;
					}
}else {
	
	echo 'No attendence marked for teacher';


}

  ?>       
     
   
   
   
 
   
   
      </div>
   </div>         
      
      

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 
 <script> 
$(".approve").click(function(){
var id=$(this).attr("name");
	var x=$(this).attr("id");
	var ses=$("#ses").val();
	var ps=$("#ps").val();
	var stuid=$("#stuid").val();
		$.ajax({
		url:"getdata.php",
		data:{id:id,tp:"1",ses:ses,stuid:stuid,ps:ps,x:x},
		type:'post',
		cache:false,
			success:function(output){

				//window.open("./viewtatt.php?ses="+ses+"&stuid="+stuid+"&ps="+ps+"&act="+output,"_self")
				window.location.reload();
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


   
     