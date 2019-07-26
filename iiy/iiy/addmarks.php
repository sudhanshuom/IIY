<?php include("topheader.php");
 $cls=cleanTAG($_GET['cid']);
 $tp=cleanTAG($_GET['tp']);
 $sub=cleanTAG($_GET['sub']);
 $dt1=date("Y-m-d");
 if($cls>0){
	 $subids=findnm("stu_class","SUB"," WHERE ID=$cls",$dbh);
 }
 if($sub>0){
	 $subnm=findnm("stu_sub","SUB"," WHERE ID=$sub",$dbh);
 }
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
                <h1 class="h4 text-gray-900 mb-4">Report Card</h1>
              </div>
				<div class="row">
					<div class="col-lg-12">
	<form class="user" method="post" action="savemarks.php" enctype="multipart/form-data">
				<div class="row">
			  	
 <input type="hidden" readonly name="eid" class="form-control" value="<?php echo $eid; ?>">
  <input type="hidden" readonly name="cls" id="cls" class="form-control" value="<?php echo $cls; ?>">
  <input type="hidden" readonly name="tp" id="tp" class="form-control" value="<?php echo $tp; ?>">
   <input type="hidden" readonly name="sub" id="sub" class="form-control" value="<?php echo $sub; ?>">
                  
                  <div class="form-group col-md-3	">
    				<label>Class</label>
                  <select name="examclass" class="form-control cls">
                  <option value="" selected="selected"></option>
				     <?php
					createoptions("stu_class","ID","CLS",$cls,$dbh);
					?>
                    </select>
                </div> 
       <div class="form-group col-md-3">
    				<label>Subject</label>
                  <select name="examsub" class="form-control sub">
                  <option value="" selected="selected"></option>
				     <?php
					createoptions("stu_sub WHERE ID IN(".$subids.")","ID","SUB",$sub,$dbh);
					?>
                    </select>
                </div> 
                <div class="form-group col-md-2">
    				<label>Exam Type
                    </label>
                  <select name="examtp" class="form-control tp">
                	<?php
					$arr=array("","Daily Marks","Term 1 Marks","Term 2 Marks");
					for($x=0;$x<count($arr);$x++)
					{
					if($x==$tp)
						echo '<option value="'.$x.'" selected>'.$arr[$x].'</option>';	
					else
						echo '<option value="'.$x.'">'.$arr[$x].'</option>';	
						
					}
					?>
                    </select>
                </div>
   			<?php 
			$cols='col-md-4';
			if($tp==1){ ?>
                <div class="form-group col-md-2">
    				<label>Daily Marks Date</label>
                    <input type="text" name="dt" placeholder="dd-mm-yyyy" class="form-control" value="<?php echo $dt; ?>">
  
                </div> 
   			<?php 
			$cols='col-md-2';
			} ?>

                <div class="form-group <?php echo $cols; ?>">
    				<label>Max.Marks</label>
                    <input type="text" name="mm" id="mm" class="form-control" value="">
  
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
			          <th>Marks for <?php echo $subnm; ?></th>
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
		
	$dt=date("Y-m-d");	
			if($cls>0 && $tp>0 && $sub>0)
			{
			if($tp==1) $dailyQRY=" AND DATE='".$dt."'";
			$qq=" WHERE SID=".$row['ID']." AND SUBID=".$sub." AND EXAMTP=".$tp."".$dailyQRY;
			$found=findnm("stu_dmarks","ID",$qq,$dbh);
			
			if($found==""){
				$dbh->exec("INSERT INTO stu_dmarks(SID,DATE,SUBID,EXAMTP) VALUES ('".$row['ID']."','$dt','$sub','$tp')");
			}
			$marks=findnm("stu_dmarks","OBM",$qq,$dbh);
			$mm=findnm("stu_dmarks","TOTM",$qq,$dbh);
		
			}
			
			echo '<td>';
			echo '<input type="text" size=2 name="marks[]" value="'.$marks.'" class="form-control"/>';
					
							
					}
						}


				  ?>
                    
                  </tbody>
                </table>
                
     <input type="submit" value="Save Marks" class="btn btn-primary btn-user btn-block col-md-2"/>
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
 $("#mm").val(<?php echo $mm; ?>);	
<?php if($_GET['p']>0) {?>	
alert("Marks Updated successfully");   
<?php } ?>	
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

		window.open("addmarks.php?cid="+id,"_self");

});
$(".tp").change(function(){
	var id=$(this).val();
	var cls=$("#cls").val();
	var sub=$("#sub").val();
	window.open("addmarks.php?cid="+cls+"&tp="+id+"&sub="+sub,"_self");
});
$(".sub").change(function(){
	var id=$(this).val();
	var cls=$("#cls").val();
	var tp=$("#tp").val();
	window.open("addmarks.php?cid="+cls+"&tp="+tp+"&sub="+id,"_self");
});
</script>