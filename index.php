<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen","projection"/>
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/global.css">
  <link type="text/css" rel="stylesheet" href="index.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<?php include 'api/api.php'; ?>
<?php include 'api/navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">
  <script src="js/countup.js"></script>

  <center>
    <div class="progress" id="progress"></div>
    <h4 id="count" class="marg">Deine Punkte: 0 / 20</h4>
    <a href="load.php" class="btn btn-large white black-text projectbtn">to the projects</a>
  </center>

  <?php
    include "modals/editModal.php";
    include "modals/addModal.php";
    include "modals/loginModal.php";
    include "modals/projectModal.php";
    include "modals/impressumModal.php";
    include "modals/pointModal.php";
    include "modals/scoreModal.php";
   ?>

  <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="api/api.js"></script>
  <script src="api/initializer.js"></script>
  <script src="index.js"></script>
  <script src="api/progress.js"></script>
</body>
</html>
