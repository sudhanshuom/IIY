<?php include("topheader.php");
	$cid=cleanTAG($_GET['cid']);
?>
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
           <div class="col-lg-12" >
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Album Photo</h1>
                
              </div>
				<div class="row">
					<div class="col-lg-4">
                    <?php echo $_SESSION['errors'];  unset($_SESSION['errors']);?>
					<form class="user" method="post" action="savegallery.php" enctype="multipart/form-data">
			   <input type="text" name="cid" class="form-control form-control-user" id="exampleFirstName" hidden="" value="<?php echo $cid; ?>">
	            

                <div class="form-group">
    				<label>Select Album</label>
                  <select name="ev" class="form-control">
                   <?php 
				  createoptions("stu_gallerycat","ID","ALB",$cid,$dbh)
				   
				    ?>
                  </select>	
                </div>
                <div class="form-group">
    				<label>File (pdf, jpg, png only)</label>
                    <input type="file" name="photoimg" class="form-control" id="im" style="display:none"><br />

                    <label for="im" class="btn btn-success">Choose File</label>
                </div>
                

                   <input type="submit" value="Save" class="btn btn-primary btn-user btn-block"/>
			</form>	
					</div>
	<div class="col-lg-8">
	<div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                       <th>Photo</th>
					   <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				  	$sql999="SELECT * FROM stu_gallery WHERE CID=$cid";
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
							
							echo '<td><img src="../download/'.$row['IMAGE'].'" class="img-thumbnail">';
	
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
		data:{id:id,tp:"12"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>