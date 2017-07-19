<div class="row">
<div class="col s0 m2 l2"></div>
<div class="col s12 m8 l8">
  <div class="card blue-grey darken-1">
    <div class="card-content white-text">
      <span class="card-title"><?php echo $data['title'] ?></span>


         <?php
         if(!checkJoin($uId, $data['id'], $con) == true){
            echo '<div class="fixed-action-btn tooltipped absolute" data-position="left" data-delay="50" data-tooltip="Beitreten"><a class="btn-floating green joinbtn" onclick="join(' . $data['id'] . ')"><i class="material-icons">person_add</i>';
          }else{
            echo '<div class="fixed-action-btn tooltipped absolute" data-position="left" data-delay="50" data-tooltip="Verlassen"><a class="btn-floating red joinbtn" onclick="leave(' . $data['id'] . ')"><i class="material-icons">close</i>';
          }?>
       </a>
     </div>

      <p><?php echo $data['content'] ?></p>
    </div>
    <div class="card-action">
      <?php
        $detect = new Mobile_Detect;
        if ($detect->isMobile()) $pmax = 3; else $pmax = 10;

        $parse = $data['members'];
        $parse = json_decode($parse);
        $pcount = count($parse);
        if($pcount > $pmax) $pcount = $pmax;
        for($j = 0; $j < $pcount; $j++){

          $id = $parse[$j];
          $query = mysqli_query($con,"SELECT userName FROM users WHERE userId=$id");
          $name = mysqli_fetch_array($query);
          echo '<div class="chip grey darken-3 z-depth-1 white-text tooltipped" data-position="bottom" data-delay="50" data-tooltip="Teilnehmer/in">' . nameParser($name['userName']) . "</div>";

        }
       ?>

       <a onclick="" class="chip white-text grey darken-3 z-depth-1">
         <div class="valign-wrapper">
           &nbsp...&nbsp;
         </div>
       </a>
    </div>
  </div>
</div>
<div class="col s0 m2 l2"></div>
</div>
