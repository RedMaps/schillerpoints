<?php
function url(){
  $suffix = null;
  if($_SERVER['SERVER_NAME'] != "localhost") $suffix = "";
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'], $suffix
  );
}
?>

<title>Schillerpoints</title>
<script src="/js/jquery-3.2.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="/css/materialize.css"  media="screen","projection"/>
<link type="text/css" rel="stylesheet" href="/css/materialnote.css"/>
<script src="/js/materialnote.js"></script>
<link rel="stylesheet" href="/css/global.css">
<link rel="stylesheet" href="/css/animate.css">
<link type="text/css" rel="stylesheet" href="index.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
