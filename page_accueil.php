<?php
session_start();

if (empty($_POST["inscription"])){
} else {
    include('form_ajout_utilisateur.html');
    exit();
}

if (empty($_POST["recherche_jeu"])){
} else {
    $recherche_jeu=$_POST["recherche_jeu"];
    include('form_recherche_jeu.html');
    exit();
}

if (empty($_POST["connecter"])){
} else {
    $connecter=$_POST["connecter"];
    include('form_connecter.html');
    exit();
}

if (empty($_POST["ajout_jeu"])){
} else {
    $ajout_jeu=$_POST["ajout_jeu"];
    include('form_ajout_jeu.html');
    exit();
}

if (empty($_POST["menu"])){
}else{
    $menu=$_POST['menu'];
    include('form_menu.php');
    exit();
}

if (empty($_POST["ajout_amis"])){
}else{
    $ajout_amis=$_POST['ajout_amis'];
    include('form_ajout_amis.html');
    exit();
}

if (empty($_POST["decourvrir_jeux"])){
}else{
    include('decouvrir.php');
    exit();
}

/*https://cdn.aarp.net/content/dam/aarp/livable-communities/livability-in-action/2018/03/1140-board-games.imgcache.rev70b206bbad9db19b62eabafce2dbd0d3.jpg*/
?>
