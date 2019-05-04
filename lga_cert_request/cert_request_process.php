<?php
require_once '../services/help_file.php';
require_once '../db_connect.php';
require_once '../root_dir.php';
require_once '../url.php';
require_once '../EmailService.php';
session_start();
if($_POST) {
      $errors = array();
      $post_data=$_POST;
      if (!empty($post_data)) {
            $required_fields = array("surname" => "Last Name", "password" => "Password", "confirm_password" => "Confirm Password", "othernames" => "Other Names", "email" => "Email", "phone_number" => "Phone Number", "village" => "Village Name", "clan" => "Clan", "ward" => "Ward", "current_address" => "Current Address", "village_head" => "Village Head", "village_head_phone_number" => "Village Head Phone Number", "clan_head" => "Clan Head", "clan_head_phone" => "Clan Head Phone Number", "card_id_number" => "Card ID Number", "tax_id_number" => "Tax ID Number", "reason_for_request" => "Reason For Request", "member_image_uploaded" => "Passport Photo", "gender" => "Gender", "identification" => "Mode Of Identification", "tos" => "Terms and Condition");

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
                  if (!empty($post_data['password']) && !empty($post_data['cpassword']) && $post_data['password'] !== $post_data['cpassword']) {
                        $errors['password'] = 'Passwords do not match';
                  }
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
                  $stmt = $conn->prepare("SELECT * FROM lga_cert_request WHERE email=:email ");
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
                  $post_data['password'] = sha1($post_data['password']);
                  $date_requested = date("Y-m-d H:i:s");
                  $user_query = "INSERT INTO lga_cert_request SET  surname='" . $post_data['surname'] . "', 
                        othernames='" . $post_data['othernames'] . "', gender='" . $post_data['gender'] . "', 
                        phone_number='" . $post_data['phone_number'] . "',village='" . $post_data['village'] . "',
                        clan='" . $post_data['clan'] . "',ward='" . $post_data['ward'] . "',current_address='" . $post_data['current_address'] . "',
                        email='" . $post_data['email'] . "',password='" . $post_data['password'] . "',village_head='" . $post_data['village_head'] . "',
                        village_head_phone_number='" . $post_data['village_head_phone_number'] . "',clan_head='" . $post_data['clan_head'] . "',clan_head_phone='" . $post_data['clan_head_phone'] . "',
                        identification='" . $post_data['identification'] . "',identification_number='" . $post_data['card_id_number'] . "',tax_id_number='" . $post_data['tax_id_number'] . "',
                        reason_for_request='" . $post_data['reason_for_request'] . "',passport='" . $post_data['passport'] . "',user_id='" . $unique_hash . "', date_requested='".$date_requested."'";
                 try {
                       if ($conn->query($user_query)) {
                             $_SESSION['success']= "Your Request has been received.<br/> To complete the process, please make payment below.";
                             $_SESSION['user_id'] = $unique_hash;
                       } else {
                             $errors['email'] = "A server error occurred while submitting your request. <br/>Please refresh the page and try again later!";
                       }
                 }catch(Exception $e){
                       error_log($e->getMessage());
                 }

            }

            /***   Send Admin Notification Email if Request is Successful *****/
            if(!empty($_SESSION['success'])){
                  $email_data['message'] = '
					<div>
					     The following user has requested for local government certificate.<br />
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
                  $email_data = array_merge($email_data, array('to' => 'uyolga2018@gmail.com', 'subject' => 'Admin Notification for LGA Certificate Request'));
                  $res=$result_obj->notifyAdmin($email_data);
                  header('Location: ../payment');
                  exit();
            }

      }
}
