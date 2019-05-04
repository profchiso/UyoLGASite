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
			<h1 class="page-header text-center">LGA CERTIFICATE REQUEST PORTAL</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">LGA Certificate Requests</h3>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped table-responsive" width="100%">
						<thead>
							
							<th>ID</th>
							<th>Surname</th>
							<th>Othernames</th>
							<th>Sex</th>
							<th>Phone</th>
							<th>Email</th>

							<th>Passport</th>
							<th>Date Requested</th>
							<th class="text-center" style="color: green;">ACTIONS</th>

						</thead>
						<tbody>
							<?php
$stmt = $conn->prepare("SELECT * FROM lga_cert_request");
$stmt->execute(array());
$users_data=array();
while($row= $stmt->fetch(PDO::FETCH_ASSOC)){
      $users_data[]=$row;
//}
//_d($users_data,1);


								//while ($row = mysql_fetch_array($users_data)) {
							//?>
							<tr>
								
								<td><?php echo $row['id']?></td>
								
								<td><?php echo $row['surname']?></td>
								<td><?php echo $row['othernames']?></td>
								<td><?php echo $row['gender']?></td>
								<td><?php echo $row['phone_number']?></td>
								<td><?php echo $row['email']?></td>

								<td><?php echo"<img class'image-rounded' src '$row['passport']'"?></td>

								<td><?php echo $row['date_requested']?></td>


							</tr>
							<?php } ?>
						</tbody>

					</table>
				</div>
				
			</div>
		</div>

		

		
	</div>
	</div>
	<div>

	
	</div>
  <?php
 
include 'inc/footer.php';
?>