<html lang="fr">
<head>
    <title>Critique_jeux_plateau</title>
</head>
<style>
    div.animation1 {
        width: 10px;
        height: 10px;
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
        25%  {background-color:yellow; left:336px; top:0px;}
        50%  {background-color:blue; left:336px; top:700px;}
        75%  {background-color:green; left:0px; top:700px;}
        100% {background-color:red; left:0px; top:0px;}
    }

    body {
        background-image: url("https://images.pexels.com/photos/1323712/pexels-photo-1323712.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260");
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        border: 2px solid black;
    }
    input[type=text]{
        width: 25%;
        padding: 6px 10px;
        margin: auto;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 1px;
        box-sizing: border-box;
    }
    select{
        width: 60%;
        margin: auto;
        text-align: center;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 1px;
        box-sizing: border-box;
    }

    input[type=submit] {
        width: 70%;
        background-color:black;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: white;
        font-weight: bold;
    }

    input[type=submit]:hover {
        background-color:  rgba(0, 187, 254, 1);
    }
    select{
        height: 2.5%;
    }

    div.transbox {
        width: 300px;
        height: 700px;
        background-color: hsla(15, 16%, 97%, 0.8);
        margin: auto;

    }

    div.transbox p {
        width: 300px;
        height: 1000px;
        font-weight: bold;
        color: black;
        text-align: center;
    }
    div.jeu{
             text-align: center;
             font-size: 40px;
             font-weight: bold;
             margin-top: 30px;
             margin-bottom: 30px;
            text-decoration: underline rgba(0, 187, 254, 1);
         }

</style>
<body>
<div class="jeu">

    <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
    Ajout jeu
   <sub><img src="https://img.icons8.com/windows/96/000000/queen.png" width="40" height="40"/></sub>
</div>
<div class="animation1">
</div>

<div class="transbox">
<form method="post" action="ajout_jeu.php">
    <p></br></br>
        <img style="margin-top: 30px" src="https://img.icons8.com/android/24/000000/plus.png"/></br></br></br>
    <label>
        Nom : </br><input type="texte" name="nom"/>
    </label>
    </br></br>
    <label>
        Prix :</br> <input type="number" name="prix"/>
    </label>
    </br></br>
    <label>
        Edition :</br> <input type="texte" name="edition"/>
    </label>
    </br></br>
    <label for="type_jeu">Veuillez choisir le type de jeu auquel il appartient :</label></br>
    <select id="type_jeu" name="type_jeu">
        <option value="1">stratégie</option>
        <option value="2">hasard</option>
        <option value="3">mémoire</option>
        <option value="4">parcours</option>
    </select></br></br>
        <label>
            Descritptif :</br> <textarea name="bio" cols="20" rows="10"></textarea>
        </label></br></br>
    </br> <input type="submit" name="submit" value="Enregistrer">
    </p>
</form>
</div>

</body>
</html>