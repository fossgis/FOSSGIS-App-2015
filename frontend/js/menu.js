(function () {
  var ajaxLoading = false;
  $("dd > a").click(function (evt) {
    evt.preventDefault();
    room = evt.target.innerHTML;
    date = '2015-03-11';
    target = evt.target.hash;
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
        $(target).empty();
        obj = JSON.parse(data);
        console.log(obj);
        obj.forEach( function(speech) {
          $(target).append("<p>"+speech.start+" : "+speech.title+" <a href='#' class='button openmodal' data-reveal-id='infos"+speech.number+"-"+target.slice(1,target.length)+"'> weitere Informationen</a> <a href='#' class='button'> Merken</a> <a href='participate.php' class='button'> Teilnehmen </a></p>");
          $(target).append("<div id='infos"+speech.number+"-"+target.slice(1,target.length)+"' class='reveal-modal' data-reveal><h2>"+speech.title+"</h2><p class='lead'>"+speech.subtitle+"</p><p>Dauer: "+speech.duration+"</p><p>"+speech.description+"</p><a class='close-reveal-modal'>&#215;</a></div>");
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
  });
}());