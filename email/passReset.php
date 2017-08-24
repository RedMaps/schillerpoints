<?php

  $header = "From: info@schillerpoints.de\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html; charset=utf-8";
  $msg = "Reset link: www.schillerpoints.de/new/?reset=".$uni;
  $subject = "=?utf-8?B?".base64_encode("Password reset - Schillerpoints")."?=";
  $mail = "julian@karhof.net";

  mail($mail, $subject, $msg, $header);

 ?>
