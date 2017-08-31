<div id="forgotPassModal" class="modal modal-fixed-footer blue-grey white-text forgotPassModal">
  <div class="modal-content white-text">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">Passwort zurücksetzen</h4>

    <div class="row">

      <p>Um dein Passwort zurückzusetzen, müssen wir dir eine E-Mail zusenden um deine Identität zu bestätigen.
        Bitte gib deine E-Mail adresse in das Feld ein und klicke dann auf den link in der E-Mail um dein Passwort zurückzusetzen.
        Du kannst daraufhin ein neues Passwort festlegen und dich ganz nochmal einloggen.</p>

      <div class="input-field col l12 s12">
        <input placeholder="max@mustermann.de" name="rMail" id="rmail" type="email" class="validate rMail" data-length="50">
        <label class="white-text" for="rmail" data-error="please enter a valid E-Mail adress!" data-success="valid">E-Mail</label>
      </div>

    </div>

  </div>

  <div class="modal-footer blue-grey darken-1 white-text">
    <a class="modal-action waves-effect waves-black btn-flat white-text green accent-4" onclick="forgotPass();">E-Mail Senden</a>
  </div>
</div>
