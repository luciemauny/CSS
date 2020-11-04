<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
</head>
<body>

<style>
    div.animation1 {
        width: 10px;
        height: 10px;
        background-color: red;
        position: relative;
        animation-name: animation1;
        animation-duration: 10s;
        animation-iteration-count: 10;
        margin-right: 50%;
        margin-left: 36%;
        padding: 0;
        float :top;
    }

    @keyframes animation1{
        0%   {background-color:red; left:0px; top:0px;}
        25%  {background-color:yellow; left:336px; top:0px;}
        50%  {background-color:blue; left:336px; top:700px;}
        75%  {background-color:green; left:0px; top:700px;}
        100% {background-color:red; left:0px; top:0px;}
    }

    body {
        background-image: url("https://images.pexels.com/photos/1323712/pexels-photo-1323712.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        border: 2px solid black;
    }


    input[type=submit] {
        width: 70%;
        background-color:black;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        font-weight: bold;
    }

    input[type=submit]:hover {
        background-color: rgba(255, 249, 0, 1);
    }


    div.transbox {
        width: 300px;
        height: 700px;
        background-color: hsla(15, 16%, 97%, 0.8);
        margin: auto;
        color: black;
        text-align: center;
        font-size: 20px;

    }

    div.jeu{
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        margin-top: 30px;
        margin-bottom: 30px;
        text-decoration: underline rgba(255, 249, 0, 1);
    }

    span{
        color: gold;
    }

</style>
<body>
<div class="jeu">

    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    Mes amis
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<div class="animation1">
</div>
<div class="transbox">
        </br>

        <img src="https://img.icons8.com/material-sharp/24/000000/find-user-male.png"/></br></br>
    <div class="box"></br></br></br></br></br>

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

    <div style="font-size: 15px">Les utilisateurs écrits en jaune sont ceux qui vous suivent aussi !</div>
    <form method="post" action="page_accueil.php">
        <input type="submit" name="menu" value="MENU">
    </form>

</div>
</body>
</html>
