<?php include("topheader.php");
if($_GET['eid']!=""){
	$id=cleanTAG($_GET['eid']);
		$sql999="SELECT * FROM stu_hw where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$eid=$row['ID'];
							$ev=$row['HW'];
							$ad=$row['SUB'];
							$ph=$row['CID'];
							$dob=date("d-m-Y",strtotime($row['DOB']));
							
						}
}
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
                <h1 class="h4 text-gray-900 mb-4">Home Work</h1>
              </div>
<form class="user" method="post" action="savehw.php" enctype="multipart/form-data">
<input type="hidden" id="cid" name="cid" value="<?php echo $cid; ?>"/>
       
		<div class="row">
					<div class="col-lg-3">
				   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" hidden="" value="<?php echo $eid; ?>">
	            
 				<div class="form-group">
    				<label>Date</label>
                  <input type="text" readonly="readonly" class="form-control" value="<?php echo date("d-m-Y"); ?>">
                </div>
               
                <div class="form-group">
    				<label>Class</label>
                  <select name="classid" class="form-control cls" >
                    	<option value="">-Class-</option>
						<?php
						createoptions("stu_class ","ID","CLS",$cid,$dbh)
						
						?>
                        
                    </select>
                </div>
                 <?php
		$classids=findnm("stu_class","SUB"," WHERE ID=$cid",$dbh);
		?>  
                <div class="form-group">
    				<label>Subject</label>
                  <select name="subid" class="form-control">
                    	<?php
						createoptions("stu_sub WHERE ID in(".$classids.")  ","ID","SUB",$seleced,$dbh)
						
						?>
                    </select>
                </div>
                <div class="form-group">
    				<label>Homework</label>
                  <input type="text" name="ev" class="form-control" value="<?php echo $ev; ?>">
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
                       <th>Subject</th>
                      <th>Homework</th>
		
					   <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
if($cid!="")
{				  
$sql9="SELECT DISTINCT DATE FROM stu_hw WHERE CID=$cid order by DATE DESC LIMIT 10";
		foreach ($dbh->query($sql9) as $row9){
		echo '<tr><th colspan=4><div align="center">'.date("d-m-Y",strtotime($row9['DATE'])).'</div>';
						
	$sql999="SELECT * FROM stu_hw WHERE CID=$cid AND DATE='".$row9['DATE']."' order by ID DESC";
		foreach ($dbh->query($sql999) as $row){
							
				$sub=findnm("stu_sub","SUB"," WHERE ID=".$row['SUB']."",$dbh);
							echo '<tr><td>'.++$a;
							echo '<td>'.$sub;
							echo '<td >'.$row['HW'];
						
							echo '<td> <a href="?eid='.$row['ID'].'&cid='.$cid.'"><i class="fas fa-user-edit"></i></a> 
							<a class="del" id="'.$row['ID'].'" href="#"><i class="fas fa-trash"></i></a>';
						}
		}
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

$(".cls").change(function(){
	var id=$(this).val();
	window.open("./addhw.php?cid="+id,"_self")
}); 
$(".del").click(function(){
	var id=$(this).attr('id');
var gg=confirm("Are You Sure ? You Are going To Remove this record");
if(gg==false)return false;
	$.ajax({
		url:"action.php",
		data:{id:id,tp:"6"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>