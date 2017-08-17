$('.button-collapse').sideNav();
$('.modal').modal({
  dismissible: true, // Modal can be dismissed by clicking outside of the modal
  opacity: 0.5, // Opacity of modal background
  inDuration: 300, // Transition in duration
  outDuration: 200, // Transition out duration
  startingTop: '4%', // Starting top style attribute
  endingTop: '10%', // Ending top style attribute
  ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
    alert("Ready");
    console.log(modal, trigger);
  },
  complete: function() {
   } // Callback for Modal close
});

loadSubTable();

function loadSubTable(){
  $.ajax({
        type: "POST",
        url: "loadsubtable.php",
        data: {
          action: "loadsubtable"
        },
        success: function(results){
            $(".loadsubtable").html(results);
          },
        error: function(message){
            console.log(message);
        }
  })
}

function searchSubTable(){

  var search = $("#searchfield");
  search = search.focus();
  search = search.val();

  $.ajax({
        type: "POST",
        url: "loadsubtable.php",
        data: {
          action: "search",
          search: search
        },
        success: function(results){
            $(".loadsubtable").html(results);
          },
        error: function(message){
            console.log(message);
        }
  })
}
