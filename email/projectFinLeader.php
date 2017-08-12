<?php

  $header = "From: info@schillerpoints.de\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html; charset=utf-8";
  $msg = "this is a test message!";
  $subject = "=?utf-8?B?".base64_encode("Test Message")."?=";
  $mail = "julian@karhof.net";

  mail($mail, $subject, $msg, $header);
  
 ?>
