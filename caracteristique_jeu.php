<?php

session_start();

if(isset($_POST['bouton']) && is_array($_POST['bouton'])) {
    $liste_bouton = $_POST['bouton'];
    foreach($liste_bouton as $key => $data) {
        $key .' => '. $data .'<br/>'; //$key contient le nom du jeu sélectionné
    }
}

$_SESSION['nom_jeu']=$key;

$bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");

//récupérartion des caractéristiques du jeu sélectionné
$req = $bdd->prepare("SELECT jeu.nom_jeu, edition.nom_edition, type_jeu.nom_type_jeu, jeu.prix, jeu.id_jeu FROM jeu 
INNER JOIN edition ON jeu.id_edition=edition.id_edition INNER JOIN type_jeu ON type_jeu.id_type_jeu=jeu.id_jeu_type_jeu
WHERE jeu.nom_jeu=?");
$req -> execute([$_SESSION['nom_jeu']]);

$data = $req->fetch();

//affichage des caractéristiques du jeu
echo'
<html lang="fr">
<head>
    <title>Caractéristiques jeu</title>
    <link rel="stylesheet" type="text/css" href="tableaux.css" media="all"/>
</head>
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

//récupération des critiques du jeu sélectionné
$req = $bdd->prepare("SELECT utilisateur.pseudo,critique.bio,critique.id_critique FROM utilisateur INNER JOIN critique
ON utilisateur.id=critique.id_utilisateur INNER JOIN jeu ON jeu.id_jeu=critique.id_jeu WHERE jeu.nom_jeu=?");
$req->execute([$_SESSION['nom_jeu']]);

//affichage des critiques
?>
<span>

    <table class="table1" cellspacing="0">
    <tr style="font-weight: bold">
    <td>Pseudo</td>
        <td>Critique</td>
        <td>Interessant</td>
        <td>Pas intéressant</td>
        <td>Note</td>
        <?php if(!empty( $_SESSION['pseudo'])){ ?>
            <td>Votre avis</td>
        <?php } ?>
        </tr>

<?php

$j=0; //variable permettant d'afficher les lignes du tableau de couleurs différentes

while ($data2 = $req->fetch()){
    if ($j%2==0) {

        //affichage sur bande grise si j pair
        echo'<tr style="background-color: #cccccc">';
    }else{
        //affichage sur image de fond si j impair
        echo'<tr>';}
    echo'<td>';
    echo $data2["pseudo"];
    echo '</td>';
    echo '<td>';
    echo $data2["bio"];
    echo '</td>';

    //compte le nombre d'avis intéressants
    $requete = $bdd->prepare("SELECT COUNT(note_critique) FROM note_critique WHERE id_critique=? AND note_critique=1");
    $requete->execute([$data2["id_critique"]]);
    $avis_critique = $requete->fetch();
    echo '<td>';
    //affiche le nombre d'avis intéressants
    echo $avis_critique["COUNT(note_critique)"];

    echo ' </td> ';

    //compte le nombre d'avis pas intéressants
    $requete = $bdd->prepare("SELECT COUNT(note_critique) FROM note_critique WHERE id_critique=? AND note_critique=0");
    $requete->execute([$data2["id_critique"]]);
    $avis_critique = $requete->fetch();
    echo '<td> ';
    //affiche le nombre d'avis pas intéressants
    echo $avis_critique["COUNT(note_critique)"];
    echo '</td>';

    //récupère note mise par l'utilisateur qui a émis la critique
    $requete = $bdd->prepare("SELECT note.note FROM note INNER JOIN utilisateur ON note.id_utilisateur=utilisateur.id
                INNER JOIN jeu ON note.id_jeu=jeu.id_jeu WHERE utilisateur.pseudo=? AND jeu.nom_jeu=?");
    $requete->execute([$data2["pseudo"], $_SESSION['nom_jeu']]);
    $note_utilisateur = $requete->fetch();

    if (empty($note_utilisateur["note"])) {
        echo ' <td>  / </td>';
    } else {
        echo '<td>';
        echo $note_utilisateur["note"];
        echo '</td>';
    }

    if (!empty($_SESSION['pseudo'])) {

        //teste si utilisateur a déjà donné son avis sur la critique
        $requ = $bdd->prepare("SELECT id_note_critique FROM note_critique WHERE id_utilisateur=? AND id_critique=?");
        $requ->execute([$_SESSION['id'], $data2["id_critique"]]);
        $note = $requ->fetch();

        if (empty($note["id_note_critique"])) {


            ?>
            <td><form method="post" action="ajout_avis_critique.php">
                        <label>
                            <input type="radio" name="avis_critique" value="1">
                            intéressant
                            <br/>
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
    echo'</tr>';
    $j++;
}
?> </table></span> <?php


//affichage box se connecter/s'inscrire si utilisateur non connecté

if(empty( $_SESSION['pseudo'])){
    ?>
    <div class="transbox" style="margin-top: -300px">
    <form method="post" action="page_accueil.php">
    </br></br>Pour ajouter des critiques ou une note vous devez vous identifier ou bien vous inscrire !</br></br>
        </br></br>
        <input style="background-color: rgb(0, 201, 0)" class="critique" type="submit" name="connecter" value="Se connecter">
        </br></br></br>
        <input style="background-color: rgb(255, 0, 0)" class="critique" type="submit" name="inscription" value="Inscription">
    </form>
    </div>
    <?php

}else {

//affichage box note+critique si utilisateur connecté
    ?>

    <span>
    <div class="transbox">
        <form method="post" action="ajout_critique.php"></br></br>
                <?php

                //teste si utilisateur a déjà émis une critique sur le jeu
                $req = $bdd->prepare("SELECT critique.id_utilisateur FROM critique INNER JOIN jeu ON 
                critique.id_jeu=jeu.id_jeu WHERE critique.id_utilisateur=? AND jeu.nom_jeu=?");
                $req->execute([$_SESSION['id'], $_SESSION['nom_jeu']]);
                $c=$req->fetch();

                //teste si utilisateur a déjà mis une note au jeu
                $req = $bdd->prepare("SELECT note.id_utilisateur FROM note INNER JOIN jeu ON 
                note.id_jeu=jeu.id_jeu WHERE note.id_utilisateur=? AND jeu.nom_jeu=?");
                $req->execute([$_SESSION['id'], $_SESSION['nom_jeu']]);
                $n=$req->fetch();

                if(empty($c)){
                    ?>
                    <label>
                Ajouter une critique :</br></br> <textarea name="bio" cols="30" rows="10"></textarea>
            </label>
                <?php }else{ echo 'Vous avez déjà ajouté une critique pour ce jeu<br/>';} ?>
            </br></br>

            <?php if(empty($n)){ ?>
                <label>
                Ajouter une note : </br></br><input type="number" id="note" name="note" min="0" max="10">
                    </br></br>
            </label>
            <?php }else{ echo'Vous avez déjà noté ce jeu</br></br></br>';}
            if((!empty($c)) && (!empty($n))){}else{
                ?>
                <input class="critique" type="submit" name="ajouter" value="Ajouter">
            <?php }?>
        </form>
        Revenir au menu
        <form method="post" action="page_accueil.php">
            <input style="background-color: black" class="critique" type="submit" name="menu" value="MENU">
        </form>
    </div></span>';
    <?php
}
?>
</html>
