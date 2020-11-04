<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="formulaire.css" media="all"/>
</head>
<body>


<body>
<div class="jeu">

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


$req = $bdd->prepare("SELECT id_amis  FROM amis WHERE id_utilisateur=?");
$req->execute([$_SESSION['id']]);

$i=0;
while ($data = $req->fetch()) {
    $reque = $bdd->prepare("SELECT utilisateur.pseudo FROM utilisateur INNER JOIN amis ON utilisateur.id=amis.id_amis
    WHERE amis.id_amis=?");
    $reque->execute([$data["id_amis"]]);
    $datapseudo=$reque->fetch();
    $requete = $bdd->prepare("SELECT utilisateur.id FROM utilisateur INNER JOIN amis ON utilisateur.id=amis.id_amis WHERE amis.id_utilisateur=? AND amis.id_amis=?");
    $requete->execute([$data["id_amis"], $_SESSION['id']]);
    $datamis = $requete->fetch();
    if (empty($datamis['id'])){
    ?><?php echo $datapseudo["pseudo"];?>
        <?php
    }else{
        echo '<span>';
         echo $datapseudo["pseudo"]; echo'</span>'
            ?> <?php
    }
    echo'</br>';
    $i++;
    ?>
    <form method="post" action="gestion_amis.php">
        <input type="hidden" name="id_amis" value="<?php echo $data["id_amis"] ?>">
       <input type="submit" name="supprimer" value="supprimer cet ami">
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
