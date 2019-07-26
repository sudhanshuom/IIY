<?php include("topheader.php");
if($_GET['eid']!=""){
	$id=cleanTAG($_GET['eid']);
		$sql999="SELECT * FROM stu_calendar where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$dt=date("d-m-Y",strtotime($row['DATE']));
							$ev=$row['NM'];
							$tp=$row['HOLY'];
							if($tp=='Holiday') $tpsel1="selected"; else $tpsel2="selected";	
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
                <h1 class="h4 text-gray-900 mb-4">Calendar</h1>
              </div>
				<div class="row">
					<div class="col-lg-4">
					<form class="user" method="post" action="savecalendar.php" enctype="multipart/form-data">
			   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" hidden="" value="<?php echo $eid; ?>">
	               <div class="form-group">
					<label>Date</label>
                  <input type="text" name="dt" class="form-control"  placeholder="dd-mm-yyyy" value="<?php echo $dt; ?>">
                </div>

                <div class="form-group">
    				<label>Event</label>
                  <input type="text" name="ev" class="form-control" value="<?php echo $ev; ?>">
                </div>

                <div class="form-group">
    				<label>Type</label>
		
                  <select name="tp" class="form-control">
					<option value="Holiday" <?php  echo $tpsel1; ?>>Holiday</option>
					<option value="Event" <?php  echo $tpsel2; ?>>Workingday</option>
				  </select>
						
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
                      <th>Date</th>
                      <th>Event</th>
                      <th>Status</th>

                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				  	$sql999="SELECT * FROM stu_calendar";
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
							echo '<td>'.date("d-m-Y",strtotime($row['DATE']));
							echo '<td>'.$row['NM'];
							echo '<td>'.$row['HOLY'];

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
		data:{id:id,tp:"2"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>