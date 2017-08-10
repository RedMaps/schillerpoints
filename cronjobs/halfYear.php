<?php

include "../api/dbconnect.php";

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Not Authorized!';
    exit;
} elseif($_SERVER['PHP_AUTH_USER'] == "JulianAdmin" && $_SERVER['PHP_AUTH_PW'] == "u8t4U@079X3w") {
    echo "<p>SUCESSFULLY GAINED ACCESS!</p>";
    echo $_SERVER['PHP_AUTH_PW'];
    $result = mysqli_query($con, "select * from ".USERBASE);
    while($row = mysqli_fetch_assoc($result)){
      echo $row['userPoints'] . "<br>";
      mysqli_query($con, "update ".USERBASE." set userTotal= userTotal + '".$row['userPoints']."' where userId='".$row['userId']."'");
      mysqli_query($con, "update ".USERBASE." set userPoints='0' where userId='".$row['userId']."'");
    }
} else {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Not Authorized!';
    exit;
}

 ?>
