<?php
session_start();
$identifiant=$_POST["identifiant"];
$mdp=$_POST["mdp"];

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo, utilisateur.mail FROM utilisateur
WHERE (utilisateur.pseudo=? OR utilisateur.mail=?) AND utilisateur.password=?");
$req->execute([$identifiant, $identifiant, $mdp]);
$data=$req->fetch();

if(empty($data)){

    ?>

    <html lang="fr">
    <head>
        <title>Critique_jeux_plateau</title>
        <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
    </head>
    <body>
    <form method="post" action="page_accueil.php";>
        <div class="jeu">

            <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            OOPS !
            <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
        </div>
        <div class="animation1">

        </div>
        </br>
        <div class="texte">
            Le mot de passe ou l'identifiant n'existe pas ! Cliquez ici pour réessayer:
        </div>

        </br> </br>
        <div class="animation2"></div>
        <div class="animation4"></div>
        <div class="animation3"></div>

        <div class="box">
            <label>
                <p><input type="submit" name="connecter" value="Réessayer"></p>
            </label>
        </div>

    </form>
    </body>
    </html>

    <?php
}else{
    $_SESSION["id"]=$data['id'];
    $_SESSION["pseudo"]=$data['pseudo'];
    include('form_menu.php');
}
?>
