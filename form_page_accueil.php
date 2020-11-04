<?php
session_start();
session_destroy();
?>

<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
</head>

<style>
    input[type=submit]{
        background-color: black;
        border: none;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }
    body {
        background-image: url('https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/best-board-games-2018-1538589179.jpg?crop=1.00xw:1.00xh;0,0&resize=1200:*');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        border: 2px solid black;
    }

    div.transbox {
        margin: 5px;
        background-color: #ffffff;
        border: 1px solid black;
        opacity: 0.6;

    }

    div.transbox p {
        margin: 5%;
        font-weight: bold;
        color: #000000;
        text-align: center;
    }
    div.titre{
        font-size: 100px;
    }

</style>

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
