<?php

function _d($var,$exit=0){
      $ip = $_SERVER['REMOTE_ADDR'];
      if($ip == '127.0.0.1' || $ip == '67.83.33.151' || $ip == '73.4.60.155' || $ip == '174.78.134.202' || true){
            echo "<pre style='font-size:8pt; background-color:#fff;'>".print_r($var,1)."</pre><hr size=1 />";
            if($exit)
                  exit;
      }
}

function _j($var, $exit=0){
      $ip = $_SERVER['REMOTE_ADDR'];
      //header('Content-Type: application/json');
      echo json_encode($var,1);
      if($exit)
            exit;
}

function _l($var, $backtrace = 0){
      if($backtrace){
            $backtrace = debug_backtrace();
            log_message('error', print_r($backtrace[0]['file'],1) );
      }
      log_message('error', prettify(json_encode($var)) );
}

