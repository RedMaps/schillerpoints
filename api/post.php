<?php

//TODO: FIX
include 'dbconnect.php';

if(isset($_GET['reset']) && $_GET['reset'] != ""){
  $reset = $_GET['reset'];
  if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM ".USERBASE." WHERE reset='".$reset."'")) > 0){
    $res = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM ".USERBASE." WHERE reset='".$reset."'"));
    echo json_encode($res);
  }
}

?>
