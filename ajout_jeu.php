<?php
session_start();
$nom=$_POST["nom"];
$prix=$_POST["prix"];
$edition=$_POST["edition"];
$type_jeu=$_POST["type_jeu"];
$bio=$_POST["bio"];
$a=0;


$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

$req=$bdd->prepare("SELECT jeu.nom_jeu, jeu.prix, jeu.id_edition, jeu.id_jeu_type_jeu FROM jeu INNER JOIN edition
    ON jeu.id_edition=edition.id_edition WHERE jeu.nom_jeu=? AND edition.nom_edition=? AND jeu.prix=? AND jeu.id_jeu_type_jeu=?");
$req->execute([$nom,$edition,$prix,$type_jeu]);
$data = $req->fetch();

if(empty($data)){$a=1;

    $req = $bdd->prepare("SELECT id_edition FROM edition WHERE nom_edition=?;");
    $req->execute([$edition]);
    $data = $req->fetch();

    if(empty($data['id_edition'])){
        $req = $bdd->prepare("INSERT INTO edition(nom_edition) VALUES (?);");
        $req->execute([$edition]);
    }
    $req = $bdd->prepare("SELECT id_edition FROM edition INNER JOIN jeu ON jeu.id_edition=edition.id_edition
    WHERE jeu.nom=?;");
    $req->execute([$nom]);
    $data_existe = $req->fetch();

    $req = $bdd->prepare("SELECT id_edition FROM edition WHERE nom_edition=?;");
    $req->execute([$edition]);
    $data_edition = $req->fetch();


    $req = $bdd->prepare("SELECT id FROM utilisateur WHERE utilisateur.pseudo=?;");
    $req->execute([$_SESSION["pseudo"]]);
    $data_pseudo = $req->fetch();

    $req = $bdd->prepare("SELECT id_jeu FROM jeu WHERE jeu.nom_jeu=?;");
    $req->execute([$nom]);
    $data_nom = $req->fetch();

    if(empty($data_existe['id_edition'])){
        $req = $bdd ->prepare ("INSERT INTO jeu(nom_jeu, prix, id_edition, id_jeu_type_jeu, bio) VALUES (?,?,?,?,?);");
        $req -> execute ([$nom, $prix, $data_edition['id_edition'], $type_jeu, $bio]);}


}else{}

?>

<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
</head>
<body>
<form method="post" action="form_menu.html" ;>
    <div class="jeu">

        <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>

        <?php if($a==1){echo'BRAVO !';
        }else{echo'OOUPS !';
        } ?>

        <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    </div>
    <div class="animation1">

    </div>
    </br>
    <div class="texte">

        <?php if($a==1){echo'Votre jeu a bien été enregistré ! ';
        }else{echo'Ce jeu existe déjà ! ';
        }?>

        Cliquez ici pour revenir au menu :
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
