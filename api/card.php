<div class="row">
  <div class="col s12 m4"></div>
  <div class="col s12 m4">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <span class="card-title"><?php echo $data['title']; ?></span>
        <p><?php echo $data['content']; ?></p>
      </div>
      <?php
        if(Project::checkJoin($uId, $data['id'], $con)){
          echo '<a onclick="leave('. $data['id'] .')" class="btn-floating waves-effect waves-light red right joinbtn tooltipped" data-position="bottom" data-delay="50" data-tooltip="leav project"><i class="material-icons">remove</i></a>';
        }else{
          echo '<a onclick="join('. $data['id'] .')" class="btn-floating waves-effect waves-light green right joinbtn tooltipped" data-position="bottom" data-delay="50" data-tooltip="join project" '; if(Project::checkFull($data['id'], $con)) echo "disabled";  echo '><i class="material-icons">person_add</i></a>';
        }

        if(Project::canEdit($uId, $data['id'], $con)) echo '<a onclick="edit('. $data['id'] .')" class="btn-floating waves-effect waves-light blue-grey darken-3 right editbtn tooltipped" data-position="bottom" data-delay="50" data-tooltip="edit project"><i class="material-icons">edit</i></a>';
      ?>
      <a class="btn-floating waves-effect waves-light blue-grey darken-3 morebtn tooltipped left" data-position="bottom" data-delay="50" data-tooltip="view project"><i class="material-icons">remove_red_eye</i></a>
    </div>
  </div>
  <div class="col s12 m4"></div>
</div>
