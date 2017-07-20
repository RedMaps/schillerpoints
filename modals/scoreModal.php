<div id="scoreModal" class="modal full modal blue-grey white-text scoreModal">
  <div class="modal-content">

    <h4 class="modalTitle">Scoreboard</h4>
    <h4 class="right modal-close x-button btn-flat white-text"><i class="material-icons">close</i></h4>

    <div class="row">

      <?php
      $scoreboard = mysqli_query($con, "SELECT userName, userPoints FROM users ORDER BY userPoints DESC LIMIT 10");

      echo '
      <table>
        <thead>
          <tr>
              <th data-field="id">Platz</th>
              <th data-field="name">Name</th>
              <th data-field="price">Punkte</th>
          </tr>
        </thead>

        <tbody>';


        while($row = mysqli_fetch_array($scoreboard, MYSQLI_BOTH)){
          $i++;
          $name = $row[0];
          $name = nameParser($name);
          $points = $row[1];

        echo '
          <tr>
            <td>'.$i.'</td>
            <td>'.$name.'</td>
            <td>'.$points.'</td>
          </tr>
          ';
        }

          echo '
        </tbody>
      </table>';
      ?>

    </div>

</div>
