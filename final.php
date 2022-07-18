 <?php include "database.php";?>
<?php session_start();?>
<?php
//Create Select Query
$query = "select * from shouts order by time desc limit 100";
$shouts = mysqli_query($con, $query);

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>PHP Quizzer!</title>
    <link rel="stylesheet" href="css/style.css" type="text/css" />
  </head>
  <body>
    <div id="container">
      <header>
        <div class="container">
          <h1>PHP Quizzer</h1>
	</div>
      </header>


      <main>
	<div class="container" style="text-align: center ;">
	     <h2>Quizz QCM terminé !</h2>
	     <p>Bien ! Vous avez fini le quiz !</p>
	     <p>Score (1pt par bonne réponse) : <?php echo $_SESSION['score']; ?></p>
	     <p>
        <div><button><a href="question.php?n=1" class="start">Refaire le quiz</a></button>
	     <div><?php session_destroy();?><button><a href="index.php">Retour acceuil</a></button></div>
      </div>
       </p>
  </div>
      </main>


      <footer>
      <?php
include 'footer.html'
?>
    </footer>
  </body>
</html>