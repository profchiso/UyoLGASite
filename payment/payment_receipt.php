<?php
session_start();
require_once '../url.php';
require_once '../db_connect.php';
require_once '../services/help_file.php';

$payment_ref['payment_reference']=!empty($_GET['payment_reference'])?$_GET['payment_reference']:'';

if(empty($payment_ref['payment_reference'])){
      $payment_ref=!empty($_SESSION['payment'])?$_SESSION['payment']:array();
}
if(empty($payment_ref) || empty($payment_ref['payment_reference'])){
      header('Location: ../');
      exit();
}else{
      $_SESSION['payment']['payment_reference']=$payment_ref['payment_reference'];
}

$stmt = $conn->prepare("SELECT * FROM payment WHERE payment_reference=:payment_reference");
$stmt->execute(array(':payment_reference' => $payment_ref['payment_reference']));

if($stmt->rowCount()<1){
      header('Location: ../');
      exit();
}else{
      $payment_data= $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title>UyoLGA | Payment Receipt</title>
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

<body class="bg-dark payment_option payment_receipt">


<div class="container-fluid">

      <!--==========================
      Header
        ============================-->
      <header id="header">

            <nav id="nav-menu-container" class="hide_print">
                  <ul class="nav-menu">
                        <li class="menu-active"><a href="index.php">Home</a></li>
                  </ul>
            </nav>
            <!-- #nav-menu-container -->
            <!--Nav Bar end-->
      </header><!-- #header -->

      <div class="response_message">
            <?php if(!empty($payment_ref['payment_success'])): ?>
                  <div class="col-md-12">
                        <div class="alert  alert-success text-center" >
                              <strong><?php echo $payment_ref['payment_success']; ?></strong>
                        </div>
                  </div>
            <?php endif; ?>
      </div>
      <div class="print_logo_holder">
            <div class="print_logo text-center"><img src="img/uyo.png"/> </div>
      </div>
      <div class="card card-payment mx-auto mt-5">

            <div class="card-header text-center"><b>Payment Receipt</b></div>
            <div class="card-body">
                  <div class="content-body">
                        <div class="order_details_section">
                              <div class="order_content ">
                                    <div class="text-center summary_title">
                                          <kbd class=" animate-this text-center ">
                                                <strong>Payment Summary</strong>
                                          </kbd>
                                    </div>
                                    <div class="content_holder">
                                          <p><span class="copy_header"><b>Payment Reference:</b> &nbsp; </span><span class="copy_body"><?php echo !empty($payment_data['payment_reference'])?$payment_data['payment_reference']:'' ?></span> </p>
                                          <p><span class="copy_header"><b>Payment Status:</b> &nbsp; </span><span class="copy_body"><?php echo !empty($payment_data['payment_status'])?$payment_data['payment_status']:'' ?></span> </p>
                                          <p><span class="copy_header"><b>Payment Amount:</b> &nbsp; </span><span class="copy_body"><?php echo !empty($payment_data['amount_paid'])?("&#8358;".number_format($payment_data['amount_paid'],2,".",",")):'' ?></span> </p>
                                          <p><span class="copy_header"><b>Payment Date:</b> &nbsp; </span><span class="copy_body"><?php echo !empty($payment_data['payment_date'])?$payment_data['payment_date']:'' ?></span> </p>
                                    </div>
                              </div>
                              <div class="row print_receipt_row">
                                    <div class="col-xs-12 ">
                                          <a href="javascript:void(0);" class="print_btn btn btn-primary hide_print"><strong>Print Receipt</strong></a>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>

      <!--==========================
        Footer
      ============================-->
      <footer id="footer" class="hide_print">
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
