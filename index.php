<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include_once("parts/analyticstracking.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <?php include 'parts/head.php'; ?>
</head>
<?php include 'api/api.php';
include 'parts/navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">
  <script src="js/countup.js"></script>

  <center>
    <div class="progress_round" id="progress_round"></div>
    <img class="mark animated" src="pics/mark.png">
    <h4 id="count" class="marg">Your Points: 0 / 20</h4>
    <a href="/new/projects/" class="btn btn-large white black-text projectbtn">TO THE PROJECTS</a>
  </center>

  <?php
    include "modals/editModal.php";
    include "modals/addModal.php";
    include "modals/loginModal.php";
    include "modals/projectModal.php";
    include "modals/impressumModal.php";
    include "modals/pointModal.php";
    include "modals/pollModal.php";
    include "modals/resultsModal.php";
    include "modals/changePassModal.php";
    include "modals/passResetModal.php";
    include "modals/notificationModal.php";
    include "modals/scoreModal.php";
   ?>

  <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="api/api.js"></script>
  <script src="api/initializer.js"></script>
  <script src="index.js"></script>
  <script src="js/progress.js"></script>
</body>
</html>
