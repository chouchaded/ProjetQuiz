<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
    <header>
    <?php
include 'header1.html'
?>
</header>
<?php
require 'database.php';
session_start();

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($mysqli, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($mysqli, $password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='" . hash('sha256', $password) . "'";
    $result = mysqli_query($mysqli, $query) or die(mysqli_error($mysqli, $query));
    $rows = mysqli_num_rows($result);
    if ($rows == 1) {
        $_SESSION['username'] = $username;
        header("Location: add.php");
    } else {
        $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?><div id="container">
<div class="container" style="text-align: center ;">
<p><form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>
<input type="text"  name="username" placeholder="Nom d'utilisateur">
<input type="password"  name="password" placeholder="Mot de passe"></p>
<p><input type="submit" value="Connexion " name="submit" class="box-button"></p>
 <div><button><a href="index.php">Retour acceuil</a></button></div>
<!-- <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p> -->
<?php if (!empty($message)) {?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php }?>
</form>
</div></div>
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
<footer>
      <?php
include 'footer.html'
?>
    </footer>
</body>
</html>