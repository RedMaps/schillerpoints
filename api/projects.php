<?php
//require_once 'Mobile_Detect.php';
//include 'nameParser.php';
include 'api.php';

$uId = $_POST['id'];

function active($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM projects WHERE status='1' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function pending($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM projects WHERE status='0' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function finished($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM projects WHERE status='3' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function removed($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM projects WHERE status='2' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}

switch ($_POST['type']) {
  case 'active':
  active($con, $uId);
  break;
  case 'pending':
  pending($con, $uId);
  break;
  case 'finished':
  finished($con, $uId);
  break;
  case 'removed':
  removed($con, $uId);
  break;
  default:
    echo "Error!";
    break;
}
 ?>
