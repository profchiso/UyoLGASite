<?php if(stripos($_SERVER['HTTP_HOST'], '127.0.0.1') !== FALSE ||stripos($_SERVER['HTTP_HOST'],'localhost')!==false) {
      define('IS_LOCAL', true);
}else {
      define('IS_LOCAL', false);
}


require_once 'cert_request_process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="utf-8">
      <title>UyoLGA |LGA Cert Request</title>
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <meta content="" name="keywords">
      <meta content="" name="description">
      <base href="../" />
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

<body class="bg-dark cert_request_page">
<div class="page_container">
      <!--==========================
    Header
  ============================-->
      <header id="header">
            <div class="container-fluid">
                  <nav id="nav-menu-container">
                        <ul class="nav-menu">
                              <li class="menu-active"><a href="index.php">Home</a></li>
                        </ul>
                  </nav><!-- #nav-menu-container -->
                  <!--Nav Bar end-->
            </div>
      </header><!-- #header -->

      <!--=======================
form start
  ===============================-->
      <div class="card card-register mx-auto mt-5">
            <div class="card-header text-center" >Local Govt. Cert. Request Form <i style="color: red;">(All Fields with Asteriks must be filled)</i></div>
            <div class="card-body">
                  <?php if(!empty($errors)): ?>
                        <div class="form-group">
                              <div class="alert alert-dismissable alert-danger text-center" >
                                    Error(s) occurred processing your requests, Please fix your error(s) and try again
                              </div><br/>
                        </div>
                  <?php endif; ?>
                  <form method="post" enctype="multipart/form-data" action="" class="lga_cert_request_form" id="lga_cert_request_form">
                        <div class="form-group">
                              <div class="form-row">
                                    <div class="col-md-6">
                                          <label for="exampleInputName">Surname <b style="color: red;">*</b></label>
                                          <input class="form-control <?php echo !empty($errors['surname'])?'error':'' ?>" id="surname" type="text" aria-describedby="nameHelp"  name="surname" value="<?php echo !empty($post_data['surname'])?$post_data['surname']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['surname'])): ?><p class="help-block"><?php echo $errors['surname'] ?></p><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                          <label for="exampleInputLastName">Othernames <b style="color: red;">*</b></label>
                                          <input class="form-control <?php echo !empty($errors['othernames'])?'error':'' ?>" id="othernames" type="text" aria-describedby="nameHelp"  name="othernames" value="<?php echo !empty($post_data['othernames'])?$post_data['othernames']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['othernames'])): ?><p class="help-block"><?php echo $errors['othernames'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              <div class="<?php echo !empty($errors['gender'])?'error':'' ?>">
                                    <label for="" class="option_field_label">Gender <b style="color: red;">*</b></label>
                                    <label class="pointer_cursor"><input class="" type="radio" name="gender" value="Male" <?php echo (!empty($post_data['gender']) && strtolower($post_data['gender'])==="male")?'checked="checked"':'' ?> > Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="pointer_cursor"><input type="radio" name="gender" value="Female" <?php echo (!empty($post_data['gender']) && strtolower($post_data['gender'])==="female")?'checked="checked"':'' ?>> Female</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <div class="form-group">
                              <label for="exampleInputLastName">Phone Number <b style="color: red;">*</b></label>
                              <input class="form-control  <?php echo !empty($errors['phone_number'])?'error':'' ?>" id="phone_number" type="text" aria-describedby="nameHelp" name="phone_number" value="<?php echo !empty($post_data['phone_number'])?$post_data['phone_number']:''; ?>">
                              <?php if(!empty($errors) && !empty($errors['phone_number'])): ?><p class="help-block"><?php echo $errors['phone_number'] ?></p><?php endif; ?>
                        </div>
                        <div class="form-group">
                              <div class="form-row">
                                    <div class="col-md-6">
                                          <label for="exampleInputName">Village <b style="color: red;">*</b></label>
                                          <input class="form-control  <?php echo !empty($errors['village'])?'error':'' ?>" id="village" type="text" aria-describedby="phoneHelp" name="village" value="<?php echo !empty($post_data['village'])?$post_data['village']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['village'])): ?><p class="help-block"><?php echo $errors['village'] ?></p><?php endif; ?>
                                    </div>

                                    <div class="col-md-6">
                                          <label for="exampleInputLastName">Clan <b style="color: red;">*</b></label>
                                          <input class="form-control  <?php echo !empty($errors['clan'])?'error':'' ?>" id="clan" type="text" aria-describedby="nameHelp"  name="clan" value="<?php echo !empty($post_data['clan'])?$post_data['clan']:''; ?>" >
                                          <?php if(!empty($errors) && !empty($errors['clan'])): ?><p class="help-block"><?php echo $errors['clan'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              <div class="form-row">
                                    <div class="col-md-6">
                                          <label for="exampleInputName">Ward <b style="color: red;">*</b></label>
                                          <input class="form-control  <?php echo !empty($errors['ward'])?'error':'' ?>" id="ward" type="text" aria-describedby="phoneHelp"  name="ward" value="<?php echo !empty($post_data['ward'])?$post_data['ward']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['ward'])): ?><p class="help-block"><?php echo $errors['ward'] ?></p><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                          <label for="exampleInputLastName">Current Address <b style="color: red;">*</b></label>
                                          <input class="form-control  <?php echo !empty($errors['current_address'])?'error':'' ?>" id="current_address" type="text" aria-describedby="nameHelp"  name="current_address" value="<?php echo !empty($post_data['current_address'])?$post_data['current_address']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['current_address'])): ?><p class="help-block"><?php echo $errors['current_address'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              <label for="exampleInputEmail1">Email Address <b style="color: red;">*</b></label>
                              <input class="form-control  <?php echo !empty($errors['email'])?'error':'' ?>" id="email" type="text" aria-describedby="emailHelp"  name="email" value="<?php echo !empty($post_data['email'])?$post_data['email']:''; ?>">
                              <?php if(!empty($errors) && !empty($errors['email'])): ?><p class="help-block"><?php echo $errors['email'] ?></p><?php endif; ?>
                        </div>
                        <div class="form-group">
                              <div class="form-row">
                                    <div class="col-md-6">
                                          <label for="password">Password <b style="color: red;">*</b></label>
                                          <input type="password" name="password" id="password" value="" class="form-control <?php echo (!empty($errors['password'])?'error':''); ?>"/>
                                          <?php if(!empty($errors) && !empty($errors['password'])): ?><p class="help-block"><?php echo $errors['password'] ?></p><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                          <label for="confirm_password">Confirm Password <b style="color: red;">*</b></label><br/>
                                          <input type="password" name="confirm_password" id="confirm_password" value="" class="form-control <?php echo (!empty($errors['confirm_password'])?'error':''); ?>"/>
                                          <?php if(!empty($errors) && !empty($errors['confirm_password'])): ?><p class="help-block"><?php echo $errors['confirm_password'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>
                        <div class="form-group">
                              <div class="form-row">
                                    <div class="col-md-6">
                                          <label for="exampleInputName">Name of village Head <b style="color: red;"></b></label>
                                          <input class="form-control  <?php echo !empty($errors['village_head'])?'error':'' ?>" id="village_head" type="text" aria-describedby="phoneHelp"  name="village_head" value="<?php echo !empty($post_data['village_head'])?$post_data['village_head']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['village_head'])): ?><p class="help-block"><?php echo $errors['village_head'] ?></p><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                          <label for="exampleInputLastName">Phone Number of village head</label>
                                          <input class="form-control <?php echo !empty($errors['village_head_phone_number'])?'error':'' ?>" id="village_head_phone_number" type="text" aria-describedby="nameHelp" name="village_head_phone_number" value="<?php echo !empty($post_data['village_head_phone_number'])?$post_data['village_head_phone_number']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['village_head_phone_number'])): ?><p class="help-block"><?php echo $errors['village_head_phone_number'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              <div class="form-row">
                                    <div class="col-md-6">
                                          <label for="exampleInputName"> Name Of Clan Head  <b style="color: red;">*</b></label>
                                          <input class="form-control <?php echo !empty($errors['clan_head'])?'error':'' ?>" id="clan_head" type="text" aria-describedby="phoneHelp"  name="clan_head" value="<?php echo !empty($post_data['clan_head'])?$post_data['clan_head']:''; ?>">
                                          <?php if(!empty($errors) && !empty($errors['clan_head'])): ?><p class="help-block"><?php echo $errors['clan_head'] ?></p><?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                          <label for="exampleInputLastName">Phone Number of Clan Head </label>
                                          <input class="form-control <?php echo !empty($errors['clan_head_phone'])?'error':'' ?>" id="clan_head_phone" type="text" aria-describedby="nameHelp"  name="clan_head_phone" value="<?php echo !empty($post_data['clan_head_phone'])?$post_data['clan_head_phone']:''; ?>" >
                                          <?php if(!empty($errors) && !empty($errors['clan_head_phone'])): ?><p class="help-block"><?php echo $errors['clan_head_phone'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>

                        <div class="form-group">
                              <div class=" <?php echo !empty($errors['identification'])?'error':'' ?>">
                                    <label for="" style="color: blue;" class="option_field_label">Mode of Identification <b style="color: red;">*</b></label>
                                    <label class="pointer_cursor"><input type="radio" name="identification" value="PVC" <?php echo (!empty($post_data['identification']) && strtolower($post_data['identification'])==="pvc")?'checked="checked"':'' ?> > PVC</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="pointer_cursor"><input type="radio" name="identification" value="National ID Card" <?php echo (!empty($post_data['identification']) && strtolower($post_data['identification'])==="national id card")?'checked="checked"':'' ?>> National ID-Card</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="pointer_cursor"><input type="radio" name="identification" value="Drivers Licence" <?php echo (!empty($post_data['identification']) && strtolower($post_data['identification'])==="drivers licence")?'checked="checked"':'' ?>> Drivers Licence</label>
                              </div>
                              <?php if(!empty($errors) && !empty($errors['identification'])): ?><p class="help-block"><?php echo $errors['identification'] ?></p><?php endif; ?>
                        </div>

                        <div class="form-group">
                              <label for="exampleInputEmail1">Card ID Number</label>
                              <input class="form-control <?php echo !empty($errors['card_id_number'])?'error':'' ?>"  type="text" aria-describedby=""  name="card_id_number" value="<?php echo !empty($post_data['card_id_number'])?$post_data['card_id_number']:''; ?>">
                              <?php if(!empty($errors) && !empty($errors['card_id_number'])): ?><p class="help-block"><?php echo $errors['card_id_number'] ?></p><?php endif; ?>
                        </div>

                        <div class="form-group">
                              <label for="exampleInputEmail1">Tax Identificatuion Number</label>
                              <input class="form-control <?php echo !empty($errors['tax_id_number'])?'error':'' ?>" id="tax_id_number" type="text" aria-describedby="passportHelp"  name="tax_id_number" value="<?php echo !empty($post_data['tax_id_number'])?$post_data['tax_id_number']:''; ?>">
                              <?php if(!empty($errors) && !empty($errors['tax_id_number'])): ?><p class="help-block"><?php echo $errors['tax_id_number'] ?></p><?php endif; ?>
                        </div>

                        <div class="form-group">
                              <div class="form-row">
                                    <div class="reason_for_request_label">
                                          <label for="exampleInputName">Reason For Request <b style="color: red;">*</b></label>
                                    </div>
                                    <div class="col-xs-12 reason_for_request_field">
                                          <textarea  class="<?php echo !empty($errors['reason_for_request'])?'error':'' ?>" name="reason_for_request" ><?php echo !empty($post_data['reason_for_request'])?$post_data['reason_for_request']:''; ?></textarea>
                                          <?php if(!empty($errors) && !empty($errors['reason_for_request'])): ?><p class="help-block"><?php echo $errors['reason_for_request'] ?></p><?php endif; ?>
                                    </div>
                              </div>
                        </div>

                        <?php
                        $member_image_uploaded=!empty($post_data['member_image_uploaded'])?$post_data['member_image_uploaded']:'';
                        $uploaded_member_photo = !empty($member_image_uploaded)?$member_image_uploaded:"";
                        /*** End of code segment for wrapping member passport   ***/

                        ?>

                        <div class="form-group">
                              <div class="thumbnail  <?php echo (!empty($errors['member_image_uploaded'])?'error':''); ?>" id="member_thumbnail">
                                    <img src="img/photohold.png" alt="" >
                              </div>
                              <?php if(!empty($errors) && !empty($errors['member_image_uploaded'])): ?><p class="help-block"><?php echo $errors['member_image_uploaded'] ?></p><?php endif; ?>
                              <button class="btn btn-primary" type="button" id="upload_member_photo">CLICK TO UPLOAD</button>
                              <div style="clear: both"><br class="hidden-lg hidden-md"></div>
                              <input type="hidden" id="member_image_uploaded" name="member_image_uploaded" value="<?php echo !empty($uploaded_member_photo)?$uploaded_member_photo:'' ?>"/>
                        </div>

                        <div class="form-group">
                              <div class=" <?php echo (!empty($errors['tos'])?'error':''); ?>">
                                    <label for="tos" class="pointer_cursor"><input type="checkbox" name="tos" id="tos" value="YES" <?php echo (!empty($post_data['tos']) && $post_data['tos']==="YES")?'checked="checked"':''; ?> > I here by agree that the information above is true to the best of my knowledge</label>
                              </div>
                              <?php if(!empty($errors) && !empty($errors['tos'])): ?><p class="help-block"><?php echo $errors['tos'] ?></p><?php endif; ?>
                        </div>

                        <div class="g-recaptcha captcha_frame <?php echo (!empty($errors['captcha_error'])?'error':''); ?>" data-sitekey="6Lepp2YUAAAAAK3p9QiLWfcO0ovYhz8OlzDGzHWP"></div>
                        <?php if(!empty($errors) && !empty($errors['captcha_error'])): ?><p class="help-block"><?php echo $errors['captcha_error'] ?></p><?php endif; ?>

                        <div class="submit_btn">
                              <button type="Submit" class="btn btn-success btn-block" name="Submit">Submit</button>
                        </div>
                  </form>

            </div>
      </div>

</div>


<!----
Modal for uploading Member Passport Photo
---->
<div class="modal fade" id="member_upload_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding:5px;overflow-x:auto">
      <div class="modal-dialog" style="width:100%;max-width:600px;margin:10px auto;">
            <div class="modal-content">
                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h6 class="modal-title" id="myModalLabel">UPLOAD  PASSPORT PHOTO</h6>
                  </div>
                  <div class="modal-body">
                        <p class="help-block"></p>
                        <div id="member_image_editor" class="image-editor">
                              <input type="file" class="cropit-image-input" />
                              <div class="cropit-preview " style="<?php if(!empty($member_http_photo) || !empty($uploaded_member_photo)): ?>display:block<?php endif; ?>"></div>
                              <div class="image-size-label" style="<?php if(!empty($member_http_photo) || !empty($uploaded_member_photo)): ?>display:block<?php endif; ?>">
                                    <small>Drag image to desired position and/or use slider to resize</small><br/>
                              </div>
                              <div class="controls-wrapper" style="<?php if(!empty($member_http_photo) || !empty($uploaded_member_photo)): ?>display:block<?php else: ?>display:none<?php endif; ?>">
                                    <div>
                                          <span class="icone icone-rotate-left rotate-ccw-btn"></span>
                                          <span class="icone icone-rotate-right rotate-cw-btn"></span>
                                    </div>
                                    <input type="range" class="cropit-image-zoom-input" style="<?php if(!empty($member_http_photo) || !empty($uploaded_member_photo)): ?>display:block<?php endif; ?>">
                              </div>
                        </div>

                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="member_continue_upload">UPLOAD</button>
                  </div>
            </div>
      </div>
</div>
<!-- End of member upload modal  -->

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
                  
                  Designed by <a href="https://giftedbraintech.com">giftedbraintech</a>
            </div>
      </div>

</footer><!-- #footer -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
<script src="lib/jquery/jquery.min.js"></script>
<script src="lib/jquery/jquery-migrate.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="lib/bootbox/bootbox.min.js"></script>
<script src="lib/cropit/jquery.cropit.js"></script>
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
<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Template Main Javascript File -->
<script src="js/main.js?v=<?php echo time(); ?>"></script>
<!-- JavaScript Libraries -->

</body>
</html>
