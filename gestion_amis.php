<?php
session_start();

$id=$_SESSION['id'];

if(empty($_POST["supprimer"])){

$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$pseudo=$_POST["pseudo"];

$t=0;


$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

if(empty($pseudo)){
    $req = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo FROM utilisateur WHERE utilisateur.nom=? AND utilisateur.prenom=?;");
    $req->execute([$nom, $prenom]);
    $data = $req->fetch();
        if(!$data){
?>
            <html lang="fr">
            <head>
                <title>Critique_jeux_plateau</title>
                <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
            </head>
            <body>
            <div class="jeu">

                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                OOPS !
                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            </div>
            <div class="animation1">

            </div>
            </br>
            <div class="texte">
                Cet utilisateur n'existe ! Cliquez ici réessayer :
            </div>

            </br> </br>
            <div class="animation2"></div>
            <div class="animation4"></div>
            <div class="animation3"></div>

            <div class="box">
                <form method="post" action="page_accueil.php"
                <label>
                    <p><input type="submit" name="ajout_amis" value="Réessayer"></p>
                </label>
            </div>

            </form>
            </body>
            </html>
            <?php
            exit();

        }
        else{
            $req = $bdd->prepare("SELECT utilisateur.id FROM utilisateur INNER JOIN amis ON amis.id_utilisateur=utilisateur.id
            WHERE utilisateur.id=? AND amis.id_amis=?;");
            $req->execute([$id, $data["id"]]);
            $data1 = $req->fetch();

            if(empty($data1['id'])){

            $req = $bdd->prepare("INSERT INTO amis(id_utilisateur, id_amis) VALUES (?,?);");
            $req->execute([$id, $data["id"]]);
            $t=1;

            }
            else{?>
                <html lang="fr">
            <head>
                <title>Critique_jeux_plateau</title>
                <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
            </head>
            <body>
            <div class="jeu">

                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                WAOUU !
                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            </div>
            <div class="animation1">

            </div>
            </br>
            <div class="texte">
                Cet utilisateur est déjà ton amis ! Cliquez ici pour revenir au menu :
            </div>

            </br> </br>
            <div class="animation2"></div>
            <div class="animation4"></div>
            <div class="animation3"></div>

            <div class="box">
                <form method="post" action="page_accueil.php"
                <label>
                    <p><input type="submit" name="menu" value="MENU"></p>
                </label>
            </div>

            </form>
            </body>
            </html>
                <?php
            }
        }
}

else if (empty($nom)&&empty($prenom)){
    $req = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo FROM utilisateur WHERE utilisateur.pseudo=? ");
    $req->execute([$pseudo]);
    $data = $req->fetch();
        if(!$data){?>
            <html lang="fr">
            <head>
                <title>Critique_jeux_plateau</title>
                <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
            </head>
            <body>
            <div class="jeu">

                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                OOPS !
                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            </div>
            <div class="animation1">

            </div>
            </br>
            <div class="texte">
                Cet utilisateur n'existe pas ! Cliquez ici réessayer :
            </div>

            </br> </br>
            <div class="animation2"></div>
            <div class="animation4"></div>
            <div class="animation3"></div>

            <div class="box">
                <form method="post" action="page_accueil.php"
                <label>
                    <p><input type="submit" name="ajout_amis" value="Réessayer"></p>
                </label>
            </div>

            </form>
            </body>
            </html>

            <?php
        exit();
        }else {
            $req = $bdd->prepare("SELECT utilisateur.id FROM utilisateur INNER JOIN amis ON amis.id_utilisateur=utilisateur.id
            WHERE utilisateur.id=? AND amis.id_amis=?;");
            $req->execute([$id, $data["id"]]);
            $data1 = $req->fetch();

            if(empty($data1['id'])){

                $req = $bdd->prepare("INSERT INTO amis(id_utilisateur, id_amis) VALUES (?,?);");
                $req->execute([$id, $data["id"]]);
                $t=1;

            }
            else{?>
                <html lang="fr">
                <head>
                    <title>Critique_jeux_plateau</title>
                    <link rel="stylesheet" type="text/css" href="confirmation.css" media="all"/>
                </head>
                <body>
                <div class="jeu">

                    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                    WAOUU !
                    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                </div>
                <div class="animation1">

                </div>
                </br>
                <div class="texte">
                    Cet utilisateur est déjà ton amis ! Cliquez ici pour revenir au menu :
                </div>

                </br> </br>
                <div class="animation2"></div>
                <div class="animation4"></div>
                <div class="animation3"></div>

                <div class="box">
                    <form method="post" action="page_accueil.php"
                    <label>
                        <p><input type="submit" name="menu" value="MENU"></p>
                    </label>
                </div>

                </form>
                </body>
                </html>
                <?php
            }
    }
}

if ($t==1){
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
        BRAVO !
        <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    </div>
    <div class="animation1">

    </div>
    </br>
    <div class="texte">
        <?php echo $data["pseudo"]?> est maintenant votre ami! Cliquez ici pour revenir au menu :
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

<?php
}
}else{

    $id_amis=$_POST["id_amis"];

    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
    $req = $bdd->prepare("DELETE FROM amis WHERE id_utilisateur=? AND id_amis=?");
    $req->execute([$_SESSION['id'],$id_amis]);

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
        BRAVO !
        <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    </div>
    <div class="animation1">

    </div>
    </br>
    <div class="texte">
        Vous venez de supprimer un de vos ami! Cliquez ici pour revenir au menu :
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

<?php
}
    ?>