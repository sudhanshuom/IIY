<?php include("topheader.php");
$sub=array();
if($_GET['eid']!=""){
	$id=cleanTAG($_GET['eid']);
		$sql999="SELECT * FROM stu_teacher where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$ev=$row['NM'];
							$ad=$row['AD'];
							$ph=$row['PH'];
							$eml=$row['EML'];
							$dob=date("d-m-Y",strtotime($row['DOB']));
							$des=$row['DES'];
							$quali=$row['QUALI'];
							$sub=$row['SUB'];
							$gender=$row['GENDER'];
							$pass1=$row['PASS1'];
							$tp=$row['TP'];
							$sub=explode(",",$row['CLASSES']);
							
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
                <h1 class="h4 text-gray-900 mb-4">Teachers</h1>
              </div>
						<form class="user" method="post" action="saveteacher.php" enctype="multipart/form-data">
		<div class="row">
					<div class="col-lg-4">
				   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" hidden="" value="<?php echo $eid; ?>">
	            

                <div class="form-group">
    				<label>Teacher Name</label>
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
    				<label>Email</label>
                  <input type="text" name="exam" class="form-control" value="<?php echo $eml; ?>">
                </div>
				
				</div>
				<div class="col-lg-4">
                <div class="form-group">
    				<label>Qualification</label>
                  <input type="text" name="tf" class="form-control" value="<?php echo $quali; ?>">
                </div>
				
		
                <div class="form-group">
    				<label>Designation</label>
                  <input type="text" name="des" class="form-control" value="<?php echo $des; ?>">
                </div>
				
						
                <div class="form-group">
    				<label>Subject</label>
                  <input type="text" name="sub" class="form-control" value="<?php echo $sub; ?>">
                </div>
				
                <div class="form-group">
    				<label>Date of Birth</label>
                  <input type="text" name="dob" class="form-control" value="<?php echo $dob; ?>">
                </div>
				</div>
				<div class="col-lg-4">
                <div class="form-group">
    				<label>Gender</label>
                  <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                </div>
                <div class="form-group">
    				<label>Password</label>
                  <input type="text" name="pass" class="form-control" value="<?php echo $pass1; ?>">
                </div>
                <div class="form-group">
    				<label>Type</label>
				<?php $arr=array("Admin","Principal","Staff"); 
					?>
                  <select name="tp" class="form-control">
					<?php 
					for($x=0;$x<count($arr);$x++)
					{
						if($tp==$x)
							echo '<option value="'.$x.'" selected>'.$arr[$x].'</option>';							
						else
							echo '<option value="'.$x.'">'.$arr[$x].'</option>';							
					}
					
					
					?>
				  </select>
                </div>
  <div class="form-group">
    				<label>Classes</label><br />
                  <?php
				  $sql999="SELECT * FROM stu_class";
				    foreach ($dbh->query($sql999) as $row){
			if(in_array($row['ID'],$sub))
			echo '<input type="checkbox" checked id="'.$row['ID'].'" class="sub" onclick="addsub()" name="sub[]" value="'.$row['ID'].'"><label for="'.$row['ID'].'">'.$row['CLS'].'</label> ';
	else			
			echo '<input type="checkbox" id="'.$row['ID'].'" class="sub" onclick="addsub()" name="sub[]" value="'.$row['ID'].'"><label for="'.$row['ID'].'">'.$row['CLS'].'</label> ';
					}
					?>
                </div>
<input type="hidden" name="classes" id="subjects" value="<?php echo implode(",",$sub); ?>"/>
                   <input type="submit" value="Save" class="btn btn-primary btn-user btn-block"/>
			</form>	
					</div>
	<div class="col-lg-12"><br />
<br />

	<div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                       <th>Image</th>
                    	 <th>Roll<br />User ID & Password</th>
                 <th>Name</th>
                      <th>Address</th>
			          <th>Email</th>
			          <th>Quali.</th>
					   <th>Des</th>
					   <th>Sub</th>
					   <th>DOB</th>
					   <th>Gender</th>
					   <th>Subjects</th>
					   <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				  	$sql999="SELECT * FROM stu_teacher";
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
				if($row['IMAGE']=="")$img='no-image.png'; else $img=$row['IMAGE'];
							echo '<td><a href="uploadte.php?id='.$row['ID'].'"><img src="../uploads/'.$img.'" width=60></a>';
							echo '<td align="right">'.$row['TP'].'<br>'.$row['ID'].'<br>'.$row['PASS1'];

							echo '<td>'.$row['NM'];
							echo '<td align="left">'.$row['AD'];
							echo ',	 '.$row['PH'];
							echo '<td >'.$row['EML'];
							echo '<td >'.$row['QUALI'];
							echo '<td >'.$row['DES'];
							echo '<td >'.$row['SUB'];
							echo '<td >'.$row['DOB'];
							echo '<td >'.$row['GENDER'];
						$arr=explode(",",$row['CLASSES']);
					$sub="";
					for($x=0;$x<count($arr);$x++)
					{
						if($sub=="")
						$sub=findnm("stu_class","CLS"," WHERE ID=".$arr[$x]."",$dbh);
						else
						$sub.=','.findnm("stu_class","CLS"," WHERE ID=".$arr[$x]."",$dbh);
					}
							echo '<td align="right">'.$sub;
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
function addsub()
{

var cap= $('input:checkbox:checked.sub').map(function () {
  return this.value;
}).get() 
//	alert(amt)
	$("#subjects").val(cap);	
	
		
}
$(".del").click(function(){
	var id=$(this).attr('id');
var gg=confirm("Are You Sure ? You Are going To Remove this record");
if(gg==false)return false;
	$.ajax({
		url:"action.php",
		data:{id:id,tp:"5"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>