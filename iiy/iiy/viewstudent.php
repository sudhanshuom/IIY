<?php include("topheader.php");
?><div class="container">
<div class="row">
  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Student's List</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Sr No.</th>
                     <th>Image</th>
                      <th>Student Detail</th>
                      <th>Class</th>
                      <th>Adm No and Date</th>
                      
                     <th>ID & Password</th>
                      <th>Fee</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
if($_POST['srch']!="")
{
	$srch=cleanTAG($_POST['srch']);
	$sql999="SELECT * FROM stu_info WHERE NM LIKE '%".$srch."%' OR FNM LIKE '%".$srch."%' OR MNM LIKE '%".$srch."%' OR MB LIKE '%".$srch."%'";

}else{
	$sql999="SELECT * FROM stu_info limit 10";
}
//echo $sql999;
				    foreach ($dbh->query($sql999) as $row){
							echo '<tr><td>'.++$a;
						if($row['IMAGE']=="")$img='no-image.png'; else $img=$row['IMAGE'];
							echo '<td><a href="upload.php?id='.$row['ID'].'"><img src="../uploads/'.$img.'" width=60></a>';
							echo '<td>'.$row['NM'];
							echo '/ '.$row['FNM'];
							echo '/ '.$row['MNM'];
							echo ', '.$row['AD'];
							echo ', '.$row['MB'];
							echo '<br>DOB: '.$row['DOB'];
				$cls=findnm("stu_class","CLS"," WHERE ID=".$row['CLS']."",$dbh);
				
							echo '<td>'.$cls;
							echo '<br>RollNo:'.$row['ROLLNO'];
							echo '<td>'.$row['ADMNO'];
							echo '<br>'.$row['ADMDATE'];
							echo '<td>'.$row['ID'].'<br>'.$row['PASS1'];
						
							$endmnth=date("M-Y");
							$bal=getBalance($row['ID'],$endmnth,$dbh);
							
							echo '<td>'.$bal;
							
							echo '<br><a href="payfee.php?user='.$row['ID'].'">PayNow</a>';	
							echo '<td> <a href="addstudent.php?eid='.$row['ID'].'"><i class="fas fa-user-edit"></i></a>'; 
			//				<a class="del" id="'.$row['ID'].'" href="#"><i class="fas fa-trash"></i></a>';
						
							
						}

				  ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

 <?php include("footer.php");
 ?>  
 <script>

$(".del").click(function(){
	var id=$(this).attr('id');
var gg=confirm("Are You Sure ? You Are going To Remove this record");
if(gg==false)return false;
	$.ajax({
		url:"action.php",
		data:{id:id,tp:"1"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>
