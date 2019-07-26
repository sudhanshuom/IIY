<?php include("topheader.php");
 $cls=cleanTAG($_GET['cid']);
 $dt1=date("Y-m-d");
 if($cls>0)$eid=findnm("stu_attendence","ID"," WHERE DATE='".$dt1."' AND CID=$cls",$dbh);
 $dt=date("d-m-Y");
?>
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
           <div class="col-lg-12" >
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Attendance</h1>
              </div>
				<div class="row">
					<div class="col-lg-12">
	<form class="user" method="post" action="saveattendance.php" enctype="multipart/form-data">
				<div class="row">
			  <div class="form-group col-md-6">
    				<label>Date</label>
                  <input type="text" readonly name="dt" class="form-control" value="<?php echo $dt; ?>">  <input type="hidden" readonly name="eid" class="form-control" value="<?php echo $eid; ?>">
                   
                </div>
                <div class="form-group col-md-6">
    				<label>Class</label>
                  <select name="class" class="form-control cls">
                    <?php
					createoptions("stu_class","ID","CLS",$cls,$dbh);
					?>
                    </select>
                </div>
   
	</div>
    		
					</div>

	<div class="col-lg-12">
	<div class="card shadow mb-4">
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                       <th>Roll No</th>
                      <th>Name</th>
			          <th>Father Name</th>
			          <th>Attendance</th>
			        </tr>
                  </thead>
                  <tbody>
                  <?php
				 
	if($cls!="")
	{
		$sql999="SELECT * FROM stu_info where CLS=$cls";
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
							echo '<input type="hidden" value="'.$row['ID'].'" name="ids[]">';
							echo '<td>'.$row['ROLLNO'];
							echo '<td>'.$row['NM'];
							echo '<td>'.$row['FNM'];
		
		$sid=findnm("stu_attendence","STUID"," WHERE DATE='".$dt1."' AND CID=$cls",$dbh);
		$att=findnm("stu_attendence","ATT"," WHERE DATE='".$dt1."' AND CID=$cls",$dbh);
		$att=explode(",",$att);
		$sid=explode(",",$sid);
		
		$key=array_search($row['ID'],$sid);
								echo '<td>';
				$arr=array("Present","Absent","Leave");
			echo '<select name="att[]" class="form-control">';
					for($x=0;$x<count($arr);$x++)
					{
					if($att[$key]==$x)
					echo '<option value="'.$x.'" selected>'.$arr[$x].'</option>';	
					else
					echo '<option value="'.$x.'">'.$arr[$x].'</option>';	
						
					}
			echo '</select>';
					
							
					}
						}


				  ?>
                    
                  </tbody>
                </table>
     <input type="submit" value="Take Attendance" class="btn btn-primary btn-user btn-block col-md-2"/>
			</form>	
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

$(".cls").change(function(){
	var id=$(this).val();
		window.open("addattendance.php?cid="+id,"_self");

});
</script>