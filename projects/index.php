<!DOCTYPE html>
<html>
<head>
  <?php include '../api/head.php'; ?>
</head>
<?php include '../api/api.php'; ?>
<?php include '../api/navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">

  <div class="active_projects"></div>

  <a onclick="addProject()" class="btn-floating halfway-fab waves-effect waves-light blue-grey addbtn z-depth-4 tooltipped btn-down" data-position="left" data-tooltip="suggest project"><i class="material-icons">add</i></a>

  <?php
    include "../modals/editModal.php";
    include "../modals/addModal.php";
    include "../modals/loginModal.php";
    include "../modals/projectModal.php";
    include "../modals/impressumModal.php";
    include "../modals/pointModal.php";
    include "../modals/scoreModal.php";
   ?>

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="../api/api.js"></script>
  <script src="../api/initializer.js"></script>
  <script src="index.js"></script>
</body>
</html>
