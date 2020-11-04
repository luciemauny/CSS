<?php
session_start();

$avis=$_POST["avis_critique"];
$id_critique=$_POST["id_critique"];

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
$req = $bdd->prepare("INSERT INTO note_critique (id_critique,note_critique,id_utilisateur) VALUES (?,?,?)");
$req->execute([$id_critique,$avis,$_SESSION['id']]);


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
        Bravo !
        <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    </div>
    <div class="animation1">

    </div>
    </br>
    <div class="texte">
        Votre note critique a bien été ajoutée ! Cliquez ici pour revenir au menu :
    </div>

    </br> </br>
    <div class="animation2"></div>
    <div class="animation4"></div>
    <div class="animation3"></div>

    <div class="box">
        <label>
            <p><input type="submit" name="menu" value="MENU"></p>
        </label>
    </div>

</form>
</body>
</html>
