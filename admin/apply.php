<?php
include 'inc/header.php';
include 'inc/sidebar2.php';
$fetch = mysql_query("SELECT * FROM applications");
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">Student application Portal</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>apply</h3>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#candidateReg"><i class="fa fa-plus"></i> </a>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped">
						<thead>
							<th>Regno</th>
							<th>Name</th>
							
							<th>Sex</th>
							<th>School</th>
							<th>Department</th>
							<th>Level</th>
							<th>Sch fees Reciept N0</th>
							<th>Hostel Reciept N0</th>
							
							
							<th><i class="fa fa-bars"></i></th>
						</thead>
						<tbody>
							<?php
								while ($row = mysql_fetch_array($fetch)) {
							?>
							<tr>
								<td><?php echo $row['Regno']?></td>
								<td><?php echo $row['Name']?></td>
								
								<td><?php echo $row['Sex']?></td>
								<td><?php echo $row['School']?></td>
								<td><?php echo $row['Dept']?></td>

								<td><?php echo $row['Level']?></td>
								<td><?php echo $row['Sch_Fees_reciept_No']?></td>
								<td><?php echo $row['Hostel_Fees_reciept_NO']?></td>
								









								</tr>
							<div class="modal fade" id="edit<?php echo $row['Regno']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="myModalLabel"><center>EDIT Students ACCOUNT</center></h4>
							      </div>
							         <form method="post" action="#" enctype="multipart/form-data">
									      <div class="modal-body">
									      	<div class="form-group">
									      		<input type="text" name="regno" class="form-control" value="<?php echo $row['Regno']?>" readonly>
									      	</div>
									         <div class="form-group">
									         	<input type="text" name="name" class="form-control" value="<?php echo $row['Name']?>" placeholder="Name">
									         </div>
									        






									         <div class="form-group">
									         	<select name="sex" class="form-control">
									         		<option selected="" disabled="">Select Gender</option>
									         		<option value="Male">Male</option>
									         		<option value="Female">Female</option>
									         	</select>
									         </div>

												<div class="form-group">
									         	<input type="text" name="school" class="form-control" value="<?php echo $row['School']?>" placeholder="School">
									        	 </div>


									         <div class="form-group">
									         	<input type="text" name="dept" class="form-control" value="<?php echo $row['Dept']?>" placeholder="Dept">
									         </div>
									         <div class="form-group">
									         	<input type="text" name="level" class="form-control" value="<?php echo $row['Level']?>" placeholder="Level">
									         </div>

									         	<div class="form-group">
									         	<input type="text" name="sch_fees_reciept_no" class="form-control" value="<?php echo $row['Sch_Fees_reciept_No']?>" placeholder="School fee reciept no">
									         </div>

									         <div class="form-group">
									         	<input type="text" name="hostel_fees_reciept_no" class="form-control" value="<?php echo $row['Hostel_Fees_reciept_NO']?>" placeholder="hostel fees reciept No">
									         </div>

									         	<div class="form-group">
									         	<input type="text" name="password" class="form-control" value="<?php echo $row['Password']?>" placeholder="password">
									         </div>



									      </div>
									      <div class="modal-footer">
									            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									            <button name="update" class="btn btn-success btn-simple"><i class="fa fa-check-square"></i> Update</button>
									      </div>
							         </form>
							         <?php
							         	if (isset($_POST['update'])) {
							         		$regno = $_POST['regno'];
							         		$name = $_POST['name'];
											
											$sex = $_POST['sex'];
											
											$phone = $_POST['School'];
											$dept = $_POST['dept'];
											$level = $_POST['level'];
											//$reg_date =  date("j F Y. h:iA");
											$sch_fees_reciept_no = $_POST['sch_fees_reciept_no'];
											$hostel_fees_reciept_no = $_POST['hostel_fees_reciept_no'];
											$password = $_POST['password'];
							         		$update_row = mysql_query("UPDATE applications SET Name = '$name',Sex='$sex' , School = '$school',Dept='$dept',Level='$level',Sch_Fees_reciept_No='$sch_fees_reciept_no',Hostel_Fees_reciept_NO='$hostel_fees_reciept_no',Password='$password' WHERE Regno = '$regno' ");
							         		if ($update_row) {
							         			echo "<script>alert('Account Updated Succesfully')</script>";
							         			echo "<script>window.open('apply.php','_self')</script>";
							         		}else{
							         			echo "<script>alert('".mysql_error()."')</script>";
							         		}
							         	}
							         ?>
							    </div>
							  </div>
							  </div>

							  <div class="modal fade" regno="delete<?php echo $row['Regno']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
									      <div class="modal-body">
									      Do you want to delete the account of <b><?php echo $row['Regno']?></b>
									        </div>
									      <div class="modal-footer">
									            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									            <a name="update" href="voters_del.php?regno=<?php echo $row['Regno']?>" class="btn btn-danger btn-simple"><i class="fa fa-check-square"></i> Delete</a>
										      </div>
							    </div>
							  </div>
							  </div>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="candidateReg"  name="candidateReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><center>Application Form</center></h4>
      </div>
         <form method="post" action="#" enctype="multipart/form-data">
		      <div class="modal-body">
		         <div class="form-group">
		         	<input type="text" name="regno" class="form-control" placeholder="Regno" required>
		         </div>

<div class="form-group">
		         	<input type="text" name="name" class="form-control" placeholder="Name" required>
		         </div>

		         <div class="form-group">
		         	<select name="sex" class="form-control" required>
		         		<option selected="" disabled="">Select Gender</option>
		         		<option value="Male">Male</option>
		         		<option value="Female">Female</option>
		         	</select>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="school" class="form-control" placeholder="School" required>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="dept" class="form-control" placeholder="Dept" required>
		         </div>


				<div class="form-group">
		         	<input type="text" name="level" class="form-control" placeholder="Level" required>
		         </div>


		         <div class="form-group">
		         	<input type="text" name="sch_fees_reciept_no" class="form-control" placeholder="Sch Fees reciept NO" required>
		         </div>

		         <div class="form-group">
		         	<input type="text" name="hostel_fees_reciept_no" class="form-control" placeholder="Hostel Fees reciept NO" required>
		         </div>


		         	<div class="form-group">
		         	<input type="password" name="password" class="form-control" placeholder="Password" required>
		         </div>


		      </div>
		      <div class="modal-footer">
		            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
		            <button name="submit" class="btn btn-success btn-simple"><i class="fa fa-check-square"></i> Submit</button>
		      </div>
         </form>
    </div>
  </div>
  </div>
<?php
if(isset($_POST["submit"])) {

		$regno = $_POST['regno'];

	$name = $_POST['name'];

	$sex = $_POST['sex'];
	
	$phone = $_POST['School'];
	$dept = $_POST['dept'];
	$level = $_POST['level'];
	//$reg_date =  date("j F Y. h:iA");
	$sch_fees_reciept_no = $_POST['sch_fees_reciept_no'];
	$hostel_fees_reciept_no = $_POST['hostel_fees_reciept_no'];
	$password = $_POST['password'];
	



		        $sql = mysql_query("INSERT INTO applications(Regno,Name ,Sex,School,Dept,Level,Sch_Fees_reciept_No,Hostel_Fees_reciept_NO,Password)VALUES('$regno', '$name','$sex','$school','$dept','$level','$sch_Fees_reciept_no','$hostel_fees_reciept_no','$password')");
			        if ($sql) {
			        	echo "<script>alert('application sucessful!')</script>";
			        	echo "<script>window.open('apply.php','_self')</script>";
			        }else{
			        	echo '<span class="alert alert-danger">'.mysql_error().'Please try again!</span>';
			        }
			    }
include 'inc/footer.php';
?>