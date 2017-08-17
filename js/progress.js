var circle = new ProgressBar.Circle('#progress_round', {
    strokeWidth: 2,
    color: '#FFFFFF',
    duration: 2000,
    easing: 'easeInOut',
    trailColor: 'rgba(0, 0, 0, 0.3)',
});

// points = points * 0.05;
//
// if(points > 1){
//   points = 1;
// }


var uId = localStorage.getItem("userid");
getPoints(uId);

function getPoints(uId){

	$.ajax({
            type: "POST",
            url: "/new/api/api.php",
            data: {
              action: "getpoints",
              uId: uId
            },
            success: function(results){

              var easingFn = function (t, b, c, d) {
                var ts = (t /= d) * t;
                var tc = ts * t;
                return b + c * (tc + -3 * ts + 3 * t);
              }

              var options = {
                useEasing : true,
                easingFn: easingFn,
                useGrouping : true,
                separator : ',',
                decimal : '.',
                prefix : 'Your Points: ',
                suffix : ' / 20'
              };

              var count = new CountUp("count", 0, results, 0, 2.2, options);
              if(results >= 20){
                count.start(animate);
              }else{
                count.start();
              }

            points = results * 0.05;
            if(points > 1) points = 1;

            circle.animate(points);

            },
            error: function(results){
              console.log(results);
            }
  });
}

function animate(){
  $(".mark").addClass("tada");
  setTimeout(function(){
    $(".mark").addClass("imageRotateHorizontal");
  }, 1000);
}
