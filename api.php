<?php
$page_title = 'Weather API';
include 'includes/header.html';
?>

<h1>This is an API page</h1>
<p>Please enter the name of the city:</p>
<form class="" action="" method="post">
  <input type="text" name="city" value="">
  <input type="submit" name="submit" value="Submit">
</form>

<?php
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'POST') {
  $data = file_get_contents('http://api.openweathermap.org/data/2.5/weather?units=metric&q=' . $_POST['city'] . '&appid=4138b5b6e0742be21c37a883c2b7ebb6');
  $data_decoded = json_decode($data, false);

  $city = $data_decoded->name;
  $temp = $data_decoded->main->temp;
  $wind = $data_decoded->wind->speed;
  $daily_min = $data_decoded->main->temp_min;
  $daily_max = $data_decoded->main->temp_max;

  echo '<h3>The current weather information for the city of <strong>' . $city . '</strong> is as follows:</h3>' .
  '<br> <p>Current temperature: ' . $temp . ' celsius.</p><br><p>Wind speed: ' . $wind . ' meters per second.</p><br><p> Daily min: ' .
  $daily_min . ' celsius.</p><br><p>Daily max: ' . $daily_max . ' celsius.</p>';

}

?>


<?php
include 'includes/footer.html';
?>
