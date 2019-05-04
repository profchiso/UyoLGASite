<?php
require_once 'services/help_file.php';
require_once 'db_connect.php';
require_once 'root_dir.php';
require_once 'url.php';
require_once 'EmailService.php';
session_start();
if($_POST) {
      $errors = array();
      $post_data=$_POST;
      if (!empty($post_data)) {
            $required_fields = array("surname" => "Surname", "othernames" => "Othernames", "gender" => "Gender", "date_of_birth" => "Date of Birth", "village" => "Village", "clan" => "Clan", "ward" => "Ward", "unit_number" => "Unit Number", "residential_address" => "Residential Addres", "current_address" => "Current Address", "phone_number" => "Phone Number", "email" => "Email", "primary_school" => "Primary School", "primary_year" => "Primary Year", "secondary_school" => "Seconday School", "secondary_year" => "Secondary Year", "higher_institution" => "Higher Institution", "higher_year" => "Higher Year", "area" => "Area of specialization", "professional" => "Professional Body", "employment_status" => "Employment Status" , "employee_name" => "Employee Name", "employee_address" => "Employee Address", "position" => "Position", "position_year" => "Year", "personal_message" => "Personal Message", "member_image_uploaded" => "Indigen Passport", "tos" => "Terms of service");

            $post_data=array_map('trim',$post_data);
            $post_data['email']=strtolower($post_data['email']);
            foreach ($required_fields as $field_key => $field_text) {
                  if (empty(($post_data[$field_key]))) {
                        $errors[$field_key] = "The " . $field_text . " field is required";
                  }
            }

            if (empty($errors)) {
                  if (!empty($post_data['email']) && !filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
                        $errors['email'] = 'Please enter a valid email address';
                  }
                  if (!empty($post_data['phone_number']) && (!is_numeric((string)$post_data['phone_number']) || strlen((string)$post_data['phone_number']) < 10)) {
                        $errors['phone_number'] = 'Please enter a valid phone number (at least 10 numeric characters)';
                  }
                  //if (!empty($post_data['password']) && !empty($post_data['cpassword']) && $post_data['password'] !== $post_data['cpassword']) {
                       // $errors['password'] = 'Passwords do not match';
                  //}
            }

            /***  Verify Captcha Security Check ****/
            if(empty($errors)){
                  $captcha_url='https://www.google.com/recaptcha/api/siteverify';
                  $publickey = "6Lepp2YUAAAAAK3p9QiLWfcO0ovYhz8OlzDGzHWP";
                  $privatekey = "6Lepp2YUAAAAAHKNrDa_-fEISRiTGsPee1a6jn0U";
                  $response=file_get_contents($captcha_url."?secret=".$privatekey."&response=".$post_data['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
                  $data= json_decode($response);
                  $security_passed=false;
                  if(isset($data->success) AND $data->success==true){
                        $security_passed=true;
                  }
                  if(!$security_passed){
                        $errors['captcha_error'] = "Please solve the captcha to continue";
                  }
            }

            /**** Uploading Passport Photo  ***/
            if (empty($errors)) {
                  if (!empty($post_data['member_image_uploaded'])) {
                        $image_location = APPLICATION_PATH . "/img/passport_images/" . sha1($post_data['email']) . ".jpg";
                        $image_url = $url . "img/passport_images/" . sha1($post_data['email']) . ".jpg";
                        $decoded = $post_data['member_image_uploaded'];
                        $data = explode(',', $decoded);
                        if (!empty($data[1])) {
                              try {
                                    file_put_contents($image_location, base64_decode($data[1]));
                              } catch (\Exception $e) {
                                    unset($data);
                                    return $errors['member_image_uploaded'] = 'A server error occurred while uploading Passport Photo!';
                              }
                        }
                        unset($data);
                        if (!is_file($image_location)) {
                              return $errors['member_image_uploaded'] = 'A server error occurred while uploading Passport Photo!';
                        }
                        $post_data['passport'] = $image_url;
                  }
            }

            /*** Checking if Email already Exists  ***/
            if(empty($errors)){
                  $stmt = $conn->prepare("SELECT * FROM indigene WHERE email=:email ");
                  $stmt->execute(array(':email' => $post_data['email']));
                  $check_row = $stmt->fetch(PDO::FETCH_ASSOC);

                  if (!empty($check_row)) {
                        $errors['email'] = 'Email address (<strong>' . $post_data['email'] . '</strong>) already exists';
                  }
            }

            /*** Submit/Insert User data to DB *****/
            if(empty($errors)) {
                  date_default_timezone_set('Africa/Lagos');
                  $unique_hash = sha1(uniqid(rand(), true));
                  //$post_data['password'] = sha1($post_data['password']);
                  $date_reg = date("Y-m-d H:i:s");
                  $user_query = "INSERT INTO indigene SET  surname='" . $post_data['surname'] . "', 
                        othernames='" . $post_data['othernames'] . "', gender='" . $post_data['gender'] . "', 
                        date_of_birth='" . $post_data['date_of_birth'] . "',village='" . $post_data['village'] . "',
                        clan='" . $post_data['clan'] . "',ward='" . $post_data['ward'] . "',unit_number='" . $post_data['unit_number'] . "',
                        residential_address='" . $post_data['residential_address'] . "',current_address='" . $post_data['current_address'] . "',phone_number='" . $post_data['phone_number'] . "',
                        email='" . $post_data['email'] . "',primary_school='" . $post_data['primary_school'] . "',primary_year='" . $post_data['primary_year'] . "',secondary_school='" . $post_data['secondary_school'] . "',secondary_year='" . $post_data['secondary_year'] . "',
                        higher_institution='" . $post_data['higher_institution'] . "', higher_year='" . $post_data['higher_year'] . "',area='" . $post_data['area'] . "',profissional='" . $post_data['profissional'] . "',
                        employment_status='" . $post_data['employment_status'] . "',employee_name='" . $post_data['employee_name'] . "', employee_address='" . $post_data['employee_address'] . "',position='" . $post_data['position'] . "',position_year='" . $post_data['position_year'] . "',personal_message='" . $post_data['personal_message'] . "',passport='" . $post_data['passport'] . "',indigene_id='" . $unique_hash . "', date_of_reg='".$date_reg."'";
                 try {
                       if ($conn->query($user_query)) {
                             $_SESSION['success']= "Your Registration was successful<br/>";
                             $_SESSION['user_id'] = $unique_hash;
                       } else {
                             $errors['email'] = "A server error occurred while submitting your Registration. <br/>Please refresh the page and try again later!";
                       }
                 }catch(Exception $e){
                       error_log($e->getMessage());
                 }

            }

            /***   Send Admin Notification Email if Request is Successful *****/
            if(!empty($_SESSION['success'])){
                  $email_data['message'] = '
					<div>
					     New Indigene Registration Recieved.<br />
					    <br />
					    <b>Name: &nbsp;</b>'.ucwords(strtolower($post_data['surname'])).' '.ucwords(strtolower($post_data['othernames'])).'
					    <br/><b>Email: &nbsp;</b>'.strtolower($post_data['email']).'
					    <br/><b>Phone Number: &nbsp;</b>'.$post_data['phone_number'].'
					    <br/><br/>Please click on the link below to view User Information:<br />
					    <a href="' . ($url) . 'admin/cert_request/view_user.php?user_id=' . (!empty($unique_hash)?$unique_hash:'') . '" >View User Information</a><br />
					    <br /><br/><br/>
					   
					    Thank You,
					    <br/>
					    Uyo LGA<br />
					</div>
					';

                  $result_obj = new Email();
                  $email_data = array_merge($email_data, array('to' => 'uyolga2018@gmail.com', 'subject' => 'Admin Notification Indigene Registration'));
                  $res=$result_obj->notifyAdmin($email_data);
                  header('Location:index.php');
                  exit();
            }

      }
}
