<?php
session_start();
require_once 'services/help_file.php';
//require_once 'db_connect.php';
require_once 'EmailService.php';

if(isset($_POST['send_msg'])){    
$servername="localhost";
$username="uyo_lga";
$password="uyolgaadmin";
$db="uyo_lga";  
//contact variables
      $name = $_POST['name'];
      $email = $_POST['email'];
      $subject = $_POST['subject'];
      $message= $_POST['message'];

try{

  $conn= new PDO("mysql:host=$servername;dbname=$db",$username,$password);

  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


  

       if(!empty($name) && !empty($email) && !empty($subject) && !empty($message)){
 
  $sql="INSERT INTO message(senders_name,email,subject,message)value('$name','$email','$subject','$message')";
$conn->exec($sql);
echo "<script> alert('Message sent. We will get back to you shortly!')</script>";
}else{
  echo "<script>alert('all field required')</script>";
}
 
}
catch(PDOException $e){
  echo $sql."<br/>".$e->getmessage();
}



}
/***   Send Admin Notification Email if Message Sent Successfully *****/
$conn=null;
 

                  //$email_data['message'] = '
         // <div>
             //  New Message From.<br />
             // <br />
              //<b>Name: &nbsp;</b>'.ucwords(strtolower($name)).'
              //<br/><b>Email: &nbsp;</b>'.strtolower($email).'
              //<br/><b>Subject: &nbsp;</b>'.$subject.'
               /*<br/><b>Subject: &nbsp;</b>'.$message.'
              <br/><br/>
              <br />
             
              Thank You,
              <br/>
              Uyo LGA<br />
          </div>
          ';

                  $result_obj = new Email();
                  $email_data = array_merge($email_data, array('to' => 'uyolga2018@gmail.com', 'subject' => 'Admin Notification for New Cantact Message'));
                  $res=$result_obj->notifyAdmin($email_data);
                  header('Location:index.php');
                  exit();*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>UyoLGA | Home</title>
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
  <link href="css/style.css?v=<?php echo time(); ?>" rel="stylesheet">

  
</head>

<body>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container-fluid">

      <div id="logo" class="pull-left">
       <!-- <h1><a href="#intro" class="scrollto">Uyo LGA</a> <h5 style="color: white;"> <i class="icon-calendar icon-large" style="color: white;"></i>  <span class="glyphicon glyphicon-calendar glyphicon-large calendar-large" style="color: white;"></span>-->


       	<a href="#intro"><img src="img/uyo.png" alt="" title="" width="100px" height="100px"   /></a>

										<h6 style="color: green;">
                                        <?php
                                        date_default_timezone_set('Africa/Lagos');
                                        $new = date('l-d-m-Y');//, strtotime($Today));
                                        echo $new;
                                        ?>
                                        </h6>
        
        
      </div>

      <!--nav Bar starts-->

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#intro">Home</a></li>
          <li><a href="#news">News</a></li>



          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Photo Gallery</a></li>
          <li><a href="#team">Officers</a></li>
          <li><a href="#contact">Contact</a></li>

          <li class="menu-has-children"><a href="">Registrations</a>
            <ul>
              <li><a href="lga_cert_request">Request for LGA Certificate</a></li>
              <li><a href="indigene_reg.php">Register as an indigene</a></li>
              <!--<li><a href="Computer_skill_reg.php">Register for Computer Training</a></li>-->
              <!--<li><a href="payment.php">Make Payment Online</a></li>-->
              <li><a href="login.php">Print LGA Cert.</a></li>
            </ul>
          </li>
          
        </ul>
      </nav><!-- #nav-menu-container -->
<!--Nav Bar end-->


    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
<!--Slide carousel start-->

  <section id="intro">
    <div class="intro-container">
      <div id="introCarousel" class="carousel  slide carousel-fade" data-ride="carousel">

        <ol class="carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">


        	<div class="carousel-item active">
            <div class="carousel-background"><img src="img/intro-carousel/he.png" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Our Working Governor</h2>
                <h3>HE Udom Emmanuel</h3>
                
              </div>
            </div>
          </div>





          <div class="carousel-item ">
            <div class="carousel-background"><img src="img/intro-carousel/1.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Ibom Specialist Hospital</h2>
                
                
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/intro-carousel/2.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Uyo LGA Chairman's Office</h2>
                
                
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/intro-carousel/leg.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Legislative Building</h2>
                
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/intro-carousel/3.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Finance Building</h2>       
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/intro-carousel/4.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Works Department</h2>
                
                
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="carousel-background"><img src="img/intro-carousel/5.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2>Education Department</h2>
                
                
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#introCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon ion-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#introCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon ion-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </section><!-- #intro -->


  <!-- Slide carousel end-->

  <main id="main">




<!--News section starts-->

<section id="news">
      <div class="container">
        <br><br>

        <header class="section-header wow fadeInUp">
          <h3>News And Happenings</h3>
          <p>GET INFORMED <span class="glyphicon glyphicon-info-sign"></span></p>
        </header>

        <div class="row">

          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title"><a href="">Indigene Registration</a></h4>
            <p class="description">All indigene of uyo lga can access our website any where in the world and fill their indigene registration form</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="">Continous Voter Registration</a></h4>
            <p class="description">This service is currently unavailable online. members of the public are adivce to visit the local government council at<b>NO 1 Uyo village road Uyo</b> to enrol for their voters registration.</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="">NIMS Enrolment</a></h4>
            <p class="description">The enrolment into the National Identity Management system is also ongoing in  Uyo local governmnet council.</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Computer Skill Acquisation Enrolment</a></h4>
            <p class="description">indigene of uyo who wishes to acquire computer skills can now register on our site and make the necessary payments</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Local Government of Orign Certificate</a></h4>
            <p class="description">This service is currently accessible on this website. indigenes are advice to enrol and get their <b>Origin Certificate </b> online.Note after online enrolment and payment, the Admin will verify the correctness of the indigenes details before he/she can be able to print it online. And it takes a maximum of one week </p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Marriage Registration</a></h4>
            <p class="description">This service is currently available in the councils headquaters @ <b>NO1 Uyo village road Uyo</b></p>
          </div>

        </div>

      </div>
    </section>
    <!--News section end-->

    <!--==========================
      About Us Section Starts
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Brief History Of Uyo LGA</h3>
          <p>Uyo local government is  one out of the 31 local government in Akwaibom State of Nigeria. we house the state capital and almost all the state ministrys and parastertals</p>
        </header>

        <div class="row about-cols">

          <div class="col-md-4 wow fadeInUp">
            <div class="about-col">
              <div class="img">
                <img src="img/about-mission.jpg" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
              </div>
              <h2 class="title"><a href="#">Our Mission</a></h2>
              <p>
                Uyo Local government of Akwaibom State Nigeria want to be the best local government in Nigeria before the year 2010
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
            <div class="about-col">
              <div class="img">
                <img src="img/about-plan.jpg" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-list-outline"></i></div>
              </div>
              <h2 class="title"><a href="#">Our Plan</a></h2>
              <p>
                    Uyo Local government of Akwaibom State Nigeria want to be the best local government in Nigeria before the year 2010
              </p>
            </div>
          </div>

          <div class="col-md-4 wow fadeInUp" data-wow-delay="0.2s">
            <div class="about-col">
              <div class="img">
                <img src="img/about-vision.jpg" alt="" class="img-fluid">
                <div class="icon"><i class="ion-ios-eye-outline"></i></div>
              </div>
              <h2 class="title"><a href="#">Our Vision</a></h2>
              <p>
                    Uyo Local government of Akwaibom State Nigeria want to be the best local government in Nigeria before the year 2020
              </p>
            </div>
          </div>

        </div>

      </div>
    </section>



    <!-- about us section ends -->

    <!--==========================
      Services Section starts
    ============================-->
    <section id="services">
      <div class="container">

        <header class="section-header wow fadeInUp">
          <h3>Our Services</h3>
          <p>We offer the following services</p>
        </header>

        <div class="row">

          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-analytics-outline"></i></div>
            <h4 class="title"><a href="">Indigene Registration</a></h4>
            <p class="description">All indigene of uyo lga can access our website any where in the world in fill their indigene registration form</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-bookmarks-outline"></i></div>
            <h4 class="title"><a href="">Continous Voters registration</a></h4>
            <p class="description">This service is currently unavailable online. members of the public are adivce to visit the local government council at<b>NO 1 Willington road Uyo</b> to enrol for their voters registration.</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-paper-outline"></i></div>
            <h4 class="title"><a href="">NIMS Enrolment</a></h4>
            <p class="description">The enrolment into the National Identity Management system is also ongoing in the Uyo local governmnet council.</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-speedometer-outline"></i></div>
            <h4 class="title"><a href="">Computer Skill Acquisation Enrolment</a></h4>
            <p class="description">indigene of uyo who wishes to acquire computer skills can now register on our site and make the necessary payments</p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-barcode-outline"></i></div>
            <h4 class="title"><a href="">Local government of Orign Certificate</a></h4>
            <p class="description">This service is currently accessible on this website. indigenes are advice to enrol and get their <b>Origin Certificate </b> online.Note after online enrolment and payment, the Admin will verify the correctness of the indigenes details before he/she can be able to print it online. And it takes a maximum of two working days </p>
          </div>
          <div class="col-lg-4 col-md-6 box wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="icon"><i class="ion-ios-people-outline"></i></div>
            <h4 class="title"><a href="">Marriage Registration</a></h4>
            <p class="description">This service is currently available in the councils headquaters @ <b>NO1 Willington road Uyo</b></p>
          </div>

        </div>

      </div>
    </section>
    <!-- #services Section end -->
    <!--==========================
      Photo gallery Section starts
    ============================-->
    <section id="portfolio"  class="section-bg" >
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Our Gallery</h3>
        </header>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
             
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/1.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/1.jpg" data-lightbox="portfolio" data-title="Ibom Specialist Hospital" class="link-preview" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Ibom Specialist Hospital</a></h4>
               
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/2.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/2.jpg" class="link-preview" data-lightbox="portfolio" data-title="Chairmans office" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Uyo LGA Chairmans office</a></h4>
                
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/3.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Legislative Building" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Legislative Building</a></h4>
                <p>Uyo LGA</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/4.png" class="img-fluid" alt="">
                <a href="img/portfolio/4.png" class="link-preview" data-lightbox="portfolio" data-title="Our Governor" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Our Governor</a></h4>
                <p>He Excellency Udom Emmanuel</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/5.png" class="img-fluid" alt="">
                <a href="img/portfolio/5.png" class="link-preview" data-lightbox="portfolio" data-title="our logo" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Our Logo</a></h4>
                
              </div>
            </div>
          </div>

          <!--<div class="col-lg-4 col-md-6 portfolio-item filter-app wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/app3.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/app3.jpg" class="link-preview" data-lightbox="portfolio" data-title="App 3" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">App 3</a></h4>
                <p>App</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/card1.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/card1.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 1" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Card 1</a></h4>
                <p>Card</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card wow fadeInUp" data-wow-delay="0.1s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/card3.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/card3.jpg" class="link-preview" data-lightbox="portfolio" data-title="Card 3" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Card 3</a></h4>
                <p>Card</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web wow fadeInUp" data-wow-delay="0.2s">
            <div class="portfolio-wrap">
              <figure>
                <img src="img/portfolio/web1.jpg" class="img-fluid" alt="">
                <a href="img/portfolio/web1.jpg" class="link-preview" data-lightbox="portfolio" data-title="Web 1" title="Preview"><i class="ion ion-eye"></i></a>
                <a href="#" class="link-details" title="More Details"><i class="ion ion-android-open"></i></a>
              </figure>

              <div class="portfolio-info">
                <h4><a href="#">Web 1</a></h4>
                <p>Web</p>
              </div>
            </div>
          </div>-->

        </div>

      </div>
    </section>


    <!-- #Photo gallery ends -->

   
    
    <!--==========================
     Officers section start
    ============================-->
    <section id="team">
      <div class="container">
        <div class="section-header wow fadeInUp">
          <h3>our Amiable Leaders</h3>
          <p>Before you are th leaders of Uyo Local Government Area council</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 wow fadeInUp">
            <div class="member">
              <img src="img/team-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>HON. Imoh A. Okon</h4>
                  <span>Executive Chairman</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="member">
              <img src="img/team-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Hon.....</h4>
                  <span>Vice Chairman</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
            <div class="member">
              <img src="img/team-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>MRS.....</h4>
                  <span>Head of service</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
            <div class="member">
              <img src="img/team-4.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Mr.....    </h4>
                  <span>Legislative Head</span>
                  <div class="social">
                    <a href=""><i class="fa fa-twitter"></i></a>
                    <a href=""><i class="fa fa-facebook"></i></a>
                    <a href=""><i class="fa fa-google-plus"></i></a>
                    <a href=""><i class="fa fa-linkedin"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>

    <!-- #Officers section ends -->




<!--==========================
      Head of Dept Section starts
    ============================-->
    <section id="testimonials" class="section-bg wow fadeInUp">
      <div class="container">

        <header class="section-header">
          <h3>Other Leaders</h3>
        </header>

        <div class="owl-carousel testimonials-carousel">

          <div class="testimonial-item">
            <img src="img/testimonial-1.jpg" class="testimonial-img" alt="">
            <h3>Mr.....</h3>
            <h4>head works department</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              <!--brief happenings in the department-->
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-2.jpg" class="testimonial-img" alt="">
            <h3>Mr....</h3>
            <h4>head finance department</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              <!--brief happenings in the department-->
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-3.jpg" class="testimonial-img" alt="">
            <h3>mr......</h3>
            <h4>head admin department</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              <!--brief happenings in the department-->
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-4.jpg" class="testimonial-img" alt="">
            <h3>mr.....</h3>
            <h4>Head education department</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              <!--brief happenings in the department-->
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

          <div class="testimonial-item">
            <img src="img/testimonial-5.jpg" class="testimonial-img" alt="">
            <h3>mr....</h3>
            <h4>head open registry</h4>
            <p>
              <img src="img/quote-sign-left.png" class="quote-sign-left" alt="">
              <!--brief happenings in the department-->
              <img src="img/quote-sign-right.png" class="quote-sign-right" alt="">
            </p>
          </div>

        </div>

      </div>
    </section>

    <!-- #Head of departments ends -->


    <!--==========================
      Contact Section starts
    ============================-->
    <section id="contact" class="section-bg wow fadeInUp">
      <div class="container">


        <div class="section-header">
          <h3>Contact Us</h3>
          <p>You can contact us using the following means</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>No 1, Uyo Village road AkwaIbom state Uyo</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+23436009397">+2348036009397</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@uyolga.gov.ng">info@uyolga.gov.ng</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessage"></div>
          <h6 class="text-center" style="color: red; ">Note All contact field are Required</h6>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" id="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit" name="send_msg" id="send_msg">Send Message</button></div>
          </form>
        </div>

      </div>
    </section>
    <!-- #contact section ends -->

  </main>

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
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Home</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">About us</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Services</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="ion-ios-arrow-right"></i> <a href="#">Privacy policy</a></li>
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
        Designed by <a href="https://giftedbraintech.com">giftedbraintech</a>
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



  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <!--<script src="contactform/contactform.js"></script>-->

  <!-- Template Main Javascript File -->
  <script src="js/main.js?v=<?php echo time(); ?>"></script>

</body>
</html>
