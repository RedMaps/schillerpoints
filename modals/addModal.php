<div id="addModal" class="modal full modal-fixed-footer blue-grey white-text addModal">
  <div class="modal-content">

    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>
    <h4 class="modalTitle">Projekt vorschlagen</h4>

    <div class="row">

      <div class="input-field col l6 s12">
        <input placeholder="" name="pTitle" id="title" type="text" class="validate pTitle add" data-length="50">
        <label for="title" class="grey-text text-lighten-2">Titel</label>
      </div>

      <div class="input-field col l6 s12">
        <input placeholder="" name="pLocation" id="location" type="text" class="validate pLocation add" data-length="50">
        <label for="location" class="grey-text text-lighten-2">Ort</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDate" id="date" type="date" class="datepicker pDate add">
        <label for="date" class="grey-text text-lighten-2">Datum</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pTime" id="time" type="text" class="timepicker pTime add">
        <label for="time" class="grey-text text-lighten-2">Uhrzeit</label>
      </div>

      <div class="input-field col l4 s12">
        <input placeholder="" name="pDuration" id="duration" type="text" data-length="50" class="pDuration add">
        <label for="duration" class="grey-text text-lighten-2">Dauer (in etwa)</label>
      </div>

    </div>

    <div class="row">

      <div class="input-field col s12">
        <!-- <textarea placeholder="" name="pContent" id="description" class="materialize-textarea pContent add" data-length="500"></textarea>
        <label for="description" class="grey-text text-lighten-2">Beschreibung</label> -->
        <div placeholder="" id="pdescription" class="pContent edit" name="pContent"></div>
      </div>

      <div class="input-field col s12">
        <form action="#">
            <p>Maximale Teilnehmer-Anzahl<p>
            <p class="range-field">
              <input name="pMax" type="range" id="max" min="0" max="200" class="pMax add" />
            </p>
          </form>
        </div>
      </div>

  </div>

  <div class="modal-footer blue-grey white-text darken-1">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat green accent-4 white-text" onclick="createProject()">Vorschlagen</a>
  </div>
</div>
