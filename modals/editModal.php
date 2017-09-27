<div id="editWin" class="modal modal-fixed-footer blue-grey white-text editWin full">
  <div class="modal-content">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">Bearbeiten</h4>

    <div class="row">

      <div class="input-field col l6 s12">
        <input placeholder="" name="pTitle" id="title" type="text" class="validate pTitle edit" data-length="50">
        <label for="title" class="grey-text text-lighten-2">Titel</label>
      </div>

      <div class="input-field col l6 s12">
        <input placeholder="" name="pLocation" id="location" type="text" class="validate pLocation edit" data-length="50">
        <label for="location" class="grey-text text-lighten-2">Ort</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDate" id="date" type="date" class="datepicker pDate edit">
        <label for="date" class="grey-text text-lighten-2">Datum</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pTime" id="time" type="text" class="timepicker pTime edit">
        <label for="time" class="grey-text text-lighten-2">Uhrzeit</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDuration" id="duration" type="text" data-length="50" class="pDuration edit">
        <label for="duration" class="grey-text text-lighten-2">Dauer (in etwa)</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s12">
        <div placeholder="" id="description" class="pContent edit" name="pContent"></div>
        <!-- <textarea placeholder="" name="pContent" id="description" class="materialize-textarea pContent edit" data-length="500"></textarea>
        <label for="description" class="grey-text text-lighten-2">Beschreibung</label> -->
      </div>

      <div class="input-field col s12">
        <form action="#">
          <p>Maximale Teilnehmer-Anzahl<p>
          <p class="range-field">
            <input name="pMax" type="range" id="max" min="0" max="200" class="pMax edit" />
          </p>
        </form>
      </div>

    </div>
  </div>

  <div class="modal-footer blue-grey darken-1 white-text">
    <a href="#!" class="white-text modal-action waves-effect waves-light btn-flat red" onclick="$('.deleteModal').modal('open');">Löschen</a>
    <a href="#!" id="submitEdit" class="white-text modal-action modal-close waves-effect waves-light btn-flat green">Bestätigen</a>
  </div>
</div>

<div id="deleteModal" class="modal deleteModal blue-grey white-text">
  <div class="modal-content">
    <h4>LÖSCHEN</h4>
    <p>Möchtest du dieses Projekt wirklich löschen? Alle Teilnehmer werden entfernt und das Projekt kann nicht ohne hilfe eines Admins wierderhergestellt werden!
    Du kannst die Projekt Leitung auch an einen anderen Teilnehmer des Projekts abgeben, falls du nicht teilnehmen kannst, aber das Projekt nicht löschen möchtest.</p>
    <div class="row">
      <div class="input-field col l6 s12">
        <input type="checkbox" id="checkbox" class="del-checkbox" />
        <label for="checkbox" class="white-text">Ich habe den obigen Text sorgfältig gelesen und bestätige hiermit, dass ich das Projekt permanent löschen möchte.</label>
      </div>
    </div>
  </div>
  <div class="modal-footer blue-grey darken-1 white-text">
    <a id="deleteEdit" class="modal-action waves-light waves-effect btn-flat green deletebtn disabled white-text">JA</a>
    <a class="modal-action modal-close waves-light waves-effect btn-flat red white-text">NEIN</a>
  </div>
</div>
