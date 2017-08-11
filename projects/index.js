$('.datepicker').pickadate({
 selectMonths: true, // Creates a dropdown to control month
 selectYears: 15, // Creates a dropdown of 15 years to control year
 formatSubmit: 'mm/dd/yyyy'
});

$('.timepicker').pickatime({
  default: 'now', // Set default time
  fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
  twelvehour: false, // Use AM/PM or 24-hour format
  donetext: 'OK', // text for done-button
  cleartext: 'Clear', // text for clear-button
  canceltext: 'Cancel', // Text for cancel-button
  autoclose: false, // automatic close timepicker
  ampmclickable: true, // make AM PM clickable
  formatSubmit: 'HH:i',
  hiddenName: true,
  aftershow: function(){} //Function for after opening timepicker
});

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

 $(".button-collapse").sideNav();


 // Hide Header on on scroll down
 var didScroll;
 var lastScrollTop = 0;
 var delta = 65;
 var navbarHeight = $('header').outerHeight();

 $(window).scroll(function(event){
     didScroll = true;
 });

 setInterval(function() {
     if (didScroll) {
         hasScrolled();
         didScroll = false;
     }
 }, 20);

 function hasScrolled() {
     var st = $(this).scrollTop();

     // Make sure they scroll more than delta
     if(Math.abs(lastScrollTop - st) <= delta)
         return;

     // If they scrolled down and are past the navbar, add class .nav-up.
     // This is necessary so you never see what is "behind" the navbar.
     if (st > lastScrollTop && st > navbarHeight){
         // Scroll Down
         $('header').removeClass('nav-down').addClass('nav-up');
         $('.addbtn').removeClass('btn-down').addClass('btn-up');
     } else {
         // Scroll Up
         if(st + $(window).height() < $(document).height()) {
             $('header').removeClass('nav-up').addClass('nav-down');
             $('.addbtn').removeClass('btn-up').addClass('btn-down');
         }
     }

     lastScrollTop = st;
 }