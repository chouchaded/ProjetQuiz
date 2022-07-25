<?php
/*
Page: connexion.php
 */
//à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
require 'database.php';

session_start();
//si le bouton "Connexion" est cliqué
// if (isset($_POST['connexion'])) {echo 'flop';
// on vérifie que le champ "Pseudo" n'est pas vide
// empty vérifie à la fois si le champ est vide et si le champ existe belle et bien (is set)
if (empty($_POST['username'])) {
    echo "Le champ Pseudo est vide.";
} else {
    // on vérifie maintenant si le champ "Mot de passe" n'est pas vide"
    if (empty($_POST['password'])) {
        echo "Le champ Mot de passe est vide.";
    } else {
        // les champs pseudo & mdp sont bien postés et pas vides, on sécurise les données entrées par l'utilisateur
        //le htmlentities() passera les guillemets en entités HTML, ce qui empêchera en partie, les injections SQL
        $Pseudo = htmlentities($_POST['username'], ENT_QUOTES, "UTF-8");
        $MotDePasse = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
        //on se connecte à la base de données:
        // $mysqli = mysqli_connect("domaine.tld", "nom d'utilisateur", "mot de passe", "base de données");
        //on vérifie que la connexion s'effectue correctement:
        if (!$mysqli) {
            echo "Erreur de connexion à la base de données.";
        } else {
            //on fait maintenant la requête dans la base de données pour rechercher si ces données existent et correspondent:
            //si vous avez enregistré le mot de passe en md5() il vous faudra faire la vérification en mettant mdp = '".md5($MotDePasse)."' au lieu de mdp = '".$MotDePasse."'
            // $Requete = mysqli_query($mysqli, "SELECT * FROM membres WHERE username = '" . $Pseudo . "' AND password = '" . $MotDePasse . "'");

            $Requete = mysqli_query($mysqli, "SELECT * FROM `users` WHERE username='$Pseudo' and password='" . hash('sha256', $MotDePasse) . "'");

            //si il y a un résultat, mysqli_num_rows() nous donnera alors 1
            //si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
            if (mysqli_num_rows($Requete) == 0) {
                echo "Le pseudo ou le mot de passe est incorrect, le compte n'a pas été trouvé.";
            } else {
                //on ouvre la session avec $_SESSION:
                //la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
                $_SESSION['username'] = $Pseudo;
                header("Location: add.php");

                // echo "Vous êtes à présent connecté !";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <title>Document</title>
</head>
<body>
  <div id="container" style="text-align: center ;">
<p>
    <form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>
<input type="text"  name="username" placeholder="Nom d'utilisateur">
<input type="password"  name="password" placeholder="Mot de passe"></p>
<p><input type="submit" value="Connexion " name="submit" class="box-button"></p>
<!-- <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p> -->
<?php if (!empty($message)) {?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php }?>
</form>
</div>


<script language="JavaScript" type="text/javascript">
var titre = "-<<<--- Quizz QCM ! --->>>-";
function bougerTitre()
{
 titre = titre.substring(1, titre.length) + titre.substring(0, 1);
 document.title = titre;
 setTimeout("bougerTitre()", 100);
 }
bougerTitre();
</script>


</body>
</html>
</body>
</html>