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

<?php
	/* 
		Insert a comment with given POST values to database
	*/ 

	include ('nb_functions.php');

	InsertComment($_POST['message'], $_POST['author_name'], $_POST['author_mail'], str_replace("!answerid!", "0", $_POST['answer_to']));

?> 
