<?php
$page_title = "Standings";
include '../includes/header.html';

# DB connection
require('../mysqli_connect2.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  # Set request parameters
  $uri = "https://api.football-data.org/v4/competitions/PL/standings";
  $reqPrefs['http']['method'] = 'GET';
  $reqPrefs['http']['header'] = 'X-Auth-Token: 1d3d726e50264cdaaf1465e12ce491e5';
  $stream_context = stream_context_create($reqPrefs);

  $data = file_get_contents($uri, false, $stream_context);
  $data_decoded = json_decode($data, true);


  $table = $data_decoded['standings'][0]['table'];
  $query = "";

  # Loop trough data and prepare for writing into DB
  foreach ($table as $t) {
    $position = $t['position'];
    $name = $t['team']['name'];
    $playedGames = $t['playedGames'];
    $form = $t['form'];
    $won = $t['won'];
    $draw = $t['draw'];
    $lost = $t['lost'];
    $points = $t['points'];
    $goalsFor = $t['goalsFor'];
    $goalsAgainst = $t['goalsAgainst'];
    $goalDifference = $t['goalDifference'];

    # Write data to DB
    $query = "INSERT INTO standings (position, name, played_games, form, won, draw, lost, points, goals_for, goals_against, goal_difference)
              VALUES (
                $position,
                '$name',
                $playedGames,
                '$form',
                $won,
                $draw,
                $lost,
                $points,
                $goalsFor,
                $goalsAgainst,
                $goalDifference
              )";

    $r = @mysqli_query($dbc, $query);
    echo mysqli_error($dbc);
    header('location: tables.php');
  }
}


# Read data from DB to make a standings table
$query2 = "SELECT * FROM standings";
$r2 = @mysqli_query($dbc, $query2);

# Table heading
echo '<table width="60%">
      <thead>
      <tr>
        <th>Pos</th>
        <th>Name</th>
        <th>P</th>
        <th>W</th>
        <th>D</th>
        <th>L</th>
        <th>FOR</th>
        <th>AG</th>
        <th>DIFF</th>
        <th>PTS</th>
        <th>FORM</th>
      </thead>
      </tr>
      <tbody>';

# Table body
while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
  echo '<tr>
          <td>' . $row['position'] . '</td>
          <td>' . $row['name'] . '</td>
          <td>' . $row['played_games'] . '</td>
          <td>' . $row['won'] . '</td>
          <td>' . $row['draw'] . '</td>
          <td>' . $row['lost'] . '</td>
          <td>' . $row['goals_for'] . '</td>
          <td>' . $row['goals_against'] . '</td>
          <td>' . $row['goal_difference'] . '</td>
          <td>' . $row['points'] . '</td>
          <td>' . $row['form'] . '</td>
          </tr>
          </tbody>';
}


?>

<h1>This page shows a Premier League table</h1>

<pre>
  <form class="" action="tables.php" method="post">
    <input type="submit" name="submit" value="UPDATE TABLE">
  </form>
</pre>

<?php
 include '../includes/footer.html';
?>
