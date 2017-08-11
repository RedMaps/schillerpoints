<?php
function url(){
  $suffix = null;
  if($_SERVER['SERVER_NAME'] != "localhost") $suffix = "/new";
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'], $suffix
  );
}
?>

<script src="<?php echo url(); ?>/js/jquery-3.2.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo url(); ?>/css/materialize.css"  media="screen","projection"/>
<link rel="stylesheet" href="<?php echo url(); ?>/css/animate.css">
<link rel="stylesheet" href="<?php echo url(); ?>/css/global.css">
<link type="text/css" rel="stylesheet" href="index.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
