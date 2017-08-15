<?php
include 'api.php';

$uId = $_POST['id'];

function pending($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE status='0' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function active($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE status='1' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function removed($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE status='2' ORDER BY date");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function finished($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE status='3' ORDER BY date DESC");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $i++;
    include "card.php";
  };
}
function your($con, $uId){
  $result = mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE status='1' OR status='3' ORDER BY date DESC");
  $num_rows = mysqli_num_rows($result);
  $i = 0;

  while($data = mysqli_fetch_assoc($result)){
    $own = false;
    $members = $data['members'];
    $array = json_decode($members, true);
    for($j=0;$j<count($array);$j++){
      if($array[$j] == $uId) $own = true;
    }
    if($own){
      $i++;
      include "card.php";
    }
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
  case 'your':
  your($con, $uId);
  break;
  default:
    echo "Error!";
    break;
}
 ?>
