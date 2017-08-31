<div id="changePassModal" class="modal modal-fixed-footer blue-grey white-text changePassModal">
  <div class="modal-content white-text">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">Passwort ändern</h4>

    <div class="row">

      <div class="input-field col l12 s12">
        <input placeholder="•••" name="cPass" id="oldpass" type="password" class="cPass" data-length="50">
        <label class="white-text" for="cPass">Altes Passwort</label>
      </div>

      <div class="input-field col l12 s12">
        <input placeholder="•••" name="cPass" id="newpass" type="password" class="cPass" data-length="50">
        <label class="white-text" for="cPass">Neues Passwort</label>
      </div>

      <div class="input-field col l12 s12">
        <input placeholder="•••" name="cPass" id="reppass" type="password" class="cPass" data-length="50">
        <label class="white-text" for="cPass">Neues Passwort wiederholen</label>
      </div>

    </div>

  </div>

  <div class="modal-footer blue-grey darken-1 white-text">
    <a href="#!" class="modal-action waves-effect waves-black btn-flat white-text green accent-4" onclick="changePass()">Passwort ändern</a>
  </div>
</div>
