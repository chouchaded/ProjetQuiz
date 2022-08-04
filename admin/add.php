<?php include "../database.php";?>

<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    //Get Post variables
    $question_number = $_POST['question_number'];
    $question_text = $_POST['question_text'];
    $correct_choice = $_POST['correct_choice'];
    $choices = array();
    $choices[1] = $_POST['choice1'];
    $choices[2] = $_POST['choice2'];
    $choices[3] = $_POST['choice3'];
    $choices[4] = $_POST['choice4'];
    $choices[5] = $_POST['choice5'];

    //Question query
    $query = "insert into questions (question_number, question)
   	 values('$question_number','$question_text')";
    $insert_row = $mysqli->query($query) or die($mysqli->error);

    //VALIDATE INSERT
    if ($insert_row) {
        foreach ($choices as $choice => $value) {
            if ($value != '') {
                if ($correct_choice == $choice) {
                    $is_correct = 1;
                } else {
                    $is_correct = 0;
                }
                $query = "insert into choices (question_number,is_correct,choice)
   	          values('$question_number','$is_correct','$value')";
                $insert_row = $mysqli->query($query) or die($mysqli->error);
                if ($insert_row) {
                    continue;
                } else {
                    die("Error: (" . $mysqli->error . ") " . $mysqli->error);
                }
            }
        }
        $msg = "La question a bien été ajouté";
    }
}
//get total questions
$query = "select * from questions";
$questions = $mysqli->query($query) or die($mysqli->error);
$total = $questions->num_rows;
$next = $total + 1;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Quiz QCM !</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="stylesheet" href="../css/style.css" type="text/css" />
  </head>

  <body>

  <!-- <script>
         function isEmpty(){
             var str = document.forms['formAdd'].firstName.value;
             if( !str.replace(/\s+/, '').length ) {
                  alert( "Le champ Choix 5 est vide!" );
                  return false;
             }
         }
      </script> -->






      <header>
  <?php
include '../html/header1.html'
?>
      </header>
<div id="container">

      <main>
	<div >
       <h1><p style="text-align: center ;">Liste des questions</p></h1>
	     <?php
if (isset($msg)) {echo "<p>" . $msg . "</p>";}

$sql = "SELECT * FROM questions";

if ($result = mysqli_query($mysqli, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="blueTable">';
        echo '<thead  ">';
        echo '<tr >';
        // echo "<th>#</th>";
        echo '<th style="text-align : center">N° Questions</th>';
        echo "<th>Questions</th>";

        echo '<th style="text-align : center">Effacer Question/Réponse</th>';

        echo '<th style="text-align : center">Voir les réponses</th>';

        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo '<td style="text-align : center">' . $row['question_number'] . "</td>";
            echo '<td >' . $row['question'] . "</td>";

            echo '<td style="text-align : center" >';
            echo '<a href="delete.php?question_number=' . $row['question_number'] . ' "><span><i class="fa-solid fa-trash-can"></i></span></a>';
            echo "</td>";

            echo '<td style="text-align : center">';
            echo '<a href="voirC.php?n=' . $row['question_number'] . ' "><span><i class="fa-solid fa-eye"></i></span></a>';

            echo "</td>";

            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<div class="alert alert-danger"><em>Pas d\'enregistrement</em></div>';
    }
} else {
    echo "Oops! Une erreur est survenue";
}
?>
	     <form name="formAdd" method="post" action="add.php">
	     	   <p>

			<label>N° Question</label>


      <input readonly="readonly" type="number" value="<?php echo $next; ?>" name="question_number" />

		</p>
	     	   <p>
			<label>Enoncé de la question: </label>
			<input required type="text" name="question_text" size="50%"/>
		   </p>
	     	   <p>
			<label>Choix #1: </label>
			<input required type="text" name="choice1" size="50%"/>
		   </p>
	     	   <p>
			<label>Choix #2: </label>
			<input required type="text" name="choice2" size="50%"/>
		   </p>
	     	   <p>
			<label>Choix #3: </label>
			<input required type="text" name="choice3" size="50%"/>
		   </p>
	     	   <p>
			<label>Choix #4: </label>
			<input required type="text" name="choice4" size="50%"/>
		   </p>
	     	   <p>
			<label>Choix #5: </label>
			<input  type="text" name="choice5" size="50%"/>
		   </p>
	     	   <p><div>
			<label>N° de réponse correcte: </label>
			<select type="number" name="correct_choice" >
     <option value="1">1</option>
     <option value="2">2</option>
	 <option value="3">3</option>
	 <option value="4">4</option>
	 <option value="5">5</option>
            </select>
            </div>
			<!-- <input type="number" name="correct_choice" /> -->
		   </p>
		   <p><div style="margin-top: 10px; text-align:center; ">

<input type="submit" name="submit" value="Ajouter question"/>

        </form>
        <button ><a href="../logout.php">Déconnexion</a>
        </button></div>
    </p>
	</div>
    </div>
      </main>


    <footer>
      <?php
include '../html/footer.html'
?>
    </footer>


  </body>
</html>