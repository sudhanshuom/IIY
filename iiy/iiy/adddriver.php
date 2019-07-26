<?php include("topheader.php");
if($_GET['eid']!=""){
	$id=cleanTAG($_GET['eid']);
		$sql999="SELECT * FROM stu_driver where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$ev=$row['NM'];
							$ad=$row['AD'];
							$troot=$row['TROOT'];
							$busno=$row['BUSNO'];
							$ph=$row['PH'];
							
						}
}
?>
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
           <div class="col-lg-12" >
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Drivers</h1>
              </div>
				<div class="row">
					<div class="col-lg-3">
					<form class="user" method="post" action="savedriver.php" enctype="multipart/form-data">
			   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" hidden="" value="<?php echo $eid; ?>">
	            

                <div class="form-group">
    				<label>Driver Name</label>
                  <input type="text" name="ev" class="form-control" value="<?php echo $ev; ?>">
                </div>
                <div class="form-group">
    				<label>Address</label>
                  <input type="text" name="adfee" class="form-control" value="<?php echo $ad; ?>">
                </div>
                <div class="form-group">
    				<label>Mobile Number</label>
                  <input type="text" name="readm" class="form-control" value="<?php echo $ph; ?>">
                </div>
                <div class="form-group">
    				<label>Bus No.</label>
                  <input type="text" name="exam" class="form-control" value="<?php echo $busno; ?>">
                </div>
                <div class="form-group">
    				<label>Route No. </label>
                  <input type="text" name="tf" class="form-control" value="<?php echo $troot; ?>">
                </div>

                   <input type="submit" value="Save" class="btn btn-primary btn-user btn-block"/>
			</form>	
					</div>
	<div class="col-lg-9">
	<div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                   	  <th>Name</th>
                      <th>Address</th>
			          <th>Mobile Number</th>
			          <th>Bus No</th>
			          <th>Route No</th>
				       <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				  	$sql999="SELECT * FROM stu_driver";
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
						if($row['IMAGE']=="")$img='no-image.png'; else $img=$row['IMAGE'];
							echo '<td><a href="uploaddr.php?id='.$row['ID'].'"><img src="../uploads/'.$img.'" width=60></a>';		echo '<td>'.$row['NM'];
							echo '<td align="right">'.$row['AD'];
							echo '<td align="right">'.$row['PH'];
							echo '<td align="right">'.$row['BUSNO'];
							echo '<td align="right">'.$row['TROOT'];
							
							echo '<td> <a href="?eid='.$row['ID'].'"><i class="fas fa-user-edit"></i></a> 
							<a class="del" id="'.$row['ID'].'" href="#"><i class="fas fa-trash"></i></a>';
						}

				  ?>
                    
                  </tbody>
                </table>
             </div>
        </div>
 
					</div>
				</div>
			</div>
		</div>
	</div>
        
		 </div>
 <?php include("footer.php");
 ?>  
 <script>

$(".del").click(function(){
	var id=$(this).attr('id');
var gg=confirm("Are You Sure ? You Are going To Remove this record");
if(gg==false)return false;
	$.ajax({
		url:"action.php",
		data:{id:id,tp:"4"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>