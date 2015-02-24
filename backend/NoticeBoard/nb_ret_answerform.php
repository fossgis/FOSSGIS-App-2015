<?php
	/*
		Return the answer form for the requested answer id

	*/

	include ('nb_functions.php');

    $str=requireToVar("nb_form_answer.php");
    $str=str_replace("!answerid!",$_POST["answer_to"], $str);
    
    echo $str;
    
?>
