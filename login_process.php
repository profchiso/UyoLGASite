<?php

if ($_POST) {
      $post_data = !empty($_POST) ? $_POST : array();
      $post_data = array_map('trim', $post_data);
      $post_data['email'] = strtolower($post_data['email']);
      $errors = array();
      $required_fields = array("password" => "Password", "email" => "Email");
      foreach ($required_fields as $field_key => $field_text) {
            if (empty(($post_data[$field_key]))) {
                  $errors[$field_key] = "The " . $field_text . " field is required";
            }
      }

      if (empty($errors)) {
            if (!empty($post_data['email']) && !filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
                  $errors['email'] = 'Please enter a valid email address';
            }
      }
      if (empty($errors)) {
            $stmt = null;
            $stmt = $conn->prepare("SELECT * FROM lga_cert_request WHERE email=:email");
            $stmt->execute(array(":email" => $post_data['email']));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($row)){
                  $errors['email'] = "We could not find your Account.";
            }elseif (!empty($row) && $row['password'] !== sha1($post_data['password'])) {
                  $errors['password'] = "The Password is not correct";
            }
      }
      if (empty($errors)) {
            if (!empty($post_data["remember"])) {
                  setcookie("email", "");
                  setcookie("password", "");
                  setcookie("email", $post_data["email"], time() + (10 * 365 * 24 * 60 * 60));
                  setcookie("password", $post_data["password"], time() + (10 * 365 * 24 * 60 * 60));
            } else {
                  if (isset($_COOKIE["email"])) {
                        setcookie("email", "");
                  }
                  if (isset($_COOKIE["password"])) {
                        setcookie("password", "");
                  }
            }
            $_SESSION['user_data'] = $row;
            $_SESSION['user_id'] = !empty($row['user_id']) ? $row['user_id'] : '';
            header('Location: print_cert');
            exit();
      }

      if (!empty($errors)) {
            if (isset($_COOKIE["email"])) {
                  setcookie("email", "");
            }
            if (isset($_COOKIE["password"])) {
                  setcookie("password", "");
            }
      }

}


?>