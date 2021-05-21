// JavaScript Document
ajax_modal = null;
ajax_page = null;
modal_showing = false;

	
function _init_load() {
	
	$("a[href^='#']").on("mouseup", function() {
		var ts = new Date().getTime();
		var url = $(this).attr("href");
		if (url.indexOf("ts=") >= 0) {
			var ts_new = ts;
			var url_new = url.replace(/(ts=)[^\&]+/, '$1' + ts_new);
		} else {
			var url_new = url + "?ts=" + ts;
		}
		$(this).attr("href", url_new);
		
	});

	
	clock();
	setInterval("clock()", 1000);
	weather();
	setInterval("weather()",1800000); // 30 minutes
}

function goBack() {
  window.history.back();
}

function toggleFullScreen() {
  if (!document.fullscreenElement &&    // alternative standard method
      !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {  // current working methods
    if (document.documentElement.requestFullscreen) {
      document.documentElement.requestFullscreen();
    } else if (document.documentElement.msRequestFullscreen) {
      document.documentElement.msRequestFullscreen();
    } else if (document.documentElement.mozRequestFullScreen) {
      document.documentElement.mozRequestFullScreen();
    } else if (document.documentElement.webkitRequestFullscreen) {
      document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}

function clock() {
	var now = moment();
	full_date = now.format("ddd, DD MMM YYYY");
	hours = now.format("HH");
	minutes = now.format("mm A");
	seconds = now.format("s");
	
	//$(".clock").toggleClass("pulse","");
	$(".clock .hours").html(hours);
	$(".clock .minutes").html(":" + minutes);
	$(".clock .full-date").html(full_date);
	
	second_progress = (seconds / 60 * 100);
	$(".second-counter").css("width", second_progress + "%");
}

function weather() {
	$.post("weather",
	 function(response) {
		 var temp = response.weather.curren_weather[0].temp;
		 var text = response.weather.curren_weather[0].weather_text;
		 $(".clock #degrees").html(temp);
		 $(".clock .weather-text").html(text);
	 },"json");
}

