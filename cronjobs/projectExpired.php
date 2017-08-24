
<table style="text-align:center">
  <tr>
    <th>Name</th>
    <th>Expiring</th>
    <th>Expired</th>
    <th>Status</th>
  </tr>

<?php
  include "../api/dbconnect.php";
  include "../api/api.php";

  $now = new DateTime();

  $result = mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE status='1'");
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
      $mail = "";
      $mail = mysqli_fetch_array(mysqli_query($con, "SELECT userEmail FROM ".USERBASE." WHERE userId='".$row['leader']."'"));
      $mail = $mail[0];
      include "../email/projectFinLeader.php";
      $mails = mysqli_fetch_array(mysqli_query($con, "SELECT members FROM ".PRJBASE." WHERE id='".$row['id']."'"));
      $mails = json_decode($mails[0]);
      foreach ($mails as &$val) {
        $res = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM ".USERBASE." WHERE userId='".$val."'"));
        $mail = $res['userEmail'];
        $title = $row['title'];
        $id = json_encode(array($res['userId']));
        $text = mysql_escape_string("Your project '$title' has expired!");

        Notifications::addPersonal("Project Expired", $text, 1, 0, 1, $id, $con);

        include "../email/projectFinMember.php";
      }
    }

  }

 ?>

</table>
