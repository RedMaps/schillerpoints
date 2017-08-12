<?php

$query = mysqli_query($con, "SELECT * FROM substitution_mon");

while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
    $results[] = $result;
}

$query = mysqli_query($con, "SELECT * FROM info_mon");

while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
    $infos[] = $result;
}

echo '<div class="day-display z-depth-2 white-text">Infos zu Montag</div>';

echo '
<table class="striped centered z-depth-2">
    <tbody>';

    for($i = 0; $i < count($infos); $i++){
      echo '<tr class="info"><td>'. $infos[$i][1] .'</td></tr>';
    }

    echo '
    </tbody>
</table>';

echo '<div class="day-display z-depth-2 white-text">Monday</div>';

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

 ?>

<?php

$query = mysqli_query($con, "SELECT * FROM substitution_tue");

while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
    $results[] = $result;
}

unset($infos);

$query = mysqli_query($con, "SELECT * FROM info_tue");

while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
    $infos[] = $result;
}

echo '<div class="day-display z-depth-2 white-text">Infos zu Dienstag
</div>';

echo '
<table class="striped centered z-depth-2">
    <tbody>';

    for($i = 0; $i < count($infos); $i++){
      echo '<tr class="info"><td>'. $infos[$i][1] .'</td></tr>';
    }

    echo '
    </tbody>
</table>';

echo '<div class="day-display z-depth-2 white-text">Tuesday</div>';

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

    for($i = 1; $i < count($results); $i++){
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
</table><br>';

 ?>

<?php

$query = mysqli_query($con, "SELECT * FROM substitution_wed");

while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
    $results[] = $result;
}

unset($infos);

$query = mysqli_query($con, "SELECT * FROM info_wed");

while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
    $infos[] = $result;
}

echo '<div class="day-display z-depth-2 white-text">Infos zu Mittwoch</div>';

echo '
<table class="striped centered z-depth-2">
    <tbody>';

    for($i = 0; $i < count($infos); $i++){
      echo '<tr class="info"><td>'. $infos[$i][1] .'</td></tr>';
    }

    echo '
    </tbody>
</table>';

echo '<div class="day-display z-depth-2 white-text">Wednesday</div>';

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

    for($i = 1; $i < count($results); $i++){
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
</table><br>';

 ?>

 <?php

 $query = mysqli_query($con, "SELECT * FROM substitution_thu");

 while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
     $results[] = $result;
 }

 unset($infos);

 $query = mysqli_query($con, "SELECT * FROM info_thu");

 while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
     $infos[] = $result;
 }

 echo '<div class="day-display z-depth-2 white-text">Infos zu Donnerstag</div>';

 echo '
 <table class="striped centered z-depth-2">
     <tbody>';

     for($i = 0; $i < count($infos); $i++){
       echo '<tr class="info"><td>'. $infos[$i][1] .'</td></tr>';
     }

     echo '
     </tbody>
 </table>';

echo '<div class="day-display z-depth-2 white-text">Thursday</div>';

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

     for($i = 1; $i < count($results); $i++){
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
 </table><br>';

  ?>

  <?php

  $query = mysqli_query($con, "SELECT * FROM substitution_fri");

  while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
      $results[] = $result;
  }

  unset($infos);

  $query = mysqli_query($con, "SELECT * FROM info_fri");

  while ($result = mysqli_fetch_array($query, MYSQLI_BOTH)){
      $infos[] = $result;
  }

  echo '<div class="day-display z-depth-2 white-text">Infos zu Freitag</div>';

  echo '
  <table class="striped centered z-depth-2">
      <tbody>';

      for($i = 0; $i < count($infos); $i++){
        echo '<tr class="info"><td>'. $infos[$i][1] .'</td></tr>';
      }

      echo '
      </tbody>
  </table>';

  echo '<div class="day-display z-depth-2 white-text">Friday</div>';

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

      for($i = 1; $i < count($results); $i++){
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
  </table><br>';

   ?>
