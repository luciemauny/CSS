<html lang="fr">
<head>
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="menu_utilisateur.css" media="all"/>
</head>
</br>
<h1> Bonjour <?php
    echo $_SESSION["pseudo"]; ?> !</h1></br>
<body>
<div class="texte">
    Que souhaitez vous faire ?
</div></br>
<form method="post" action="page_accueil.php">

    <table cellspacing="50px" style="margin: auto">

        <tr>
            <th>
                <div class="transbox" style="background-color: rgba(131, 0, 132,10)">
                    <label loupe >
                        </br>
                        <img src="https://img.icons8.com/android/96/000000/search.png"/>
                        </br></br>
                        <input type="submit" name="recherche_jeu" value="Rechercher des jeux">
                    </label>
                </div>
            </th>


            <th>
                <div class="transbox" style="background-color: rgba(0, 187, 254, 1)">
                    <label plus>
                        </br>
                        <img src="https://img.icons8.com/android/96/000000/plus.png"/>
                        </br></br>
                        <input type="submit" name="ajout_jeu" value="Ajouter des jeux">
                    </label>
                </div>
            </th>


            <th>
                <div class="transbox" style="background-color: rgba(0, 182, 0, 1)">
                    <label pion>
                        </br>
                        <img src="https://img.icons8.com/fluent-systems-filled/96/000000/rook.png"/>
                        </br></br>
                        <input type="submit" name="decourvrir_jeux" value="Décourvir des jeux de votre type préféré">
                    </label>
                </div>
            </th>
</form>
</tr>

<tr>
    <th>
        <div class="transbox" style="background-color: rgba(255, 249, 0, 1)">
            <label voir ses amis>
                <form method="post" action="affichage_amis.php">
                    </br>
                    <img src="https://img.icons8.com/material-sharp/96/000000/find-user-male.png"/>
                    </br></br>
                    <input type="submit" name="amis" value="Voir mes amis">
                </form>
            </label>
        </div>
    </th>

    <th>
        <div class="transbox" style="background-color: rgba(255, 175, 0, 1)">
            <label ajouter des amis>
                <form method="post" action="page_accueil.php">
                    </br>
                    <img src="https://img.icons8.com/material-rounded/96/000000/add-user-male.png"/>
                    </br></br>
                    <input type="submit" name="ajout_amis" value="Ajouter des amis">
                </form>
            </label>
        </div>
    </th>

    <th>
        <div class="transbox" style="background-color: rgba(255, 74, 0, 1)">
            <label voir les notes de ses amis>
                <form method="post" action="notes_amis.php">
                    </br>
                    <img src="https://img.icons8.com/fluent-systems-filled/96/000000/speaker-notes.png"/>
                    </br></br>
                    <input type="submit" name="notes" value="Voir les notes de mes amis">
                </form>
            </label>
        </div>
    </th>
</tr>
</table>

</body>
</html>
