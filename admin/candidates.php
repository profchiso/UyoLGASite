<?php
include 'inc/header.php';
include 'inc/sidebar.php';
$fetch = mysql_query("SELECT * FROM news");
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">News Portal</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>Upload News</h3>
					<a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#candidateReg"><i class="fa fa-plus"></i> ADD NEWS</a>
				</div>
				<div class="panel-body table-responsive">
					<table class="table table-striped">
						<thead>
							<th>Serial Number</th>
							<th>Subject</th>
							<th>News</th>
							<th>Date Uploaded</th>
							<th><i class="fa fa-bars"></i></th>
						</thead>
						<tbody>
							<?php
								while ($row = mysql_fetch_array($fetch)) {
							?>
							<tr>
								<td><?php echo $row['Serial_number']?></td>
								<td><?php echo $row['Subject']?></td>
								<td><?php echo $row['News']?></td>
								<td><?php echo $row['Date_uploaded']?></td>
								<td><a href="candidate_preview.php?id=<?php echo $row['id']?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a><a data-toggle="modal" data-target="#delete<?php echo $row['id']?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>
							</tr>
							<div class="modal fade" id="delete<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
							    <div class="modal-content">
									      <div class="modal-body">
									      Do you want to delete the account of <b><?php echo $row['fullname']?></b>
									        </div>
									      <div class="modal-footer">
									            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
									            <a name="update" href="candidate_del.php?id=<?php echo $row['id']?>" class="btn btn-danger btn-simple"><i class="fa fa-check-square"></i> Delete</a>
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
        <h4 class="modal-title" id="myModalLabel"><center>ADD NEWS</center></h4>
      </div>
         <form method="post" action="#" enctype="multipart/form-data">
		      <div class="modal-body">
		         <div class="form-group">
		         	<input type="text" name="fullname" class="form-control" placeholder="Subject">
		         </div>
		         
		         <div class="form-group">
		         	<input type="text" name="level" class="form-control" placeholder="News">
		         </div>
		         <div class="form-group">
		         	<input type="text" name="staff_num" class="form-control" placeholder="Date">
		         </div>
		         
		         
		         
		         <div class="form-group">
		         	<input type="file" name="fileToUpload" class="form-control">
		         </div>
		      </div>
		      <div class="modal-footer">
		            <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancel</button>
		            <button name="register" class="btn btn-success btn-simple"><i class="fa fa-check-square"></i> Upload</button>
		      </div>
         </form>
    </div>
  </div>
  </div>
<?php
if(isset($_POST["register"])) {
	$target_dir = "uploads/";
	$uploadOk = 1;
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2000000) {
	    echo "Picture file is too large";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
	    echo "Sorry, only JPEG, JPG, and PNG allowed";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded";

	// if everything is ok, try to upload file
	} else {
	$fullname = $_POST['fullname'];
	$sex = $_POST['sex'];
	$level = $_POST['level'];
	$staff_num = $_POST['staff_num'];
	$lga = $_POST['lga'];
	$state = $_POST['state'];
	$post = $_POST['post'];
	$img= $_FILES["fileToUpload"]["name"];
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		        $sql = mysql_query("INSERT INTO candidate(fullname,sex,level,staff_num,lga,state,post,img)VALUES('$fullname','$sex','$level','$staff_num','$lga','$state','$post','$img')");
			        if ($sql) {
			        	echo "<script>alert('Candidate has been registered into the database!')</script>";
			        	echo "<script>window.open('candidates.php','_self')</script>";
			        }else{
			        	echo '<span class="alert alert-danger">'.mysql_error().'Please try again!</span>';
			        }
			    }
		}
	}
include 'inc/footer.php';
?>