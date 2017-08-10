<?php

function nameParser($name){
  $UN = explode(' ', $name);
  $lastName = $UN[1];
  $firstName = $UN[0];
  $lastName = substr($lastName, 0 , 1);
  $lastName = strtoupper($lastName);
  return $firstName . " " . $lastName . ".";
}

function checkJoin($uId, $id, $con){
  $d = false;
  $query = mysqli_query($con, "select members from projects where id=$id");
  $array = mysqli_fetch_array($query);
  $array = $array['members'];
  $decoded = json_decode($array, true);
  for($i = 0; $i < count($decoded); $i++){
    if($decoded[$i] == $uId) $d = true;
  }
  if($d) return true;
}

function isAdmin(){

}

?>
