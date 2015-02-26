<?php

	//ini_set('display_errors', '1');
	//error_reporting(E_ALL | E_STRICT);
	
	// Get the cookies out of your browser
	$ititles = $_COOKIE['title'];
	$ititles =  utf8_decode($ititles);
	
	$output = "";
		if (strlen($ititles)>0){
		
		//Create download for a specific filename
		
		//Detect special conditions devices
		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");

		//do something with this information
		if(($iPod || $iPhone || $iPad) && window.navigator.standalone===false){
			//browser reported as an iPhone/iPod touch
			$Filename = "FossGISKalender.ics";
			header("Content-Type: text/Calendar");
			header("Content-Disposition: attachment; filename=$Filename");	
		
		
		}else if($Android){
			//browser reported as an Android device
			$Filename = "FossGISKalender.vcs";
			header("Content-Type: text/x-vCalendar");
			header("Content-Disposition: attachment; filename=$Filename");
		}else{
			//browser reported as an anything else
			$Filename = "FossGISKalender.ics";
			header("Content-Type: text/Calendar");
			header("Content-Disposition: attachment; filename=$Filename");	
		}
		// Create iCal file part 1
		$output.= "BEGIN:VCALENDAR\n";
		$output.= "VERSION:2.0\n";
		$output.= "PRODID:FossGIS-app\n";
		$output.= "METHOD:PUBLISH\n";

		require 'config.php';

		// Get all requested information out of the database
		$titles = explode(",", $ititles);
		$maxi = count($titles);

		$help = $maxi - 1;

		$sql = "(Select title, date, start, room_id, duration
			From Speech
			Where ";
		for ($i=0; $i < $maxi; $i++)
		{	
			if ($i == $help){
				$sql = $sql."Speech.id = '".$titles[$i]."%'";
				$sqlarray[] = $sql;
			}else{
				$sql = $sql."Speech.id = '".$titles[$i]."%' OR ";
			}
			
		}
		$sqlfor = $sqlarray[0];
		$sqlend = $sqlfor." order by start)
			Order by date;";
			
		$result = mysqli_query($connection, $sqlend);
		   
				
		while($row = mysqli_fetch_array($result)){
		
			/*
			*	Calculation of starttime and endtime
			*
			*/
		
			$start = $row[2];
			$duration = $row[4];
			
			$start2 = explode(":", $start);
			$duration2 = explode(":", $duration);
			
			$startstring = implode("", $start2);
			
			$resulthour = (int)$start2[0] + (int)$duration2[0];
			$resultminutes = (int)$start2[1] + (int)$duration2[1];
			$resultseconds = (int)$start2[2] + (int)$duration2[2];
			
			if($resultminutes >= 60){
				$resultminutes = $resultminutes - 60;
				$resulthour = $resulthour + 1;
			}
			
			if($resulthour < 10){
				$resulthour = (string)$resulthour;
				$resulthour = "0".$resulthour;
			}
			
			if($resultminutes < 10){
				$resultminutes = (string)$resultminutes;
				$resultminutes = "0".$resultminutes;
			}
			
			if($resultseconds < 10){
				$resultseconds = (string)$resultseconds;
				$resultseconds = "0".$resultseconds;
			}
		
			$resultt = array($resulthour, $resultminutes, $resultseconds);
			
			$resulttime = implode("", $resultt);

			
			$idatestart = $row[1];
			$idateend = $row[1];
			
			$datestart = explode("-", $idatestart);
			$dateend = explode("-", $idateend);
			
			$datestart2 = implode("", $datestart);
			$dateend2 = implode("", $dateend);
			
			$resultdatestart = (string)$datestart2."T";
			$resultdateend = (string)$dateend2."T";
			
			// endresult
			$resultstartdt = $resultdatestart . $startstring ."Z";
			$resultenddt = $resultdateend . $resulttime ."Z";
			
		// Create iCal file part 2
		$output.= "BEGIN:VEVENT\n";
		$output.= "LOCATION:".$row[3]. "\n";
		$output.= "SUMMARY:". $row[0] . "\n";
		$output.= "DESCRIPTION:". $row[0] . "\n";
		$output.= "CLASS:PUBLIC\n";
		$output.= "DTSTART:".$resultstartdt. "\n";
		$output.= "DTEND:".$resultenddt. "\n";
		$output.= "END:VEVENT\n";
		}
		$output.= "END:VCALENDAR";
		
		// Extra output to file for iPod/iPhone work around
		if( $iPod || $iPhone || $iPad){
			$content='<?php
					header("Content-Type: text/Calendar");
					header("Content-Disposition: attachment; filename=FossGISKalender.ics");?>';
			
			$content.=$output;
			
			// Generate unique hash
			$id=md5($content);
			
			// Insert content to file
			file_put_contents("calexport/$id.php", $content);
			
			// Link to created file
			echo "<h2><a href='http://giv-fossgis-app.uni-muenster.de/fossgis/backend/calexport/".$id.".php'  target='_blank'> In Kalender importieren!</a></h2><br><br>
			<h4><a href='javascript:history.back()'>Zur&uuml;ck!</a></h4>";
			
			
		} else {
			echo $output;
		} 
		
	}
	else{ 
		echo utf8_decode("Keine Veranstaltung ausgewählt.")."<br><br>
				<h4><a href='javascript:history.back()'>Zur&uuml;ck!</a></h4>"; 
	}
	
	
?>
