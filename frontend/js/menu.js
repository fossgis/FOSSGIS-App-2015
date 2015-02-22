(function () {
  var ajaxLoading = false;
  var date = "2015-03-11";
  var cal = false;

  $("dd[class='accordion-navigation']").click(function(evt){
    switch(evt.target.innerHTML){
      case "Mittwoch":
        date = "2015-03-11";
        break;
      case "Donnerstag":
        date = "2015-03-12";
        break;
      case "Freitag":
        date = "2015-03-13";
        break;
	case "Mein Kalender":
		cal = true;
		break;
      default:
        break;
    }
  });

  $("dd > a").click(function (evt) {
    evt.preventDefault();
    room = evt.target.innerHTML;
    target = evt.target.hash;
	if (cal) {
	ajaxLoading = true;
	$.ajax({
			url:'/fossgis/backend/api.php',
			data: {
				func: 'getTitles'
			}
	}).done(function(data){
	
		$(target+" > .content").empty();
        if(target.indexOf("-") > -1) {
          $(target).empty();
        }
        obj = JSON.parse(data);
        console.log(obj);
        obj.forEach( function(speech) {
          $(target).append("<div class='row small-collapse large-uncollapse'><div class='small-12 large-6 columns'><p>" +speech.datum+" "+speech.start+" : "+speech.title+"</div><div class='small-12 large-6 columns'><a href='#' class='button openmodal' style='width: 70%' data-reveal-id='infos"+speech.number+"-"+target.slice(1,target.length)+"'> weitere Informationen</a></p></div></div>");
          $(target).append("<div id='infos"+speech.number+"-"+target.slice(1,target.length)+"' class='reveal-modal' data-reveal><h2>"+speech.title+"</h2><p class='lead'>"+speech.room+"</p><p>Dauer: "+speech.duration+"</p><p>"+speech.description+"</p><a class='close-reveal-modal'>&#215;</a></div>");
		  $('a.openmodal').on("click", function (evt) {
            evt.preventDefault();
            modal = evt.target.attributes[2].value;
            $("#"+modal).foundation('reveal', 'open');
          });
        });
		
	})
	.fail(function(err){
	})
	.always(function(){
		ajaxLoading=false;
	});
	} else {
    if (!ajaxLoading) {
      ajaxLoading = true;
      $.ajax({
        url: '/fossgis/backend/api.php',
        data: {
          func: 'getSpeeches',
          room: room,
          date: date
        }
      }).done(function (data) {
        $(target+" > .tabs-content > .content").empty();
        if(target.indexOf("-") > -1) {
          $(target).empty();
        }
        obj = JSON.parse(data);
        console.log(obj);
        obj.forEach( function(speech) {
          $(target).append("<div class='row small-collapse large-uncollapse'><div class='small-12 large-6 columns'><p>"+speech.start+" : "+speech.title+"</div><div class='small-12 large-6 columns'><form action='../backend/teilnehmen.php' method='get'><input type=hidden id=title name=title value="+speech.title+"><a href='#' class='button openmodal' style='width: 70%' data-reveal-id='infos"+speech.number+"-"+target.slice(1,target.length)+"'> weitere Informationen</a> <input type='submit' id='filter' class='button' style='width: 30%' value='Vormerken'></form></div></p></div>");
          $(target).append("<div id='infos"+speech.number+"-"+target.slice(1,target.length)+"' class='reveal-modal' data-reveal><h2>"+speech.title+"</h2><p class='lead'>"+speech.subtitle+"</p><p>Dauer: "+speech.duration+"</p><p>Referent: "+speech.name+"</p><p>"+speech.description+"</p><a class='close-reveal-modal'>&#215;</a></div>");
		  $('a.openmodal').on("click", function (evt) {
            evt.preventDefault();
            modal = evt.target.attributes[2].value;
            $("#"+modal).foundation('reveal', 'open');
          });
        });
      }).fail(function (error) {
        console.log(error);
      }).always(function () {
        ajaxLoading = false;
      });
    }
	}
  });
}());
