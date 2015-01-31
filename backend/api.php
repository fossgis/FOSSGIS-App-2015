<?php
  // attempt a connection
  ini_set('display_errors', '1');
  error_reporting(E_ALL | E_STRICT);
  include("config.php");

  //-----------------------------------------------------------

  // execute query
  $sql = "SELECT title, start , subtitle, description, duration
      FROM Speech
      WHERE room_id =  'Aula'
      AND DATE =  '2015-03-11'
      Order by start";

  //-----------------------------------------------------------

  $result = mysqli_query($connection, $sql);


  // iterate over result set
  // print each row
  $number = 0;
  $array = [];
  while ($row = mysqli_fetch_array($result)) {
    $title = (string)$row[0];
    $start = (string)$row[1];
    $subtitle = (string)$row[2];
    $description = (string)$row[3];
    $number = $number + 1;
    $duration = (string)$row[4];

    $test = new stdClass();
    $test->title = (string)$row[0];
    $test->start = (string)$row[1];
    $test->subtitle = (string)$row[2];
    $test->description = (string)$row[3];
    $test->number = $number+1;
    $test->duration = (string)$row[4];

    array_push($array, $test);
  }

  print_r(json_encode($array));

  // close connection
  mysqli_close($connection);
?>