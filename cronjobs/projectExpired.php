
<table style="text-align:center">
  <tr>
    <th>Name</th>
    <th>Expiring</th>
    <th>Expired</th>
    <th>Status</th>
  </tr>

<?php
  include "../api/dbconnect.php";

  $now = new DateTime();

  $result = mysqli_query($con, "select * from ".PRJBASE);
  while($row = mysqli_fetch_assoc($result)){

    $date = new DateTime($row['date'] . $row['time']);

    echo "<tr>";
      echo "<td>".$row['title']."</td>";
      echo "<td>".$now->diff($date)->format("%r %a Days left")."</td>";
      echo "<td>"; echo $now->diff($date)->format("%r") == "-"; echo "</td>";
      echo "<td>".$row['status']."</td>";
    echo "</tr>";

    if($now->diff($date)->format("%r") == "-"){
      mysqli_query($con, "update ".PRJBASE." set status='3' where id='".$row['id']."'");
      //TODO: send email
    }

  }

 ?>

</table>
