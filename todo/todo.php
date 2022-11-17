<?php
# Set page title
$page_title = 'To do app';

# Include page header
include '../includes/header.html';

# Database connection
require('../mysqli_connect2.php');

# Create query for printing table
$tasks = @mysqli_query($dbc, "SELECT * FROM todos");

$method = $_SERVER['REQUEST_METHOD'];

# Check if form submitted
if (isset($_POST['submit'])) {

  $task = $_POST['new_task'];

  # Check if tasks input is valid
  if (!empty($task)) {
    # Creating query for task insertion
    $r = @mysqli_query($dbc, "INSERT INTO todos (text) VALUES ('$task')");
    header('location: todo.php');
  } else {
    echo '<p>Task cannot be blank!</p>';
  }
}

# Delete task
if (isset($_GET['del_task'])) {
  $id = $_GET['del_task'];
  echo $_GET['del_task'];
  $res = @mysqli_query($dbc, "DELETE FROM todos WHERE id=$id");
  header('location: todo.php');
}
?>

<!-- Page content -->
<h1>This is a simple To-do web app</h1>

<!-- Form for adding tasks -->
<div class="container">
  <form class="row" action="todo.php" method="post">
    <div class="col-auto">
      <input class="" type="text" name="new_task" value="">
    </div>
    <div class="col-auto">
      <input class="btn btn-primary" type="submit" name="submit" value="Add">
    </div>
  </form>
</div>


<!-- End of tasks form -->


<?php
# Creating table
echo '<br>';
echo '<table width="30%" border="1px solid black">';
$i=1;
while ($row=mysqli_fetch_array($tasks)) {
  echo '<tr><td>' . $i . '<td style="padding: 4px">' . $row['text'] . '</td><td align="center"><a href="todo.php?del_task=' .
  $row['id'] . '">' . 'X' . '</a></td></tr>' . "\r\n";
  $i++;
}
 ?>
<?php echo '</table>'; ?>

<!-- Try to add EDIT feature for this todo list -->


<!-- End page content -->
<?php
include '../includes/footer.html';
?>
