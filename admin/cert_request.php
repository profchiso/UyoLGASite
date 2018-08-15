 <?php

 require_once 'db_connect.php';
 include 'inc/header.php';
 include 'inc/sidebar.php';
 require_once 'root_dir.php';
 require_once 'services/help_file.php';
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">LGA CERT. REQUEST PORTAL</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>LGA Certificate Request Table</h3>
					<!--<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#candidateReg"><i class="fa fa-plus"></i> Allocate Room</a>-->
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped">
						<thead>
							<th>Serial Number</th>
							<th>Surname</th>
							<th>Othernames</th>
							<th>Sex</th>
							<th>Phone Number</th>
							<th>Village</th>
							<th>Clan</th>
							<th>Ward</th>
							<th>Current Address</th>
							<th>Email Address</th>
							<th>Village Head</th>
							<th>Village Head Phone</th>
							<th>Clan Head</th>
							<th>Clan Head Phone</th>
							<!--<th>Identification</th>
							<th>Identification Number</th>
							<th>Tax ID No</th>
							<th>Reason For Request</th>
							<th>Passport</th>
							<th>Payment Teller</th>
							<th>Agreement</th>
							<th>Date Of Request</th>-->

							
							<th><i class="fa fa-bars"></i></th>
						</thead>
						<tbody>
							<?php
                                          $stmt = $conn->prepare("SELECT * FROM lga_cert_request");
                                          $stmt->execute(array());
                                          $users_data=array();
                                          while($row_data= $stmt->fetch(PDO::FETCH_ASSOC)){
                                                $users_data[]=$row_data;
                                          }
                                          if(!empty($users_data)): ?>
                                          <?php foreach ($users_data as $key_index=>$row): ?>
							<tr>
								<td><?php echo !empty($row['surname'])?$row['surname']:'' ?></td>
								<td><?php echo !empty($row['othernames'])?$row['othernames']:'' ?></td>
								<td><?php echo !empty($row['email'])?$row['email']:'' ?></td>
								<td><?php echo !empty($row['phone_number'])?$row['phone_number']:'' ?></td>
								<!--<td><?php //echo $row['Clan']?></td>
								<td><?php// echo $row['Clan']?></td>
								<td><?php //echo $row['Clan']?></td>-->













								<td><a href="candidate_preview.php?id=<?php echo $row['Regno']?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a></td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
							<div class="modal fade" id="delete<?php echo $row['Regno']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
									      <div class="modal-body">
									      Do you want to delete the account of <b><?php echo $row['Name']?></b>
									        </div>
									      <div class="modal-footer">
									            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									            <a name="update" href="candidate_del.php?id=<?php echo $row['regno']?>" class="btn btn-danger btn-simple"><i class="fa fa-check-square"></i> Delete</a>
										      </div>
							    </div>
							  </div>
							  </div>
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
        <h4 class="modal-title" id="myModalLabel"><center>ALLOCATE ROOM</center></h4>
      </div>
         <form method="post" action="#" enctype="multipart/form-data">
		      <div class="modal-body">
		         <div class="form-group">
		         	<input type="text" name="stud_name" class="form-control" placeholder="STUDENT NAME" required>
		         </div>
		         <div class="form-group">
		         	<select name="sex" class="form-control" required>
		         		<option selected="" disabled="">Select Gender</option>
		         		<option value="Male">Male</option>
		         		<option value="Female">Female</option>
		         	</select>
		         </div>
		         
		         <div class="form-group">
		         	<input type="text" name="regno" class="form-control" placeholder="REGNO" required>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="dept" class="form-control" placeholder="DEPT" required>
		         </div>
		        <!-- <div class="form-group">
		         	<input type="text" name="lga" class="form-control" placeholder="LGA">
		         </div>
		         <div class="form-group">
		         	<input type="text" name="state" class="form-control" placeholder="State of Origin">
		         </div>-->
		         <div class="form-group">
		         	<select class="form-control" name="level" required>
		         		<option selected="" disabled="">LEVEL</option>
		         		<option value="HND2">HND2</option>
		         		<option value="ND1">ND1</option>
		         		

		         	</select>
		         </div>






		         <div class="form-group">
		         	<input type="text" name="room" class="form-control" placeholder="ROOM" required>
		         </div>

					<div class="form-group">
		         	<select class="form-control" name="bed_no" required>
		         		<option selected="" disabled="">SELECT BED NO</option>
		         		<option value="01">01</option>
		         		<option value="02">02</option>
		         		<option value="03">03</option>
		         		<option value="04">04</option>
		         		<option value="05">08</option>
		         		<option value="06">06</option>
		         		<option value="07">07</option>
		         		<option value="08">08</option>
		         		

		         	</select>
		         </div>



		        <!-- <div class="form-group">
		         	<input type="file" name="fileToUpload" class="form-control">
		         </div>-->
		      </div>
		      <div class="modal-footer">
		            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
		            <button name="register" class="btn btn-success btn-simple"><i class="fa fa-check-square"></i> ALLOCATE</button>
		      </div>
         </form>
    </div>
  </div>
  </div>
<?php
if(isset($_POST["register"])) {
	//$target_dir = "uploads/";
	//$uploadOk = 1;
	//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check file size
	//if ($_FILES["fileToUpload"]["size"] > 2000000) {
	   // echo "Picture file is too large";
	   // $uploadOk = 0;
	//}
	// Allow certain file formats
	//if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
	    //echo "Sorry, only JPEG, JPG, and PNG allowed";
	    //$uploadOk = 0;
	//}
	// Check if $uploadOk is set to 0 by an error
	//if ($uploadOk == 0) {
	   // echo "Sorry, your file was not uploaded";

	// if everything is ok, try to upload file
	//} else {
	$stud_name = $_POST['stud_name'];
	$sex = $_POST['sex'];
	$regno = $_POST['regno'];
	$dept= $_POST['dept'];
	$level = $_POST['level'];
	$room = $_POST['room'];
	$bed_no = $_POST['bed_no'];
	//$img= $_FILES["fileToUpload"]["name"];
			//if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        $sql = mysql_query("INSERT INTO applications(Name,Sex,Regno,Dept,Level,Room,Bed_No)VALUES('$stud_name','$sex','$regno','$dept','$level','$room','$bed_no')");
			        if ($sql) {
			        	echo "<script>alert('allocation sucessful!')</script>";
			        	echo "<script>window.open('candidates.php','_self')</script>";
			        }else{
			        	echo '<span class="alert alert-danger">'.mysql_error().'Please try again!</span>';
			        }
			    }
		//}
	//}
include 'inc/footer.php';
?>