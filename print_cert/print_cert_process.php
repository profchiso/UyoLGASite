<?php
require_once '../root_dir.php';
if(!is_ajax()) {

      if($_POST) {
            $response = $errors = $user_data = array();
            $post_data = !empty($_POST) ? $_POST : array();

            $stmt = $conn->prepare("SELECT * FROM lga_cert_request WHERE user_id=:user_id ");
            $stmt->execute(array(':user_id' => $_SESSION['user_id']));
            $check_row = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_info = $file_data = array();
            if (empty($check_row)) {
                  header('Location: ../');
                  exit();
            } else {
                  $user_info = $check_row;
            }
            $stmt = $conn->prepare("SELECT * FROM download WHERE user_id=:user_id ");
            $stmt->execute(array(':user_id' => $_SESSION['user_id']));
            $check_row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (empty($check_row)) {
                  $errors['user_id'] = "Sorry your certificate is currently being uploaded. <br class='hidden-xs'/>Please check back later.";
            } else {
                  $file_data = $check_row;
            }

            if (empty($errors)) {
                  $path = APPLICATION_PATH . '/cert_uploads';
                  $file_name = $path . '/' . $user_info['user_id'] . '.jpg';
                  $fake_file_web_path = 'lga_certificate_' . trim(strtolower($user_info['surname'])) . '_' . time() . '.jpg';
                  ob_start();
                  $mm_type = "application/octet-stream";
                  $file = $file_name;
                  $filename = $fake_file_web_path;
                  header("Cache-Control: public, must-revalidate");
                  header("Pragma: no-cache");
                  header("Content-Type: " . $mm_type);
                  header("Content-Length: " . (string)(filesize($file)));
                  header('Content-Disposition: attachment; filename="' . $filename . '"');
                  header("Content-Transfer-Encoding: binary\n");
                  ob_end_clean();
                  readfile($file);
            }
      }
}
//Function to check if the request is an AJAX request
function is_ajax() {
      return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
?>