//javascript equivalent to the uniqid function from php
(function () {
	this.uniqid = function (pr, en) {
		var pr = pr || '', en = en || false, result;

		this.seed = function (s, w) {
			s = parseInt(s, 10).toString(16);
			return w < s.length ? s.slice(s.length - w) : (w > s.length) ? new Array(1 + (w - s.length)).join('0') + s : s;
		};

		result = pr + this.seed(parseInt(new Date().getTime() / 1000, 10), 8) + this.seed(Math.floor(Math.random() * 0x75bcd15) + 1, 5);

		if (en) result += (Math.random() * 10).toFixed(8).toString();

		return result;
	};
})();

String.prototype.replaceAll = function(s1, s2) {
    return this.replace(
        new RegExp(  s1.replace(/[.^$*+?()[{\|]/g, '\\$&'),  'g'  ),
        s2
    );
};

if(localStorage.getItem("loginstatus") === null) localStorage.setItem("loginstatus",false);

var data, id;
var loginStatus = false;

//generates token (uniqid), stores it and stores it in the database via php
function genToken(id){
  var newtoken = uniqid();
  localStorage.setItem("token", newtoken);
  console.log("new token: " + newtoken);
  $.ajax({
            type: "POST",
            url: "api.php",
            data: {
              action: "settoken",
              token: newtoken,
							id: id
            },
            success: function(results){
                    console.log(results);
                },
            error: function(results){
                    console.log(results);
            }
  });
  return newtoken;
}

//checks if the user id logged in and deletes all login variables if that is not the case
function checkLogin(){
	var token = localStorage.getItem("token");
	var uId = localStorage.getItem("userid");
	return $.ajax({
            type: "POST",
            url: "api.php",
            data: {
              action: "checklogin",
              token: token,
							uId: uId
            },
            success: function(results){
							if(results == 0){
								logOut();
								loginstatus = false;
								return false;
							}else{
								loginstatus = true;
								return true;
							}
						},
            error: function(results){
              console.log(results);
            }
  });
}

//gets the locally stored token and sends it to the php api where it is compared to the token stored in the database
function getData(){
  var localtoken = localStorage.token;
  $.ajax({
            type: "POST",
            url: "api.php",
            data: {
              action: "comparetoken",
              token: localtoken
            },
            success: function(results){
										console.log(results);
										var data = JSON.parse(results);
										loginStatus = true;
										localStorage.setItem("userid", data.userId);
										localStorage.setItem("loginstatus", true);
                },
            error: function(results){
                    console.log("results");
            }
  });
}

//returns the data the user put in
function getLoginData(){
	var uMail = $('.iMail').val();
	var uPass = $('.iPass').val();
	console.log("user Email: " + uMail);
	return {
        uMail: uMail,
        uPass: uPass
    };
}

function logIn(){
	var lData = getLoginData();
	$.ajax({
            type: "POST",
            url: "api.php",
            data: {
              action: "login",
              uData: lData
            },
            success: function(results){
										console.log(results);
										var data = JSON.parse(results);
										loginStatus = true;
										localStorage.setItem("userid", data.userId);
										localStorage.setItem("loginstatus", true);
										genToken(data.userId);
                },
            error: function(results){
                    console.log(results);
            }
  });
}

//removes token item from localStorage and deletes the entry in the database as well
function logOut(){
	$.ajax({
            type: "POST",
            url: "api.php",
            data: {
              action: "logout",
              uData: data
            },
            success: function(results){
										console.log(results);
										loginStatus = false;
										localStorage.setItem("loginstatus",false);
										localStorage.setItem("userid", 0);
                },
            error: function(results){
                    console.log(results);
            }
  });
	localStorage.removeItem('token');
}

//replaces certain tags on the site with login details
function updateSite(){
	//HACK: this setlogin thing doesnt work correctly yet...
	if($('.setlogin').val()){
		var rep;
		rep = $(".uName").html().replaceAll("{uName}",data.userName);
		$(".uName").html(rep);
		rep = $(".uMail").html().replaceAll("{uMail}",data.userEmail);
		$(".uMail").html(rep);
		rep = $(".uPoints").html().replaceAll("{uPoints}",data.userPoints);
		$(".uPoints").html(rep);
		rep = $(".uTotal").html().replaceAll("{uTotal}",data.userTotal);
		$(".uTotal").html(rep);
		rep = $(".uId").html().replaceAll("{uId}",data.userId);
		$(".uId").html(rep);
		$(".uLoggedIn").html("true");
	}else{
		console.log("loginset flag doesnt exist or is set to false!");
	}
}

//resets the login details back to the state it was before
function resetSite(){
	if($('.setlogin').val()){
		rep = $(".uName").html().replaceAll(data.userName,"{uName}");
		$(".uName").html(rep);
		rep = $(".uMail").html().replaceAll(data.userEmail,"{uMail}");
		$(".uMail").html(rep);
		rep = $(".uPoints").html().replaceAll(data.userPoints,"{uPoints}");
		$(".uPoints").html(rep);
		rep = $(".uTotal").html().replaceAll(data.userTotal,"{uTotal}");
		$(".uTotal").html(rep);
		rep = $(".uId").html().replaceAll(data.userId,"{uId}");
		$(".uId").html(rep);
		$(".uLoggedIn").html("false");
	}
}

function updatejoin(){
	if(loginStatus) $(".joinbtn").removeClass("disabled");
	else $(".joinbtn").addClass("disabled");
}

//gets the input from the user concerning the project submitting process and returns it in array format
function getProjectElements() {
	var pTitle = $(".pTitle.add").val();
	var pContent = $(".pContent.add").val();
	var pLeader = $(".pLeader.add").val();
	var pDate = $('.datepicker.add').pickadate('picker').get('highlight', 'yyyy-mm-dd');
	var pTime = $(".pTime.add").val();
	var pDuration = $(".pDuration.add").val();
	var pLocation = $(".pLocation.add").val();
	var pMax = $(".pMax.add").val();
	//TODO: dat + time defined ?
	return {
        pTitle: pTitle,
				pContent: pContent,
				pLeader: pLeader,
				pDate: pDate,
				pTime: pTime,
				pDuration: pDuration,
				pLocation: pLocation,
				pMax: pMax
	 };
}

//gets the input from the user concerning the project editing process and returns it in array format
function getEditElements() {
	var pTitle = $(".pTitle.edit").val();
	var pContent = $(".pContent.edit").val();
	var pLeader = $(".pLeader.edit").val();
	var pDate = $('.datepicker.edit').pickadate('picker').get('highlight', 'yyyy-mm-dd');
	var pTime = $(".pTime.edit").val();
	var pDuration = $(".pDuration.edit").val();
	var pLocation = $(".pLocation.edit").val();
	var pMax = $(".pMax.edit").val();
	//TODO: dat + time defined ?
	return {
        pTitle: pTitle,
				pContent: pContent,
				pLeader: pLeader,
				pDate: pDate,
				pTime: pTime,
				pDuration: pDuration,
				pLocation: pLocation,
				pMax: pMax
	 };
}

//returns an array for testing (outdated)
function getTest(){
	return {
        pTitle: "pTitle",
				pContent: "pContent",
				pLeader: "32",
				pDate: "",
				pTime: "",
				pDuration: 90,
				pLocation: "pLocation",
				pMax: 5
  };
}

//gets the input data using the getProjectElements() function and sends it to the php api via ajax
function createProject() {
	var elements = getProjectElements();
	console.log(elements);
	$.ajax({
						type: "POST",
						url: "api.php",
						data: {
							action: "createproject",
							pData: elements,
							id: data.userId
						},
						success: function(results){
										console.log(results);
								},
						error: function(results){
										console.log(results);
						}
	});
}

//sends userid to the php api to make the use join a given project
function join(prId) {
	checkLogin();
	if(!localStorage.getItem("loginStatus")){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "api.php",
							data: {
								action: "joinproject",
								id: data.userId,
								prId: prId
							},
							success: function(results){
											console.log(results);
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}


function leave(prId) {
	checkLogin();
	if(!localStorage.getItem("loginStatus")){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "api.php",
							data: {
								action: "leaveproject",
								id: data.userId,
								prId: prId
							},
							success: function(results){
											console.log(results);
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function edit(prId) {
	checkLogin();
	if(!localStorage.getItem("loginStatus")){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "api.php",
							data: {
								action: "editproject",
								id: localStorage.getItem("userid"),
								prId: prId
							},
							success: function(results){
											console.log(results);
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function openEditWin(res){
	res = JSON.parse(res);
	var date = new Date(res.date);
	date = date.toLocaleDateString('de-DE');
	$("#title").val(res.title);
	$("#location").val(res.location);
	$("#date").val(date);
	$("#time").val(res.time);
	$("#duration").val(res.duration);
	$("#description").val(res.content);
	$("#max").val(res.max);
	$("#editWin").modal("open");
}

function submitEdit(prId){
	var pData = getEditElements();
	checkLogin();
	if(!localStorage.getItem("loginStatus")){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "api.php",
							data: {
								action: "submitedit",
								id: data.userId,
								prId: prId,
								pData: pData
							},
							success: function(results){
											console.log(results);
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function loadProjects(){
	checkLogin();
	if(!localStorage.getItem("loginStatus")){

	}else{

	}
	if(log)console.log("ajax active!");
	$.ajax({
				type: "POST",
				url: "projects.php",
				data: {
					type: "active",
					id: id
				},
				success: function(results){
						$(".active_projects").html(results);
					},
				error: function(message){
						console.log(message);
				}
	})
	$.ajax({
				type: "POST",
				url: "projects.php",
				data: {
					type: "pending",
					id: id
				},
				success: function(results){
						$(".pending_projects").html(results);
					},
				error: function(message){
						console.log(message);
				}
	})
	$.ajax({
				type: "POST",
				url: "projects.php",
				data: {
					type: "finished",
					id: id
				},
				success: function(results){
						$(".finished_projects").html(results);
					},
				error: function(message){
						console.log(message);
				}
	})
	$.ajax({
				type: "POST",
				url: "projects.php",
				data: {
					type: "removed",
					id: id
				},
				success: function(results){
						$(".removed_projects").html(results);
					},
				error: function(message){
						console.log(message);
				}
	})
}

function addProject(){
	if(checkLogin()) $('.addModal').modal('open');
}

function deleteProject(prId){
	$.ajax({
						type: "POST",
						url: "api.php",
						data: {
							action: "deleteproject",
							id: data.userId,
							prId: prId
						},
						success: function(results){
										console.log(results);
								},
						error: function(results){
										console.log(results);
						}
	});
}

function loadData(){
	$.ajax({
				type: "POST",
				url: "api.php",
				data: {
					action: "loaddata"
				},
				success: function(results){
						console.log(results);
					},
				error: function(message){
						console.log(message);
				}
	})
}

function tooltipload(){
	clearInterval(l);
	console.log("test");
	$('.tooltipped').tooltip();
}

//Debug functions

var t, log, l;
//t = setInterval(loadProjects,1000);

function stop(){
 	clearInterval(t);
}
function start(){
	clearInterval(t);
	t = setInterval(loadProjects,1000);
}
function interval(i){
	clearInterval(t);
	t = setInterval(loadProjects,i);
}
function once(){
	l = setInterval(tooltipload,2000);
}
function logTime(){
	log = true;
}

//TODO: Add all other project system related things

//only try to compare tokens when token exists in local storage
if (localStorage.getItem('token') !== null) getData();
