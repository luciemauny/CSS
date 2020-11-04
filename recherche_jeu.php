<?php
$nom=$_POST["nom"];
$edition=$_POST["edition"];
$type_jeu=$_POST["type_jeu"];

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");


    $req = $bdd->prepare("SELECT jeu.nom_jeu, edition.nom_edition, type_jeu.nom_type_jeu, jeu.prix FROM jeu INNER JOIN edition 
ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu  
WHERE jeu.nom_jeu LIKE CONCAT('%', ?, '%') OR edition.nom_edition LIKE CONCAT('%', ?, '%') OR type_jeu.id_type_jeu=? 
ORDER BY jeu.nom_jeu");
    $req->execute([$nom,$edition , $type_jeu]);



?>



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
        background-color:rgba(131, 0, 132,10) ;
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
    Rechercher un jeu
    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<table cellspacing="0">
    <tr>
        <th>Nom</th>
        <th>Edition</th>
        <th>Type de jeu</th>
        <th>Prix</th>
        <th>Note moyenne</th>
    </tr>
    <form method="post" action="caracteristique_jeu.php" >

        <?php
        $i=0;
        while ($data=$req->fetch()){

            if ($i%2==0){
                echo '<tr style="background-color: #cccccc">';
                echo'<td><button name="bouton['.$data["nom_jeu"].']">'; echo $data["nom_jeu"]; echo'</button></td>';

                echo' <td >'; echo $data["nom_edition"]; echo'</td>';

                echo' <td >'; echo $data["nom_type_jeu"];echo '</td>';

                echo' <td >'; echo $data["prix"]; echo'</td>';
                $requete = $bdd->prepare("SELECT ROUND(AVG(note.note),1) AS note_moyenne FROM note INNER JOIN jeu 
                    ON jeu.id_jeu=note.id_jeu INNER JOIN edition ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu
                    ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu WHERE jeu.nom_jeu=?AND edition.nom_edition=? AND type_jeu.nom_type_jeu=?");
                $requete->execute([$data["nom_jeu"], $data["nom_edition"], $data["nom_type_jeu"]]);
                $data_note=$requete->fetch();
                if (empty($data_note["note_moyenne"])){
                    echo '<td>'; echo '/'; echo'</td>';
                }else{
                    echo' <td>'; echo $data_note['note_moyenne']; echo'</td>';
                }



            }


            else {

                echo '<tr>';
                echo'<td><button  name="bouton['.$data["nom_jeu"].']">'; echo $data["nom_jeu"]; echo'</button></td>';

                echo' <td>'; echo $data["nom_edition"]; echo'</td>';

                echo' <td>'; echo $data["nom_type_jeu"];echo '</td>';

                echo' <td>'; echo $data["prix"]; echo'</td>';
                $requete = $bdd->prepare("SELECT ROUND(AVG(note.note),1) AS note_moyenne FROM note INNER JOIN jeu 
                    ON jeu.id_jeu=note.id_jeu INNER JOIN edition ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu
                    ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu WHERE jeu.nom_jeu=?AND edition.nom_edition=? AND type_jeu.nom_type_jeu=?");
                $requete->execute([$data["nom_jeu"], $data["nom_edition"], $data["nom_type_jeu"]]);
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
        /*die();*/
        ?>

    </form>
</table>
    <form method="post" action="page_accueil.php"
</br></br><box>Cliquez ici pour revenir au menu ! </box></br></br>
        <input type="submit" name="menu" value="MENU">
    </form>

</body>
</html>
