<?php if(stripos($_SERVER['HTTP_HOST'], '127.0.0.1') !== FALSE ||stripos($_SERVER['HTTP_HOST'],'localhost')!==false) {
      define('IS_LOCAL', true);
}else {
      define('IS_LOCAL', false);
}


require_once 'indigene_reg_process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>UyoLGA | Indigene Reg</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <!--<base href="../" />-->

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

<body class="bg-dark indigene_reg">

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

  




<div class="card card-register mx-auto mt-5">
      <div class="card-header text-center"><b>Indigene Registration Form</b> <i style="color: red;">(All Fields with Asteriks must be filled)</i></div>
      <div class="card-body">

                   <?php if(!empty($errors)): ?>
                        <div class="form-group">
                              <div class="alert alert-dismissable alert-danger text-center" >
                                    Error(s) occurred processing your requests, Please fix your error(s) and try again
                              </div><br/>
                        </div>
                  <?php endif; ?>

        <form method="post" enctype="multipart/form-data" action="" class="indigene_reg_form" id="indigene_reg_form">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Surname <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['surname'])?'error':''?>"" id="surname" type="text" aria-describedby="nameHelp"  name="surname" value="<?php echo !empty($post_data['surname'])?$post_data['surname']:''; ?>">
                    <?php if(!empty($errors) && !empty($errors['surname'])): ?><p class="help-block"><?php echo $errors['surname'] ?></p><?php endif; ?>


              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Othernames <b style="color: red;">*</b></label>
                <input class="form-control<?php echo !empty($errors['othernames'])?'error':''?>"" id="othernames" type="text" aria-describedby="nameHelp" name="othernames" value="<?php echo !empty($post_data['othernames'])?$post_data['othernames']:''; ?>">

               <?php if(!empty($errors) && !empty($errors['othernames'])): ?><p class="help-block"><?php echo $errors['othernames'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>



          <div class="form-group">
            <div class="form-row">
               <div class="col-md-6">
                      <label for="exampleInputName">Gender <b style="color: red;">*</b></label> &nbsp;&nbsp;&nbsp;&nbsp;

                  <label><input type="radio" name="gender" id="gender" value="Male" <?php echo (!empty($post_data['gender']) && strtolower($post_data['gender'])==="male")?'checked="checked"':'' ?> > Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <label><input type="radio" name="gender" id="gender" value="Female" <?php echo (!empty($post_data['gender']) && strtolower($post_data['gender'])==="female")?'checked="checked"':'' ?>> Female</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                      <?php if(!empty($errors) && !empty($errors['gender'])): ?><p class="help-block"><?php echo $errors['gender'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Date Of Birth <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['date_of_birth'])?'error':''?>"" id="date_of_birth" type="Date" aria-describedby="nameHelp" name="date_of_birth" value="<?php echo !empty($post_data['date_of_birth'])?$post_data['date_of_birth']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['date_of_birth'])): ?><p class="help-block"><?php echo $errors['date_of_birth'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>

<div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Village <b style="color: red;">*</b></label>
                <input class="form-control<?php echo !empty($errors['village'])?'error':''?>"" id="village" type="text" aria-describedby="phoneHelp" name="village" value="<?php echo !empty($post_data['village'])?$post_data['village']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['village'])): ?><p class="help-block"><?php echo $errors['village'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Clan <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['clan'])?'error':''?>"" id="clan" type="text" aria-describedby="nameHelp" name="clan" value="<?php echo !empty($post_data['clan'])?$post_data['clan']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['clan'])): ?><p class="help-block"><?php echo $errors['clan'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Ward <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['ward'])?'error':''?>"" id="ward" type="text" aria-describedby="phoneHelp"  name="ward" value="<?php echo !empty($post_data['ward'])?$post_data['ward']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['ward'])): ?><p class="help-block"><?php echo $errors['ward'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Unit Number <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['unit_number'])?'error':''?>"" id="unit_number" type="text" aria-describedby="nameHelp" name="unit_number" value="<?php echo !empty($post_data['unit_number'])?$post_data['unit_number']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['unit_number'])): ?><p class="help-block"><?php echo $errors['unit_number'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Residential Address <b style="color: red;">*</b></label>
            <input class="form-control <?php echo !empty($errors['residential_address'])?'error':''?>"" id="residential_address" type="text" aria-describedby="emailHelp"  name="residential_address" value="<?php echo !empty($post_data['residential_address'])?$post_data['residential_address']:''; ?>">

            <?php if(!empty($errors) && !empty($errors['residential_address'])): ?><p class="help-block"><?php echo $errors['residential_address'] ?></p><?php endif; ?>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Current Address <b style="color: red;">*</b></label>
            <input class="form-control <?php echo !empty($errors['current_address'])?'error':''?>"" id="current_address" type="text" aria-describedby="emailHelp"  name="current_address" value="<?php echo !empty($post_data['current_address'])?$post_data['current_address']:''; ?>">

            <?php if(!empty($errors) && !empty($errors['current_address'])): ?><p class="help-block"><?php echo $errors['current_address'] ?></p><?php endif; ?>
          </div>


          <div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Phone Number <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['phone_number'])?'error':''?>"" id="phone_number" type="text" aria-describedby="phoneHelp"  name="phone_number" value="<?php echo !empty($post_data['phone_number'])?$post_data['phone_number']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['phone_number'])): ?><p class="help-block"><?php echo $errors['phone_number'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName"> Email address <b style="color: red;">*</b></label>
                <input class="form-control <?php echo !empty($errors['email'])?'error':''?>"" id="email" type="text" aria-describedby="nameHelp"  name="email" value="<?php echo !empty($post_data['email'])?$post_data['email']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['email'])): ?><p class="help-block"><?php echo $errors['email'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>

         
<div class="form-group">
            <label for="exampleInputEmail1" style="color: blue;">Academic Record </b></label>
            
 <div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Primary School Attended <b style="color: red;"></b></label>
                <input class="form-control <?php echo !empty($errors['primary_school'])?'error':''?>"" id="primary_school" type="text" aria-describedby="phoneHelp" name="primary_school" value="<?php echo !empty($post_data['primary_school'])?$post_data['primary_school']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['primary_school'])): ?><p class="help-block"><?php echo $errors['primary_school'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Year of Graduation</label>
                <input class="form-control <?php echo !empty($errors['primary_year'])?'error':''?>"" id="primary_year" type="text" aria-describedby="nameHelp" name="primary_year" value="<?php echo !empty($post_data['primary_year'])?$post_data['primary_year']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['primary_year'])): ?><p class="help-block"><?php echo $errors['primary_year'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>

<div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Secondary School Attended <b style="color: red;"></b></label>
                <input class="form-control <?php echo !empty($errors['secondary_school'])?'error':''?>"" id="secondary_school" type="text" aria-describedby="phoneHelp" name="secondary_school" value="<?php echo !empty($post_data['secondary_school'])?$post_data['secondary_school']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['secondary_school'])): ?><p class="help-block"><?php echo $errors['secondary_school'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Year of Graduation</label>
                <input class="form-control <?php echo !empty($errors['secondary_year'])?'error':''?>"" id="secondary_year" type="text" aria-describedby="nameHelp" name="secondary_year" value="<?php echo !empty($post_data['secondary_year'])?$post_data['secondary_year']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['secondary_year'])): ?><p class="help-block"><?php echo $errors['secondary_year'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>

<div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Higher Institution Attended </b></label>
                <input class="form-control <?php echo !empty($errors['higher_institution'])?'error':''?>"" id="higher_institution" type="text" aria-describedby="phoneHelp"name="higher_institution" value="<?php echo !empty($post_data['higher_institution'])?$post_data['higher_institution']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['higher_institution'])): ?><p class="help-block"><?php echo $errors['higher_institution'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Year of Graduation</label>
                <input class="form-control <?php echo !empty($errors['higher_year'])?'error':''?>"" id="higher_year" type="text" aria-describedby="nameHelp" name="higher_year" value="<?php echo !empty($post_data['higher_year'])?$post_data['higher_year']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['higher_year'])): ?><p class="help-block"><?php echo $errors['higher_year'] ?></p><?php endif; ?>
              </div>
            </div>
          </div>

      </div>


<div class="form-group">
            <label for="exampleInputEmail1">Area of specialization</b></label>
            <input class="form-control" id="area" type="text" aria-describedby="passportHelp" name="area" value="<?php echo !empty($post_data['area'])?$post_data['area']:''; ?>">

            <?php if(!empty($errors) && !empty($errors['area'])): ?><p class="help-block"><?php echo $errors['area'] ?></p><?php endif; ?>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Professional Body belonged to</label>
            <input class="form-control <?php echo !empty($errors['professional'])?'error':''?>"" id="professional" type="text" aria-describedby="passportHelp"  name="professional" value="<?php echo !empty($post_data['professional'])?$post_data['professional']:''; ?>">

            <?php if(!empty($errors) && !empty($errors['professional'])): ?><p class="help-block"><?php echo $errors['professional'] ?></p><?php endif; ?>
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1" style="color: blue;">Empolyment Status <b style="color: red;">*</b></label>
 
            <label><input type="radio" name="empolyment_status" id="empolyment_status" value="Employed" <?php echo (!empty($post_data['empolyment_status']) && strtolower($post_data['empolyment_status'])==="employed")?'checked="checked"':'' ?> > Employed</label>
           <label><input type="radio" name="empolyment_status" id="empolyment_status" value="Not_Employed"  <?php echo (!empty($post_data['empolyment_status']) && strtolower($post_data['empolyment_status'])==="not employed")?'checked="checked"':'' ?> >  Not Employed</label>

            <?php if(!empty($errors) && !empty($errors['empolyment_status'])): ?><p class="help-block"><?php echo $errors['empolyment_status'] ?></p><?php endif; ?>






          </div>



 <div class="form-group">
            <label for="exampleInputEmail1" style="color: blue;">If Employed, Employee Details <b style="color: red;"></b></label>

<div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Employee Name </b></label>
                <input class="form-control <?php echo !empty($errors['employee_name'])?'error':''?>"" id="employee_name" type="text" aria-describedby="phoneHelp"  name="employee_name" value="<?php echo !empty($post_data['employee_name'])?$post_data['employee_name']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['employee_name'])): ?><p class="help-block"><?php echo $errors['employee_name'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName"> Employee Address</label>
                <input class="form-control <?php echo !empty($errors['employee_address'])?'error':''?>"" id="employee_address" type="text" aria-describedby="nameHelp"  name="employee_address" value="<?php echo !empty($post_data['employee_address'])?$post_data['employee_address']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['employee_address'])): ?><p class="help-block"><?php echo $errors['employee_address'] ?></p><?php endif; ?>


              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Position</b></label>
                <input class="form-control <?php echo !empty($errors['position'])?'error':''?>"" id="position" type="text" aria-describedby="phoneHelp" name="position" value="<?php echo !empty($post_data['position'])?$post_data['position']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['position'])): ?><p class="help-block"><?php echo $errors['position'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName"> Year</label>
                <input class="form-control <?php echo !empty($errors['position_year'])?'error':''?>"" id="position_year" type="text" aria-describedby="nameHelp"  name="position_year" value="<?php echo !empty($post_data['position_year'])?$post_data['position_year']:''; ?>">

                <?php if(!empty($errors) && !empty($errors['position_year'])): ?><p class="help-block"><?php echo $errors['position_year'] ?></p><?php endif; ?>


                
              </div>
            </div>
          </div>



</div>
          <div class="form-group">
            <div class="form-row">
                <div class="personal_message_label">
                      <label for="exampleInputName">Personal Message/Introduction <b style="color: red;">*</b></label>
                </div>
                <div class="col-xs-12 personal_message_field">
                      <textarea  class=" <?php echo !empty($errors['personal_message'])?'error':'' ?>" name="personal_message" ><?php echo !empty($post_data['personal_message'])?$post_data['personal_message']:''; ?></textarea>
                      <?php if(!empty($errors) && !empty($errors['personal_message'])): ?><p class="help-block"><?php echo $errors['personal_message'] ?></p><?php endif; ?>
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
            <label for="tos" style="color: green;"><input type="checkbox" name="tos"  id="tos" value="YES" <?php echo (!empty($post_data['tos']) && $post_data['tos']==="YES")?'checked="checked"':''; ?>> I hereby agree that the information above is true to the best of my knowledge</label>
          </div>
            <?php if(!empty($errors) && !empty($errors['tos'])): ?><p class="help-block"><?php echo $errors['tos'] ?></p><?php endif; ?>
          </div>

           <div class="g-recaptcha captcha_frame <?php echo (!empty($errors['captcha_error'])?'error':''); ?>" data-sitekey="6Lepp2YUAAAAAK3p9QiLWfcO0ovYhz8OlzDGzHWP"></div>
                        <?php if(!empty($errors) && !empty($errors['captcha_error'])): ?><p class="help-block"><?php echo $errors['captcha_error'] ?></p><?php endif; ?>

                <div class="submit_btn"><button type="Submit" class="btn btn-success btn-block submit_btn" name="Submit">Submit</button>
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
    <!--</div>-->

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

  <!-- JavaScript Libraries -->
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

</body>
</html>
