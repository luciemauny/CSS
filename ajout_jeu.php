<?php
session_start();

$nom=$_POST["nom"];
$prix=$_POST["prix"];
$edition=$_POST["edition"];
$type_jeu=$_POST["type_jeu"];
$bio=$_POST["bio"];
$a=0; //variable permettant d'afficher différents message en fonction de l'exécution des différentes fonctions

//teste si les champs sont tous remplis
if(empty($nom)||empty($prix)||empty($edition)||empty($type_jeu)||empty($bio)){
    $a=2;
} else{

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

//teste si le jeu entré existe déjà dans la base de données
$req=$bdd->prepare("SELECT jeu.nom_jeu, jeu.id_edition FROM jeu INNER JOIN edition
    ON jeu.id_edition=edition.id_edition WHERE jeu.nom_jeu=? AND edition.nom_edition=?");
$req->execute([$nom,$edition]);
$data = $req->fetch();

if(empty($data)){$a=1;

    //teste si l'édition entrée par le joueur existe déjà dans la base données
    $req = $bdd->prepare("SELECT id_edition FROM edition WHERE nom_edition=?;");
    $req->execute([$edition]);
    $data = $req->fetch();

    if(empty($data['id_edition'])){

        //insert l'édition du jeu dans la table edition
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

    //récupère l'id de l'utilisateur connecté
    $req = $bdd->prepare("SELECT id FROM utilisateur WHERE utilisateur.pseudo=?;");
    $req->execute([$_SESSION["pseudo"]]);
    $data_pseudo = $req->fetch();


    $req = $bdd->prepare("SELECT id_jeu FROM jeu WHERE jeu.nom_jeu=?;");
    $req->execute([$nom]);
    $data_nom = $req->fetch();

    if(empty($data_existe['id_edition'])){
        $req = $bdd ->prepare ("INSERT INTO jeu(nom_jeu, prix, id_edition, id_jeu_type_jeu, bio) VALUES (?,?,?,?,?);");
        $req -> execute ([$nom, $prix, $data_edition['id_edition'], $type_jeu, $bio]);}

}
}

?>

<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
</head>
<body>
<form method="post" action="page_accueil.php">
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

        <?php
        switch($a) {
            case 0 :
                echo'Ce jeu existe déjà ! Cliquez ici pour revenir au menu :';
                break;

            case 1 :
                echo 'Votre jeu a bien été enregistré ! Cliquez ici pour revenir au menu :';
                break;

            case 2 :
                echo 'Veuillez remplir tous les champs! Cliquez ici pour revenir au formulaire';
                break;
        }
        ?>


    </div>

    </br> </br>
    <div class="animation2"></div>
    <div class="animation4"></div>
    <div class="animation3"></div>

    <div class="box">
        <?php if ($a==2){
            echo'
        <label>
            <p><input type="submit" name="ajout_jeu" value="Formulaire"></p>
        </label>
        </form>';
        } else{
        echo'
        <label>
            <p><input type="submit" name="menu" value="MENU"></p>
        </label>
        ';}?>
    </div>

</form>
</body>
</html>
