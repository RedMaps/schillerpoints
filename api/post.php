<?php

if(isset($_GET['finished']) && $_GET['finished'] != ""){
   $fin = $_GET['finished'];
   if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE pass='".$fin."'")) > 0){
     $res = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM ".PRJBASE." WHERE pass='".$fin."'"));
     $id = $res['id'];
     echo "<script>$('.pointModal').modal('open');
     loadPoint($id);</script>";
   }
}

if(isset($_GET['reset']) && $_GET['reset'] != ""){
   $reset = $_GET['reset'];
   if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM ".USERBASE." WHERE reset='".$reset."'")) > 0){
    $res = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM ".USERBASE." WHERE reset='".$reset."'"));
    $id = $res['id'];
    echo "<script>$('.passResetModal').modal('open');
    $('.reset').attr('onclick', 'resetPass(' + res.userId + ')');</script>";
  }
}

?>
