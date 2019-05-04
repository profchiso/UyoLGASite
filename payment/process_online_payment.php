<?php
session_start();
require_once '../vendor/paystack-php/src/autoload.php';

if (is_ajax()) {
      require_once '../url.php';
      require_once '../db_connect.php';
      require_once '../services/help_file.php';
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
      if(!empty($user_data)){
            $user_data['unique_hash'] = sha1(uniqid(rand(), true));
            $user_query = "UPDATE lga_cert_request SET unique_hash='".$user_data['unique_hash']."' WHERE user_id='".$user_data['user_id']."'";
            if ($conn->query($user_query)) {
                  $user_data['amount'] = 5000;
                  $_SESSION['user_data']=$user_data;
                  /*** Initialize Paystack Transaction API   ***/
                  $SECRET_KEY = "sk_test_0cfe7de189fec072e19e26f6325ddba441ccf7e0";
                  $paystack = new Yabacon\Paystack($SECRET_KEY);
//				Yabacon\Paystack::disableFileGetContentsFallback();
                  try {
                        $tranx = $paystack->transaction->initialize([
                              'amount' => (intval($user_data['amount'], 10) * 100),       // in kobo
                              'email' => $user_data['email'],         // unique to customers
                              'phone' => $user_data['phone_number'],
                              'first_name' => $user_data['othernames'],
                              'last_name' => $user_data['surname'],
                              'reference' => $user_data['unique_hash'], // unique to transactions
                        ]);
                  } catch (\Yabacon\Paystack\Exception\ApiException $e) {
                        print_r($e->getResponseObject());
                        die($e->getMessage());
                  }
                  // store transaction reference so we can query in case user never comes back
                  // perhaps due to network issue

//				save_last_transaction_reference($tranx->data->reference);
                  // redirect to page so User can pay
                  $response['data']['authorized_url'] = $tranx->data->authorization_url;
            }
      }

      if(!empty($errors)){
            echo json_encode(array("success"=>false,"errors"=>$errors));
      }else{

            echo json_encode(array_merge(array("success"=>true),$response));
      }

}
//Function to check if the request is an AJAX request
function is_ajax() {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
