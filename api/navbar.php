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
          <li><a href="http://localhost/">Startseite</a></li>
          <li><a href="http://localhost/projects">Projekte<span class="badge white-text"><span class="new badge vMax" data-badge-caption=""><?php echo getProjectCount($con); ?></span></span></a></li>
          <li><a onclick="$('.scoreModal').modal('open')">Bestenliste</a></li>
          <li><a href="http://localhost/vertretung">Vertretungsplan</a></li>
          <li><a id="dropdown" class="uName uname_drop dropdown-button" href="#!" data-activates="dropdown-list">{uName}<i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
      </div>
    </nav>
  </div>

  <ul id='dropdown-list' class='dropdown-content'>
    <li><a onclick="$('.loginModal').modal('open');" class="black-text loginDesktop"><i class="material-icons black-text">perm_identity</i>Log In</a></li>
    <li class="divider"></li>
    <li><a href="http://localhost/profile" class="black-text"><i class="material-icons black-text">person</i> Profile (WIP)</a></li>
    <li><a href="http://localhost/settings" class="black-text"><i class="material-icons black-text">settings</i> Settings (WIP)</a></li>
    <li class="divider"></li>
    <li><a onclick="$('.impressumModal').modal('open');" class="black-text"><i class="material-icons black-text">subject</i> Impressum</a></li>
  </ul>

  <ul id="slide-out" class="side-nav slide-mobile blue-grey darken-2 white-text">
    <li><div class="userView white-text z-depth-2">
      <div class="background green accent-4">

      </div>
      <a href="#!user"></a>
      <a href="#!name"><span class="white-text name uNameMobile" id="uname">{uName}</span></a>
      <a href="#!email"><span class="white-text email uMail" id="umail">{uMail}</span></a>
    </div></li>
    <li><a href="http://localhost/" class="white-text"><i class="material-icons white-text">home</i> Startseite</a></li>
    <li><a href="#" class="white-text"><i class="material-icons white-text">view_list</i> Projekte <b><span class="new badge vMax" data-badge-caption=""><?php echo getProjectCount($con); ?></span></b></a></li>
    <li><a onclick="$('.scoreModal').modal('open')" class="white-text"><i class="material-icons white-text">format_list_numbered</i> Bestenliste</a></li>
    <li><a href="http://localhost/vertretung" class="white-text"><i class="material-icons white-text">people_outline</i> Vertretungsplan</a></li>
    <div class="background green accent-4">
      <li><a class="subheader white-text z-depth-2">Nutzer Optionen</a></li>
    </div>
    <li><a onclick="$('.loginModal').modal('open');" class="white-text loginMobile"><i class="material-icons white-text">perm_identity</i> Log In</a></li>
    <li><a href="http://localhost/profile" class="white-text"><i class="material-icons white-text">person</i> Profil (WIP)</a></li>
    <li><a href="http://localhost/settings" class="white-text"><i class="material-icons white-text">settings</i> Einstellungen (WIP)</a></li>
    <div class="background green accent-4">
      <li><a class="subheader white-text z-depth-2">Weiteres</a></li>
    </div>
    <li><a onclick="$('.impressumModal').modal('open');" class="white-text"><i class="material-icons white-text">subject</i> Impressum</a></li>
  </ul>
</header>
