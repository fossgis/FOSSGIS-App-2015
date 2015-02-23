<?
	/*
		Answer form
		
	*/
?>

<script>
    $(document).ready(function(){
        // Bind to the submit event of our form
        $("#answerform").submit(function(event){
            $.post('../backend/NoticeBoard/nb_ret_insertcomment.php', $(this).serialize(),function(data) {
                $("#commentInsert").html("Der Kommentar wurde erfolgreich hinzugef&uuml;gt.");
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
			<label style="font-weight: bold">Name: </br>
				<input type="text" id="author_name" name="author_name" placeholder="Ihr gew&uuml;nschter Name" required/>
			</label>
		</div>
	</div>
	
		
			
	<div class="row">
		<div class="large-12 columns">
			<label style="font-weight: bold">Mail (Optional, <b> &ouml;ffentlich</b>): </br>
				<input type="text" id="author_mail" name="author_mail" placeholder="Ihre Mailadresse"/>
			</label>
		</div>
	</div>
	
	<div class="row">
		<div class="large-12 columns">
			<label style="font-weight: bold">Text: </br>
				<textarea name="message" id="message" rows="4" required/></textarea ></br></br>
			</label>
		</div>
	</div>
			
			
	<div class="large-12 columns">	
		<div class="row">
			<input id="submit" type="submit" class="button expand" value="Abschicken"/>
		</div>
	</div>
	
	</form>
<br><br>
</div>
