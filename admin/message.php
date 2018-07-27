<?php
include 'inc/header.php';
include 'inc/sidebar.php';
include('inc/config.php');
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">Mail Portal</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>Message</h3>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped">
						<thead>
							
							<th>Serial Number</th>
							<th>Sender</th>
							<th>Email</th>
							<th>Subject</th>
							<th>Message</th>
							<th>Date Recieved</th>

						</thead>
						<tbody>
							<?php
							$fetch = mysql_query("SELECT * FROM message");
								while ($row = mysql_fetch_array($fetch)) {
							?>
							<tr>
								
								<td><?php echo $row['Serial Number']?></td>
								
								<td><?php echo $row['Senders_name']?></td>
								<td><?php echo $row['Email']?></td>
								<td><?php echo $row['Subject']?></td>
								<td><?php echo $row['Message']?></td>
								<td><?php echo $row['Date_sent']?></td>

								


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