<div id="editWin" class="modal modal-fixed-footer editWin">
  <div class="modal-content">

    <h4>EDIT</h4>

    <div class="row">

      <div class="input-field col l6 s12">
        <input placeholder="" name="pTitle" id="title" type="text" class="validate pTitle edit" data-length="50">
        <label for="title">Title</label>
      </div>

      <div class="input-field col l6 s12">
        <input placeholder="" name="pLocation" id="location" type="text" class="validate pLocation edit" data-length="50">
        <label for="location">Location</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDate" id="date" type="date" class="datepicker pDate edit">
        <label for="date">Date</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pTime" id="time" type="text" class="timepicker pTime edit">
        <label for="time">Time</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDuration" id="duration" type="text" data-length="50" class="pDuration edit">
        <label for="duration">Duration (approximately)</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s12">
        <textarea placeholder="" name="pContent" id="description" class="materialize-textarea pContent edit" data-length="500"></textarea>
        <label for="description">Desctiption</label>
      </div>

      <div class="input-field col s12">
        <form action="#">
            <p>Maximum number of participants<p>
            <p class="range-field">
              <input name="pMax" type="range" id="max" min="0" max="200" class="pMax edit" />
            </p>
          </form>
        </div>
      </div>

  </div>

  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red" onclick="$('.deleteModal').modal('open');">Delete</a>
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green" onclick="submitEdit(15)">Submit</a>
  </div>
</div>

<!-- TODO: Make this work :D -->

<div id="deleteModal" class="modal deleteModal">
  <div class="modal-content">
    <h4>DELETE</h4>
    <p>Do you really want to delete this project? All contributors will be kicked from the project and you will not be able to un-delete the project without help from and admin!
    You can also give the project lead to another member of the project if you can't participate but do not want to delete the project.</p>
    <div class="row">
      <div class="input-field col l6 s12">
        <input type="checkbox" id="checkbox" class="del-checkbox" />
        <label for="checkbox">I red the text above and am certain that I want to delete this project permanently.</label>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green deletebtn disabled" onclick="deleteProject(16)">YES</a>
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat red">NO</a>
  </div>
</div>
