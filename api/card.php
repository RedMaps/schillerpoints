<div class="row">
  <div class="col s12 m3 l4"></div>
  <div class="col s12 m6 l4">
    <div class="card blue-grey darken-1">
      <div class="card-content white-text">
        <?php
        $date = new DateTime($data['date'] . $data['time']);
        $now = new DateTime();
         ?>
        <span class="new badge <?php if($now->diff($date)->format('%r')) echo 'red darken-1'; ?>" data-badge-caption=""><?php
          echo $now->diff($date)->format("%r %a Days left");
          ?></span>
        <span class="card-title"><?php echo $data['title']; ?></span>
        <p><?php echo $data['content']; ?></p>
      </div>
      <?php
        if($uId == 0){
          echo '<a class="btn-floating waves-effect waves-light green right joinbtn tooltipped" data-position="left" data-tooltip="This project is full!" disabled=""><i class="material-icons">person_add</i></a>';
        }else{
          if(Project::checkJoin($uId, $data['id'], $con)){
            echo '<a onclick="leave('. $data['id'] .')" class="btn-floating waves-effect waves-light red right joinbtn tooltipped" data-position="left" data-tooltip="leave project"><i class="material-icons">remove</i></a>';
          }else{
            echo '<a onclick="join('. $data['id'] .')" class="btn-floating waves-effect waves-light green right joinbtn tooltipped" data-position="left" data-tooltip="'; if(Project::checkFull($data['id'], $con)) echo "This project is full!"; else echo "join project"; echo '"'; if(Project::checkFull($data['id'], $con)) echo "disabled";  echo '><i class="material-icons">person_add</i></a>';
          }
        }
        if(Project::canEdit($uId, $data['id'], $con)) echo '<a onclick="edit('. $data['id'] .')" class="btn-floating waves-effect waves-light blue-grey darken-3 right editbtn tooltipped" data-position="left" data-tooltip="edit project"><i class="material-icons">edit</i></a>';
      ?>
      <?php echo '<a onclick="view('. $data['id'] .')" class="btn-floating waves-effect waves-light blue-grey darken-3 morebtn tooltipped left" data-position="right" data-tooltip="view project"><i class="material-icons">remove_red_eye</i></a>'; ?>
    </div>
  </div>
  <div class="col s12 m3 l4"></div>
</div>
