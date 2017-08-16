<div id="changePassModal" class="modal modal-fixed-footer blue-grey white-text changePassModal">
  <div class="modal-content white-text">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">Change password</h4>

    <div class="row">

      <div class="input-field col l12 s12">
        <input placeholder="•••" name="cPass" id="oldpass" type="password" class="cPass" data-length="50">
        <label class="white-text" for="cPass">Old Password</label>
      </div>

      <div class="input-field col l12 s12">
        <input placeholder="•••" name="cPass" id="newpass" type="password" class="cPass" data-length="50">
        <label class="white-text" for="cPass">New Password</label>
      </div>

      <div class="input-field col l12 s12">
        <input placeholder="•••" name="cPass" id="reppass" type="password" class="cPass" data-length="50">
        <label class="white-text" for="cPass">Repeat New Password</label>
      </div>

    </div>

  </div>

  <div class="modal-footer blue-grey darken-1 white-text">
    <!-- <a href="projekte" class="waves-effect waves-light white black-text btn">forgot password</a> -->
    <a href="#!" class="modal-action waves-effect waves-black btn-flat white-text green accent-4" onclick="changePass()">Change Password
    </a>
  </div>
</div>
