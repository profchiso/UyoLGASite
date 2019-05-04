
<?php

$surnameErr = $othernamesErr=$genderErr= $date_of_birthErr=$residential_addressErr=$phone_numberErr=$emailErr=$levelErr=$interestErr=$passportErr=$tosErr="";

$target_dir="Uploads/";
$targ_file=$target_dir.basename($_FILES["passport"]["name"]);

$Uploadok=1;
$_imageFileType=strtolower(pathinfo($targ_file,PATHINFO_EXTENSION));

if($_SERVER["REQUEST_METHOD"]=="POST"){

if (empty($_POST["email"])) {
  $emailErr="Email address required";
}else{

    $email=test_input($_POST["email"]);

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

             $emailErr="Invalid Email";
    }


    }

    if(empty($_POST["surname"])){

      $passwordErr="Surname required";

    }else{
      $surname=test_input($_POST["surname"]);

        if(!preg_match("/^[a-zA-Z]*$/",$surname)){
          $surnameErr="only letters and white space are allowed";

        }

    }
      if(empty($_POST["othernames"])){

      $othernamesErr="othernames required";

    }else{
      $othernames=test_input($_POST["othernames"]);

        if(!preg_match("/^[a-zA-Z]*$/",$othernames)){
          $othernamesErr="only letters and white space are allowed";

        }

    }
     if(empty($_POST["gender"])){

      $genderErr="you must a gender";

    }else{

      $gender=test_input($_POST["gender"]);
    }

    if(isset($_POST["date_of_birth"]) && strtotime($_POST["date_of_birth"])){
      $dateErr[]="Birth date cannot be blank";
    }


 if(empty($_POST["residential_address"])){

      $residential_addressErr="Residential address required";

    }else{
      $residential_address=test_input($_POST["residential_address"]);

        if(!preg_match("/^[a-zA-Z]*$/",$residential_address)){
          $residential_addressErr="only letters and white space are allowed";

        }

    }

    if(empty($_POST["phone_number"])){

      $phone_numberErr="phone number required";

    }else{
      $phone_number=test_input($_POST["phone_number"]);

        if(!preg_match("/^[0-9]{3}-[0-9]{3}[0-9]{4}$/",$phone_number)){
          $phone_numberErr="only numbers allowed";

        }

    }

    if(empty($_POST["level"])){

      $levelErr="you must select your level in computer";

    }else{

      $level=test_input($_POST["level"]);
    }

    if(empty($_POST["interest"])){

      $interestErr="please choose your interest";

    }else{

      $interest=test_input($_POST["interest"]);
    }



$check=getimagesize($_FILES["passport"]["tmp_name"]);
if($check!=false){

  $Uploadok=1;
}else{

  $Uploadok=0;
}
if(file_exists($targ_file)){

$passportErr="sorry file already exit!";
$Uploadok=0;
}
if($_FILES["passport"]["size"]>500000){


$passportErr="sorry file too large";
$Uploadok=0;

}
if($_imageFileType !="jpg" && $_imageFileType !="png" && $_imageFileType !="jpeg" && $_imageFileType !="gif"){



  $passportErr="sorry only JPG,PNG,JPEG,GIF Files are allowed";
  $Uploadok=0;
}
if($Uploadok==0){

$passportErr="sorry the passport was not uploaded";

}else{

  if(move_uploaded_file($_FILES["passport"] ["tmp_name"],$targ_file)){


                  }else{

                    $passportErr="error uploading passport";
        }

    } 







    if(empty($_POST["tos"])){

      $tosErr="you must agree with terms of service";

    }else{

      $tos=test_input($_POST["tos"]);
    }
}


function test_input($data){

  $data=trim($data);
  $data=stripcslashes($data);
  $data=htmlspecialchars($data);

  return $data;
}

?>









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>UyoLGA | Comp. Training Reg</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

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
  <link href="css/style.css" rel="stylesheet">
  <link href="css/form.css" rel="stylesheet">

  
</head>

<body class="bg-dark">

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

     
      <!--nav Bar starts-->

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.php">Home</a></li>
         
          
        </ul>
      </nav><!-- #nav-menu-container -->
<!--Nav Bar end-->


    </div>
  </header><!-- #header -->

  




<div class="card card-register mx-auto mt-5">
      <div class="card-header">Computer Skill Acquisation Form <i style="color: red;">(All Fields with Asteriks must be filled)</i></div>
      <div class="card-body">
        <form  method="post" enctype="multipart/form-data" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Surname <b style="color: red;">*</b></label>
                <input class="form-control" id="surname" type="text" aria-describedby="nameHelp"  name="surname" value="<?php echo $surname; ?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Othernames <b style="color: red;">*</b></label>
                <input class="form-control" id="othernames" type="text" aria-describedby="nameHelp"  name="othernames"  value="<?php echo $othernames; ?>">
              </div>
            </div>
          </div>



          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Gender <b style="color: red;">*</b></label>

            <label><input type="radio" name="gender" value="Male" <?php echo (!empty($post_data['gender']) && strtolower($post_data['gender'])==="male")?'checked="checked"':'' ?> > Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

           <label><input type="radio" name="gender" value="Female" <?php echo (!empty($post_data['gender']) && strtolower($post_data['gender'])==="female")?'checked="checked"':'' ?>> Female</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <?php if(!empty($errors) && !empty($errors['gender'])): ?><p class="help-block"><?php echo $errors['gender'] ?></p><?php endif; ?>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Date Of Birth <b style="color: red;">*</b></label>
                <input class="form-control" id="date_of_birth" type="Date" aria-describedby="nameHelp"  name="date_of_birth"  value="<?php echo $date_of_birth; ?>">
              </div>
            </div>
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Residential Address <b style="color: red;">*</b></label>
            <input class="form-control" id="residential_address" type="text" aria-describedby="emailHelp" name="residential_address"  value="<?php echo $residential_address; ?>">
          </div>
         


          <div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Phone Number <b style="color: red;">*</b></label>
                <input class="form-control" id="phone_number" type="text" aria-describedby="phoneHelp" name="phone_number"  value="<?php echo $phone_number; ?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName"> Email address</label>
                <input class="form-control" id="email" type="text" aria-describedby="nameHelp"  name="email"  value="<?php echo $email; ?>">
              </div>
            </div>
          </div>

         
<div class="form-group">
            <label for="exampleInputEmail1" style="color: blue;">Level in computer skill <b style="color: red;">*</b></label>
 
            <label><input type="radio" name="level" value="Beginner"> Beginner</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

           <label><input type="radio" name="level" value="Intermediate">Intermediate</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <label><input type="radio" name="level" value="Advanced">Advanced</label>

          </div>




<div class="form-group">
            <div class="form-row">

              <div class="col-md-6">
                <label for="exampleInputName">Area of interest <b style="color: red;">*</b></label>
                
              </div>
              <div class="col-md-6">
                
                <select name="area_of_interest">
             <option>Computer Appreciation</option> 
              <option>Computer Repairs</option> 
              <option>Computer Networking</option>
              <option>Web Development</option>


            </select>

              </div>
            </div>
          </div>







           <div class="form-group">
            <label for="passport">Upload Passport<b style="color: red;">*</b></label>
            <input class="form-control" id="passport" type="file" aria-describedby="passportHelp" placeholder="No file" name="passport"  value="<?php echo $passport; ?>">
          </div>

          <div class="form-group">
            <label for="tos" style="color: red;"><input type="checkbox" name="tos" id="tos" value="YES"> I here by agree that the information above is true to the best of my knowledge</label>
            
          </div>

<div><button type="Submit" class="btn btn-success btn-block" name="Submit">Register</button></div>

          <!--<a class="btn btn-primary btn-block" href="login.php">Register</a>-->
        </form>
        <!--<div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          <a class="d-block small" href="index.php">HomePage?</a>
        </div>-->
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
              <!--<li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>-->
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

         <!-- <div class="col-lg-3 col-md-6 footer-newsletter">
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
  <script src="js/main.js"></script>

</body>
</html>
