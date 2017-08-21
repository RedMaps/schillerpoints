init();

function init(){
	if($('.active_projects').length || $('.pending_projects').length || $('.removed_projects').length || $('.finished_projects').length) loadProjects();
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
	console.error(text);
}
function success(text){
	Materialize.toast(text, 3000, 'green accent-4');
	console.log(text);
}
function msg(text){
	Materialize.toast(text, 3000, 'blue-grey');
	console.info(text);
}
function info(text){
	Materialize.toast(text, 3000, 'blue-grey');
	console.info(text);
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
            url: "/new/api/api.php",
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

function executeFunctionByName(functionName, context, args) {
  var args = [].slice.call(arguments).splice(2);
  var namespaces = functionName.split(".");
  var func = namespaces.pop();
  for(var i = 0; i < namespaces.length; i++) {
    context = context[namespaces[i]];
  }
  return context[func].apply(context, args);
}

//checks if the user id logged in and deletes all login variables if that is not the case
function checkLogin(){
	var token = localStorage.getItem("token");
	var uId = localStorage.getItem("userid");
	return $.ajax({
            type: "POST",
            url: "/new/api/api.php",
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

function checkLoginExec(func, args){
	var token = localStorage.getItem("token");
	var uId = localStorage.getItem("userid");
	$.ajax({
	    type: "POST",
	    url: "/new/api/api.php",
	    data: {
	      action: "checklogin",
	      token: token,
				uId: uId
	    },
	    success: function(results){
				if(results == 0){
					logOut();
					loginstatus = false;
					executeFunctionByName(func,window,results==0);
				}else{
					loginstatus = true;
					$(".loginMobile").html('<i class="material-icons white-text">exit_to_app</i> Log Out');
					$(".loginMobile").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
					$(".loginDesktop").html('<i class="material-icons black-text">exit_to_app</i> Log Out');
					$(".loginDesktop").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
					executeFunctionByName(func,window,results==0);
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
            url: "/new/api/api.php",
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
	console.log(typeof uMail);
	if(uMail == '' && uPass == ''){
		error("Please enter your E-Mail and Password!");
		console.log("error!");
		return;
	}else if(uMail == ''){
		error("Please enter your E-Mail!");
		console.log("error!");
		return;
	}else if(uPass == ''){
		error("Please enter your Password!");
		console.log("error!");
		return;
	} else {
		expr = /@/;  // no quotes here
		if(expr.test(uMail)){
			return {
      	uMail: uMail,
      	uPass: uPass
    	}
		}else{
			error("Your E-Mail must contain an @ symbol!");
		}
	}
}

function logIn(){
	var lData = getLoginData();
	$.ajax({
            type: "POST",
            url: "/new/api/api.php",
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
										$(".loginModal").modal("close");
										$(".loginMobile").html('<i class="material-icons white-text">exit_to_app</i> Log Out');
										$(".loginMobile").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
										$(".loginDesktop").html('<i class="material-icons black-text">exit_to_app</i> Log Out');
										$(".loginDesktop").attr('onclick', 'logOut(); location.reload(); success("logged out sucessfully!");');
										//getPoints(data.userId);
										success("logged in sucessfully!");
										loadNotifications();
										loadBadge();
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
            url: "/new/api/api.php",
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
// TODO: make lists work?
// TODO: maybe put something right or left to projects on desktop version
// TODO: create deploy version of project
// TODO: make substitution table search work
// !TODO: migrate project for q1
// TODO: add user options (mobile view)
// !TODO: implement external cronjobs
// TODO: add forum for school related things
// !TODO: add password reset system
// TODO: add notification system (app?)
// TODO: add salt n' pepper maybe
// TODO: check for all details filled in
// TODO: make todo list even longer

//replaces certain tags on the site with login details
function updateSite(data){
	//HACK: this setlogin thing doesnt work correctly yet...
	if($('.setlogin').val()){
		var rep;
		if($('.uName').length){ rep = $(".uName").html().replaceAll("Guest",data.userName);
		$(".uName").html(rep); }
		if($('.uNameMobile').length){ rep = $(".uNameMobile").html().replaceAll("Guest",data.userName);
		$(".uNameMobile").html(rep); }
		if($('.uMail').length){ rep = $(".uMail").html().replaceAll("guest@schillerpoints.de",data.userEmail);
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
		rep = $(".uName").html().replaceAll(data.userName,"Guest");
		$(".uName").html(rep);
		rep = $(".uNameMobile").html().replaceAll(data.userName,"Guest");
		$(".uNameMobile").html(rep);
		rep = $(".uMail").html().replaceAll(data.userEmail,"guest@schillerpoints.de");
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
							url: "/new/api/api.php",
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
							url: "/new/api/api.php",
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
							url: "/new/api/api.php",
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
							url: "/new/api/api.php",
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
							url: "/new/api/api.php",
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
	$('#description').trigger('autoresize');
	$("#editWin").modal("open");
	$('#description').trigger('autoresize');
}

function getNames(ids){
	$.ajax({
						type: "POST",
						url: "/new/api/api.php",
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
						url: "/new/api/api.php",
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
	$(".vProfit").addClass("hidden");
	$("#vProfit").html('<i class="material-icons">euro_symbol</i>&nbsp;' + res.profit + "€");
	if(res.status == '3'){
		console.log("hidden");
		$(".vProfit").removeClass("hidden");
	}
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
							url: "/new/api/api.php",
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
				url: "/new/api/projects.php",
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
				url: "/new/api/projects.php",
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
				url: "/new/api/projects.php",
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
				url: "/new/api/projects.php",
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
	$.ajax({
				type: "POST",
				url: "/new/api/projects.php",
				data: {
					type: "your",
					id: localStorage.getItem("userid")
				},
				success: function(results){
						resultHandler(results);
						$(".your_projects").html(results);
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
						url: "/new/api/api.php",
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
				url: "/new/api/api.php",
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

function active(){
	$('.prj').removeClass('your_projects');
	$('.prj').removeClass('finished_projects');
	$('.prj').addClass('active_projects');
	loadProjects();
	$('.active').addClass('disabled');
	$('.finished').removeClass('disabled');
	$('.your').removeClass('disabled');
}

function finished(){
	$('.prj').removeClass('active_projects');
	$('.prj').removeClass('your_projects');
	$('.prj').addClass('finished_projects');
	loadProjects();
	$('.finished').addClass('disabled');
	$('.active').removeClass('disabled');
	$('.your').removeClass('disabled');
}

function your(){
	checkLoginExec("your_projects");
}

function your_projects(ret){
	if(ret){
		console.log("not logged in!");
		info("Log in to see your projects!");
	}else{
		$('.prj').removeClass('active_projects');
		$('.prj').removeClass('finished_projects');
		$('.prj').addClass('your_projects');
		loadProjects();
		$('.your').addClass('disabled');
		$('.finished').removeClass('disabled');
		$('.active').removeClass('disabled');
	}
}

//TODO: MAKE THIS WORK!

function loadPoll(id, nr){
	$.ajax({
				type: "POST",
				url: "/new/api/api.php",
				data: {
					action: "getpolldata",
					id: id
				},
				success: function(results){
						resultHandler(results);
						res = JSON.parse(results);
						$(".qTitle" + nr).html(res.question);
						options = JSON.parse(res.options);
						var opt = "";
						for(var i=0;i<options.length;i++){
							opt = opt + '<p><input class="'+nr+'with-gap with-gap '+nr+'checks" name="'+nr+'checks" type="radio" id="'+nr+'check'+i+'" /><label for="'+nr+'check'+i+'" class="white-text options">'+options[i]+'</label></p><div class="hidden '+nr+'per '+nr+'percent'+i+'">error</div><div class="'+nr+'bar bar'+i+' bar"><div class="determinate '+nr+'width'+i+'"></div></div>';
						}
						$(".polls" + nr).html(opt);
						inArray(id, nr);
					},
				error: function(message){
						console.log(message);
				}
	})
}

function inArray(id, nr){
	$.ajax({
				type: "POST",
				url: "/new/api/api.php",
				data: {
					action: "inarray",
					uId: localStorage.getItem("userid"),
					id: id
				},
				success: function(results){
						resultHandler(results);
						if(isNumber(results)){
							$("#"+nr+"check"+results).prop("checked", true);
							$('[id^="'+nr+'check"]').attr("disabled", "disabled");
							loadBars(nr, id);
						}
					},
				error: function(message){
						console.log(message);
				}
	})
}

function loadBars(nr, id){
	for(var j=0;j<$("."+nr+"checks").length;j++){
		$.ajax({
					type: "POST",
					url: "/new/api/api.php",
					data: {
						action: "getpolldata",
						id: id
					},
					success: function(results){
							resultHandler(results);
							res = JSON.parse(results);
							res = JSON.parse(res.results);
							var total = 0;
							for(var i = 0; i<res.length; i++){
								total += res[i];
							}
							for(var i = 0; i<res.length; i++){
								$("."+nr+"width"+i).width(percentage(res[i],total) + "%");
								$("."+nr+"percent"+i).text(Math.round(percentage(res[i],total)*100)/100 + "%");
							}
							$("."+nr+"per").addClass("percentage");
							$("."+nr+"per").removeClass("hidden");
							$("."+nr+"bar").addClass("progress");
							$("."+nr+"with-gap").attr("disabled","disabled");
							$("."+nr+"confirm-button").remove();
						},
					error: function(message){
							console.log(message);
					}
		})
	}
}

function progressPoll(nr, id){
	for(var j=0;j<$("."+nr+"checks").length;j++){
		if($("#"+nr+"check"+j).prop('checked')){
			$.ajax({
						type: "POST",
						url: "/new/api/api.php",
						data: {
							action: "progresspoll",
							check: j,
							id: id,
							uId: localStorage.getItem("userid")
						},
						success: function(results){
								console.log(results);
								resultHandler(results);
								res = JSON.parse(results);
								var total = 0;
								for(var i = 0; i<res.length; i++){
									total += res[i];
								}
								for(var i = 0; i<res.length; i++){
									$("."+nr+"width"+i).width(percentage(res[i],total) + "%");
									$("."+nr+"percent"+i).text(Math.round(percentage(res[i],total)*100)/100 + "%");
								}
								$("."+nr+"per").addClass("percentage");
								$("."+nr+"per").removeClass("hidden");
								$("."+nr+"bar").addClass("progress");
								$("."+nr+"with-gap").attr("disabled","disabled");
								$("."+nr+"confirm-button").remove();
							},
						error: function(message){
								console.log(message);
						}
			})
		}
	}
}

function changePass(){
	var oldpass = $("#oldpass").val();
	var newpass = $("#newpass").val();
	var reppass = $("#reppass").val();
	if(newpass != reppass){
		error("Please correctly repeat your new password!");
	}else{
		$.ajax({
					type: "POST",
					url: "/new/api/api.php",
					data: {
						action: "changepass",
						id: localStorage.getItem("userid"),
						oldpass: oldpass,
						newpass: newpass
					},
					success: function(results){
							resultHandler(results);
							if(results == "SUCCESS: Successfully changed your password!"){
								$("#changePassModal").modal("close");
							}
						},
					error: function(message){
							console.log(message);
					}
		})
	}
}

function loadNotifications(){
	$.ajax({
				type: "POST",
				url: "/new/api/api.php",
				data: {
					action: "loadnotifications",
					id: localStorage.getItem("userid")
				},
				success: function(results){
						resultHandler(results);
						$(".notifications").html(results);
					},
				error: function(message){
						console.log(message);
				}
	})
}

function notify(){
	if(localStorage.getItem("loginstatus") != "true"){
		console.log("not logged in!");
		info("Log in to see your notifications!");
	}else{
		$('.notificationModal').modal('open');
	}
}

function seen(nId){
	$.ajax({
				type: "POST",
				url: "/new/api/api.php",
				data: {
					action: "seennotification",
					id: localStorage.getItem("userid"),
					nId: nId
				},
				success: function(results){
						console.log(results);
						resultHandler(results);
						loadNotifications();
						loadBadge();
					},
				error: function(message){
						console.log(message);
				}
	})
}

function loadBadge(){
	if(localStorage.getItem("userid") != '0'){
		$.ajax({
					type: "POST",
					url: "/new/api/api.php",
					data: {
						action: "countnotifications",
						id: localStorage.getItem("userid")
					},
					success: function(results){
							resultHandler(results);
							$('.notification-badge').html(results);
						},
					error: function(message){
							console.log(message);
					}
		})
	}else{
		$('.notification-badge').remove();
		$('.notification_bell').html("notifications_none");
	}
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function percentage(num, num2){
  return (num/num2)*100;
}


// function tooltipload(){
// 	clearInterval(l);
// 	console.log("test");
// 	$('.tooltipped').tooltip();
// }

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

checkLogin();

//only try to compare tokens when token exists in local storage
if (localStorage.getItem('token') !== null) getData();
