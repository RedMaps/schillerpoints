<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen","projection"/>
  <link type="text/css" rel="stylesheet" href="load.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<?php include 'api.php'; ?>
<?php include 'navbar.php'; ?>
<body>
  <input type="hidden" name="setlogin" class="setlogin" value="true">

  <div class="active_projects"></div>

  <a onclick="addProject()" class="btn-floating halfway-fab waves-effect waves-light blue-grey addbtn z-depth-4 tooltipped btn-down" data-position="left" data-tooltip="suggest project"><i class="material-icons">add</i></a>

  <!-- <div class="row">
    <div class="col s12 m4"></div>
    <div class="col s12 m4">
      <div class="card blue-grey darken-1" onclick="console.log('click')">
        <div class="card-content white-text">
          <span class="card-title">Theaterstück</span>
          <p>Gemeinsam mit bisher zwanzig Weiteren, habe&nbsp;ich im zweitem Halbjahr der EF einen Theaterkurs auf die Beine gestellt. Wir wollen uns bisher dienstags in der 55min Pause treffen und bis zum Ende des Schuljahres ein St&uuml;ck ein&uuml;ben. Der Gewinn vom Eintritt unserer Vorstellung wird dann nat&uuml;rlich auf&nbsp;unser Stufenkonto &uuml;berwiesen.</p>
        </div>
        <a class="btn-floating waves-effect waves-light green right join tooltipped" data-position="bottom" data-delay="50" data-tooltip="join project"><i class="material-icons">person_add</i></a>
        <a class="btn-floating waves-effect waves-light blue-grey darken-3 right edit tooltipped" data-position="bottom" data-delay="50" data-tooltip="edit project"><i class="material-icons">edit</i></a>
      </div>
    </div>
    <div class="col s12 m4"></div>
  </div> -->

  <!-- <div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large green waves-effect waves-light addbtn">
      <i class="large material-icons">add</i>
    </a>
  </div> -->

  <?php
    include "../modals/editModal.php";
    include "../modals/addModal.php";
    include "../modals/loginModal.php";
    include "../modals/projectModal.php";
    include "../modals/scoreModal.php";
   ?>

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="api.js"></script>
  <script src="load.js"></script>
</body>
</html>
