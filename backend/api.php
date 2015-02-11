<?php
  // attempt a connection
  ini_set('display_errors', '1');
  error_reporting(E_ALL | E_STRICT);
  require_once('config.php');

  if (isset($_GET["func"])) {
    if ($_GET["func"] == "getSpeeches") {
      $room = $_GET["room"];
      $date = $_GET["date"];
      echo getSpeeches($connection,$room,$date);
    }
  }

  function getSpeeches($connection,$room, $date) {

    $sql = "SELECT title, start , subtitle, description, duration, GROUP_CONCAT(name) FROM Speech
      LEFT OUTER JOIN SpeakerSpeech
      ON Speech.id = SpeakerSpeech.speech_id
      LEFT OUTER JOIN Speaker
      On SpeakerSpeech.speaker_id = Speaker.id
      WHERE room_id = '".$room."'
      AND DATE =  '".$date."'
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

      array_push($array, $test);
    }

    // close connection
    mysqli_close($connection);

    return json_encode($array);
  }
?>