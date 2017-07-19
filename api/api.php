<?php
include "dbconnect.php";

//outputs to console like javascripts console.log();
class Console {
  public static function log($string) {
    echo "<script>console.log('" . $string . "')</script>";
  }
}

class Api {
  //gets data by a certain given condition
  public static function getDataBy($condition, $data, $returns, $con){
    switch ($condition) {
      case 'token':
        $sqlData = Api::getDataSql($data, $con);
        if(!$sqlData) return false;
        if($sqlData->token == $data) echo(json_encode($sqlData));
        return true;
        break;

      default:
        echo "error";
        return false;
        break;
    }
  }

  //writes token to database
  public static function setTokenSql($token, $id, $con){
    $result = mysqli_query($con, "update users set token='".$token."' where userId='".$id."'");
    if($result) return true; else return false;
  }

  //checks wether the login is viable
  public static function checkLogin($token, $uId, $con){
    return mysqli_num_rows(mysqli_query($con, "SELECT * from users WHERE token='".$token."' AND userId='".$uId."'"));
  }

  //gets userrow from database if token matches one from the database
  //returns false otherwise
  public static function getDataSql($data, $con){
    $result = mysqli_query($con, "select * from users where token='".$data."'");
    if($result == false) return false;
    while ($row = mysqli_fetch_object($result)) {
      return $row;
    }
  }

  //compares logindata to data from database and returns the result
  public static function logInSql($uData, $con){
    $uMail = $uData['uMail'];
    $uPass = hash('sha256', $uData['uPass']);
    $result = mysqli_query($con, "select * from users where userEmail='".$uMail."'");
    if($result == false) return false;
    while ($row = mysqli_fetch_object($result)) {
      if($row->userPass == $uPass) return $row; else return false;
    }
  }

  public static function logOutSql($uData, $con){
    $uId = $uData['userId'];
    $result = mysqli_query($con, "update users set token='' where userId='".$uId."'");
    if($result == false) return false; else return true;
  }
}

//TODO: ALl of this

class Points {
  public static function addPoints($amount, $uId, $con){
    $result = mysqli_query($con, "update users set userPoints = userPoints + '".$amount."' where userId='".$uId."'");
  }

  public static function setPoints($amount, $uId, $con){
    $result = mysqli_query($con, "update users set userPoints = '".$amount."' where userId='".$uId."'");
  }


  //TODO: Make this work
  public static function getPoints($uid, $con){
    $result = mysqli_query($con, "select userPoints from users where userId='".$uId."'");
    $assoc = mysqli_fetch_object($result);
    echo $assoc['userId'];
    return $assoc['userId'];
  }

  public static function subPoints($amount, $uId, $con){
    $result = mysqli_query($con, "update users set userPoints = userPoints - '".$amount."' where userId='".$uId."'");
  }

  public static function addToTotal($uId, $con){
    $result = mysqli_query($con, "update users set userTotal = userPoints + userTotal where userId='".$uId."'");
    $result = mysqli_query($con, "update users set userPoints = 0 where userId='".$uId."'");
  }
}

function array_to_object($array) {
    return (object) $array;
}

class Project {
  //HACK: TODO: Fix all of the code below and finish up project creation system
  public static function create($uId, $arr, $con){
    $data = array_to_object($arr);
    $result = mysqli_query($con, "SELECT * FROM projects");
    $num = mysqli_num_rows($result);
    $num++;
    $array = array($uId);
    $idarray = json_encode($array);
    $query = mysqli_query($con, "INSERT INTO projects VALUES (
        '$num',
        '$data->pTitle',
        '$data->pContent',
        '$idarray',
        '$uId',
        '$data->pDate',
        '$data->pTime',
        '$data->pDuration',
        '$data->pLocation',
        '0',
        '0',
        '$data->pMax')");
        //return id
        return true;
  }
  public static function approve($id, $con){

  }
  public static function disapprove($id, $con){

  }
  public static function delete($id, $prId, $con){
    $query = mysqli_query($con, "select leader from projects where id=$prId");
    $leader = mysqli_fetch_array($query);
    $leader = $leader['leader'];
    $query = mysqli_query($con, "select userStatus from users where userId=$id");
    $status = mysqli_fetch_array($query);
    $status = $status['userStatus'];
    $allowed = false;
    if($uId == $leader) $allowed = true;
    if($status == 1) $allowed = true;
    if($allowed){
      $result = mysqli_query($con, "update projects set status='2' where id='".$prId."'");
      echo $result;
    }else{
      echo "ERROR: User not allowed to delete project!";
    }
  }
  public static function edit($uId, $id, $con){
    $query = mysqli_query($con, "select leader from projects where id=$id");
    $leader = mysqli_fetch_array($query);
    $leader = $leader['leader'];
    $query = mysqli_query($con, "select userStatus from users where userId=$uId");
    $status = mysqli_fetch_array($query);
    $status = $status['userStatus'];
    $allowed = false;
    if($uId == $leader) $allowed = true;
    if($status == 1) $allowed = true;
    if($allowed){
    $query = mysqli_query($con, "select * from projects where id=$id");
    $project = mysqli_fetch_array($query);
    return json_encode($project);
      //TODO: create user edit system!
    }else{
      echo "ERROR: User not allowed to edit project!";
    }
  }
  public static function submitEdit($id, $prId, $pData, $con){

    $pTitle = $pData['pTitle'];
    $pContent = $pData['pContent'];
    $pLeader = $pData['pLeader'];
    $pDate = $pData['pDate'];
    $pTime = $pData['pTime'];
    $pDuration = $pData['pDuration'];
    $pLocation = $pData['pLocation'];
    $pMax = $pData['pMax'];

    $query = mysqli_query($con, "UPDATE projects SET
    title='$pTitle',
    content='$pContent',
    leader='$pLeader',
    date='$pDate',
    time='$pTime',
    duration='$pDuration',
    location='$pLocation',
    max='$pMax'
    WHERE id=$prId");
    return json_encode($query);
  }
  public static function get($id, $con){

  }

  //IDEA: maybe make users join/leave by userId?
  public static function join($uId, $id, $con){
    $query = mysqli_query($con, "select members from projects where id=$id");
    $array = mysqli_fetch_array($query);
    $array = $array['members'];
    $decoded = json_decode($array, true);
    for($i = 0; $i < count($decoded); $i++){
      if($decoded[$i] == $uId) $double = true;
    }
    if(!$double){
      array_push($decoded,$uId);
      print_r($decoded);
      $serialized_array = json_encode($decoded);
      $result = mysqli_query($con, "update projects set members='$serialized_array' where id='".$id."'");
    }else{
      echo "ERROR: User already joined the project!";
    }
  }

  public static function leave($uId, $id, $con){
    $query = mysqli_query($con, "select leader from projects where id=$id");
    $leader = mysqli_fetch_array($query);
    if($leader['leader'] != $uId){
      $query = mysqli_query($con, "select members from projects where id=$id");
      $array = mysqli_fetch_array($query);
      $array = $array['members'];
      $decoded = json_decode($array, true);
      for($i = 0; $i < count($decoded); $i++){
        if($decoded[$i] == $uId) $lId = $i;
      }
      if($lId){
        unset($decoded[$lId]);
        print_r($decoded);
        $serialized_array = json_encode($decoded);
        $result = mysqli_query($con, "update projects set members='$serialized_array' where id='".$id."'");
      }else{
        echo "ERROR: User hasn't joined project!";
      }
    }else{
      echo "ERROR: Leader cannot leave project!";
    }
  }
}

if(isset($_POST['action'])){
  switch ($_POST['action']) {
    case 'settoken':
      //TODO: implement getting id from login and then giving the user id to the setTokenSql function
      if(!Api::setTokenSql($_POST['token'], $_POST['id'], $con)) echo "\nerror: couldnt write to database!"; else echo "sucessfully written to database!";
      break;
    case 'comparetoken':
      if(Api::getDataBy("token", $_POST['token'], "nothing", $con) == false) echo "\nerror: couldnt read from database!";;
      break;
    case 'login':
      $loginStat = Api::logInSql($_POST['uData'], $con);
      if($loginStat != false) echo json_encode($loginStat); else return false;
      break;
    case 'logout':
      if(Api::logOutSql($_POST['uData'], $con)) echo "logged out sucessfully!"; else echo "error: logout failed!";
      break;
    case 'createproject':
      if(Project::create($_POST['id'], $_POST['pData'], $con)) echo "project created successfully!"; else echo "error: error while trying to create project!";
      break;
    case 'loaddata':
      echo(json_encode(Project::load()));
      break;
    case 'joinproject':
      Project::join($_POST['id'],$_POST['prId'],$con);
    break;
    case 'leaveproject':
      Project::leave($_POST['id'],$_POST['prId'],$con);
    break;
    case 'editproject':
      echo Project::edit($_POST['id'],$_POST['prId'],$con);
    break;
    case 'deleteproject':
      echo Project::delete($_POST['id'],$_POST['prId'],$con);
    break;
    case 'submitedit':
      echo Project::submitEdit($_POST['id'],$_POST['prId'],$_POST['pData'],$con);
    break;
    case 'checklogin':
      echo Api::checkLogin($_POST['token'],$_POST['uId'],$con);
    break;
    default:
      return false;
      break;
  }
}

 ?>
