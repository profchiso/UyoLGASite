<?php
session_start();
require_once '../vendor/paystack-php/src/autoload.php';

if ($_GET) {

      require_once '../db_connect.php';
      require_once '../url.php';
      require_once '../EmailService.php';
      require_once '../services/help_file.php';

      $payment_reference=!empty($_GET['reference'])?$_GET['reference']:'';
      $errors=$user_data=array();
      if(!empty($_SESSION['user_data'])){
            $user_data=$_SESSION['user_data'];
      }
      if(empty($payment_reference) || empty($user_data['unique_hash']) || (!empty($user_data['unique_hash']) && $user_data['unique_hash'] !==$payment_reference)){
            $errors['user_id']="An error occurred processing your payment. If the payment was successful, Please <a href='mailto:uyolga2018@gmail.com?subject=Uyo%20LGA%20Support' class='btn btn-primary cart_login_btn'>contact support</a> right away to confirm with the <strong>reference number</strong> sent to your email ";
      }

      if(empty($errors)) {

            /*** initiate the Library's Paystack Object   ***/
            $SECRET_KEY = "sk_test_0cfe7de189fec072e19e26f6325ddba441ccf7e0";
            $paystack = new Yabacon\Paystack($SECRET_KEY);
            try {
                  // verify using the library
                  $tranx = $paystack->transaction->verify([
                        'reference' => $payment_reference, // unique to transactions
                  ]);
            } catch (\Yabacon\Paystack\Exception\ApiException $e) {
                  print_r($e->getResponseObject());
                  die($e->getMessage());
            }
            if ('success' !== $tranx->data->status) {
                  // transaction was successful...
                  $errors['user_id']="An error occurred processing your payment. If the payment was successful, Please <a href='mailto:uyolga2018@gmail.com?subject=Uyo%20LGA%20Support' class='btn btn-primary cart_login_btn'>contact support</a> right away to confirm with the <strong>reference number</strong> sent to your email ";
            }
      }
      $uploaded_by_data=array();
      if(empty($errors)) {
            $payment_status = "VERIFIED";
            $payment_date = date("Y-m-d H:i:s");
            $payment_amount = $user_data['amount'];
            $user_id = $user_data['user_id'];
            $payment_method = "ONLINE";

            $user_query = "INSERT INTO payment SET  payment_status='$payment_status', payment_method='$payment_method', payment_date='$payment_date', amount_paid=$payment_amount,  payment_reference='$payment_reference', user_id='$user_id'";
            if (!$conn->query($user_query)) {
                  $errors['payment_reference']="Transaction was Successful but Payment Reference (<strong>$payment_reference</strong>) could not be submitted. Please <a href='mailto:uyolga2018@gmail.com?subject=Uyo%20LGA%20Support' class='btn btn-primary cart_login_btn'>contact support</a> right away to confirm reference number sent to your email";
            }
      }
      if(!empty($errors)){
            $_SESSION['payment']['payment_failure']=$errors;
      }else{
            $_SESSION['payment']['payment_success']="<strong>Your Payment was Successful!</strong> <br class='visible-xs'/><span class='hide_print'>See Payment details below.</span>";
            $_SESSION['payment']['payment_reference']=$payment_reference;
            $_SESSION['success'] = "Thank you. Your Payment was successful. <br/> Your request is being processed.";

            /**** SEND Payment CONFIRMATION EMAIL TO USER  ****/
            $email_data['message'] = ('
				<div>
					Hello '.(!empty($user_data['surname'])?ucwords(strtolower($user_data['surname'])):''). (!empty($user_data['othernames'])?' '.ucwords(strtolower($user_data['othernames'])):'').',<br />
				     <br />
				     Thank you for making payment for your LGA Certificate Request.<br/>
				     <a href="'.$url.'payment/payment_receipt.php?payment_reference='.$payment_reference.'">View/Print Receipt</a><br/><br/>
				     <b>Payment Amount: ' . ("&#8358;".number_format($user_data['amount'],2,".",",")) . '</b><br/>
				     Payment Date: ' . date("Y-m-d H:i:s") .'
				     <br /><br/>
				    
				     Thank You,<br />
				     Uyo LGA<br />
				     <br />
				</div>
			') ;
            $result_obj = new Email();
            $email_data = array_merge($email_data, array('to' =>$user_data['email'], 'subject' => 'Your Uyo LGA Certificate Request Payment'));
            $result_obj->notifyAdmin($email_data);
            /**** END *******/

            /**** SEND ORDER CONFIRMATION EMAIL TO ADMIN  ****/
            $email_data['message'] = ('
				<div>
					Hello Admin, <br />
				     <br />
				     A NEW payment has just been made at Uyo LGA Online Platform by '.(!empty($user_data['surname'])?ucwords(strtolower($user_data['surname'])):''). (!empty($user_data['othernames'])?' '.ucwords(strtolower($user_data['othernames'])):'').'.<br/>
				        <a href="'.$url.'payment/payment_receipt.php?payment_reference='.$payment_reference.'">View/Print Receipt</a><br/><br/>
				     <b>Payment Amount: ' . ("&#8358;".number_format($user_data['amount'],2,".",",")) . '</b><br/>
				     Payment Date: ' . date("Y-m-d H:i:s") .'
				     <br /><br/>
				     Thank You,<br />
				     Uyo LGA<br />
				     <br />
				</div>
			') ;
            $result_obj = new Email();
            $email_data = array_merge($email_data, array('to' =>'uyolga2018@gmail.com', 'subject' => 'Admin Notification for New LGA Certificate Request Payment'));
            $result_obj->notifyAdmin($email_data);

            /**** END *******/

      }
      header('Location: payment_receipt.php');
      exit();
}

