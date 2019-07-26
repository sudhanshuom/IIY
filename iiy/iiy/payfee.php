<?php include("topheader.php");
if($_GET['user']!=""){
	$id=cleanTAG($_GET['user']);
		$sql999="SELECT * FROM stu_info where ID=$id";
				    foreach ($dbh->query($sql999) as $row){
							$stuid=$row['ID'];
							$studentClass=$row['CLS'];
							
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
                <h1 class="h4 text-gray-900 mb-4">Pay Fee</h1>
              </div>
              
              <?php
 $paidmonth="";
	$sql999="SELECT * FROM stu_paid_fee WHERE SID=$stuid order by ID ASC";
	foreach ($dbh->query($sql999) as $row)
		{
			if($paidmonth=="")$paidmonth=$row['REM2']; else $paidmonth.=','.$row['REM2'];
			$paidsum+=$row['AMT'];
			$paidpayable+=$row['PAYBL'];
		}
	//$paidmonth=array("Admission Fee","Apr-2019","May-2019");
	$paidmonth=explode(",",$paidmonth);
	
	$oldbalance=$paidpayable-$paidsum;
	if($oldbalance!=0)$old='Old Balance'; else $old="Select Month(s)";		  
			  ?>
				<div class="row">
					<div class="col-lg-4">
					<form class="user" method="post" action="savepayfee.php" enctype="multipart/form-data">
			   <input type="text" name="eid" class="form-control form-control-user" id="exampleFirstName" hidden="" value="<?php echo $eid; ?>">
	            
  
    				
   
   <input type="hidden" name="amounts" id="amounts" class="form-control">
  <input type="hidden" name="stuid" value="<?php echo $stuid; ?>" class="form-control">
  
               <div class="form-group">
    				<label>Months</label>
                 <input type="hidden" name="months" value="<?php echo $old; ?>" id="months" class="form-control">
          <?php if($oldbalance!=0){ ?>
                 <input type="checkbox" value="<?php echo $oldbalance; ?>" style="display:none" checked="checked" class="feetype" alt="<?php echo $old; ?>" id="months" class="form-control">
                <?php   } ?>
                 <div id="monthslist" style="color:#F00"><?php echo $old; ?></div>
                </div>
               
                <div class="form-group">
    				<label>Old Balance</label>
                  <input type="text" readonly="readonly" name="oldbalance" id="oldbalance" class="form-control" value="<?php echo $oldbalance; ?>">
                </div>     
                
              	<div class="form-group">
    				<label>Amount</label>
                  <input type="text" readonly="readonly" name="amountsum" id="amountsum" class="form-control" value="0">
                </div>  
                <div class="form-group">
    				<label>Payable Amount</label>
                  <input type="text" readonly="readonly" name="payableamount" id="payableamount" class="form-control" value="<?php echo $oldbalance; ?>">
                </div>     
                <div class="form-group">
    				<label>Cash Deposit</label>
                  <input type="text" name="cash" class="form-control" value="<?php echo $ev; ?>">
                </div>
                 <div class="form-group">
    				<label>Remarks</label>
                  <input type="text" name="rem" class="form-control" value="<?php echo $rem; ?>">
                </div>
               <div class="form-group">
    				<label>Date</label>
                  <input type="text" name="dt" class="form-control" value="<?php echo date("d-m-Y"); ?>">
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
                      <th>Subject</th>
				     </tr>
                  </thead>
                  <tbody>
                  
                  <?php
			  
				  
				  	$sql999="SELECT * FROM stu_mnth order by ID ASC";
				    foreach ($dbh->query($sql999) as $row){
					$tfee=findnm("stu_class",$row['FLD']," WHERE ID=".$studentClass."",$dbh);
						if($tfee>0)
						{
							echo '<tr><td>';
						if(in_array($row['YR'],$paidmonth))
						{				
							echo '<i class="fa fa-check"></i> '.$tfee;    
						}else{
						echo '<input type="checkbox" value="'.$tfee.'"  alt="'.$row['YR'].'" id="chk'.$row['ID'].'" onclick="addfee('.$tfee.')" class="feetype"><label for="chk'.$row['ID'].'"> '.$tfee;

							}
							echo '<td><label for="chk'.$row['ID'].'">'.$row['YR'].'</label>';
						
							
						}
						}

				  ?>
                    
                  </tbody>
                </table>
             </div>
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
                      <th>Date</th>
                      <th>Fee Details</th>
                      <th>Payable Amount</th>
                      <th>Paid Amount</th>
                      <th>Remarks</th>
                      <th>Action</th>
				     </tr>
                  </thead>
                  <tbody>
                  
                  <?php
			  
				  
				  	$sql999="SELECT * FROM stu_paid_fee WHERE SID=$stuid order by ID ASC";
				    foreach ($dbh->query($sql999) as $row){
					echo '<tr>';
					echo '<td>'.date("d-m-Y",strtotime($row['DATE1']));
					echo '<td>'.$row['REM2'];
					echo '<td align="right">'.$row['PAYBL'];
					echo '<td align="right">'.$row['AMT'];
					echo '<td>'.$row['REM'];
					$totp+=$row['PAYBL'];
					$totpaid+=$row['AMT'];
					
					echo '<td>';
					// <a href="?eid='.$row['ID'].'"><i class="fas fa-user-edit"></i></a> ';
					echo '<a class="del" id="'.$row['ID'].'" href="#"><i class="fas fa-trash"></i></a>';	
						}
$totbal=$totp-$totpaid;
	echo '<tr><td><td><td align="right">'.$totp.'<td align="right">'.$totpaid.'<td colspan="2">Balance: '.$totbal;
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
function addfee(fee)
{
	var amt= $('input:checkbox:checked.feetype').map(function () {
  	return this.value;
}).get();	
var cap= $('input:checkbox:checked.feetype').map(function () {
  return this.alt;
}).get() 
//	alert(amt)
	$("#months").val(cap);	
	$("#monthslist").text(cap);	
	$("#amounts").val(amt);	
		sum();
}



function sum() {
      sumofnums = 0;
      nums = document.getElementById("amounts").value.split(",");
      for (i = 0; i < nums.length; i++) {
        sumofnums += parseInt(nums[i]);
      }
	 
       var oldbal=document.getElementById("oldbalance").value;
     	var totalsum=parseInt(sumofnums)-parseInt(oldbal);
		 document.getElementById("payableamount").value = sumofnums;
     	document.getElementById("amountsum").value = totalsum;
	  
    }






$(".del").click(function(){
	var id=$(this).attr('id');
var gg=confirm("Are You Sure ? You Are going To Remove this record");
if(gg==false)return false;
	$.ajax({
		url:"action.php",
		data:{id:id,tp:"9"},
		type:'post',
		cache:false,
			success:function(output){
		window.location.reload();
			}


		});

});
</script>