<?php

include_once("../api/dbconnect.php");

if($_POST['action'] == "loadsubtable"){

  for($j = 1; $j < 5; $j++){

    if($j == 1){ $table_day = "substitution_mon"; $day = "Montag"; $info = "info_mon"; }
    if($j == 2){ $table_day = "substitution_tue"; $day = "Dienstag"; $info = "info_tue"; }
    if($j == 3){ $table_day = "substitution_wed"; $day = "Mittwoch"; $info = "info_wed"; }
    if($j == 4){ $table_day = "substitution_thu"; $day = "Donnerstag"; $info = "info_thu"; }
    if($j == 5){ $table_day = "substitution_fri"; $day = "Freitag"; $info = "info_fri"; }

    $query = mysqli_query($con, "SELECT * FROM " . $table_day);

    while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
        $results[] = $result;
    }

    if($j > 1) unset($infos);

    $query = mysqli_query($con, "SELECT * FROM " . $info);

    while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
        $infos[] = $result;
    }

    echo '<div class="day-display z-depth-2 white-text">Infos zu '.$day.'</div>';

    echo '
    <table class="striped centered z-depth-2">
        <tbody>';

        for($i = 0; $i < count($infos); $i++){
          echo '<tr class="info"><td>'. $infos[$i][1] .'</td></tr>';
        }

        echo '
        </tbody>
    </table>';

    echo '<div class="day-display z-depth-2 white-text">'.$day.'</div>';

    echo '
    <table class="striped z-depth-2">
        <thead class="white-text">
          <tr>
            <th>Klasse</th>
            <th>Datum</th>
            <th>Stunde</th>
            <th>Fach</th>
            <th>Text</th>
            <th>Vertreter</th>
            <th>Raum</th>
          </tr>
        </thead>
        <tbody>';

        for($i = 0; $i < count($results); $i++){
          echo '
            <tr>
              <td>'. $results[$i][1] .'</td>
              <td>'. $results[$i][2] .'</td>
              <td>'. $results[$i][3] .'</td>
              <td>'. $results[$i][4] .'</td>
              <td>'. $results[$i][5] .'</td>
              <td>'. $results[$i][6] .'</td>
              <td>'. $results[$i][7] .'</td>';
            echo '</tr>';
        }

        echo '
        </tbody>
    </table><br><br>';


  }

?>
