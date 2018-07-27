<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include('inc/config.php');
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">Training Registration Portal</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>Training Registrations</h3>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped">
						<thead>
							
							<th>Serial Number</th>
							<th>Surname</th>
							<th>Othernames</th>
							<th>Sex</th>
							<th>Phone</th>
							<th>Interest</th>

							<th>Passport</th>
							<th>Date Of Reg</th>

						</thead>
						<tbody>
							<?php
							$fetch = mysql_query("SELECT * FROM training_reg");
								while ($row = mysql_fetch_array($fetch)) {
							?>
							<tr>
								
								<td><?php echo $row['Serial_number']?></td>
								
								<td><?php echo $row['Surname']?></td>
								<td><?php echo $row['Othernames']?></td>
								<td><?php echo $row['Sex']?></td>
								<td><?php echo $row['Phone_number']?></td>
								<td><?php echo $row['Interest']?></td>

								<td><?php echo $row['Passport']?></td>

								<td><?php echo $row['Date_of_reg']?></td>


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