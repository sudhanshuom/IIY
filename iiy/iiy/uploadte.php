<?php include("topheader.php");
if($_GET['id']!=""){
	$id=cleanTAG($_GET['id']);
		$sql999="SELECT * FROM stu_teacher where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$nm=$row['NM'];
						//	$img=$row['IMAGE'];
						if($row['IMAGE']=="")$img='no-image.png'; else $img=$row['IMAGE'];	
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
                <h1 class="h4 text-gray-900 mb-4">Teacher->Change Image for <?php echo $nm; ?></h1>
                
              </div>
				<div class="row">
					<div class="col-lg-4">
                    <?php echo $_SESSION['errors'];  unset($_SESSION['errors']);?>
					<form class="user" method="post" action="saveuploadte.php" enctype="multipart/form-data">
			   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" hidden="" value="<?php echo $eid; ?>">
	            

                
                <div class="form-group">
    				<label>File (jpg, png only)</label>
                    <input type="file" name="photoimg" class="form-control" id="im" style="display:none"><br />

                    <label for="im" class="btn btn-success">Choose File</label>
                </div>
                

                   <input type="submit" value="Save" class="btn btn-primary btn-user btn-block"/>
			</form>	
					</div>
	<div class="col-lg-8">
	           <img src="../uploads/<?php echo $img; ?>" class="img-responsive col-lg-8" />
               
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
		data:{id:id,tp:"10"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>