  window.onload = function() {
    console.log("onload fired!");
    checkLogin();
  };

  $(document).ready(function(){
    console.log("document ready fired!");
    loadNotifications();
    loadMyNotifications();
    loadBadge();

    // $(".pollModal").modal("open");
    $('.dropdown-button').dropdown({
          inDuration: 300,
          outDuration: 225,
          constrainWidth: false, // Does not change width of dropdown to that of the activator
          hover: false, // Activate on hover
          gutter: 0, // Spacing from edge
          belowOrigin: true, // Displays dropdown below the button
          alignment: 'left', // Displays dropdown with edge aligned to the left of button
          stopPropagation: false // Stops event propagation
        }
      );
    $('.collapsible').collapsible();
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: 0.5, // Opacity of modal background
      inDuration: 300, // Transition in duration
      outDuration: 200, // Transition out duration
      startingTop: '4%', // Starting top style attribute
      endingTop: '10%', // Ending top style attribute
      ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
        console.log(modal, trigger);
        $('ul.tabs').tabs();
      },
      complete: function() {
       } // Callback for Modal close
    }
  );
});

$(".del-checkbox").change(function() {
    if(this.checked) {
      $(".deletebtn").removeClass("disabled");
      console.log("checked!");
    }else{
      $(".deletebtn").addClass("disabled");
      console.log("unchecked!");
    }
});

$('.tooltipped').tooltip();

$(".button-collapse").sideNav();

$('.modal').modal({
  dismissible: true, // Modal can be dismissed by clicking outside of the modal
  opacity: 0.5, // Opacity of modal background
  inDuration: 300, // Transition in duration
  outDuration: 200, // Transition out duration
  startingTop: '4%', // Starting top style attribute
  endingTop: '10%', // Ending top style attribute
  ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
    console.log(modal, trigger);
  },
  complete: function() {
   } // Callback for Modal close
});
