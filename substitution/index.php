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
  <meta name="viewport" content="width=device-width, initial-scale=0.6, maximum-scale=1.0, user-scalable=1">
</head>
<?php include '../api/api.php'; ?>
<?php include '../parts/navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">

  <div class="row">
  <div class="col l2 m0 s0"></div>
  <div class="col l8 m12 s12">
    <!-- <a onclick="sortTable('Fach','ASC')" class="modal-action modal-close waves-effect waves-grey btn-flat white-text blue">SORT!</a> -->
    <div class="nav-wrapper z-depth-2">
     <form id="search">
         <div class="input-field">
           <input id="searchfield" type="search" onkeyup="sortTable('id','ASC')" placeholder="Suchbegriff eingeben ..." required>
           <label class="label-icon" for="search"><i class="material-icons">search</i></label><i class="material-icons white-text inf">info</i>
         </div>
     </form>
   </div>

   <div class="loadsubtable"></div>

  </div>

  <?php
    include "../modals/editModal.php";
    include "../modals/addModal.php";
    include "../modals/loginModal.php";
    include "../modals/projectModal.php";
    include "../modals/impressumModal.php";
    include "../modals/pointModal.php";
    include "../modals/scoreModal.php";
   ?>

  <div class="col l2 m0 s0"></div>
  </div>

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="../api/api.js"></script>
  <script src="index.js"></script>
</body>
</html>
