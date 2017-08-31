<div id="loginModal" class="modal modal-fixed-footer blue-grey white-text loginModal">
  <div class="modal-content white-text">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">Anmelden</h4>

    <div class="row">

      <div class="input-field col l12 s12">
        <input placeholder="max@mustermann.de" name="iMail" id="mail" type="email" class="validate iMail" data-length="50">
        <label class="white-text" for="mail" data-error="please enter a valid E-Mail adress!" data-success="valid">E-Mail</label>
      </div>

      <div class="input-field col l12 s12">
        <input placeholder="••••••••••" name="iPass" id="pass" type="password" class="iPass" data-length="50">
        <label class="white-text" for="pass">Passwort</label>
      </div>

    </div>

  </div>

  <div class="modal-footer blue-grey darken-1 white-text">
    <a class="waves-effect waves-light white black-text btn" onclick="$('.forgotPassModal').modal('open');">vergessen</a>
    <a class="modal-action waves-effect waves-black btn-flat white-text green accent-4" onclick="logIn()">Anmelden</a>
  </div>
</div>
