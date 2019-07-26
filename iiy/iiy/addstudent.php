<?php include("topheader.php");
//if($_GET['eid']!=""){
	$eid=cleanTAG($_GET['eid']);
$sql999="SELECT * FROM stu_info where ID=$eid";
				    foreach ($dbh->query($sql999) as $row){
							$nm=$row['NM'];
							$fnm=$row['FNM'];
							$mnm=$row['MNM'];
							$class=$row['CLS'];
							$rno=$row['ROLLNO'];
							$dob=$row['DOB'];
							$ano=$row['ADMNO'];
							$adt=$row['ADMDATE'];
							$tf=$row['TF'];
							$dtf=$row['DTF'];
							$ad=$row['AD'];
							$gender=$row['GENDER'];
							$pno=$row['MB'];
						}
//}
?>
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
           <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="post" action="savestu.php" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="stunm" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" value="<?php echo $nm; ?>">
                    <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" placeholder="Student Name" hidden="" value="<?php echo $eid; ?>">
                  </div>
                  
                  <div class="col-sm-6">
                    <input type="text" name="fnm" class="form-control form-control-user" id="exampleLastName" placeholder="Father Name" value="<?php echo $fnm; ?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="mnm" class="form-control form-control-user" id="exampleFirstName" placeholder="Mother Name" value="<?php echo $mnm; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="class" class="form-control form-control-user" id="exampleLastName" placeholder="Class" value="<?php echo $class; ?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="rno" class="form-control form-control-user" id="exampleFirstName" placeholder="Roll No" value="<?php echo $rno; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="dob" class="form-control form-control-user" id="exampleLastName" placeholder="Date Of Birth" value="<?php echo $dob; ?>">
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="ano" class="form-control form-control-user" id="exampleFirstName" placeholder="Admission Number" value="<?php echo $ano; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="adt" class="form-control form-control-user" id="exampleLastName" placeholder="Admission Date" value="<?php echo $adt; ?>">
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="tf" class="form-control form-control-user" id="exampleFirstName" placeholder="TF" value="<?php echo $tf; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="dtf" class="form-control form-control-user" id="exampleLastName" placeholder="DTF" value="<?php echo $dtf; ?>">
                  </div>
                </div>
            	
                           
                <div class="form-group">
                  <input type="text" name="ad" class="form-control form-control-user" id="exampleInputEmail" placeholder="Address" value="<?php echo $ad; ?>">
                </div>

                
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="gender" class="form-control form-control-user" id="exampleFirstName" placeholder="Gender" value="<?php echo $gender; ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="pno" class="form-control form-control-user" id="exampleLastName" placeholder="Phone" value="<?php echo $pno; ?>">
                  </div>
                </div>
                 
                
                
                
                <input type="submit" value="Save" class="btn btn-primary btn-user btn-block"/>
                  
               
            </div>
          </div>
        </div>
      </div>
    </div>

 <?php include("footer.php");
 ?>  