<?php
$url="";
if(stripos($_SERVER['SERVER_NAME'], "127.0") !==FALSE){
      $url="http://127.0.0.1/uyolga/admin/";
}elseif(stripos($_SERVER['SERVER_NAME'], "local.") !==FALSE){
      $url="http://localhost/uyolga/admin/";
}else{
      $server_protocol = "http://";
      if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443) {
            $server_protocol = "https://";
      }
      $url=$server_protocol.$_SERVER['SERVER_NAME']."/admin/";
}