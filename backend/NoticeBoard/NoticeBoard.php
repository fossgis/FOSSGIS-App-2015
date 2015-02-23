<!doctype html>
<html>
<!-- Import JQUERY framework and css -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="../backend/NoticeBoard/main.css" />
<link rel="stylesheet" type="text/css" media="all"
  href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css"    />
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
							$('#answerform_title').html("Antwort auf <a href='#' onclick='ScrollTo(\"comment"+id+"\")';> diesen Kommentar</a>:");
						} else {
							$('#answerform_title').html("Neuen Kommentar erstellen:");
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
     

    <?php
		//include ('nb_functions.php');
    ?>
	<div align="center">
		<div id="comments"> </div>   

		<h4><div id="answerform_title" name="answerform_title"> </div>	</h4>
		<div id="form"> </div>
		
		<div id="actionlink" align="center" > <a href="#" onclick="ShowAnswerForm(0)"> Eintrag erstellen </a> </div>
    </div>
	
	</body>
</html>
