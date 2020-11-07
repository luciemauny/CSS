<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="formulaire.css" media="all"/>
</head>
<style>
    input[type=submit].amis {
        background-color: #cccccc;
    }
    input[type=submit]:hover {
        background-color: gold;
    }
</style>
<body>

<div class="jeu" style="text-decoration: underline rgba(255, 249, 0, 1)">

    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    Mes amis
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<div class="animation1">
</div>
<div class="transbox">


    <div class="texte">
        </br>

        <img src="https://img.icons8.com/material-sharp/24/000000/find-user-male.png"/>

        </br></br>

        <?php

        session_start();

        $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

        //recherche les id des amis de l'utilisateur connecté
        $req = $bdd->prepare("SELECT id_amis  FROM amis WHERE id_utilisateur=?");
        $req->execute([$_SESSION['id']]);

        while ($data = $req->fetch()) { //boucle se termine quand tous amis de l'utilisateur ont été affichés

            //récupère le pseudo de l'ami
            $reque = $bdd->prepare("SELECT utilisateur.pseudo FROM utilisateur INNER JOIN amis ON
            utilisateur.id=amis.id_amis WHERE amis.id_amis=?");
            $reque->execute([$data["id_amis"]]);
            $datapseudo=$reque->fetch();

            //teste si l'amitié est réciproque
            $requete = $bdd->prepare("SELECT utilisateur.id FROM utilisateur INNER JOIN amis ON
            utilisateur.id=amis.id_amis WHERE amis.id_utilisateur=? AND amis.id_amis=?");
            $requete->execute([$data["id_amis"], $_SESSION['id']]);
            $datamis = $requete->fetch();

            if (empty($datamis['id'])){
                echo $datapseudo["pseudo"]; //affiche pseudo en noir si amitié non réciproque

            }else{
                echo '<span>';
                echo $datapseudo["pseudo"]; echo'</span>'; //affiche pseudo de couleur si amitié réciproque
            }
            echo'</br>';

            //affichage bouton de suppression d'ami avec passage de variable cachée contenant l'id de l'ami à supprimer
            ?>
            <form method="post" action="gestion_amis.php">
                <input type="hidden" name="id_amis" value="<?php echo $data["id_amis"] ?>">
                <input class="amis" type="submit" name="supprimer" value="supprimer cet ami">
            </form>

            <?php
        }
        ?>

    </div>

    <br/>

    <div class="texte">Les utilisateurs écrits en jaune sont ceux qui vous suivent aussi !
        <form method="post" action="page_accueil.php">
            <input type="submit" name="menu" value="MENU">
        </form>
    </div>
</div>
</body>
</html>
