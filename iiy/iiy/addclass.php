<?php include("topheader.php");
$sub=array();
if($_GET['eid']!=""){
	$id=cleanTAG($_GET['eid']);
		$sql999="SELECT * FROM stu_class where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$dt=date("d-m-Y",strtotime($row['DATE']));
							$ev=$row['CLS'];
							$adfee=$row['ADFEE'];
							$adfeed=$row['ADFEED'];
							$readm=$row['READM'];
							$exam=$row['EXAM'];
							$tf=$row['TF'];
							$sub=explode(",",$row['SUB']);
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
                <h1 class="h4 text-gray-900 mb-4">Classes</h1>
              </div>
				<div class="row">
					<div class="col-lg-3">
					<form class="user" method="post" action="saveclass.php" enctype="multipart/form-data">
			   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" hidden="" value="<?php echo $eid; ?>">
	            

                <div class="form-group">
    				<label>Class</label>
                  <input type="text" name="ev" class="form-control" value="<?php echo $ev; ?>">
                </div>
                <div class="form-group">
    				<label>Admission Fee</label>
                  <input type="text" name="adfee" class="form-control" value="<?php echo $adfee; ?>">
                </div>
                <div class="form-group">
    				<label>Annual Charges</label>
                  <input type="text" name="readm" class="form-control" value="<?php echo $readm; ?>">
                </div>
                <div class="form-group">
    				<label>Exam Fee</label>
                  <input type="text" name="exam" class="form-control" value="<?php echo $exam; ?>">
                </div>
                <div class="form-group">
    				<label>Monthly Fee</label>
                  <input type="text" name="tf" class="form-control" value="<?php echo $tf; ?>">
                </div>
                  <div class="form-group">
    				<label>Class Subjects</label>
                  <?php
				  $sql999="SELECT * FROM stu_sub";
				    foreach ($dbh->query($sql999) as $row){
			if(in_array($row['ID'],$sub))
			echo '<br><input type="checkbox" checked id="'.$row['ID'].'" class="sub" onclick="addsub()" name="sub[]" value="'.$row['ID'].'"><label for="'.$row['ID'].'">'.$row['SUB'].'</label>';
	else			
			echo '<br><input type="checkbox" id="'.$row['ID'].'" class="sub" onclick="addsub()" name="sub[]" value="'.$row['ID'].'"><label for="'.$row['ID'].'">'.$row['SUB'].'</label>';
					}
					?>
                </div>
<input type="hidden" name="sub" id="subjects"/>
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
                       <th>Class</th>
                      <th>Adm. Fee</th>
			          <th>Annual Fee</th>
			          <th>Exam Fee</th>
			          <th>Monthly Fee</th>
			          <th>Subjects</th>
					   <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				  	$sql999="SELECT * FROM stu_class";
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
							echo '<td>'.$row['CLS'];
							echo '<td align="right">'.$row['ADFEE'];
							echo '<td align="right">'.$row['READM'];
							echo '<td align="right">'.$row['EXAM'];
							echo '<td align="right">'.$row['TF'];

					$arr=explode(",",$row['SUB']);
					$sub="";
					for($x=0;$x<count($arr);$x++)
					{
						if($sub=="")
						$sub=findnm("stu_sub","SUB"," WHERE ID=".$arr[$x]."",$dbh);
						else
						$sub.=','.findnm("stu_sub","SUB"," WHERE ID=".$arr[$x]."",$dbh);
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
		data:{id:id,tp:"3"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>