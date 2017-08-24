<?php

  $header = "From: info@schillerpoints.de\r\n";
  $header .= "MIME-Version: 1.0\r\n";
  $header .= "Content-type: text/html; charset=utf-8";
  $msg = "Dein Projekt ist abgelaufen!\n\n
   Nutze den folgenden link um das Abschlussformular auszufüllen damit du und die anderen Teilnehmer ihre Punkte bekommen können!\n
   www.schillerpoints.de/new/projects?finished=";
  $subject = "=?utf-8?B?".base64_encode("Dein Projekt ist abgelaufen! - Schillerpoints")."?=";

  mail($mail, $subject, $msg, $header);

 ?>
