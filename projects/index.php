<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include_once("../parts/analyticstracking.php");
 ?>
<!DOCTYPE html>
<html>
<head>
  <?php include '../parts/head.php'; ?>
</head>
<?php include '../api/api.php';
 include '../parts/navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">

  <center>
    <a class="waves-effect waves-light btn green accent-4 lef active disabled" onclick="active();">Aktive Projekte</a>
    <a class="waves-effect waves-light btn green accent-4 mid finished" onclick="finished();">Beendete Projekte</a>
    <a class="waves-effect waves-light btn green accent-4 rig your" onclick="your();">Deine Projekte</a>
  </center>

  <br>

  <!-- <div class="row"><div class="col s0 m3 l4"></div><div class="col s12 m6 l4"><div class="card blue-grey darken-1"><div class="card-content white-text"><?php //include "../parts/ad.php"; ?></div></div></div><div class="col s0 m3 l4"></div></div> -->

  <br>

  <div class="prj active_projects"></div>

  <div class="row"><div class="col s0 m3 l4"></div><div class="col s12 m6 l4"><div class="card blue-grey darken-1"><div class="card-content white-text"><?php include "../parts/ad.php"; ?></div></div></div><div class="col s0 m3 l4"></div></div>

  <a onclick="addProject()" class="btn-floating halfway-fab waves-effect waves-light blue-grey addbtn z-depth-4 tooltipped btn-down" data-position="left" data-tooltip="projekt vorschlagen"><i class="material-icons">add</i></a>

  <?php
    include "../modals/editModal.php";
    include "../modals/addModal.php";
    include "../modals/loginModal.php";
    include "../modals/projectModal.php";
    include "../modals/impressumModal.php";
    include "../modals/pointModal.php";
    include "../modals/pollModal.php";
    include "../modals/resultsModal.php";
    include "../modals/changePassModal.php";
    include "../modals/passResetModal.php";
    include "../modals/notificationModal.php";
    include "../modals/forgotPassModal.php";
    include "../modals/scoreModal.php";
   ?>

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="../api/api.js"></script>
  <script src="../api/initializer.js"></script>
  <script src="index.js"></script>
</body>
</html>

<?php include "../api/post.php" ?>
