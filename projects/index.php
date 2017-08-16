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
<?php include '../api/api.php'; ?>
<?php include '../parts/navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">

  <center>
    <a class="waves-effect waves-light btn green accent-4 lef active disabled" onclick="active();">Active Projects</a>
    <a class="waves-effect waves-light btn green accent-4 mid finished" onclick="finished();">Finished Projects</a>
    <a class="waves-effect waves-light btn green accent-4 rig your" onclick="your();">Your Projects</a>
  </center>

  <br>

  <div class="prj active_projects"></div>

  <a onclick="addProject()" class="btn-floating halfway-fab waves-effect waves-light blue-grey addbtn z-depth-4 tooltipped btn-down" data-position="left" data-tooltip="suggest project"><i class="material-icons">add</i></a>

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
    include "../modals/scoreModal.php";
   ?>

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="../api/api.js"></script>
  <script src="../api/initializer.js"></script>
  <script src="index.js"></script>
</body>
</html>
