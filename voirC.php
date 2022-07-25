<?php
// Verifiez si le paramettre id existe
if (isset($_GET["question_number"]) && !empty(trim($_GET["question_number"]))) {
    // Inclure le fichier config
    require_once "database.php";

    // Preparer la requete
    $sql = "SELECT * FROM choices WHERE question_number = ?";

    if ($stmt = mysqli_prepare($mysqli, $sql)) {
        // Bind les variables
        // mysqli_stmt_bind_param($stmt, "iiiii", $param_id);

        // Set parameters
        // $param_id = trim($_GET["question_number"]);

        // Attempt to execute la requette
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* recuperer l'enregistrement */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // recuperer les champs
                $question_number = $row["question_number"];
                // $question = $row["question"];
                $choice = $row['choice'];

            } else {
                // Si pas de id correct retourne la page d'erreur
                header("location: error.php");
                exit();
            }

        } else {
            echo "Oops! une erreur est survenue.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($mysqli);
} else {
    // Si pas de id correct retourne la page d'erreur
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir l'enregistrement</title>

    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <p >STOCK ET REFERENCEMENT</p>
    <div class="wrapper">
        <div >
            <div >
                <div>
                                        <h1 >Voir la référence</h1>
                    <div>
                        <label><b>Référence</b></label>
                        <p ><?php echo $row["question_number"]; ?></p>
                    </div>

                    <div>
                        <label><b>Type d'article</b></label>
                        <p ><?php echo $row["choice"]; ?></p>
                    </div>


                    <p><a href="add.php" >Retour</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
