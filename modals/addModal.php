<div id="addModal" class="modal modal-fixed-footer addModal">
  <div class="modal-content">

    <h4>SUBMIT A PROJECT</h4>

    <div class="row">

      <div class="input-field col l6 s12">
        <input placeholder="" name="pTitle" id="title" type="text" class="validate pTitle add" data-length="50">
        <label for="title">Title</label>
      </div>

      <div class="input-field col l6 s12">
        <input placeholder="" name="pLocation" id="location" type="text" class="validate pLocation add" data-length="50">
        <label for="location">Location</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDate" id="date" type="date" class="datepicker pDate add">
        <label for="date">Date</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pTime" id="time" type="text" class="timepicker pTime add">
        <label for="time">Time</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDuration" id="duration" type="text" data-length="50" class="pDuration add">
        <label for="duration">Duration (approximately)</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s12">
        <textarea placeholder="" name="pContent" id="description" class="materialize-textarea pContent add" data-length="500"></textarea>
        <label for="description">Desctiption</label>
      </div>

      <div class="input-field col s12">
        <form action="#">
            <p>Maximum number of participants<p>
            <p class="range-field">
              <input name="pMax" type="range" id="max" min="0" max="200" class="pMax add" />
            </p>
          </form>
        </div>
      </div>

  </div>

  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green" onclick="createProject()">Submit</a>
  </div>
</div>
