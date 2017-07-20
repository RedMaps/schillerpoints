<?php
function getProjectCount($con){
  return mysqli_num_rows(mysqli_query($con, "SELECT * FROM projects WHERE status=1"));
} ?>
<header class="nav-down">
  <div class='navbar-fixed'>
    <nav>
      <div class="nav-wrapper green accent-4">
        <a href="#" class="brand-logo">&nbsp;&nbsp;S-Points</a>
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="../index.php">Startseite</a></li>
          <li><a href="#">Projekte<span class="badge white-text"><?php echo getProjectCount($con); ?></span></a></li>
          <li><a onclick="$('.scoreModal').modal('open')">Bestenliste</a></li>
          <li><a href="../vertretung">Vertretungsplan</a></li>
          <li><a id="dropdown" class="dropdown-button uName uname_drop" href="#!" data-activates="dropdown-list">{uName}<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div>

  <ul id="slide-out" class="side-nav slide-mobile blue-grey darken-2 white-text">
    <li><div class="userView white-text z-depth-2">
      <div class="background green accent-4">

      </div>
      <a href="#!user"></a>
      <a href="#!name"><span class="white-text name uName" id="uname">{uName}</span></a>
      <a href="#!email"><span class="white-text email uMail" id="umail">{uMail}</span></a>
    </div></li>
    <li><a href="../index.php" class="white-text"><i class="material-icons white-text">home</i> Startseite</a></li>
    <li><a href="#" class="white-text"><i class="material-icons white-text">view_list</i> Projekte <b>[ <?php echo getProjectCount($con); ?> ]</b></a></li>
    <li><a onclick="$('.scoreModal').modal('open')" class="white-text"><i class="material-icons white-text">format_list_numbered</i> Bestenliste</a></li>
    <li><a href="../vertretung" class="white-text"><i class="material-icons white-text">people_outline</i> Vertretungsplan</a></li>
    <div class="background green accent-4">
      <li><a class="subheader white-text z-depth-2">Nutzer Optionen</a></li>
    </div>
  </ul>
</header>
