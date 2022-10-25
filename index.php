<?php # Script 3.7 - index.php #2

include 'mysqli_connect.php';
$r = mysqli_query($dbc, "select first_name from users where user_id = 2");
if (!$r) {
  echo mysqli_error($dbc);
}

print_r($r);
mysqli_close($dbc);

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad() {
  echo '<div class="alert alert-info" role="alert"><p>This is an annoying ad!
  This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
} // End of the function definition.

$page_title = 'My Projects';
include('includes/header.html');

// Call the function:
create_ad();
?>

<div class="page-header"><h1>Content Header</h1></div>
<p>This is where the page-specific content goes. This section,
  and the corresponding header, will change from one page to the next.</p>

<p>Volutpat at varius sed sollicitudin et, arcu. Vivamus viverra. Nullam turpis.
  Vestibulum sed etiam. Lorem ipsum sit amet dolore. Nulla facilisi. Sed tortor.
  Aenean felis. Quisque eros. Cras lobortis commodo metus. Vestibulum vel purus.
  In eget odio in sapien adipiscing blandit. Quisque augue tortor, facilisis sit
  amet, aliquam, suscipit vitae, cursus sed, arcu lorem ipsum dolor sit amet.</p>

<?php
// Call the function again:
create_ad();

include('includes/footer.html');
?>