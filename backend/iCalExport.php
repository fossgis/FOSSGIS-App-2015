<?php

	//ini_set('display_errors', '1');
	//error_reporting(E_ALL | E_STRICT);
	
	// Get the cookies out of your browser
	$ititles = $_COOKIE['title'];
	$ititles =  utf8_decode($ititles);
	
	if (strlen($ititles)>0){
	
	//Create download for a specific filename
	
	//Detect special conditions devices
	$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");

	//do something with this information
	if( $iPod || $iPhone ){
		//browser reported as an iPhone/iPod touch
		$Filename = "FossGISKalender.ics";
		header("Content-Type: text/Calendar");
		header("Content-Disposition: attachment; filename=$Filename");	
	
	}else if($iPad){
		//browser reported as an iPad
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
    echo "BEGIN:VCALENDAR\n";
    echo "VERSION:2.0\n";
    echo "PRODID:FossGIS-app\n";
    echo "METHOD:PUBLISH\n";

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
			$sql = $sql."title LIKE '".utf8_encode($titles[$i])."%'";
			$sqlarray[] = $sql;
		}else{
			$sql = $sql."title LIKE '".utf8_encode($titles[$i])."%' OR ";
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
	echo "BEGIN:VEVENT\n";
	echo "LOCATION:".$row[3]. "\n";
	echo "SUMMARY:". $row[0] . "\n";
	echo "DESCRIPTION:". $row[0] . "\n";
	echo "CLASS:PUBLIC\n";
	echo "DTSTART:".$resultstartdt. "\n";
	echo "DTEND:".$resultenddt. "\n";
	echo "END:VEVENT\n";
    }
	echo "END:VCALENDAR";
	}
	else{ echo utf8_decode("Keine Veranstaltung ausgewählt."); }
?>
