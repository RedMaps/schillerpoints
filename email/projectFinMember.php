<?php

  $header = "From: info@schillerpoints.de\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html; charset=utf-8";
  $msg = "Dein Projekt ist beendet! Du bekommst eine weitere Benachrichtigung wenn der Leiter deine Anwesenheit bestätigt hat, und du somit deine Punkte erhälst! https://www.schillerpoints.de/new";
  $subject = "=?utf-8?B?".base64_encode("Projekt beendet - Schillerpoints")."?=";
  $mail = "julian@karhof.net";

  mail($mail, $subject, $msg, $header);

 ?>
