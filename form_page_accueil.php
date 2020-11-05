<?php
session_start();
session_destroy();
?>

<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
    <link rel="stylesheet" type="text/css" href="page_accueil.css" media="all"/>
</head>
<h1>
    <form method="post" action="page_accueil.php">
        <table cellspacing="0" style="margin-left: 900px;width:10%;">
            <tr>
                <th>
                    <label plus >
                        <img src="https://img.icons8.com/windows/32/000000/add-user-male--v1.png"/>
                    </label>
                </th>
                <th>
                    <label tic>
                        <img src="https://img.icons8.com/windows/32/000000/login-rounded-down.png"/>
                    </label>
                </th>
                <th>
                    <label loupe>
                        <img src="https://img.icons8.com/windows/32/000000/search.png"/>
                    </label>
                </th>
            </tr>

            <tr>
                <th>
                    <input type="submit" name="inscription" value="S'inscrire" style="background-color: rgb(255, 0, 0)">
                </th>
                <th>
                    <input type="submit" name="connecter" value="Se connecter" style="background-color: rgb(0, 201, 0)">
                </th>
                <th>
                    <input type="submit" name="recherche_jeu" value="Rechercher jeux" style="background-color: rgba(131, 0, 132,10)">
                </th>
            </tr>
        </table>

    </form>
    <h1>
        <body>
        </br></br></br>

        <div class="transbox">
            <p><sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            Critique de jeux de plateau
                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            </p>
        </div>


        </body>
</html>
