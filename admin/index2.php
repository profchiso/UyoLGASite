<?php
session_start();
$title = "ONLINE hostel allocation";
include('inc/header.php');
include('inc/config.php');
?>
<div class="grid">
	<div class="row cells4">
		<div class="row cell"><H2><font color="blue">ONLINE HOSTEL ALLOCATION</font></H2></div>
		<div class="cell  colspan2">
                        <div class="carousel" data-role="carousel" data-height="500" data-control-next="<span class='mif-chevron-right'></span>" data-control-prev="<span class='mif-chevron-left'></span>">
                            
                        		<div class="slide"><img src="images/sip1.jpg" data-role="fitImage" data-format="fill"></div>
                            <div class="slide"><img src="images/slide1.jpg" data-role="fitImage" data-format="fill"></div>
                             <div class="slide"><img src="images/s.jpg" data-role="fitImage" data-format="fill"></div>
                            <div class="slide"><img src="images/slide2.png" data-role="fitImage" data-format="fill"></div>
                            <div class="slide"><img src="images/slide3.jpg" data-role="fitImage" data-format="fill"></div>
                            
                            
                            <div class="slide"><img src="images/hostel.jpg" data-role="fitImage" data-format="fill"></div>
                           
                        </div>
				</div>












		<div class="cell">
			<form method="post" action="#">
			<h2 align="center"><font color="blue">Student Login</font> </h2>
				<div class="input-control modern text iconic">
				    <input type="text" name="username">
				    <span class="label">Your Regno</span>
				    <span class="informer">Please enter your Regno</span>
				    <span class="placeholder">Username</span>
				    <span class="icon mif-user"></span>
				</div>
				<div class="input-control modern password iconic" data-role="input">
				    <input type="password" name="password">
				    <span class="label">You password</span>
				    <span class="informer">Please enter you password</span>
				    <span class="placeholder">Input password</span>
				    <span class="icon mif-lock"></span>
				    <button class="button helper-button reveal"><span class="mif-looks"></span></button>
				</div>
				<div align="center">
				<button type="login"name="login" class="button success block-shadow-success text-shadow"><span class="mif-enter"> Login</span></button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$user = mysql_query("SELECT * FROM applications WHERE Regno = '$username' AND Password = '$password'", $conn);
	if (mysql_num_rows($user)) {
		$_SESSION['username'] = $username;
		echo "<script>window.open('portal.php','_self')</script>";
	}else{
		echo "<script>alert('Incorrect Username or Password')</script>";
	}
}
include('inc/footer.php');
?>