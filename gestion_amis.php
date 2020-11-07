<?php
session_start();

$id=$_SESSION['id'];
$t=0;

if(empty($_POST["supprimer"])){

    $pseudo=$_POST["pseudo"];

    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

    //récupération id et pseudo de l'utilisateur recherché
    $req = $bdd->prepare("SELECT id, pseudo FROM utilisateur WHERE pseudo=? ");
    $req->execute([$pseudo]);
    $data = $req->fetch();

    //teste si utilisateur recherché existe
    if(empty($data)){$t=1;

    }else{

        //cherche si utilisateur entré est déjà dans la liste d'amis
        $req = $bdd->prepare("SELECT utilisateur.id FROM utilisateur INNER JOIN amis ON 
        amis.id_utilisateur=utilisateur.id WHERE utilisateur.id=? AND amis.id_amis=?");
        $req->execute([$id, $data["id"]]);
        $data1 = $req->fetch();

        if(empty($data1['id'])){

            //enregistrement du nouvel ami
            $req = $bdd->prepare("INSERT INTO amis(id_utilisateur, id_amis) VALUES (?,?);");
            $req->execute([$id, $data["id"]]);
            $t=2;

        }
        else{$t=3;
        }
    }


}else {

    $id_amis = $_POST["id_amis"];

    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
    $req = $bdd->prepare("DELETE FROM amis WHERE id_utilisateur=? AND id_amis=?");
    $req->execute([$_SESSION['id'], $id_amis]);

}
?>


<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
</head>
<body>
<div class="jeu">

    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    <?php if($t==2) {echo'BRAVO !';}else{echo'OOUPS !';} ?>
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<div class="animation1">

</div>
</br>
<div class="texte">

    <?php switch($t){
        case 1 :
            echo "Cet utilisateur n'existe pas ! ";
            break;
        case 2 :
            echo $data["pseudo"];
            echo ' est maintenant votre ami ! ';
            break;
        case 3 :
            echo 'Cet utilisateur est déjà votre ami ! ';
            break;
        case 0 :
            echo 'Vous venez de supprimer un de vos ami ! ';

    } ?>
    Cliquez ici pour revenir au menu :
</div>

</br> </br>
<div class="animation2"></div>
<div class="animation4"></div>
<div class="animation3"></div>

<div class="box">
    <form method="post" action="page_accueil.php">
        <label>
            <p><input type="submit" name="menu" value="menu"></p>
        </label>
</div>

</form>
</body>
</html>
