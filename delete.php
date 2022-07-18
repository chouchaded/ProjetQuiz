<?php
// confirmer
if (isset($_POST["question_number"]) && !empty($_POST["question_number"])) {
    // Inclure le fichier config
    require_once "database.php";

    // Prepare la requette
    $sql = "DELETE FROM questions  WHERE question_number = ?";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["question_number"]);

        // Executer
        if (mysqli_stmt_execute($stmt)) {
            // supprimé, retourne
            header("location: add.php");
            exit();
        } else {
            echo "Oops! une erreur est survenue.";
        }
    }
    $sql1 = "DELETE FROM choices WHERE question_number = ?";

    if ($stmt = mysqli_prepare($mysqli, $sql1)) {
        // Bind les variables
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["question_number"]);

        // Executer
        if (mysqli_stmt_execute($stmt)) {
            // supprimé, retourne
            header("location: add.php");
            exit();
        } else {
            echo "Oops! une erreur est survenue.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($mysqli);
} else {
    // verifier si paramettre id exite
    if (empty(trim($_GET["question_number"]))) {
        // pas de id, erreur
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer l'enregistrement</title>
 <!-- <link rel="stylesheet" href="css/style.css" type="text/css" /> -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<body>
<main>
       <div >
        <div class="container mt-3">
            <div class="card border-2 border-dark">
                <div class="card-body text-bg-secondary p-3 " style="text-align: center;">
                    <h4 class="card-title">Supprimer la question</h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div >
                            <input type="hidden" name="question_number" value="<?php echo trim($_GET["question_number"]); ?>"/>
                            <p>Etes vous sûr de vouloir supprimer cette question ?</p>
                            <p>
                                <input class="btn btn-warning" type="submit" value="OUI" >
                                <a href="add.php" class="btn btn-primary">NON</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>
</body>
</html>
