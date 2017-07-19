<div id="loginModal" class="modal modal-fixed-footer loginModal">
  <div class="modal-content">

    <h4>LOGIN</h4>

    <div class="row">

      <div class="input-field col l12 s12">
        <input placeholder="max@mustermann.de" name="iMail" id="mail" type="email" class="validate iMail" data-length="50">
        <label for="mail" data-error="please enter a valid E-Mail adress!" data-success="correct">E-Mail</label>
      </div>

      <div class="input-field col l12 s12">
        <input placeholder="••••••••••" name="iPass" id="pass" type="password" class="validate iPass" data-length="50">
        <label for="pass">Password</label>
      </div>

    </div>

    <!-- <div class="row">
      <div class="input-field col l6 s12">
        <input type="checkbox" id="checkbox" />
        <label for="checkbox">Keep me signed in</label>
      </div>
    </div> -->

  </div>

  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" onclick="logIn()">LogIn</a>
  </div>
</div>
