<?php
require_once '../root_dir.php';
require_once '../EmailService.php';
if ($_POST) {
      $response=$errors=$user_data=array();
      $post_data=!empty($_POST)?$_POST:array();
      if(!empty($post_data)) {
            if(empty($post_data['user_id'])){
                  $errors['user_id']="Invalid User account detected. Please refresh the page and try again!";
            }
            if(empty($errors)){
                  $stmt = $conn->prepare("SELECT * FROM lga_cert_request WHERE user_id=:user_id ");
                  $stmt->execute(array(':user_id' => $_SESSION['user_id']));
                  $check_row = $stmt->fetch(PDO::FETCH_ASSOC);
                  if (!empty($check_row)) {
                        $user_data=$check_row;
                  }else{
                        $errors['user_id']="Invalid User account detected. Please refresh the page and try again!";
                  }
            }
      }

      /**** Uploading Passport Photo  ***/
      if (empty($errors)) {
            $user_data['unique_hash'] = sha1(uniqid(rand(), true));
            if (!empty($post_data['payment_teller_image_uploaded'])) {
                  $res=is_dir(APPLICATION_PATH . "/teller_uploads/");
                  if(!is_dir(APPLICATION_PATH . "/teller_uploads/")){
                        mkdir(APPLICATION_PATH . "/teller_uploads/");
                  }
                  $image_location = APPLICATION_PATH . "/teller_uploads/" .  $user_data['user_id']. ".jpg";
                  $image_url = $url . "teller_uploads/" .  $user_data['unique_hash']. ".jpg";
                  $decoded = $post_data['payment_teller_image_uploaded'];
                  $data = explode(',', $decoded);
                  if (!empty($data[1])) {
                        try {
                              file_put_contents($image_location, base64_decode($data[1]));
                        } catch (\Exception $e) {
                              unset($data);
                              return $errors['payment_teller_image_uploaded'] = 'A server error occurred while uploading Payment Teller!';
                        }
                  }
                  unset($data);
                  if (!is_file($image_location)) {
                        return $errors['payment_teller_image_uploaded'] = 'A server error occurred while uploading Payment Teller!';
                  }
                  $post_data['payment_teller'] = $image_url;
            }
      }
      if(empty($errors)){
            $user_query = "UPDATE lga_cert_request SET unique_hash='".$user_data['unique_hash']."' WHERE user_id='".$user_data['user_id']."'";
            if($conn->query($user_query)) {
                  $is_update = false;
                  $old_data = array();
                  $stmt = $conn->prepare("SELECT * FROM payment WHERE user_id=:user_id AND payment_method=:payment_method ");
                  $stmt->execute(array(':user_id' => $_SESSION['user_id'],':payment_method'=>"BANK"));
                  $check_row = $stmt->fetch(PDO::FETCH_ASSOC);
                  if (!empty($check_row)) {
                        $is_update = true;
                        $old_data = $check_row;
                  }
                  $payment_date = date("Y-m-d H:i:s");
                  $payment_status='PENDING';
                  if ($is_update) {
                        $user_query = "UPDATE payment SET payment_teller='" . $post_data['payment_teller'] . "', payment_status='".$payment_status."', payment_method='BANK', payment_date='".$payment_date."' WHERE user_id='" . $old_data['user_id'] . "' AND payment_method='BANK'";
                  } else {
                        $user_query = "INSERT INTO payment SET payment_teller='" . $post_data['payment_teller'] . "', payment_status='".$payment_status."', payment_method='BANK', payment_date='".$payment_date."', user_id='".$user_data['user_id']."'";
                  }
                  if ($conn->query($user_query)) {
                        $_SESSION['success'] = "Thank you. Your Payment Teller was successfully uploaded <br/> Your request is being processed.";
                  }else{
                        $errors['user_id']= 'A server error occurred while uploading your Payment Teller. <br/> Please refresh the page and try again later!';
                  }
            }
      }
      if(!empty($_SESSION['success'])){
            /**** SEND ORDER CONFIRMATION EMAIL TO ADMIN  ****/
            $email_data['message'] = ('
				<div>
					Hello Admin, <br />
				     <br />
				     A NEW payment teller has just been uploaded  through Uyo LGA Website.<br/>
				     See user details below;<br/><br/>
					    <b>Name: &nbsp;</b>'.ucwords(strtolower($user_data['surname'])).' '.ucwords(strtolower($user_data['othernames'])).'
					    <br/><b>Email: &nbsp;</b>'.strtolower($user_data['email']).'
					    <br/><b>Phone Number: &nbsp;</b>'.$user_data['phone_number'].'
					    <br/><br/>Please click on the link below to verify/ user payment:<br />
					    <a href="' . ($url) . 'admin/cert_request/view_user.php?user_id=' . (!empty($user_data['user_id'])?$user_data['user_id']:'') . '" >Verify User Payment</a><br />
					    <br /><br/>
				     Thank You,<br />
				     Uyo LGA<br />
				     <br />
				</div>
			') ;
            $result_obj = new Email();
            $email_data = array_merge($email_data, array('to' =>'uyolga2018@gmail.com', 'subject' => 'Admin Notification for New Payment Teller Upload'));
//            $result_obj->notifyAdmin($email_data);
            /**** END *******/
      }
}
