<!doctype html>
<html>
<head>
<!-- Import JQUERY framework and css -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../backend/NoticeBoard/main.css" />
<link rel="stylesheet" type="text/css" media="all" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css" />
</head>
   <body>
    <script>
	
		// Show answer form
        function ShowAnswerForm(id) {
			$('#actionlink').html("");
			
            $.post('../backend/NoticeBoard/nb_form_answer.php', "answerid="+id, function(data){
						data=data.replace("!answerid!",id);
                        $('#answerform').html(data);
                        $('#form').html(data);
						if(id!=0) {
							$('#answerform_title').html("Antwort auf <a href='#' onclick='ScrollTo(\"comment"+id+"\")';> diese Notiz</a>:");
						} else {
							$('#answerform_title').html("Neue Notiz erstellen:");
						}
						
						ScrollTo("form");
            });
        };
        
		// Display each comment
        function DisplayComments() {
            $.post('../backend/NoticeBoard/nb_ret_displaycomments.php', "", function(data){
				$('#comments').html(data);
				
            });
        };
        
        
		// Scroll To
        function ScrollTo(element) {
            $("body, html").animate({ 
				scrollTop: $("#"+element).offset().top 
			}, 60);
        };
		
        // Start function
        $(document).ready(function(){
            DisplayComments();
        });
    </script>
     

   
	
		<div id="comments" align="center" style="margin-top: 10px"></div>   

		<p><div class="row"><div id="answerform_title" name="answerform_title" class="large-12 columns"> </div></div></p>

		<div id="form" align="left"></div>
		
		<div class="row"><div class="large-12 columns" id="actionlink" align="center"><a href="#" class=" button expand" onclick="ShowAnswerForm(0)" style="font-weight: bold">Notiz erstellen</a></div></div>
	
	</body>
</html>
