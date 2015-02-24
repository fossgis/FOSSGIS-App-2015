<?php
	/* 
		Insert a comment with given POST values to database
	*/ 

	include ('nb_functions.php');

	InsertComment($_POST['message'], $_POST['author_name'], $_POST['author_mail'], str_replace("!answerid!", "0", $_POST['answer_to']));

?> 
