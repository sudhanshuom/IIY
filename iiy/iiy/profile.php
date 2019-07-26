<?php include("topheader.php");
		$sql999="SELECT * FROM stu_admin where ID=$adminid";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$ev=$row['NAME'];
							$news=$row['LOCKER1'];
							
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
                <h1 class="h4 text-gray-900 mb-4">Profile</h1>
              </div>
				<div class="row">
					<div class="col-lg-4">
					<form class="user" method="post" action="saveprofile.php" enctype="multipart/form-data">
			 

                <div class="form-group">
    				<label>Name</label>
                  <input type="text" name="ev" class="form-control" value="<?php echo $ev; ?>">
                </div>
                <div class="form-group">
    				<label>Password</label>
                  <input type="password" name="news" class="form-control" value="<?php echo $news; ?>"/>
                </div>
                

                   <input type="submit" value="Update" class="btn btn-primary btn-user btn-block"/>
			</form>	
					</div>
	<!--<div class="col-lg-4">
    </div>
	<div class="col-lg-4">
					<form class="user" method="post" action="saveprofile.php" enctype="multipart/form-data">
			 

                <div class="form-group">
    				<label>Name</label>
                  <input type="text" name="ev" class="form-control" value="<?php echo $ev; ?>">
                </div>
                <div class="form-group">
    				<label>Password</label>
                  <input type="password" name="news" class="form-control" value="<?php echo $news; ?>"/>
                </div>
                

                   <input type="submit" value="Update" class="btn btn-primary btn-user btn-block"/>
			</form>	
					</div>
	</div>-->
        
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
		data:{id:id,tp:"7"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>