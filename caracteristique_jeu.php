
<?php

session_start();

if(isset($_POST['bouton']) && is_array($_POST['bouton'])) {
    $liste_bouton = $_POST['bouton'];
    foreach($liste_bouton as $key => $data) {
        $key .' => '. $data .'<br/>'; //$key contient l nom du jeu sélectionné
    }
}

$_SESSION['nom_jeu']=$key;

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT jeu.nom_jeu, edition.nom_edition, type_jeu.nom_type_jeu, jeu.prix, jeu.id_jeu FROM jeu 
INNER JOIN edition ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu
WHERE jeu.nom_jeu=?");
$req -> execute([$_SESSION['nom_jeu']]);

$data = $req->fetch();
echo'


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



    input[type=submit] {
        width: auto;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        background-color: plum;
    }

    input[type=submit]:hover {
        background-color: #cccccc;
    }

    input[type=submit].avis {
        width: auto;
        color: white;
        height: auto;
        border: none;
        cursor: pointer;
        font-weight: bold;
        background-color: plum;
        font-size: 12px;

    }
       input[type=submit]:hover.avis {
        background-color: #cccccc;
    }
    div.transbox1 {
        width: 300px;
        height: 700px;
        background-color: hsla(15, 16%, 97%, 0.8);
        margin-left: 900px;
        margin-top: -1000px;
        text-align: center;
        font-weight: bold;
        display: inline-block;
        


    }
    
        div.transbox {
        width: 300px;
        height: 700px;
        background-color: hsla(15, 16%, 97%, 0.8);
        margin-left: 900px;
        margin-top: -200px;
        text-align: center;
        font-weight: bold;
        
        


    }
    th,td{
    height: 30px;
    }

    span{
        display: inline-block;
    }


    div.jeu{
        text-align: center;
        font-size: 40px;
        font-weight: bold;
        margin-top: 30px;
        margin-bottom: 30px;

    }
    div.texte{
        text-align: center;
        font-size : 20px;

    }


    table.table1{
        margin-left: 50px;
        text-align: center;
        width: 100%;   
   
   
    }

    div.critique {
        font-weight: bold;
        font-size=40px;
        margin-left: 50px;
        text-decoration: underline;
    }

</style>

<body>
<div class="jeu">

    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>';
echo $_SESSION['nom_jeu'];
echo'<sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<div class="texte">
    <span style="font-weight: bold">Edition : </span> ';echo $data["nom_edition"]; echo'&nbsp;&nbsp;&nbsp;
    <span style="font-weight: bold">Type jeu :</span>';echo $data["nom_type_jeu"]; echo' &nbsp;&nbsp;&nbsp;
    <span style="font-weight: bold">Prix : </span>';echo $data["prix"];echo'€

</div>
</br></br></br>


<div class="critique">CRITIQUES : </div></br></br></br>
</body>';

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT utilisateur.pseudo,critique.bio,critique.id_critique FROM utilisateur INNER JOIN critique
ON utilisateur.id=critique.id_utilisateur INNER JOIN jeu ON jeu.id_jeu=critique.id_jeu WHERE jeu.nom_jeu=?");
$req->execute([$_SESSION['nom_jeu']]);
$data2 = $req->fetch();

echo '<span>';
if(empty( $_SESSION['pseudo'])) {
    echo '<table class="table1" cellspacing="0">
    <tr style="font-weight: bold">
    <td>Pseudo</td>
        <td>Critique</td>
        <td>Interessant</td>
        <td>Pas intéressant</td>
        <td>Note</td>
        </tr>';
}else{
    echo'<table class="table1" cellspacing="0">
    <tr style="font-weight: bold">
        <td>Pseudo</td>
        <td>Critique</td>
        <td>Interessant</td>
        <td>Pas intéressant</td>
        <td>Note</td>
    <td>Votre avis</td>
    </tr>';}


$j=1;
while ($data2 = $req->fetch()){
    if ($j%2==0) {
        echo '
            <tr style="background-color: #cccccc">';
        echo '<td>';
        echo $data2["pseudo"];
        echo '</td>';
        echo '<td>';
        echo $data2["bio"];
        echo '</td>';

        $requete = $bdd->prepare("SELECT COUNT(note_critique) FROM note_critique WHERE id_critique=? AND note_critique=1");
        $requete->execute([$data2["id_critique"]]);
        $avis_critique = $requete->fetch();
        echo '<td>';
        echo $avis_critique["COUNT(note_critique)"];

        echo ' </td> ';

        $requete = $bdd->prepare("SELECT COUNT(note_critique) FROM note_critique WHERE id_critique=? AND note_critique=0");
        $requete->execute([$data2["id_critique"]]);
        $avis_critique = $requete->fetch();
        echo '<td> ';
        echo $avis_critique["COUNT(note_critique)"];
        echo '</td>';

        $requete = $bdd->prepare("SELECT note.note FROM note INNER JOIN utilisateur ON note.id_utilisateur=utilisateur.id
                INNER JOIN jeu ON note.id_jeu=jeu.id_jeu WHERE utilisateur.pseudo=? AND jeu.nom_jeu=?");
        $requete->execute([$data2["pseudo"], $_SESSION['nom_jeu']]);
        $note_utilisateur = $requete->fetch();

        if (empty($note_utilisateur["note"])) {$n=0;
            echo ' <td>  / </td>';
        } else {
            echo '<td>';
            $n=1;
            echo $note_utilisateur["note"];
            echo '</td>';
        }

        if (empty($_SESSION['pseudo'])) {
        } else {
        $requ = $bdd->prepare("SELECT id_note_critique FROM note_critique WHERE id_utilisateur=? AND id_critique=?");
        $requ->execute([$_SESSION['id'], $data2["id_critique"]]);
        $note = $requ->fetch();

            if (empty($note["id_note_critique"])) {


                ?>
                <td><form method="post" action="ajout_avis_critique.php">
                        <label>
                            <input type="radio" name="avis_critique" value="1">
                            intéressant
                        </label>
                        <label>
                            <input type="radio" name="avis_critique" value="0">
                            pas intéressant
                        </label>
                        <input type="hidden" name="id_critique" value="<?php echo $data2["id_critique"] ?> ">
                        <input type="submit" class="avis" name="avis" value="donner son avis">

                    </form></td> <?php
            } else {
                echo "<td>Vous avez déjà </br>noté cette critique</td>";
            }

        }
    }


    else{
        echo'<tr>';
        echo'<td>';echo $data2["pseudo"]; echo'</td>';
        echo'<td>'; echo $data2["bio"];echo'</td>';

        $requete = $bdd->prepare("SELECT COUNT(note_critique) FROM note_critique WHERE id_critique=? AND note_critique=1");
        $requete->execute([$data2["id_critique"]]);
        $avis_critique = $requete->fetch();
        echo'<td>'; echo $avis_critique["COUNT(note_critique)"];

 echo '</td>';

        $requete = $bdd->prepare("SELECT COUNT(note_critique) FROM note_critique WHERE id_critique=? AND note_critique=0");
        $requete->execute([$data2["id_critique"]]);
        $avis_critique = $requete->fetch();
        echo'<td>'; echo $avis_critique["COUNT(note_critique)"];


            echo'</td>';

        $requete = $bdd->prepare("SELECT note.note FROM note INNER JOIN utilisateur ON note.id_utilisateur=utilisateur.id
                INNER JOIN jeu ON note.id_jeu = jeu.id_jeu WHERE utilisateur.pseudo=? AND jeu.nom_jeu=?");
        $requete->execute([$data2["pseudo"],$_SESSION['nom_jeu']]);
        $note_utilisateur = $requete->fetch();

                if (empty($note_utilisateur["note"]))
        {$n=0;
            echo' <td> /</td>';
        } else
        {
            echo' <td> ';
            $n=1;
            echo $note_utilisateur["note"]; echo'</td>';
        }

        if (empty($_SESSION['pseudo'])) {
        } else {
            $requ = $bdd->prepare("SELECT id_note_critique FROM note_critique WHERE id_utilisateur=? AND id_critique=?");
            $requ->execute([$_SESSION['id'], $data2["id_critique"]]);
            $note = $requ->fetch();

         if (empty($note["id_note_critique"])) {


                ?>
                      <td><form method="post" action="ajout_avis_critique.php">
                <label>
                    <input type="radio" name="avis_critique" value="1">
                    intéressant
                </label>
                <label>
                    <input type="radio" name="avis_critique" value="0">
                    pas intéressant
                </label>
                <input type="hidden" name="id_critique" value="<?php echo $data2["id_critique"] ?> ">
                <input type="submit" class="avis" name="avis" value="donner son avis">

            </form></td> <?php


            }
            else {
                echo "<td>Vous avez déjà</br> noté cette critique</td>";
            }
        }
    }
        echo'</tr>';

    $j++;
}

echo'</table></span>';




if(empty( $_SESSION['pseudo'])){
    echo'

    <div class="transbox1" style="margin-top: -300px"></br></br>';
    echo' Pour ajouter des critiques ou une note vous devez vous identifier ou bien vous inscrire !</br></br>';

    echo'<form method="post" action="page_accueil.php">';
    echo' </br> </br><input style="background-color: rgb(0, 201, 0)" type="submit" name="connecter" value="Se connecter">';
    echo'</br>
            <label>';
    echo" </br></br><input style='background-color: rgb(255, 0, 0)' type='submit' name='inscription' value='Inscription'>";
    echo'</label>

        </form>
    </div>';
}
else {




    echo'
<span>
    <div class="transbox">
        <form method="post" action="ajout_critique.php"></br></br><label>
                Ajouter une critique :</br></br> <textarea name="bio" cols="30" rows="10"></textarea>
            </label>
            </br></br>
            <label>
                Ajouter une note : </br></br><input type="number" id="note" name="note" min="0" max="10">
            </label>
            </br></br>
            <input type="submit" name="ajouter" value="Ajouter">
        </form>

        Revenir au menu

        <form method="post" action="page_accueil.php">
            <input style="background-color: black" type="submit" name="menu" value="MENU">
        </form>
    </div></span>';

}
echo'

</html>';

