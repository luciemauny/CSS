<?php
$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

$req = $bdd->prepare("SELECT utilisateur_type_jeu.id_type_jeu FROM utilisateur_type_jeu INNER JOIN utilisateur 
ON utilisateur_type_jeu.id_utilisateur=utilisateur.id
WHERE utilisateur.pseudo =?");
$req->execute([$_SESSION['pseudo']]);
$data_type_jeu=$req->fetch();

$req = $bdd->prepare("SELECT jeu.nom_jeu, edition.nom_edition, jeu.prix, jeu.bio FROM jeu INNER JOIN edition 
ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu  
WHERE type_jeu.id_type_jeu=? ORDER BY jeu.nom_jeu, type_jeu.nom_type_jeu, edition.id_edition");
$req->execute([$data_type_jeu['id_type_jeu']]);
?>
<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="tableaux.css" media="all"/>
</head>
<style>
    input[type=submit]:hover {
        background-color: rgba(0, 182, 0, 1);
    }
    button:hover{
        background-color: rgba(0, 182, 0, 1);
    }
</style>
<body>
<div class="jeu" style="text-decoration: underline rgba(0, 182, 0, 1)">
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    Découvrir des jeux
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<table cellspacing="3">
    <tr>
        <th>Nom</th>
        <th>Edition</th>
        <th>Prix</th>
        <th>Descriptif</th>
        <th>Note moyenne</th>

    </tr>
    <form method="post" action="caracteristique_jeu.php" >

        <?php
        $i=0;
        while ($data=$req->fetch()){

            if ($i%2==0){
                echo '<tr style="background-color: #cccccc">';
                echo'<td><button name="bouton['.$data["nom_jeu"].']">'; echo $data["nom_jeu"]; echo'</button></td>';

                echo' <td>'; echo $data["nom_edition"]; echo'</td>';

                echo' <td>'; echo $data["prix"]; echo'</td>';

                echo' <td>'; echo $data["bio"]; echo'</td>';
                $requete = $bdd->prepare("SELECT ROUND(AVG(note.note),1) AS note_moyenne FROM note INNER JOIN jeu 
                    ON jeu.id_jeu=note.id_jeu INNER JOIN edition ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu
                    ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu WHERE jeu.nom_jeu=?AND edition.nom_edition=? AND type_jeu.id_type_jeu=?");
                $requete->execute([$data["nom_jeu"], $data["nom_edition"], $data_type_jeu['id_type_jeu']]);
                $data_note=$requete->fetch();
                if (empty($data_note["note_moyenne"])){
                    echo '<td>'; echo '/'; echo'</td>';
                }else{
                    echo' <td>'; echo $data_note['note_moyenne']; echo'</td>';
                }


            }


            else {

                echo '<tr>';
                echo'<td><button name="bouton['.$data["nom_jeu"].']">'; echo $data["nom_jeu"]; echo'</button></td>';

                echo' <td>'; echo $data["nom_edition"]; echo'</td>';

                echo' <td>'; echo $data["prix"]; echo'</td>';

                echo' <td>'; echo $data["bio"]; echo'</td>';

                $requete = $bdd->prepare("SELECT ROUND(AVG(note.note),1) AS note_moyenne FROM note INNER JOIN jeu 
                    ON jeu.id_jeu=note.id_jeu INNER JOIN edition ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu
                    ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu WHERE jeu.nom_jeu=?AND edition.nom_edition=? AND type_jeu.id_type_jeu=?");
                $requete->execute([$data["nom_jeu"], $data["nom_edition"], $data_type_jeu['id_type_jeu']]);
                $data_note=$requete->fetch();
                if (empty($data_note["note_moyenne"])){
                    echo '<td>'; echo '/'; echo'</td>';
                }else{
                    echo' <td>'; echo $data_note['note_moyenne']; echo'</td>';
                }
            }


            echo '</tr>';
            $i++;

        }

        ?>

    </form>
</table>
<form method="post" action="page_accueil.php">
</br></br><box>Cliquez ici pour revenir au menu ! </box></br></br>
<input type="submit" name="menu" value="MENU">
</form>

</body>
</html>
