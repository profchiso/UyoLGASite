<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include('inc/config.php');
$fetch = mysql_query("SELECT * FROM  applications");
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">Indigene Registration Portal</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					
					<!--<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#candidateReg"><i class="fa fa-plus</i> </a>-->
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped">
						<!--<thead>
							<th>Regno</th>
							<th>Name</th>
							
							<th>Sex</th>

							
							<th>Department</th>
							<th>Level</th>
							
							<th>Room</th>
							<th>Bed No</th>
							
							<th><i class="fa fa-bars"></i></th>
						</thead>-->
						<tbody>
							<?php
								while ($row = mysql_fetch_array($fetch)) {
							?>
							<tr>
								<td><?php echo $row['Regno']?></td>
								<td><?php echo $row['Name']?></td>
								
								<td><?php echo $row['Sex']?></td>
								<td><?php echo $row['Dept']?></td>

								<td><?php echo $row['Level']?></td>
								<td><?php echo $row['Room']?></td>
								<td><?php echo $row['Bed_No']?></td>
									





								<!--<td><a data-toggle="modal" data-target="#edit<?php// echo $row['Regno']?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a><a data-toggle="modal" data-target="#delete<?php //echo $row['Regno']?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>-->
							</tr>
							<div class="modal fade" id="edit<?php echo $row['Regno']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							        <h4 class="modal-title" id="myModalLabel"><center>allocate room to student</center></h4>
							      </div>
							         <form method="post" action="#" enctype="multipart/form-data">
									      <div class="modal-body">
									      	<div class="form-group">
									      		<input type="text" name="regno" class="form-control" value="<?php echo $row['Regno']?>" readonly>
									      	</div>
									         <div class="form-group">
									         	<input type="text" name="name" class="form-control" value="<?php echo $row['Name']?>" placeholder="Name">
									         </div>
									        <!--<div class="form-group">
									         	<input type="text" name="staff_num" class="form-control" value="<?php//echo $row['Regno']?>" placeholder="Regno">
									         </div> -->







									         <div class="form-group">
									         	<select name="sex" class="form-control" value="<?php echo $row['Sex']?>">
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


									         <div class="form-group">
									         	<input type="text" name="room" class="form-control" value="<?php echo $row['Room']?>" placeholder="room">
									         </div>

									           <div class="form-group">
									         	<input type="text" name="bed_no" class="form-control"value="<?php echo $row['Bed_No']?>"  placeholder="bed no">
									         </div>

									      </div>
									      <div class="modal-footer">
									            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									            <button name="update" class="btn btn-success btn-simple" data-target="#edit"><i class="fa fa-check-square"></i> allocate</button>
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
											$room=$_POST['room'];
											$bed_no=$_POST['bed_no'];

							         		$update_row = mysql_query("UPDATE applications SET Name = '$name',Sex='$sex' , School = '$school',Dept='$dept',Level='$level',Sch_Fees_reciept_No='$sch_fees_reciept_no',Hostel_Fees_reciept_NO='$hostel_fees_reciept_no',Password='$password',Room='$room',Bed_No='$bed_no' WHERE Regno = '$regno' ");
							         		if ($update_row) {
							         			echo "<script>alert('allocation  Succesful')</script>";
							         			echo "<script>window.open('apply_allocate.php','_self')</script>";
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
	<div class="modal fade" id="candidateReg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><center>ADD NEW Student</center></h4>
      </div>
         <form method="post" action="#" enctype="multipart/form-data">
		      <div class="modal-body">
		         <div class="form-group">
		         	<input type="text" name="regno" class="form-control" placeholder="Regno">
		         </div>

<div class="form-group">
		         	<input type="text" name="name" class="form-control" placeholder="Name">
		         </div>

		         <div class="form-group">
		         	<select name="sex" class="form-control">
		         		<option selected="" disabled="">Select Gender</option>
		         		<option value="Male">Male</option>
		         		<option value="Female">Female</option>
		         	</select>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="school" class="form-control" placeholder="School">
		         </div>
		         <div class="form-group">
		         	<input type="text" name="dept" class="form-control" placeholder="Dept">
		         </div>


				<div class="form-group">
		         	<input type="text" name="level" class="form-control" placeholder="Level">
		         </div>


		         <div class="form-group">
		         	<input type="text" name="sch_fees_reciept_no" class="form-control" placeholder="Sch Fees reciept NO">
		         </div>

		         <div class="form-group">
		         	<input type="text" name="hostel_fees_reciept_no" class="form-control" placeholder="Hostel Fees reciept NO">
		         </div>


		         	<div class="form-group">
		         	<input type="text" name="password" class="form-control" placeholder="Password">
		         </div>
		         	<div class="form-group">
		         	<input type="text" name="room" class="form-control" placeholder="room">
		         		<div class="form-group">
		         	<input type="text" name="bed_no" class="form-control" placeholder="bed_no">
		         </div>
		         </div>


		      </div>
		      <div class="modal-footer">
		            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
		            <button name="register" class="btn btn-success btn-simple"><i class="fa fa-check-square"></i> Register</button>
		      </div>
         </form>
    </div>
  </div>
  </div>
<?php
if(isset($_POST["register"])) {

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
			        	echo "<script>alert('Students Added into the database!')</script>";
			        	echo "<script>window.open('apply_allocate.php','_self')</script>";
			        }else{
			        	echo '<span class="alert alert-danger">'.mysql_error().'Please try again!</span>';
			        }
			    }
include 'inc/footer.php';
?>