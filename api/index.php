<?php
include "dbconnect.php";
include "nameParser.php"; ?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen","projection"/>
  <link type="text/css" rel="stylesheet" href="../css/modals.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

  <div class="gui-div">

    <h1>API TESTING INTERFACE</h1>

    <h3>LOGIN</h3>

    <button type="button" name="logOut" class="logOut btn green" onclick="$('.loginModal').modal('open');">LOGIN</button>
    <button type="button" name="logOut" class="logOut btn red" onclick="logOut()">LOGOUT</button>
    <br>
    <h3>PROJECTS</h3>
    <button type="button" name="join" class="join btn green" onclick="join(14)">JOIN</button>
    <button type="button" name="leave" class="leave btn red" onclick="leave(14)">LEAVE</button>
    <button type="button" name="edit" class="edit btn blue" onclick="edit(14)">EDIT</button>
    <button type="button" name="edit" class="edit btn blue" onclick="addProject()">ADD</button>
    <br>
    <h3 class="center">ACTIVE PROJECTS</h3><br>
    <div class="active_projects row"></div>
    <h3 class="center">PENDING PROJECTS</h3><br>
    <div class="pending_projects row"></div>
    <h3 class="center">FINISHED PROJECTS</h3><br>
    <div class="finished_projects row"></div>
    <h3 class="center">REMOVED PROJECTS</h3><br>
    <div class="removed_projects row"></div>


  </div>

  <div class="loader"></div>

  <!-- <div class="fixed-action-btn">
    <a class="btn-floating btn-large green" onclick="$('.addModal').modal('open');"><i class="large material-icons">add</i></a>
  </div> -->

  <?php include '../modals/editModal.php'; ?>
  <?php include '../modals/loginModal.php'; ?>
  <?php include '../modals/addModal.php'; ?>

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="initializer.js"></script>
  <script src="api.js"></script>
</body>
</html>
