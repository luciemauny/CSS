<html lang="fr">
<head>
    <title>Notes amis</title>
    <link rel="stylesheet" type="text/css" href="tableaux.css" media="all"/>
</head>
<style>
    input[type=submit]:hover {
        background-color: rgba(255, 74, 0, 1);
    }
</style>
<body>
<div class="jeu" style="text-decoration: underline rgba(255, 74, 0, 1)">
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

    //Cette requête sélectionne toutes les notes attribuées par les amis de l'utilisateur. Les données sont affichées dans un tableau
    
    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT utilisateur.pseudo,note.note,jeu.nom_jeu FROM utilisateur 
INNER JOIN amis ON utilisateur.id=amis.id_amis INNER JOIN note ON note.id_utilisateur=amis.id_amis 
INNER JOIN jeu ON note.id_jeu=jeu.id_jeu WHERE amis.id_utilisateur=?");
    $req->execute([$_SESSION['id']]);
    $i=0;//Augmente de un a chaque nouvel entré dans la boucle while. Sa parité détermine le fond de la ligne du tableau.
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
</table>
    <form method="post" action="page_accueil.php">

        </br></br></br>
        <input type="submit" name="menu" value="MENU">

    </form>

    <body/>
    <html/>
