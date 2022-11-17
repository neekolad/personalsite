<?php
$page_title = "Fantasy Premier League API";
include '../includes/header.html';

# Connect to database
require('../mysqli_connect2.php');

$data = file_get_contents('https://fantasy.premierleague.com/api/bootstrap-static/');
$data_decoded = json_decode($data, true);

$eltypes = $data_decoded['element_types'];
$teams = $data_decoded['teams'];
$players = $data_decoded['elements'];

$query = "";

foreach ($players as $row) {

    $id = $row['id'];
    $first_name = $row['first_name'];
    $last_name = $row['second_name'];
    $team = $row['team'];
    $total_points = $row['total_points'];
    $goals_scored = $row['goals_scored'];
    $assists = $row['assists'];

    $query = "INSERT INTO players (id, first_name, last_name, team, total_points, goals_scored, assists)
    VALUES ('$id', " . "'" . mysqli_real_escape_string($dbc, $first_name) . "'" . ", " . "'" . mysqli_real_escape_string($dbc, $last_name) . "'" .
    ", '$team', '$total_points', '$goals_scored', '$assists')";

    echo $query;

    $r = @mysqli_query($dbc, $query);
}
 ?>

<h1>This is a Fantasy Premier League simple API</h1>

<pre>
  <?php
  if ($r) {
    echo '<p>Added data to database!</p>';
  } else {
    echo '<p>OOppss, ran into some errors: ' . mysqli_error($dbc);
  }
  print_r($data_decoded);   ?>
</pre>


<pre>
<?php
  print_r($eltypes);
?>
</pre>

<pre>
  <?php print_r($teams) ?>
</pre>


 <?php
 include '../includes/footer.html';
  ?>
