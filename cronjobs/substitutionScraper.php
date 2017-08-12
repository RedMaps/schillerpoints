<?php

require_once '../api/dbconnect.php';

require "../vendor/autoload.php";
use PHPHtmlParser\Dom;
setlocale(LC_TIME, "de_DE");

$dom = new Dom;
// $dom->loadFromUrl('http://www.schillergymnasium-muenster.de/rarw78tg/38o7fgn7/'.date('W', strtotime("+2 days")).'/w/w00000.htm');
$dom->loadFromUrl('http://www.schillergymnasium-muenster.de/rarw78tg/38o7fgn7/33/w/w00000.htm');

$info = $dom->find("table");

$modt_mon = $info[0]->find("td");
$modt_tue = $info[2]->find("td");
$modt_wed = $info[4]->find("td");
$modt_thu = $info[6]->find("td");
$modt_fri = $info[8]->find("td");

mysqli_query($con, 'TRUNCATE TABLE `info_mon`');
mysqli_query($con, 'TRUNCATE TABLE `info_tue`');
mysqli_query($con, 'TRUNCATE TABLE `info_wed`');
mysqli_query($con, 'TRUNCATE TABLE `info_thu`');
mysqli_query($con, 'TRUNCATE TABLE `info_fri`');

for($i=0; $i < count($modt_mon); $i++){
  $text = $modt_mon[$i];
    $f = $i+1;
  mysqli_query($con, "INSERT INTO info_mon(id, text) VALUES('$f','$text')");
}
for($i=0; $i < count($modt_tue); $i++){
  $text = $modt_tue[$i];
    $f = $i+1;
  mysqli_query($con, "INSERT INTO info_tue(id, text) VALUES('$f','$text')");
}
for($i=0; $i < count($modt_wed); $i++){
  $text = $modt_wed[$i];
    $f = $i+1;
  mysqli_query($con, "INSERT INTO info_wed(id, text) VALUES('$f','$text')");
}
for($i=0; $i < count($modt_thu); $i++){
  $text = $modt_thu[$i];
    $f = $i+1;
  mysqli_query($con, "INSERT INTO info_thu(id, text) VALUES('$f','$text')");
}
for($i=0; $i < count($modt_fri); $i++){
  $text = $modt_fri[$i];
    $f = $i+1;
  mysqli_query($con, "INSERT INTO info_fri(id, text) VALUES('$f','$text')");
}

$list = $dom->find("table.subst");

$mon = $list[0];
$tue = $list[1];
$wed = $list[2];
$thu = $list[3];
$fri = $list[4];

mysqli_query($con, 'TRUNCATE TABLE `substitution_mon`');

$mon = $mon->find("tr");
for($i=1; $i < count($mon); $i++){
  $row = $mon[$i]->find("td");
  $klasse = $row[0]->text();
  $date = $row[1]->text();
  $datum = date('Y-m-d',strtotime($date));
  $stunde = $row[2]->text();
  $fach = $row[3]->text();
  $text = $row[4]->text();
  $vertreter = $row[5]->text();
  $raum = $row[6]->text();

  mysqli_query($con, "INSERT INTO substitution_mon(id, klasse, datum, stunde, fach, text, vertreter, raum) VALUES('$i','$klasse','$datum','$stunde','$fach','$text','$vertreter','$raum')");
}

mysqli_query($con, 'TRUNCATE TABLE `substitution_tue`');

$tue = $tue->find("tr");
for($i=1; $i < count($tue); $i++){
  $row = $tue[$i]->find("td");
  $klasse = $row[0]->text();
  $date = $row[1]->text();
  $datum = date('Y-m-d',strtotime($date));
  $stunde = $row[2]->text();
  $fach = $row[3]->text();
  $text = $row[4]->text();
  $vertreter = $row[5]->text();
  $raum = $row[6]->text();

  mysqli_query($con, "INSERT INTO substitution_tue(id, klasse, datum, stunde, fach, text, vertreter, raum) VALUES('$i','$klasse','$datum','$stunde','$fach','$text','$vertreter','$raum')");
}

mysqli_query($con, 'TRUNCATE TABLE `substitution_wed`');

$wed = $wed->find("tr");
for($i=1; $i < count($wed); $i++){
  $row = $wed[$i]->find("td");
  $klasse = $row[0]->text();
  $date = $row[1]->text();
  $datum = date('Y-m-d',strtotime($date));
  $stunde = $row[2]->text();
  $fach = $row[3]->text();
  $text = $row[4]->text();
  $vertreter = $row[5]->text();
  $raum = $row[6]->text();

  mysqli_query($con, "INSERT INTO substitution_wed(id, klasse, datum, stunde, fach, text, vertreter, raum) VALUES('$i','$klasse','$datum','$stunde','$fach','$text','$vertreter','$raum')");
}

mysqli_query($con, 'TRUNCATE TABLE `substitution_thu`');

$thu = $thu->find("tr");
for($i=1; $i < count($thu); $i++){
  $row = $thu[$i]->find("td");
  $klasse = $row[0]->text();
  $date = $row[1]->text();
  $datum = date('Y-m-d',strtotime($date));
  $stunde = $row[2]->text();
  $fach = $row[3]->text();
  $text = $row[4]->text();
  $vertreter = $row[5]->text();
  $raum = $row[6]->text();

  mysqli_query($con, "INSERT INTO substitution_thu(id, klasse, datum, stunde, fach, text, vertreter, raum) VALUES('$i','$klasse','$datum','$stunde','$fach','$text','$vertreter','$raum')");
}

mysqli_query($con, 'TRUNCATE TABLE `substitution_fri`');

$fri = $fri->find("tr");
for($i=1; $i < count($fri); $i++){
  $row = $fri[$i]->find("td");
  $klasse = $row[0]->text();
  $date = $row[1]->text();
  $datum = date('Y-m-d',strtotime($date));
  $stunde = $row[2]->text();
  $fach = $row[3]->text();
  $text = $row[4]->text();
  $vertreter = $row[5]->text();
  $raum = $row[6]->text();

  mysqli_query($con, "INSERT INTO substitution_fri(id, klasse, datum, stunde, fach, text, vertreter, raum) VALUES('$i','$klasse','$datum','$stunde','$fach','$text','$vertreter','$raum')");
}


$klasse = array();
$datum = array();
$stunde = array();
$fach = array();
$text = array();
$vertreter = array();
$raum = array();



// mysql_query('TRUNCATE TABLE `vertretung_new`');
//
// $arraySize = count($klasse);

// for($c = 0; $c < $arraySize; $c++){
//   mysql_query("INSERT INTO vertretung_new(id, klasse, datum, stunde, fach, text, vertreter, raum) VALUES('$c','$klasse[$c]','$datum[$c]','$stunde[$c]','$fach[$c]','$text[$c]','$vertreter[$c]','$raum[$c]')");
//  }

?>
