<?php
ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);
include("config.php");
//global $connection;


/**
 * InsertComment
 * 
 * Insert a new comment
 * 
 * @param string $message Comment content
 * @param string $author_name Author name
 * @param string $author_mail Author contact mail (optional)
 * @param string $answer_to Id of an other comment (optional)
 * 
 */
function InsertComment ($message, $author_name, $author_mail, $answer_to) {
	 
	 $sql = "INSERT INTO NoticeBoard (message, author_name, author_mail, answer_to) 
	 			VALUES ('$message', '$author_name', '$author_mail', $answer_to) ";

	 mysqli_query($GLOBALS["connection"], $sql);			
}
 
/**
 * GetComments
 * 
 * Get raw datas of comments
 * 
 * @return string[] associative array containing comment datas
 */
function GetComments() {
   
    $sql="SELECT * FROM NoticeBoard";
    $result=mysqli_query($GLOBALS["connection"], $sql);
    //$result=$GLOBALS["connection"]-> mysqli_query($sql);
    return $result;
}

/*
 * DisplayComments
 * 
 * Get html formatted text, containing all comments
 */
/*function DisplayComments() {
    $html="";
    
    $res = GetComments();
    echo count($res);
    for($i=0; $i<count($res); $i++) {
        $html.= "	
	<div> 
		<br> Author Name: " . $res[i]["author_name"] . "
		<br> Author E-Mail: " . $res[i]["author_mail"] . "
		<br> Message: " . $res[i]["message"] . "
	</div>
        <br><br><br>
        ";
    }
    
    echo $html;

    
} */

function DisplayComments() {
    $html ="";
    $res = GetComments();
	
	// Generate an comment array
	$stack=null;
	while($row = $res->fetch_assoc()){
		if($stack==null) {
			$stack = array($row);
		} else {
			array_push($stack, $row);
		}
	}
	
	// Output
	for($i=0; $i<count($stack); $i++) {
		$id = $stack[$i]['id'];
		$author_name = $stack[$i]['author_name'];
        $author_mail = $stack[$i]['author_mail'];
        $message = $stack[$i]['message'];
		$createdtime = $stack[$i]['createdtime'];
		

		$answer_to = $stack[$i]['answer_to'];
		if($answer_to<=0) {
			// Main infos
			$html.="<div class='comment' align='center'>";
			$html.="<div id='comment$id'>";
			$html.= GenerateHtmlComment($author_name, $author_mail, $message, $createdtime);
					
					
			// Add answer link
			$html.="<a href='#' onclick='ShowAnswerForm($id);' class='answer'>Antworten</a>";


			// Search for answers
			for($d=0; $d<count($stack); $d++) {
				if($stack[$d]['answer_to']=="$id") {
					$html.= "<br><div class='reply'>";
					$html.= GenerateHtmlComment($stack[$d]['author_name'], $stack[$d]['author_mail'], $stack[$d]['message'], $stack[$d]['createdtime']);
					$html.= "</div><br><br>";
				}
			}
			
			// End
			$html.="		
				</div></div>
				<br><br><br>    
				";
		};
	};
	
    echo $html;
}

/**
 * Encode an email address to display on your website
 */
function encode_email_address( $email ) {

     $output = '';

     for ($i = 0; $i < strlen($email); $i++) 
     { 
          $output .= '&#'.ord($email[$i]).';'; 
     }

     return $output;
}

/* GenerateHtmlComment

* Generate the html content from a comment
*/
function GenerateHtmlComment($author_name, $author_mail, $message, $createdtime ) {
	$encodedEmail = encode_email_address( $author_mail );
	
	$date = date_create($createdtime);
	$createdtime = date_format($date, 'd.m.Y H:i');
	/*$date = DateTime::createFromFormat('Y-m-d H:m:s', $createdtime);
	$createdtime= $date->format('d.m.Y H:m');*/
		
	$name=" <div class='author'>" . $author_name.":</div>";
	if($author_mail!="") $name=" <div class='author'><a href='mailto:$encodedEmail' >$author_name:</a></div>"; 
	$str="<div class='time'>Erstellt: " . $createdtime .
		"</div>	<br> ".$name."<div class='text' align='left'>" . $message."</div>";
					
	
	
	return $str;
}

/**
* requireToVar
* 
* Includes an other file 
* @param $file path
* @return string content
* 
*/
function RequireToVar($file){
   ob_start();
   require($file);
   return ob_get_clean();
}

?>
