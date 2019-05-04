<?php
session_start();
require_once '../url.php';
require_once '../db_connect.php';
require_once '../services/help_file.php';
require_once 'print_cert_process.php';
$stmt = $conn->prepare("SELECT * FROM lga_cert_request WHERE user_id=:user_id ");
$stmt->execute(array(':user_id' => $_SESSION['user_id']));
$check_row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($check_row)) {
      $user_data=$check_row;
}
if(empty($user_data)){
      header('Location: ../');
      exit();
}
$stmt = $conn->prepare("SELECT * FROM payment WHERE user_id=:user_id ");
$stmt->execute(array(':user_id' => $user_data['user_id']));
$check_row = $stmt->fetch(PDO::FETCH_ASSOC);
if (empty($check_row)) {
      header('Location: ../payment');
      exit();
}
$is_user_verified=false;
if(!empty($user_data['verification_status']) && $user_data['verification_status']==="VERIFIED"){
      $is_user_verified=true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title>UyoLGA | Print Certificate</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">
      <base href="<?php echo $url; ?>" />
      <!-- Favicons -->
      <link href="img/uyo.png" rel="icon">
      <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

      <!-- Bootstrap CSS File -->
      <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

      <!-- Libraries CSS Files -->
      <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="lib/animate/animate.min.css" rel="stylesheet">
      <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
      <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

      <!-- Main Stylesheet File -->
      <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">
      <link href="css/form.css?v=<?php echo time(); ?>" rel="stylesheet">


</head>

<body class="bg-dark print_cert_page">


<div class="container-fluid">

      <!--==========================
      Header
        ============================-->
      <header id="header">

            <nav id="nav-menu-container">
                  <ul class="nav-menu">
                        <li class="menu-active"><a href="index.php">Home</a></li>
                  </ul>
            </nav><!-- #nav-menu-container -->
            <!--Nav Bar end-->

      </header><!-- #header -->
      <?php if(!empty($errors)): ?>
            <div class="response_message">
                  <div class="alert alert-danger text-center">
                        <?php echo !empty($errors['user_id'])?$errors['user_id']:'' ?>
                  </div>
            </div>
      <?php endif; ?>
      <div class="card card-login mx-auto mt-5 <?php echo !empty($errors)?'errors':'' ?>">
            <div class="card-header text-center"><kbd><?php echo ($is_user_verified)?'Download and Print Certificate':'Request is being processed' ?></kbd></div>
            <div class="card-body">
                  <?php if($is_user_verified): ?>
                        <form method="POST" class="download_cert_form">
                              <input type="hidden" name="user_id" value="<?php echo !empty($user_data['user_id'])?$user_data['user_id']:'' ?>"/>
                              <div class="text-center print_note">
                                    <p>Hi  <span class="user_name"><?php echo ((!empty($user_data['surname'])?ucwords(strtolower($user_data['surname'])):''). (!empty($user_data['othernames'])?' '.ucwords(strtolower($user_data['othernames'])):'')); ?></span>, your LGA certificate has been successfully processed.</p>
                                    <p>Click on the link below to download and print your certificate.</p>
                              </div>
                              <div class="download_cert_holder text-center"><a class="small mt-3 download_certificate btn btn-primary" href="javascript:void(0);" data-user_id="<?php echo !empty($user_data['user_id'])?$user_data['user_id']:'' ?>"><b><span class="fa fa-download"></span>  Download Certificate</b></a></div>
                        </form>
                  <?php else: ?>
                        <div class="text-center print_note">
                              <p>Hi  <span class="user_name"><?php echo ((!empty($user_data['surname'])?ucwords(strtolower($user_data['surname'])):''). (!empty($user_data['othernames'])?' '.ucwords(strtolower($user_data['othernames'])):'')); ?></span>, your LGA certificate request is currently being processed.</p>
                              <p>A notification email will be sent to you when your LGA certificate has been processed.</p>
                        </div>
                  <?php endif;  ?>
            </div>
      </div>

      <!--==========================
        Footer
      ============================-->
      <footer id="footer">
            <div class="footer-top">
                  <div class="container">
                        <div class="row">

                              <div class="col-lg-3 col-md-6 footer-info">

                                    <a href="#intro"><img src="img/uyo.png" alt="" title="" width="100px" height="100px"   /></a><br>
                                    <!--<h3>Uyo LGA</h3>-->
                                    <p>UYO LGA <br>DAKKADDA.</p>
                              </div>

                              <div class="col-lg-3 col-md-6 footer-links">
                                    <h4>Useful Links</h4>
                                    <ul>
                                          <li><i class="ion-ios-arrow-right"></i> <a href="index.php">Home</a></li>

                                    </ul>
                              </div>

                              <div class="col-lg-3 col-md-6 footer-contact">
                                    <h4>Contact Us</h4>
                                    <p>
                                          No 1, Uyo Village road <br>
                                          Uyo<br>
                                          Akwaibom State <br>
                                          <strong>Phone:</strong> +2348036009397<br>
                                          <strong>Email:</strong> info@uyolga.gov.ng<br>
                                    </p>

                                    <div class="social-links">
                                          <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                                          <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                                          <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                                          <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                          <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                                    </div>

                              </div>

                              <!--<div class="col-lg-3 col-md-6 footer-newsletter">
                                    <h4>Our Newsletter</h4>
                                    <p>Enter your email address to subscribe to our newsletter.</p>
                                    <form action="" method="post">
                                          <input type="email" name="email"><input type="submit"  value="Subscribe">
                                    </form>
                              </div>-->

                        </div>
                  </div>
            </div>

            <div class="container">
                  <div class="copyright">
                        &copy; Copyright <strong>UyoLGA</strong>. All Rights Reserved
                        <?php echo( date("Y.") );?>
                  </div>
                  <div class="credits">
                        <!--
                          All the links in the footer should remain intact.
                          You can delete the links only if you purchased the pro version.
                          Licensing information: https://bootstrapmade.com/license/
                          Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=BizPage
                        -->
                        Designed by <a href="https://profchisotect.com">profchisotech</a>
                  </div>
            </div>
      </footer><!-- #footer -->

      <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>



</div>

<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/superfish/hoverIntent.js"></script>
<script src="lib/superfish/superfish.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>
<script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="contactform/contactform.js"></script>

<!-- Template Main Javascript File -->
<script src="js/main.js?v=<?php echo time(); ?>"></script>

</body>
</html>
