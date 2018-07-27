<?php
include 'inc/header.php';
include 'inc/sidebar.php';
$id = $_GET['id'];
$fetch = mysql_query("SELECT * FROM applications WHERE Regno = '$id'");
$row = mysql_fetch_array($fetch);
?>
<div id="page-wrapper">
	<div class="row">
		<!-- Page Header -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<h1 class="page-header">Allocate Room to applied student</h1>
		</div>
		<!-- Page Header -->
	</div>
	<div class="row">	
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3>applocate room to <b>"<?php echo $row['Name'] ?>"</b></h3>
				</div>
				<div class="panel-body">
					<form method="post" action="#">
						<div class="form-group">
		         	<input type="text" name="name" class="form-control" placeholder="Student Name" value="<?php echo $row['Name'] ?>" readonly>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="sex" class="form-control" placeholder="Sex" value="<?php echo $row['Sex'] ?>" readonly>
		         	
		         </div>
		         <div class="form-group">
		         	<input type="text" name="level" class="form-control" placeholder="Level" value="<?php echo $row['Level'] ?>" readonly>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="regno" class="form-control" placeholder="Regno" value="<?php echo $row['Regno']?> "readonly>
		         </div>
		         <div class="form-group">
		         	<input type="text" name="room" class="form-control" placeholder="Room" value="<?php echo $row['Room'] ?>">
		         </div>
		         <div class="form-group">
		         	<input type="text" name="bed_no" class="form-control" placeholder="Bed no" value="<?php echo $row['Bed_No'] ?>">
		         </div>
		         
			      <center><div class="form-group">
			            <a href="index.php" class="btn btn-default btn-simple">Cancel</a>
			            <button name="allocate" class="btn btn-success btn-simple"><i class="fa fa-check-square"></i> Allocate</button>
			      </div></center>
		      </div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php
if (isset($_POST['allocate'])) {
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$level = $_POST['level'];
	
	$room= $_POST['room'];
	$bed_no = $_POST['bed_no'];
	
	$regno = $row['regno'];




	$query1= mysql_query("SELECT * FROM applications where  Room='$room' and  Bed_No='$bed_no'");




if(mysql_num_rows($query1)>=1){

	

echo "<script>alert('room number and bed number already allocated')</script>";

exit();
}
else{







	$query = mysql_query("UPDATE applications SET Room  ='$room', Bed_No='$bed_no' where Regno ='$id'");

	$id = $_GET['id'];
	if ($query) {
		echo "<script>alert('allocation sucessful')</script>";
		echo "<script>window.open('report.php','_self')</script>";
	}else{
		echo mysql_error();
	}
}
	}

include 'inc/footer.php';
?>