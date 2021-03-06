
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
        $req = $bdd->prepare("INSERT INTO utilisateur(prenom, nom, date_naissance, adresse_postale, mail, password, telephone, pseudo, type_jeu) VALUES (?,?,?,?,?,?,?,?,?);");
        $req->execute([$prenom, $nom, $date_naissance, $adresse_postale, $mail, $password, $telephone, $pseudo, $type_jeu]);

        //récupération de l'id de l'utilisateur
        $req = $bdd ->prepare ("SELECT id FROM utilisateur WHERE nom=? AND prenom=? AND password=? AND date_naissance=? AND mail=? AND adresse_postale=?
    AND telephone=? AND pseudo=? AND type_jeu=?");
        $req -> execute ([$nom, $prenom, $password, $date_naissance, $mail, $adresse_postale, $telephone, $pseudo,$type_jeu]);
        $data = $req->fetch();


    }else{if(empty($datamail['id'])){
        $a=2; //si mail existe déjà
    }else{$a=3;//si pseudo existe déjà
    }
    }
}
if ($a==0){//s'il n'y a aucun problème, redirection vers menu
    $_SESSION["id"]=$data['id'];
    $_SESSION["pseudo"]=$pseudo;
    include('form_menu.php');
}else{
?>

<html lang="fr">
<head>
    <title>Erreur</title>
    <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
</head>

<body>
<form method="post" action="page_accueil.php";>
        <div class="jeu">
            <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            <?php echo'OOUPS !'; ?>
            <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
        </div>
        <div class="animation1">

        </div>
        </br>
        <div class="texte">

            <?php //affichage de messages différents en fonction du cas
            switch($a){

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
                <p><input type="submit" name="inscription" value="Recommencer"></p>

        </div>

    </form>
</body>
</html>
<?php } ?>
