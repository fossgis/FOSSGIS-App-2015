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
		Name: </br><input type="text" id="author_name" name="author_name" style="width: 250px;" required /></br>
		Mail (optional, <b> &Ouml;ffentlich</b>): </br><input type="text" id="author_mail" name="author_mail" style="width: 250px;" /></br>
		Text: </br><textarea name="message" id="message" width="410px" style="width: 370px; height: 110px;" required/></textarea ></br></br>
		<input id="submit" type="submit" class="button expand" value="Abschicken" style="width: 250px;"/>
	</form>
<br><br>
</div>
