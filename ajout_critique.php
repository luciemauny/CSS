<?php
session_start();

$bio=$_POST['bio'];
$note=$_POST['note'];

echo $note;

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT jeu.id_jeu FROM jeu WHERE jeu.nom_jeu=?");
$req->execute([$_SESSION['nom_jeu']]);
$data=$req->fetch();

$req = $bdd->prepare("SELECT id FROM utilisateur WHERE pseudo=?");
$req->execute([$_SESSION['pseudo']]);
$data_utilisateur=$req->fetch();

$req = $bdd->prepare("INSERT INTO critique(bio, id_jeu, id_utilisateur) VALUES(?,?,?)");
$req->execute([$bio,$data['id_jeu'],$data_utilisateur['id']]);

$req = $bdd->prepare("INSERT INTO note(note, id_jeu, id_utilisateur) VALUES(?,?,?)");
$req->execute([$note,$data['id_jeu'],$data_utilisateur['id']]);
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
            Votre avis a bien été ajouté ! Cliquez ici pour revenir au menu :
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


