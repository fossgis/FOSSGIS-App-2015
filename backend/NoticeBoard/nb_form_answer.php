<?
	/*
		Answer form
		
	*/
?>
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

<script>
    $(document).ready(function(){
        // Bind to the submit event of our form
        $("#answerform").submit(function(event){
            $.post('../backend/NoticeBoard/nb_ret_insertcomment.php', $(this).serialize(),function(data) {
                $("#commentInsert").html("<div class='row'><div id='actionlink' align='center' class='large-12 columns'><a href='#' class='button expand' onclick='ShowAnswerForm(0)' style='font-weight: bold'>Notiz erstellen</a></div></div><div class='row'><div class='large-12 columns'><p>Die Notiz wurde erfolgreich hinzugef&uuml;gt.</p></div></div>");
				DisplayComments();
            });
            
            
            return false;
        });
    });
    
</script>

<div id="commentInsert">
					 <form action="NoticeBoard.php" method="post" id="answerform">
						
					<input type="hidden" name="answer_to" id="answer_to" value="!answerid!" />

					
					<div class="row">
						<div class="large-12 columns">
							<label style="font-weight: bold">Name:
								<input type="text" id="author_name" name="author_name" placeholder="Ihr gew&uuml;nschter Name" required/>
							</label>
						
							<label style="font-weight: bold">Mail (optional):
								<input type="text" id="author_mail" name="author_mail" placeholder="Ihre Mailadresse"/>
							</label>
						
							<label style="font-weight: bold">Text:
								<textarea name="message" id="message" rows="4" placeholder="Ihre Notiz..." required/></textarea >
							</label>
							<br/>
						
							<input id="submit" type="submit" class="button expand" value="Notiz anheften" style="font-weight: bold"/>
						</div>
					</div>
					
					</form>
				</div>
