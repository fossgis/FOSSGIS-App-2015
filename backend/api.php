<?php
  // attempt a connection
  ini_set('display_errors', '1');
  error_reporting(E_ALL | E_STRICT);
  require_once('config.php');

  if (isset($_GET["func"])) {
    if ($_GET["func"] == "getSpeeches") {
      echo getSpeeches($connection);
    }
    if ($_GET["func"] == "getTitles") {
      echo getTitles($connection);
    }
    if ($_GET["func"] == "getSearch") {
      $search = $_GET["searchTerm"];
      echo getSearch($connection,$search);
    }
  }

  function getTitles($connection) {
    $ititles = $_COOKIE['title'];
    $ititles =  utf8_decode($ititles);

	if (strlen($ititles)>0){
    $titles = explode(",", $ititles);
    $maxi = count($titles);

    $help = $maxi - 1;
    $sql = "(Select title, date, start, room_id, duration, description
		From Speech
		Where ";
    for ($i=0; $i < $maxi; $i++)
    {
      if ($i == $help){
        $sql = $sql."Speech.id = '".$titles[$i]."'";
        $sqlarray[] = $sql;
      }else{
        $sql = $sql."Speech.id = '".$titles[$i]."' OR ";
      }
    }
    $sqlfor = $sqlarray[0];
    $sqlend = $sqlfor." Order BY start)
		Order by date;";

    $result = mysqli_query($connection, $sqlend);

    $number = 0;
    $array = [];
    while($row = mysqli_fetch_array($result)){
      $test = new stdClass();
      $test->title = (string)$row[0];
      $test->datum = (string)$row[1];
      $test->start = (string)$row[2];
      $test->room = (string)$row[3];
      $test->duration = (string)$row[4];
	  $test->description = (string)$row[5];
      $test->number = $number++;

      array_push($array, $test);
    }

    // close connection
    mysqli_close($connection);

    return json_encode($array);

	}else{
		return null;
	}
  }

  function getSpeeches($connection) {

    $sql = "SELECT title, start , subtitle, description, duration, room_id, Speech.id, date, GROUP_CONCAT(name) FROM Speech
      LEFT OUTER JOIN SpeakerSpeech
      ON Speech.id = SpeakerSpeech.speech_id
      LEFT OUTER JOIN Speaker
      On SpeakerSpeech.speaker_id = Speaker.id
      GROUP BY title
      ORDER BY date, start";

    $result = mysqli_query($connection, $sql);

    $number = 0;
    $array = [];
    while ($row = mysqli_fetch_array($result)) {

      $test = new stdClass();
      $test->title = (string)$row[0];
      $test->start = (string)$row[1];
      $test->subtitle = (string)$row[2];
      $test->description = (string)$row[3];
      $test->number = $number++;
      $test->duration = (string)$row[4];
      $test->name = (string)$row[5];
	  $test->id = (string)$row[6];
      $test->date = (string)$row[7];
      $test->speaker = (string)$row[8];


      array_push($array, $test);
    }

    // close connection
    mysqli_close($connection);

    return json_encode($array);
  }

  function getSearch($connection,$search) {

    $sql = "SELECT title, start , subtitle, description, duration, room_id, Speech.id, date, GROUP_CONCAT(name) FROM Speech
      LEFT OUTER JOIN SpeakerSpeech
      ON Speech.id = SpeakerSpeech.speech_id
      LEFT OUTER JOIN Speaker
      On SpeakerSpeech.speaker_id = Speaker.id
      WHERE title LIKE '".$search."%' OR
	  description LIKE '%".$search."%'
      GROUP BY start
      Order by start";

    $result = mysqli_query($connection, $sql);

    $number = 0;
    $array = [];
    while ($row = mysqli_fetch_array($result)) {

	  $test = new stdClass();
      $test->title = (string)$row[0];
      $test->start = (string)$row[1];
      $test->subtitle = (string)$row[2];
      $test->description = (string)$row[3];
      $test->number = $number++;
      $test->duration = (string)$row[4];
      $test->name = (string)$row[5];
	  $test->id = (string)$row[6];
      $test->date = (string)$row[7];
      $test->speaker = (string)$row[8];

      array_push($array, $test);
    }

    // close connection
    mysqli_close($connection);

    return json_encode($array);
  }
?>