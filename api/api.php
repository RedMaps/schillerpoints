<?php
include "dbconnect.php";

//outputs to console like javascripts console.log();
class Console {
  public static function log($string) {
    echo "<script>console.log('" . $string . "')</script>";
  }
}

class Poll {
  public static function getPollData($id, $con){
    $query = mysqli_query($con, "SELECT * FROM polls WHERE id='".$id."'");
    $poll = mysqli_fetch_array($query);
    echo json_encode($poll);
  }

  public static function progressPoll($id, $check, $con){
    $result = mysqli_query($con, "SELECT * FROM ".POLLBASE." WHERE id='".$id."'");
    $res = mysqli_fetch_array($result);
    $array = json_decode($res['results']);
    $val = $array[$check] + 1;
    $spliced = array_splice($array,$check,1,$val);
    $new_array = json_encode($array);
    $query = mysqli_query($con, "UPDATE ".POLLBASE." SET results='".$new_array."' WHERE id='".$id."'");
    echo $new_array;
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

  public static function getNames($ids, $con){
    $array = array();
    for($i = 0; $i < count($ids); $i++){
      $result = mysqli_query($con, "select userName from ".USERBASE." where userId='".$ids[$i]."'");
      $assoc = mysqli_fetch_array($result);
      array_push($array, nameParser($assoc[0]));
    }
    echo json_encode($array);
  }

  public static function getName($id, $con){
    $result = mysqli_query($con, "select userName from ".USERBASE." where userId='".$id."'");
    $assoc = mysqli_fetch_array($result);
    echo json_encode(nameParser($assoc[0]));
  }

  //writes token to database
  public static function setTokenSql($token, $id, $con){
    $result = mysqli_query($con, "update ".USERBASE." set token='".$token."' where userId='".$id."'");
    if($result) return true; else return false;
  }

  //checks wether the login is viable
  public static function checkLogin($token, $uId, $con){
    return mysqli_num_rows(mysqli_query($con, "SELECT * from ".USERBASE." WHERE token='".$token."' AND userId='".$uId."'"));
  }

  //gets userrow from database if token matches one from the database
  //returns false otherwise
  public static function getDataSql($data, $con){
    $result = mysqli_query($con, "select * from ".USERBASE." where token='".$data."'");
    if($result == false) return false;
    while ($row = mysqli_fetch_object($result)) {
      return $row;
    }
  }

  //compares logindata to data from database and returns the result
  public static function logInSql($uData, $con){
    $uMail = $uData['uMail'];
    $uPass = hash('sha256', $uData['uPass']);
    $result = mysqli_query($con, "select * from ".USERBASE." where userEmail='".$uMail."'");
    if($result == false){
      echo "ERROR: E-Mail or password incorrect!";
    }else{
      while ($row = mysqli_fetch_object($result)) {
        if($row->userPass == $uPass) return $row;
      }
    }
    echo "ERROR: E-Mail or password incorrect!";
  }

  public static function logOutSql($uData, $con){
    $uId = $uData['userId'];
    $result = mysqli_query($con, "update ".USERBASE." set token='' where userId='".$uId."'");
    if($result == false) return false; else return true;
  }
}

//TODO: ALl of this

class Points {
  public static function addPoints($amount, $uId, $con){
    $result = mysqli_query($con, "update ".USERBASE." set userPoints = userPoints + '".$amount."' where userId='".$uId."'");
  }

  public static function setPoints($amount, $uId, $con){
    $result = mysqli_query($con, "update ".USERBASE." set userPoints = '".$amount."' where userId='".$uId."'");
  }

  public static function getPoints($uid, $con){
    $result = mysqli_query($con, "select userPoints from ".USERBASE." where userId='".$uid."'");
    $assoc = mysqli_fetch_array($result);
    echo $assoc[0];
  }

  public static function subPoints($amount, $uId, $con){
    $result = mysqli_query($con, "update ".USERBASE." set userPoints = userPoints - '".$amount."' where userId='".$uId."'");
  }

  public static function addToTotal($uId, $con){
    $result = mysqli_query($con, "update ".USERBASE." set userTotal = userPoints + userTotal where userId='".$uId."'");
    $result = mysqli_query($con, "update ".USERBASE." set userPoints = 0 where userId='".$uId."'");
  }
}

function array_to_object($array) {
    return (object) $array;
}

function nameParser($name){
  $UN = explode(' ', $name);
  $lastName = $UN[1];
  $firstName = $UN[0];
  $lastName = substr($lastName, 0 , 1);
  $lastName = strtoupper($lastName);
  return $firstName . " " . $lastName . ".";
}

class Project {
  //HACK: TODO: Fix all of the code below and finish up project creation system
  public static function create($uId, $arr, $con){
    $data = array_to_object($arr);
    $result = mysqli_query($con, "SELECT * FROM ".PRJBASE."");
    $num = mysqli_num_rows($result);
    $num++;
    $array = array($uId);
    $idarray = json_encode($array);
    $query = mysqli_query($con, "INSERT INTO ".PRJBASE." VALUES (
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
    $query = mysqli_query($con, "select leader from ".PRJBASE." where id=$prId");
    $leader = mysqli_fetch_array($query);
    $leader = $leader['leader'];
    $query = mysqli_query($con, "select userStatus from ".USERBASE." where userId=$id");
    $status = mysqli_fetch_array($query);
    $status = $status['userStatus'];
    $allowed = false;
    if($uId == $leader) $allowed = true;
    if($status == 1) $allowed = true;
    if($allowed){
      $result = mysqli_query($con, "update ".PRJBASE." set status='2' where id='".$prId."'");
      echo $result;
    }else{
      echo "ERROR: User not allowed to delete project!";
    }
  }
  public static function edit($uId, $id, $con){
    $query = mysqli_query($con, "select * from ".PRJBASE." where id=$id");
    $results = mysqli_fetch_array($query);
    $leader = $results['leader'];
    $query = mysqli_query($con, "select * from ".USERBASE." where userId=$uId");
    $array = mysqli_fetch_array($query);
    $userstatus = $array['userStatus'];
    $status = $results['status'];
    if($status != 1 && $userstatus != 1){
      echo "ERROR: Only admins can edit this project!";
      return false;
    }
    $allowed = false;
    if($uId == $leader) $allowed = true;
    if($userstatus == 1) $allowed = true;
    if($allowed){
    $query = mysqli_query($con, "select * from ".PRJBASE." where id=$id");
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
    $pDate = $pData['pDate'];
    $pTime = $pData['pTime'];
    $pDuration = $pData['pDuration'];
    $pLocation = $pData['pLocation'];
    $pMax = $pData['pMax'];

    $query = mysqli_query($con, "UPDATE ".PRJBASE." SET
    title='$pTitle',
    content='$pContent',
    date='$pDate',
    time='$pTime',
    duration='$pDuration',
    location='$pLocation',
    max='$pMax'
    WHERE id=$prId");
    return json_encode($pTitle);
  }
  public static function view($id, $con){
    $query = mysqli_query($con, "select * from ".PRJBASE." where id=$id");
    $project = mysqli_fetch_array($query);
    return json_encode($project);
  }

  //returns true if user joined project
  public static function checkJoin($uId, $id, $con){
    $double = false;
    $query = mysqli_query($con, "select members from ".PRJBASE." where id=$id");
    $array = mysqli_fetch_array($query);
    $array = $array['members'];
    $decoded = json_decode($array, true);
    for($i = 0; $i < count($decoded); $i++){
      if($decoded[$i] == $uId) $double = true;
    }
    return $double;
  }

  public static function checkFull($id, $con){
    $query = mysqli_query($con, "select members from ".PRJBASE." where id=$id");
    $array = mysqli_fetch_array($query);
    $array = $array['members'];
    $decoded = json_decode($array, true);
    $query = mysqli_query($con, "select max from ".PRJBASE." where id=$id");
    $array = mysqli_fetch_array($query);
    $max = $array['max'];
    $amount = count($decoded);
    if($amount < $max) return false; else return true;
  }

  public static function canEdit($uId, $id, $con){
    $array = mysqli_fetch_array(mysqli_query($con, "select userStatus from ".USERBASE." where userId=$uId"));
    $status = $array['userStatus'];
    if($status) return true;
    $array = mysqli_fetch_array(mysqli_query($con, "select leader from ".PRJBASE." where id=$id"));
    $leader = $array['leader'];
    if($leader == $uId) return true; else return false;
  }

  public static function join($uId, $id, $con){
    $query = mysqli_query($con, "select * from ".PRJBASE." where id=$id");
    $array = mysqli_fetch_array($query);
    $status = $array['status'];
    if($status != '1'){
      echo "ERROR: You can only join active projects!";
      return false;
    }
    $array = $array['members'];
    $decoded = json_decode($array, true);
    for($i = 0; $i < count($decoded); $i++){
      if($decoded[$i] == $uId) $double = true;
    }
    if(!$double){
      array_push($decoded,$uId);
      $serialized_array = json_encode($decoded);
      $result = mysqli_query($con, "update ".PRJBASE." set members='$serialized_array' where id='".$id."'");
      echo "SUCCESS: Sucessfully joined the project!";
    }else{
      echo "ERROR: Already joined the project!";
    }
  }

  public static function leave($uId, $id, $con){
    $query = mysqli_query($con, "select * from ".PRJBASE." where id=$id");
    $results = mysqli_fetch_array($query);
    $status = $results['status'];
    if($status != 1){
      echo "ERROR: You can only leave active projects!";
      return false;
    }
    if($results['leader'] != $uId){
      $array = $results['members'];
      $decoded = json_decode($array, true);
      for($i=0;$i<count($decoded);$i++){
        if($decoded[$i] == $uId) $lId = $i;
      }
      if($lId){
        unset($decoded[$lId]);
        $serialized_array = json_encode($decoded);
        $result = mysqli_query($con, "update ".PRJBASE." set members='$serialized_array' where id='".$id."'");
        echo "SUCCESS: Successfully left the project!";
      }else{
        echo "ERROR: You havent joined the project yet!";
      }
    }else{
      echo "ERROR: Leader cannot leave the project!";
    }
  }
}

if(isset($_POST['action']) || $val != null){
  $action = $_POST['action'];
  if($val != null) $action = $val;
  switch ($action) {
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
    case 'viewproject':
      echo Project::view($_POST['prId'],$con);
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
    case 'getnames':
      echo Api::getNames($_POST['ids'],$con);
    break;
    case 'getname':
      echo Api::getName($_POST['id'],$con);
    break;
    case 'getpoints':
      echo Points::getPoints($_POST['uId'],$con);
    break;
    case 'getpolldata':
      echo Poll::getPollData($_POST['id'],$con);
    break;
    case 'progresspoll':
      echo Poll::progressPoll($_POST['id'],$_POST['check'],$con);
    break;
    default:
      return false;
      break;
  }
}

 ?>
