<?php
session_start();
$mail=$_POST["mail"];
$pseudo=$_POST["pseudo"];
$mdp=$_POST["mdp"];
$_SESSION["pseudo"]=$pseudo;
$t=0;

if(empty($mail)){
    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo FROM utilisateur WHERE utilisateur.pseudo=? AND utilisateur.password=?");
    $req->execute([$pseudo, $mdp]);
    $data=$req->fetch();


        if(!$data){
            ?>
            <html lang="fr">
            <head>
                <title>Critique_jeux_plateau</title>
            </head>
            <style>
                div.texte{
                    text-align: center;
                    font-size : 20px
                }
                body {
                    background-image: url('https://images.pexels.com/photos/1323712/pexels-photo-1323712.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260');
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

                }
                div.animation1 {
                    width: 20px;
                    height: 3px;
                    background-color: red;
                    position: relative;
                    animation-name: animation1;
                    animation-duration: 10s;
                    animation-iteration-count: 3;
                    margin-right: 50%;
                    margin-left: 36%;
                    padding: 0;
                    float :top;
                }

                @keyframes animation1{
                    0%   {background-color:red; left:0px; top:0px;}
                    25%  {background-color:yellow; left:168px; top:0px;}
                    50%  {background-color:blue; left:336px; top:0px;}
                    75%  {background-color:green; left:168px; top:0px;}
                    100% {background-color:red; left:0px; top:0px;}
                }

                input[type=submit] {
                    width: 100px;
                    height: 30px;
                    background-color:black;
                    color: white;
                    margin-left: 45%;
                    margin-top: 5%;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    color: white;
                    font-weight: bold;
                    text-align: center;
                }

                input[type=submit]:hover {
                    background: rgb(0, 201, 0);
                }
                div.animation2 {
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    position: relative;
                    animation-name: animation2;
                    animation-duration: 10s;
                    animation-iteration-count: 3;
                    margin-right: 50%;
                    margin-left: 36%;
                    padding: 0;
                    float :top;
                }

                @keyframes animation2{
                    0%   {background-color:red; left:0px; top:0px;}
                    25%  {background-color:yellow; left:350px; top:0px;}
                    50%  {background-color:blue; left:350px; top:320px;}
                    75%  {background-color:green; left:0px; top:320px;}
                    100% {background-color:red; left:0px; top:0px;}
                }
                div.animation3 {
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    position: relative;
                    animation-name: animation3;
                    animation-duration: 10s;
                    animation-iteration-count: 3;
                    margin-right: 50%;
                    margin-left: 31%;
                    margin-top: 0;
                    padding: 0;
                    float :top;
                }

                @keyframes animation3{
                    0%   {background-color:red; left:150px; top:70px;}
                    25%  {background-color:yellow; left:300px; top:70px;}
                    50%  {background-color:blue; left:300px; top:140px;}
                    75%  {background-color:green; left:150px; top:140px;}
                    100% {background-color:red; left:150px; top:70px;}
                }
                div.animation4 {
                    width: 10px;
                    height: 10px;
                    background-color: red;
                    position: relative;
                    animation-name: animation4;
                    animation-duration: 10s;
                    animation-iteration-count: 3;
                    margin-right: 50%;
                    margin-left: 33%;
                    margin-top: 3%;
                    padding: 0;
                    float :top;
                }

                @keyframes animation4{
                    0%   {background-color:red; left:75px; top:10px;}
                    25%  {background-color:yellow; left:325px; top:10px;}
                    50%  {background-color:blue; left:325px; top:205px;}
                    75%  {background-color:green; left:75px; top:205px;}
                    100% {background-color:red; left:75px; top:10px;}
                }


            </style>

            <body>
            <form method="post" action="page_accueil.php";>
                <div class="jeu">

                    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                    OOPS !
                    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                </div>
                <div class="animation1">

                </div>
                </br>
                <div class="texte">
                    Le mot de passe ou le pseudo n'existe pas ! Cliquez ici pour réessayer:
                </div>

                </br> </br>
                <div class="animation2"></div>
                <div class="animation4"></div>
                <div class="animation3"></div>

                <div class="box">
                    <label>
                        <p><input type="submit" name="connecter" value="Réessayer"></p>
                    </label>
                </div>

            </form>
            </body>
            </html>

            <?php
            exit();
        }else{
            $_SESSION["id"]=$data['id'];
            include('form_menu.php');
        }
}

else if(empty($pseudo)){
    $bdd = new PDO("mysql:host=localhost;dbname=critique_jeux_plateau;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT utilisateur.id, utilisateur.pseudo FROM utilisateur WHERE utilisateur.mail=? AND utilisateur.password=?");
    $req->execute([$mail, $mdp]);
    $data=$req->fetch();


    if(!$data){
        ?>
        <html lang="fr">
        <head>
            <title>Critique_jeux_plateau</title>
        </head>
        <style>
            div.texte{
                text-align: center;
                font-size : 20px
            }
            body {
                background-image: url('https://images.pexels.com/photos/1323712/pexels-photo-1323712.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260');
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

            }
            div.animation1 {
                width: 20px;
                height: 3px;
                background-color: red;
                position: relative;
                animation-name: animation1;
                animation-duration: 10s;
                animation-iteration-count: 3;
                margin-right: 50%;
                margin-left: 36%;
                padding: 0;
                float :top;
            }

            @keyframes animation1{
                0%   {background-color:red; left:0px; top:0px;}
                25%  {background-color:yellow; left:168px; top:0px;}
                50%  {background-color:blue; left:336px; top:0px;}
                75%  {background-color:green; left:168px; top:0px;}
                100% {background-color:red; left:0px; top:0px;}
            }

            input[type=submit] {
                width: 100px;
                height: 30px;
                background-color:black;
                color: white;
                margin-left: 45%;
                margin-top: 5%;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                color: white;
                font-weight: bold;
                text-align: center;
            }

            input[type=submit]:hover {
                background: rgb(0, 201, 0);
            }
            div.animation2 {
                width: 10px;
                height: 10px;
                background-color: red;
                position: relative;
                animation-name: animation2;
                animation-duration: 10s;
                animation-iteration-count: 3;
                margin-right: 50%;
                margin-left: 36%;
                padding: 0;
                float :top;
            }

            @keyframes animation2{
                0%   {background-color:red; left:0px; top:0px;}
                25%  {background-color:yellow; left:350px; top:0px;}
                50%  {background-color:blue; left:350px; top:320px;}
                75%  {background-color:green; left:0px; top:320px;}
                100% {background-color:red; left:0px; top:0px;}
            }
            div.animation3 {
                width: 10px;
                height: 10px;
                background-color: red;
                position: relative;
                animation-name: animation3;
                animation-duration: 10s;
                animation-iteration-count: 3;
                margin-right: 50%;
                margin-left: 31%;
                margin-top: 0;
                padding: 0;
                float :top;
            }

            @keyframes animation3{
                0%   {background-color:red; left:150px; top:70px;}
                25%  {background-color:yellow; left:300px; top:70px;}
                50%  {background-color:blue; left:300px; top:140px;}
                75%  {background-color:green; left:150px; top:140px;}
                100% {background-color:red; left:150px; top:70px;}
            }
            div.animation4 {
                width: 10px;
                height: 10px;
                background-color: red;
                position: relative;
                animation-name: animation4;
                animation-duration: 10s;
                animation-iteration-count: 3;
                margin-right: 50%;
                margin-left: 33%;
                margin-top: 3%;
                padding: 0;
                float :top;
            }

            @keyframes animation4{
                0%   {background-color:red; left:75px; top:10px;}
                25%  {background-color:yellow; left:325px; top:10px;}
                50%  {background-color:blue; left:325px; top:205px;}
                75%  {background-color:green; left:75px; top:205px;}
                100% {background-color:red; left:75px; top:10px;}
            }


        </style>

        <body>
        <form method="post" action="page_accueil.php";>
            <div class="jeu">

                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
                OOPS !
                <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
            </div>
            <div class="animation1">

            </div>
            </br>
            <div class="texte">
                Le mot de passe ou le mail n'existe pas ! Cliquez ici pour réessayer:
            </div>

            </br> </br>
            <div class="animation2"></div>
            <div class="animation4"></div>
            <div class="animation3"></div>

            <div class="box">
                <label>
                    <p><input type="submit" name="connecter" value="Réessayer"></p>
                </label>
            </div>

        </form>
        </body>
        </html>
        <?php
        exit();
    }else{
        $_SESSION["id"]=$data['id'];

        include('form_menu.php');

    }

}


?>
