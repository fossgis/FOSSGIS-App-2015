<?php

	//ini_set('display_errors', '1');
	//error_reporting(E_ALL | E_STRICT);
	
    $Filename = "FossGISKalender.ics";
    //header("Content-Type: text/Calendar");
    //header("Content-Disposition: inline; filename=$Filename");


    echo "BEGIN:VCALENDAR\n";
    echo "VERSION:2.0\n";
    echo "PRODID:FossGIS-app\n";
    echo "METHOD:PUBLISH\n";
	echo "X-WR-TIMEZONE:UTC\n";

    require 'config.php';
    
    $ititles = $_COOKIE['title'];
	$ititles =  utf8_decode($ititles);

	echo "ititles: ".$ititles;
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
	$sqlend = $sqlfor." order by date)
		Order by start;";
		
	echo " SQL-Abfrage: ".$sqlend;

	
		
	$result = mysqli_query($connection, $sqlend);
	   
            
    while($row = mysqli_fetch_array($result)){
	
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
		
		//echo $resultdatestart;


		$resultstartdt = $resultdatestart . $startstring ."Z";
		$resultenddt = $resultdateend . $resulttime ."Z";
		
		//echo $resultstartdt;
		//echo $resultenddt;
		
		echo 
		"
		BEGIN:VEVENT\
		SUMMARY:". $row[0] . "\n
		LOCATION;ENCODING=QUOTED-PRINTABLE:".$row[3]. "\n
		DTSTART:".$resultstartdt. "\n
		DTEND:".$resultenddt. "\n
		END:VEVENT\n
		";
    }
	echo "END:VCALENDAR";
	
?>
