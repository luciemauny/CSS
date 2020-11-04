<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="tableaux.css" media="all"/>
</head>

<body>
<div class="jeu">
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    Notes données par mes amis
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<table cellspacing="0">
    <tr>
        <th>Pseudo</th>
        <th>Jeu</th>
        <th>Note</th>
    </tr>


<?php
session_start();


$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT utilisateur.pseudo,note.note,jeu.nom_jeu FROM utilisateur 
INNER JOIN amis ON utilisateur.id=amis.id_amis INNER JOIN note ON note.id_utilisateur=amis.id_amis 
INNER JOIN jeu ON note.id_jeu=jeu.id_jeu WHERE amis.id_utilisateur=?");
$req->execute([$_SESSION['id']]);
$i=0;
while ($data = $req->fetch()) {
    if ($i % 2 == 0) {
        echo '<tr style="background-color: #cccccc">';
            echo '<td>';echo $data["pseudo"]; echo '</td>';
            echo '<td>';echo $data["nom_jeu"];echo '</td>';
            echo '<td>'; echo $data["note"];echo '</td>';
            echo'</tr>';

}
    else{
        echo '<tr>';
            echo '<td>';echo $data["pseudo"]; echo '</td>';
            echo '<td>';echo $data["nom_jeu"];echo '</td>';
            echo '<td>'; echo $data["note"];echo '</td>';
            echo'</tr>';
    }
    $i++;
}
?>

<body/>
<html/>
