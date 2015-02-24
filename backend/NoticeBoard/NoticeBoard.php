<!doctype html>
<html>
<head>
<!-- Import JQUERY framework and css -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<style>
body {
    color: #444;
    background-color: #FFF;
    font-family: MuseoSans,"Lucida Grande",Arial,sans-serif;
   
    font-style: normal;
    font-weight: normal;
    line-height: 1.6em;
    text-align: left;
}	

@media only screen and (min-width: 64.063em) {
	.comment {
    width: 70%;
    padding: 30px 10px 10px;
    margin-bottom: 1px;
    background: url("sticky_note.gif") no-repeat scroll 0% 0% #FFF8BE;
   
    /*transform: rotate(-1deg); */ 
	}
}

@media only screen and (min-width: 40.063em) and (max-width: 64em) {
	.comment {
    width: 85%;
    padding: 30px 10px 10px;
    margin-bottom: 1px;
    background: url("sticky_note.gif") no-repeat scroll 0% 0% #FFF8BE;
   
    /*transform: rotate(-1deg); */
	}
}

@media only screen and (max-width: 40em) {
	.comment {
    width: 100%;
    padding: 30px 10px 10px;
    margin-bottom: 1px;
    background: url("sticky_note.gif") no-repeat scroll 0% 0% #FFF8BE;
   
    /*transform: rotate(-1deg); */
	}
}

.comment .time {
line-height: 0px;
    font-size: 11px;
	position:relative;
	padding-left: 10%;
	text-align: left;
	top:11px; 
	pointer-events: none;
	 
}

.comment .answer {
	line-height: 0px;
    font-size: 13px;
	text-align: right;
	padding-top: 10px;
	padding-right: 10%;
	top:6%;  
}

.comment .author {
	font-size: 18px;
	position:relative;
	text-align: left;
	padding-left: 10%;
	top:6%;  
}

.comment .text {
	
    font-size: 15px;
	width: 80%;
	font-family: MV Boli;
	text-align: justify;
}

.comment .reply {
	padding-left: 50px;
	background-color: #FFF6C9;
}
</style>
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
