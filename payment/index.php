<?php
require_once '../url.php';
require_once '../services/help_file.php';
require_once '../db_connect.php';
session_start();

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
if(!empty($user_data['verification_status']) && $user_data['verification_status']==="VERIFIED"){
      header('Location: ../print_cert');
      exit();
}
$success_message="";
$is_payment_not_made=false;
if(!empty($_SESSION['success'])){
      $success_message=$_SESSION['success'];
}
if(empty($success_message)) {
      $stmt = $conn->prepare("SELECT * FROM payment WHERE user_id=:user_id ");
      $stmt->execute(array(':user_id' => $user_data['user_id']));
      $check_row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!empty($check_row)) {
            $success_message= "Your Payment has been received and your request is being processed.";
      }
}else{
      $stmt = $conn->prepare("SELECT * FROM payment WHERE user_id=:user_id ");
      $stmt->execute(array(':user_id' => $user_data['user_id']));
      $check_row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (empty($check_row)) {
            $is_payment_not_made=true;
            if(!empty($_SESSION['success'])){
                  $_SESSION['success']= "Your Request has been received.<br/> To complete the process, please make payment below.";
            }
      }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title>UyoLGA | Payment Page</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">
      <base href="<?php echo $url; ?>"/>
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

<body class="bg-dark payment_option">


<div class="container-fluid">

      <!--==========================
      Header
        ============================-->
      <header id="header">

            <nav id="nav-menu-container">
                  <ul class="nav-menu">
                        <li class="menu-active"><a href="index.php">Home</a></li>
                  </ul>
            </nav>
            <!-- #nav-menu-container -->
            <!--Nav Bar end-->
      </header><!-- #header -->
      <div class="response_message success_holder">
            <?php if(!empty($success_message)): ?>
                  <div class="col-md-12 text-center">
                        <div class="alert  alert-success text-center" >
                              <strong><?php echo $success_message ?></strong>
                        </div>
                        <?php if(!$is_payment_not_made): ?>
                              <a href="" class="btn btn-success success_btn">Go Back to Homepage</a>
                              <a href="print_cert" class="btn btn-success success_btn">Print Certificate</a>
                        <?php endif; ?>
                  </div>
            <?php endif; ?>
      </div>
      <?php if(empty($success_message) || $is_payment_not_made): ?>
      <div class="card card-payment mx-auto mt-5">
            <div class="card-header text-center"><b>Select Payment Option Below</b></div>
            <div class="card-body">
                  <div class="row loader_container">
                        <div class="loader_image"></div>
                  </div>
                  <form method="POST"  name="payment_form" class="payment_form">
                        <input type="hidden" name="user_id" value="<?php echo !empty($user_data['user_id'])?$user_data['user_id']:'' ?>">
                        <div class="form-group user_details">
                              <label ><b>Name: &nbsp;</b> <?php echo !empty($user_data['surname'])?ucwords(strtolower($user_data['surname'])):'' ?> <?php echo !empty($user_data['othernames'])?ucwords(strtolower($user_data['othernames'])):'' ?>   </label>
                              <label ><b>Email: &nbsp;</b> <?php echo !empty($user_data['email'])?strtolower($user_data['email']):'' ?>   </label>
                              <label ><b>Amount to be Paid: &nbsp;</b> <?php echo  "&#8358;".number_format(5000,2,".",","); ?>   </label>
                        </div>
                        <div>
                              <div class="bank_option">
                                    <button type="button" class="btn btn-success btn-block" name="upload_bank_teller" id="upload_bank_teller" onclick="window.location.href='payment/teller_upload.php';">Pay Through Bank</button>
                              </div>
                              <div class="online_option">
                                    <button type="submit" class="btn btn-success btn-block" name="pay_online" id="pay_online">Pay Online</button>
                                    <img src="img/secured_by_paystack.png"  class="paystack_banner"/>
                              </div>

                        </div>

                  </form>

            </div>
      </div>
      <?php endif; ?>
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

                              <div class="col-lg-3 col-md-6 footer-newsletter">
                                    <h4>Our Newsletter</h4>
                                    <p>Enter your email address to subscribe to our newsletter.</p>
                                    <form action="" method="post">
                                          <input type="email" name="email"><input type="submit"  value="Subscribe">
                                    </form>
                              </div>

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
                        Designed by <a href="https://giftedbraintech.com">giftedbraintech</a>
                  </div>
            </div>
      </footer><!-- #footer -->

      <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>



</div>

<!-- JavaScript Libraries -->
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/bootbox/bootbox.min.js"></script>
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
