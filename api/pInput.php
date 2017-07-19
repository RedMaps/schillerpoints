<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<div class="container">

    <div class="row">

      <div class="input-field col l6 s12">
        <input name="pTitle" id="title" type="text" class="validate pTitle add" data-length="50">
        <label for="title">Title</label>
      </div>

      <div class="input-field col l6 s12">
        <input name="pLocation" id="location" type="text" class="validate pLocation add" data-length="50">
        <label for="location">Location</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col l4 s12">
        <input name="pDate" id="date" type="date" class="datepicker pDate add">
        <label for="date">Date</label>
      </div>

      <div class="input-field col l4 s12">
        <input name="pTime" id="time" type="text" class="timepicker pTime add">
        <label for="time">Time</label>
      </div>

      <div class="input-field col l4 s12">
        <input name="pDuration" id="duration" type="text" data-length="50" class="pDuration add">
        <label for="duration">Duration (approximately)</label>
      </div>

    </div>

    <div class="input-field col s12">
      <textarea name="pContent" id="description" class="materialize-textarea pContent add" data-length="500"></textarea>
      <label for="description">Desctiption</label>
    </div>

    <form action="#">
      <p>Maximum number of participants<p>
      <p class="range-field">
        <input name="pMax" type="range" id="max" min="0" max="200" class="pMax add" />
      </p>
    </form>

    <br>

    <button type="button" class="btn waves-effect waves-light" name="confirm" onclick="createProject()">Submit
      <i class="material-icons right">send</i>
    </button>

</div>

<br><br><br>

  <!-- <p class="uId">User Id: {uId}</p>
  <p class="uName">User Name: {uName}</p>
  <p class="uMail">User Test: {uMail}</p>
  <p class="uPoints">User Points: {uPoints}</p>
  <p class="uTotal">User Total Points: {uTotal}</p>
  <p class="uLoggedIn">false</p> -->

  <script type="text/javascript" src="../js/materialize.js"></script>
  <script src="initializer.js"></script>
  <script src="api.js"></script>
</body>
</html>
