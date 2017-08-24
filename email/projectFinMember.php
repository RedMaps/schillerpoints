<?php

  $header = "From: info@schillerpoints.de\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html; charset=utf-8";
  $msg = "Your project has expired! Check your points to see wether the leader has veryfied your attendance yet! https://www.schillerpoints.de/new";
  $subject = "=?utf-8?B?".base64_encode("Project Finished - Schillerpoints")."?=";
  $mail = "julian@karhof.net";

  mail($mail, $subject, $msg, $header);

 ?>
