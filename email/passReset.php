<?php

  $header = "From: info@schillerpoints.de\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html; charset=utf-8";
  $msg = "Reset link: www.schillerpoints.de/?reset=".$uni;
  $subject = "=?utf-8?B?".base64_encode("Passwort zurücksetzen - Schillerpoints")."?=";
  $mail = $email;

  mail($mail, $subject, $msg, $header);

 ?>
