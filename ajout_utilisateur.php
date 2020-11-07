
<?php
session_start();
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$date_naissance=$_POST["date_naissance"];
$adresse_postale=$_POST["adresse_postale"];
$mail=$_POST["mail"];
$telephone=$_POST["telephone"];
$password=$_POST["password"];
$pseudo=$_POST["pseudo"];
$type_jeu=$_POST["type_jeu"];
$a=0; //variable permettant d'afficher les différents messages en fonction de la situation

//teste si tous les champs sont remplis
if(empty($nom)||empty($prenom)||empty($password)||empty($telephone)||empty($date_naissance)||empty($adresse_postale)||empty($mail)){
    $a=1;
}else{
    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

    //cherche si le pseudo existe déjà
    $req = $bdd->prepare("SELECT utilisateur.id FROM utilisateur WHERE utilisateur.pseudo=?");
    $req->execute([$pseudo]);
    $datapseudo=$req->fetch();

    //cherche si l'adresse mail existe déjà
    $requete = $bdd->prepare("SELECT utilisateur.id FROM utilisateur WHERE utilisateur.mail=?");
    $requete->execute([$mail]);
    $datamail=$requete->fetch();


    if(empty($datapseudo['id']) && empty($datamail['id'])){

        //cas où les identifiants choisis sont uniques : insertion nouvel utilisateur dans la base de données
        $req = $bdd->prepare("INSERT INTO utilisateur(prenom, nom, date_naissance, adresse_postale, mail, password, telephone, pseudo) VALUES (?,?,?,?,?,?,?,?);");
        $req->execute([$prenom, $nom, $date_naissance, $adresse_postale, $mail, $password, $telephone, $pseudo]);

        //récupération de l'id de l'utilisateur
        $req = $bdd ->prepare ("SELECT id FROM utilisateur WHERE nom=? AND prenom=? AND password=? AND date_naissance=? AND mail=? AND adresse_postale=?
    AND telephone=? AND pseudo=?");
        $req -> execute ([$nom, $prenom, $password, $date_naissance, $mail, $adresse_postale, $telephone, $pseudo]);
        $data = $req->fetch();

        //insertion du type de jeu préféré de l'utilisateur
        $req = $bdd->prepare("INSERT INTO utilisateur_type_jeu(id_utilisateur, id_type_jeu) VALUES (?,?);");
        $req->execute([$data['id'], $type_jeu]);
    }else{if(empty($datamail['id'])){
        $a=2; //si mail existe déjà
    }else{$a=3;//si pseudo existe déjà
    }
    }
}
?>

<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
</head>

<body>
<?php if($a!=0){ //redirection vers des pages différentes en fonction des tests effectués ci-dessus ?>
<form method="post" action="page_accueil.php";>
    <?php }else{ ?>
    <form method="post" action="form_menu.html">
        <?php }?>

        <div class="jeu">

            <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            <?php if($a!=0){echo'OOUPS !';
            }else{echo'BRAVO !';
            } ?>
            <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
        </div>
        <div class="animation1">

        </div>
        </br>
        <div class="texte">

            <?php //affichage de messages différents en fonction du cas
                switch($a){

                case 0 : echo'Vous êtes bien inscrit !';
                    break;
                case 1 : echo'Veuillez remplir tous les champs !';
                    break;
                case 2 : echo'Ce pseudo existe déjà !';
                    break;
                case 3 : echo'Cette adresse mail existe déjà !';
                    break;
            }
            ?>

        </div>

        </br> </br>
        <div class="animation2"></div>
        <div class="animation4"></div>
        <div class="animation3"></div>

        <div class="box">
            <?php if($a!=0){ //bouton de retour à la page d'accueil ?>
                <p><input type="submit" name="inscription" value="Recommencer"></p>
            <?php }else{ //bouton de redirection vers le menu du compte ?>
                <p><input type="submit" name="menu" value="MENU"></p>
            <?php }?>
        </div>

    </form>
</body>
</html>
