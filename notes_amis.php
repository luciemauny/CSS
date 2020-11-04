<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
</head>
<style>

    body {
        background-image: url("https://images.pexels.com/photos/1323712/pexels-photo-1323712.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        border: 2px solid black;
    }



    div.jeu{
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        margin-top: 30px;
        margin-bottom: 30px;
        text-decoration: underline rgba(131, 0, 132,10);

    }
    input[type=submit] {
        width: 100px;
        background-color: black;
        color: white;
        padding: 14px 20px;
        margin-left: 45%;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        font-weight: bold;
    }
    box{
        margin: 40%;
    }

    input[type=submit]:hover {
        background-color: rgba(131, 0, 132,10);
    }
    table{
        width:70%;
        margin-left: 15%;
    }
    button{
        margin-left: 4%;
        cursor: pointer;
        width: 80px;

    }
    button:hover{
        background-color: black;
        color: white;
    }
    td{
        text-align: center;
    }
    tr{
        height: 50px;
    }

</style>
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
