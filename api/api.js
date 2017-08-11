init();

function init(){
	if($('.active_projects').length || $('.pending_projects').length) loadProjects();
}

$(".del-checkbox").change(function() {
    if(this.checked) {
      $(".deletebtn").removeClass("disabled");
      console.log("checked!");
    }else{
      $(".deletebtn").addClass("disabled");
      console.log("unchecked!");
    }
});

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

function error(text){
	Materialize.toast(text, 3000, 'red');
}
function success(text){
	Materialize.toast(text, 3000, 'green accent-4');
}
function msg(text){
	Materialize.toast(text, 3000, 'blue-grey');
}

function resultHandler(res){
	if(res.substring(0,5) == "ERROR") error(res.slice(7));
	if(res.substring(0,7) == "SUCCESS") success(res.slice(9));
	if(res.substring(0,3) == "MSG") msg(res.slice(5));
}

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
            url: "/api/api.php",
            data: {
              action: "settoken",
              token: newtoken,
							id: id
            },
            success: function(results){
                    console.log(results);
										resultHandler(results);
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
            url: "/api/api.php",
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
								$(".loginMobile").html('<i class="material-icons white-text">exit_to_app</i> Log Out');
								$(".loginMobile").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
								$(".loginDesktop").html('<i class="material-icons black-text">exit_to_app</i> Log Out');
								$(".loginDesktop").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
								//getPoints(localStorage.getItem("userid"));

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
            url: "/api/api.php",
            data: {
              action: "comparetoken",
              token: localtoken
            },
            success: function(results){
										console.log(results);
										resultHandler(results);
										var data = JSON.parse(results);
										loginStatus = true;
										updateSite(data);
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
            url: "/api/api.php",
            data: {
              action: "login",
              uData: lData
            },
            success: function(results){
										console.log(results);
										resultHandler(results);
										var data = JSON.parse(results);
										loginStatus = true;
										localStorage.setItem("userid", data.userId);
										updateSite(data);
										localStorage.setItem("loginstatus", true);
										genToken(data.userId);
										loadProjects();
										$(".loginMobile").html('<i class="material-icons white-text">exit_to_app</i> Log Out');
										$(".loginMobile").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
										$(".loginDesktop").html('<i class="material-icons black-text">exit_to_app</i> Log Out');
										$(".loginDesktop").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
										//getPoints(data.userId);
										success("logged in sucessfully!");
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
            url: "/api/api.php",
            data: {
              action: "logout",
              uData: data
            },
            success: function(results){
										console.log(results);
										resultHandler(results);
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

// TODO: create backend maybe
// TODO: add money view somewhere
// TODO: create some kind of documentation
// TODO: comment everything
// !TODO: add translation function
// TODO: add profiles maybe
// TODO: add color change or dark / light theme
// !TODO: add tabs for own projects / finished projects
// TODO: make lists work?
// TODO: maybe put something right or left to projects on desktop version
// TODO: make database more adaptable
// TODO: create deploy version of project
// !TODO: make timetable thing work properly and show extra text
// !TODO: migrate project for q1
// TODO: add user options (mobile view)
// !TODO: implement external cronjobs
// TODO: add forum for school related things
// !TODO: add password reset system
// TODO: add notification system (app?)
// TODO: add poll / voting system
// TODO: add salt n' pepper maybe
// TODO: check for all details filled in
// TODO: make todo list even longer

//replaces certain tags on the site with login details
function updateSite(data){
	//HACK: this setlogin thing doesnt work correctly yet...
	if($('.setlogin').val()){
		var rep;
		if($('.uName').length){ rep = $(".uName").html().replaceAll("{uName}",data.userName);
		$(".uName").html(rep); }
		if($('.uNameMobile').length){ rep = $(".uNameMobile").html().replaceAll("{uName}",data.userName);
		$(".uNameMobile").html(rep); }
		if($('.uMail').length){ rep = $(".uMail").html().replaceAll("{uMail}",data.userEmail);
		$(".uMail").html(rep); }
		if($('.uPoints').length){ rep = $(".uPoints").html().replaceAll("{uPoints}",data.userPoints);
		$(".uPoints").html(rep); }
		if($('.uTotal').length){ rep = $(".uTotal").html().replaceAll("{uTotal}",data.userTotal);
		$(".uTotal").html(rep); }
		if($('.uId').length){ rep = $(".uId").html().replaceAll("{uId}",data.userId);
		$(".uId").html(rep); }
		if($('.uLoggedIn').length) $(".uLoggedIn").html("true");
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
	var pDate = $('.pDate.edit').pickadate('picker').get('highlight', 'yyyy/mm/dd');
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
	checkLogin();
	if(localStorage.getItem("loginstatus") != "true"){
		console.log("not logged in!");
	}else{
		console.log(elements);
		$.ajax({
							type: "POST",
							url: "/api/api.php",
							data: {
								action: "createproject",
								pData: elements,
								id: localStorage.getItem("userid")
							},
							success: function(results){
											console.log(results);
											resultHandler(results);
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

//sends userid to the php api to make the use join a given project
function join(prId) {
	checkLogin();
	if(localStorage.getItem("loginstatus") != "true"){
		console.log("not logged in!");
		error("Not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "/api/api.php",
							data: {
								action: "joinproject",
								id: localStorage.getItem("userid"),
								prId: prId
							},
							success: function(results){
											console.log(results);
											resultHandler(results);
											loadProjects();
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function leave(prId) {
	checkLogin();
	if(localStorage.getItem("loginstatus") != "true"){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "/api/api.php",
							data: {
								action: "leaveproject",
								id: localStorage.getItem("userid"),
								prId: prId
							},
							success: function(results){
											console.log(results);
											resultHandler(results);
											loadProjects();
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function edit(prId) {
	checkLogin();
	if(localStorage.getItem("loginstatus") != "true"){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "/api/api.php",
							data: {
								action: "editproject",
								id: localStorage.getItem("userid"),
								prId: prId
							},
							success: function(results){
											console.log(results);
											resultHandler(results);
											openEditWin(results);
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function view(prId) {
		$.ajax({
							type: "POST",
							url: "/api/api.php",
							data: {
								action: "viewproject",
								prId: prId
							},
							success: function(results){
											console.log(results);
											resultHandler(results);
											openPrjWin(results);
									},
							error: function(results){
											console.log(results);
							}
		});
}

function openEditWin(res){
	res = JSON.parse(res);
	var date = new Date(res.date);
	var datede = date.toLocaleDateString('de-DE');
	var dateus = date.toLocaleDateString('en-US');
	console.log(dateus);
	$("#title").val(res.title);
	$("#location").val(res.location);
	//$("#date").attr("data-value",dateus);
	$("#date").pickadate('set').set('select', date);
	$("#time").val(res.time);
	$("#duration").val(res.duration);
	$("#description").val(res.content);
	$("#max").val(res.max);
	$("#submitEdit").attr('onclick', 'submitEdit(' + res.id + ')');
	$("#deleteEdit").attr('onclick', 'deleteProject(' + res.id + '); $(".modal").modal("close");');
	$("#editWin").modal("open");
}

function getNames(ids){
	$.ajax({
						type: "POST",
						url: "/api/api.php",
						data: {
							action: "getnames",
							ids: ids
						},
						success: function(results){
										array = JSON.parse(results);
										var list = "";
										for(var i=0; i < array.length; i++){
											list = list + '<div class="chip white-text grey darken-3">' + array[i] + '</div>';
										}
										$(".name-chips").html(list);
										resultHandler(results);
								},
						error: function(results){
										console.log(results);
						}
	});
}

function getName(id){
	$.ajax({
						type: "POST",
						url: "/api/api.php",
						data: {
							action: "getname",
							id: id
						},
						success: function(results){
										resultHandler(results);
										name = JSON.parse(results);
										$("#vLeader").html('<i class="material-icons">person</i>&nbsp;' + name);
								},
						error: function(results){
										console.log(results);
						}
	});
}

function openPrjWin(res){
	res = JSON.parse(res);
	var date = new Date(res.date);
	var datede = date.toLocaleDateString('de-DE');
	var dateus = date.toLocaleDateString('en-US');
	var memberdecode = JSON.parse(res.members)
	$("#joinView").attr('onclick', 'join(' + res.id + ')');
	$("#vTitle").html(res.title);
	$("#vLocation").html('<i class="material-icons">room</i>&nbsp;' + res.location);
	$("#vDate").html('<i class="material-icons">today</i>&nbsp;' + datede);
	$("#vTime").html('<i class="material-icons">schedule</i>&nbsp;' + res.time);
	$("#vDuration").html('<i class="material-icons">timer</i>&nbsp;' + res.duration);
	$("#vDescription").html(res.content);
	$("#vMax").html('<i class="material-icons">group</i>&nbsp;' + memberdecode.length + " / " + res.max);
	$(".vMax").html(memberdecode.length);
	getNames(memberdecode);
	getName(res.leader);
	//TODO: make users appear in chips
	$("#projectModal").modal("open");
}

function submitEdit(prId){
	var pData = getEditElements();
	console.log(pData);
	checkLogin();
	if(localStorage.getItem("loginstatus") != "true"){
		console.log("not logged in!");
	}else{
		$.ajax({
							type: "POST",
							url: "/api/api.php",
							data: {
								action: "submitedit",
								id: localStorage.getItem("userid"),
								prId: prId,
								pData: pData
							},
							success: function(results){
											console.log(results);
											resultHandler(results);
											loadProjects();
									},
							error: function(results){
											console.log(results);
							}
		});
	}
}

function loadProjects(){
	if(log)console.log("ajax active!");
	if(localStorage.getItem("userid") == null) localStorage.setItem("userid", 0);
	$.ajax({
				type: "POST",
				url: "/api/projects.php",
				data: {
					type: "active",
					id: localStorage.getItem("userid")
				},
				success: function(results){
						resultHandler(results);
						$(".active_projects").html(results);
						$('.tooltipped').tooltip({delay: 50});
					},
				error: function(message){
						console.log(message);
				}
	})
	$.ajax({
				type: "POST",
				url: "/api/projects.php",
				data: {
					type: "pending",
					id: localStorage.getItem("userid")
				},
				success: function(results){
						resultHandler(results);
						$(".pending_projects").html(results);
						$('.tooltipped').tooltip({delay: 50});
					},
				error: function(message){
						console.log(message);
				}
	})
	$.ajax({
				type: "POST",
				url: "/api/projects.php",
				data: {
					type: "finished",
					id: localStorage.getItem("userid")
				},
				success: function(results){
						resultHandler(results);
						$(".finished_projects").html(results);
						$('.tooltipped').tooltip({delay: 50});
					},
				error: function(message){
						console.log(message);
				}
	})
	$.ajax({
				type: "POST",
				url: "/api/projects.php",
				data: {
					type: "removed",
					id: localStorage.getItem("userid")
				},
				success: function(results){
						resultHandler(results);
						$(".removed_projects").html(results);
						$('.tooltipped').tooltip({delay: 50});
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
						url: "/api/api.php",
						data: {
							action: "deleteproject",
							id: localStorage.getItem("userid"),
							prId: prId
						},
						success: function(results){
										console.log(results);
										resultHandler(results);
										loadProjects();
								},
						error: function(results){
										console.log(results);
						}
	});
}

function loadData(){
	$.ajax({
				type: "POST",
				url: "/api/api.php",
				data: {
					action: "loaddata"
				},
				success: function(results){
						console.log(results);
						resultHandler(results);
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
