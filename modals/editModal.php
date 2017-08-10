<div id="editWin" class="modal modal-fixed-footer blue-grey white-text editWin full">
  <div class="modal-content">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">EDIT</h4>

    <div class="row">

      <div class="input-field col l6 s12">
        <input placeholder="" name="pTitle" id="title" type="text" class="validate pTitle edit" data-length="50">
        <label for="title" class="grey-text text-lighten-2">Title</label>
      </div>

      <div class="input-field col l6 s12">
        <input placeholder="" name="pLocation" id="location" type="text" class="validate pLocation edit" data-length="50">
        <label for="location" class="grey-text text-lighten-2">Location</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDate" id="date" type="date" class="datepicker pDate edit">
        <label for="date" class="grey-text text-lighten-2">Date</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pTime" id="time" type="text" class="timepicker pTime edit">
        <label for="time" class="grey-text text-lighten-2">Time</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDuration" id="duration" type="text" data-length="50" class="pDuration edit">
        <label for="duration" class="grey-text text-lighten-2">Duration (approximately)</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s12">
        <textarea placeholder="" name="pContent" id="description" class="materialize-textarea pContent edit" data-length="500"></textarea>
        <label for="description" class="grey-text text-lighten-2">Desctiption</label>
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

  <div class="modal-footer blue-grey darken-1 white-text">
    <a href="#!" class="white-text modal-action waves-effect waves-light btn-flat red" onclick="$('.deleteModal').modal('open');">Delete</a>
    <a href="#!" id="submitEdit" class="white-text modal-action modal-close waves-effect waves-light btn-flat green">Submit</a>
  </div>
</div>

<div id="deleteModal" class="modal deleteModal blue-grey white-text">
  <div class="modal-content">
    <h4>DELETE</h4>
    <p>Do you really want to delete this project? All contributors will be kicked from the project and you will not be able to un-delete the project without help from and admin!
    You can also give the project lead to another member of the project if you can't participate but do not want to delete the project.</p>
    <div class="row">
      <div class="input-field col l6 s12">
        <input type="checkbox" id="checkbox" class="del-checkbox" />
        <label for="checkbox" class="white-text">I read the text above and am certain that I want to delete this project permanently.</label>
      </div>
    </div>
  </div>
  <div class="modal-footer blue-grey darken-1 white-text">
    <a id="deleteEdit" class="modal-action waves-light waves-effect btn-flat green deletebtn disabled white-text">YES</a>
    <a class="modal-action modal-close waves-light waves-effect btn-flat red white-text">NO</a>
  </div>
</div>
