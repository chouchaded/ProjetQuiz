<?php include "../database.php";?>
<?php session_start();?>
<?php
//Set question number
$number = (int) $_GET['n'];

//Get total number of questions
$query = "select * from questions";
$results = $mysqli->query($query) or die($mysqli->error . __LINE__);
$total = $results->num_rows;

// Get Question
$query = "select * from `questions` where question_number = $number";

//Get result
$result = $mysqli->query($query) or die($mysqli->error . __LINE__);
$question = $result->fetch_assoc();

// Get Choices
$query = "select * from `choices` where question_number = $number";

//Get results
$choices = $mysqli->query($query) or die($mysqli->error . __LINE__);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Quiz QCM !</title>
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
  </head>
  <body>
  <header>
      <?php
include '../html/header1.html'
?>
    </header>
    <div id="container">

      <main>
      <div class="container" style="text-align: center ;">
        <div class="current">Question <?php echo $number; ?> de <?php echo $total; ?></div>
	<p class="question">
	   <?php echo $question['question'] ?>
	</p>

	      <ul class="choices">
	        <?php while ($row = $choices->fetch_assoc()): ?>
		<li> <?php echo $row['choice']; ?>
		</li>
		<?php endwhile;?>
	      </ul>

      </div>
       <div style="text-align: center ;"><button ><a href="add.php">retour</a>
        </button></div>
    </div>



    </main>


       <footer>
      <?php
include '../html/footer.html'
?>
    </footer>
  </body>
</html>