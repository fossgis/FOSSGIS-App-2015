(function () {
  $(document).ready(function () {
    
          $('#navigation').on('toggled', function (event, tab) {
            map.invalidateSize(true);
          });

    var ajaxLoading = false;
    if (!ajaxLoading) {
      ajaxLoading = true;
      $.ajax({
        url: '/fossgis/backend/api.php',
        data: {
          func: 'getSpeeches'
        }
      }).done(function (data) {
        obj = JSON.parse(data);
        obj.forEach(function (speech) {
          if (speech.date === "2015-03-11") {
            target = "#panel1";
          } else if (speech.date === "2015-03-12") {
            target = "#panel2";
          } else if (speech.date === "2015-03-13") {
            target = "#panel3";
          }
          appendToRoom(target,speech);
        });
      }).fail(function (err) {
        console.log(err);
      }).always(function () {
        ajaxLoading = false;
      });
    }
  });

  function appendToRoom (target,speech) {
    var tab = "";
    switch(speech.name) {
      case "Aula":
        tab = target+"-1"
        break;
      case "S10":
        tab = target+"-2";
        break;
      case "S1":
        tab = target+"-3"
        break;
      case "S2":
        tab = target+"-4"
        break;
      case "StudLab 1":
        tab = target+"-5"
        break;
      case "StudLab 2":
        tab = target+"-6"
        break;
      case "StudLab 3":
        tab = target+"-7"
        break;
    }
    $(target+" > .tabs-content > "+tab).append("<div class='row'><div class='small-12 medium-6 large-8 columns'><p>"+speech.start+" : "+speech.title+"</p></div><div class='small-12 medium-6 large-4 columns'><form action='../backend/teilnehmen.php' method='get'><input type=hidden id=titleid name=titleid value="+speech.id+"><a href='#' class='button openmodal' style='width: 64%; padding: 0.001rem 0rem' data-reveal-id='infos"+speech.number+"-"+target.slice(1,target.length)+"'> weitere Informationen</a> <input type='submit' id='filter' class='button' style='width: 34%; padding: 0.001rem 0rem' value='Vormerken'></form></div></div>");
    $(target+" > .tabs-content > "+tab).append("<div id='infos"+speech.number+"-"+target.slice(1,target.length)+"' class='reveal-modal' data-reveal><h2>"+speech.title+"</h2><p class='lead'>"+speech.subtitle+"</p><p>Dauer: "+speech.duration+"</p><p>Referent: "+speech.speaker+"</p><p>"+speech.description+"</p><a class='close-reveal-modal'>&#215;</a></div>");
  }

  $("#myevents").click(function (evt) {
  	showMyEvents();
  });
  
function showMyEvents () {
    ajaxLoading = true;
    $.ajax({
      url: "/fossgis/backend/api.php",
      data: {
        func: 'getTitles'
      }
    }).done(function (data) {
      var obj = JSON.parse(data);
	  $("#myevent").html("");
      obj.forEach(function (speech) {
        $("#myevent").append("<div class='row'><div class='small-12 medium-6 large-8 columns'><p>" +speech.datum+" "+speech.start+" : "+speech.title+"</p></div><div class='small-12 medium-6 large-4 columns'><a href='#' class='button openmodal' style='width: 64%; padding: 0.001rem 0rem' data-reveal-id='infos"+speech.number+"-"+target.slice(1,target.length)+"'> weitere Informationen</a></div></div>");
        $("#myevent").append("<div id='infos"+speech.number+"-"+target.slice(1,target.length)+"' class='reveal-modal' data-reveal><h2>"+speech.title+"</h2><p class='lead'>Raum: "+speech.room+"</p><p>Dauer: "+speech.duration+"</p><p>"+speech.description+"</p><a class='close-reveal-modal'>&#215;</a></div>");
      });
    }).fail(function (err) {
      console.log(err);
    }).always(function () {
      ajaxLoading = false;
    });
  }

    $(document).ready(function() {
      var hash = window.location.hash;
      if (hash == "#fndtn-veranstaltungen") {
        $('[data-accordion] [href="#panel4"]').click();
        showMyEvents();
      } else {
      }
    });
  
  //$("#eventsearch").click(function (evt) {
  function searchEvents () {
    ajaxLoading = true;
	search = $("#searchtext").val();
	$.ajax({
	  url: "/fossgis/backend/api.php",
      data: {
        func: 'getSearch'
      }
    }).done(function (data) {
      var obj = JSON.parse(data);
	  $("#mysearch").html("");
      obj.forEach(function (speech) {
        $("#mysearch").append("<div class='row'><div class='small-12 medium-6 large-8 columns'><p>"+speech.datum+" "+speech.start+" : "+speech.title+"</p></div><div class='small-12 medium-6 large-4 columns'><form action='../backend/teilnehmen.php' method='get'><input type=hidden id=titleid name=titleid value="+speech.id+"><a href='#' class='button openmodal' style='width: 64%; padding: 0.001rem 0rem' data-reveal-id='infos"+speech.number+"-"+target.slice(1,target.length)+"'> weitere Informationen</a> <input type='submit' id='filter' class='button' style='width: 34%; padding: 0.001rem 0rem' value='Vormerken'></form></div></div>");
		$("#mysearch").append("<div id='infos"+speech.number+"-"+target.slice(1,target.length)+"' class='reveal-modal' data-reveal><h2>"+speech.title+"</h2><p class='lead'>"+speech.subtitle+"</p><p>Raum: "+speech.name+"</p><p>Dauer: "+speech.duration+"</p><p>Referent: "+speech.speaker+"</p><p>"+speech.description+"</p><a class='close-reveal-modal'>&#215;</a></div>");
      });
    }).fail(function (err) {
      console.log(err);
    }).always(function () {
      ajaxLoading = false;
    });
  }
  //});  

}());
