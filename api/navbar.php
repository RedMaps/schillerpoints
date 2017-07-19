<div class='navbar-fixed'>
  <nav>
    <div class="nav-wrapper green accent-4">
      <a href="#" class="brand-logo">&nbsp;&nbsp;S-Points</a>
      <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="../index.php">Startseite</a></li>
        <li><a href="#">Projekte<span class="badge white-text">{projectcount}</span></a></li>
        <li><a href="#score">Bestenliste</a></li>
        <li><a href="../vertretung">Vertretungsplan</a></li>
        <li><a id="dropdown" class="dropdown-button uname uname_drop" href="#!" data-activates="dropdown-list">{uName}<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
    </div>
  </nav>
</div>

<ul id="slide-out" class="side-nav slide-mobile">
  <li><div class="userView">
    <div class="background green accent-4">

    </div>
    <a href="#!user"></a>
    <a href="#!name"><span class="white-text name uname" id="uname">{uName}</span></a>
    <a href="#!email"><span class="white-text email umail" id="umail">{uMail}</span></a>
  </div></li>
  <li><a href="../index.php"><i class="material-icons">home</i> Startseite</a></li>
  <li><a href="#"><i class="material-icons">view_list</i> Projekte <b>[ {projectcount} ]</b></a></li>
  <li><a href="#score"><i class="material-icons">format_list_numbered</i> Bestenliste</a></li>
  <li><a href="../vertretung"><i class="material-icons">people_outline</i> Vertretungsplan</a></li>
  <li><div class="divider"></div></li>
  <li><a class="subheader">Nutzer Optionen</a></li>
</ul>
