 <?php include "database.php";?>

<?php
//Get the total questions
$query = "select * from questions";
//Get Results
$results = $mysqli->query($query) or die($mysqli->error . __LINE__);
$total = $results->num_rows;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Quiz QCM !</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <header>
      <?php
include 'header.html'
?>
    </header>
    <div id="container">
           <main>
      <div class="container">

	<div style="text-align: center ;"><p ><h3>Ceci est un questionnaire à choix multiple pour tester vos connaissances</h3></p></div>

	<ul>
		<li><strong>Nombre de Questions: </strong><?php echo $total; ?></ul>
		<li><strong>Type de questionnaire: </strong>Choix Multiple</ul>
		<li><strong>Temps estimé: </strong><?php echo $total * 0.5; ?> minutes</ul>
	</ul>
<div style="text-align: center ;">
<?php
if ($total >= 1) {
    echo "<button><a href='question.php?n=1' class='start'>C'est parti !</a></button>";
} else {
    echo "/!\ Pas de question /!\ ";
}
?>
</div>
<div style="text-align: right ;">
	<a href="login.php" class="start">Administration Quiz</a></div>
    </div>
    </main></div>


      <footer>
      <?php
include 'footer.html'
?>
    </footer>
  </body>
</html>