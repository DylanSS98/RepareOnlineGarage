<?php

session_start();
if (isset($_SESSION['auth'])) {

require 'db.php';
//condition si on appuie sur le bouton//
if (isset($_POST['form_submit'])) {

    //déclaration des $_POST avec leurs sécurisation//
    $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
    $mdp_confirm = password_hash($_POST['mdp_confirm'], PASSWORD_BCRYPT);
    $identifiant = htmlspecialchars($_POST['identifiant']);

    //on limite le nombres de caractéres du pseudo//
    $identifiantlength = strlen($identifiant);
    if ($identifiantlength <= 255){

        //on verifie si le pseudo est disponible//
        $verifidentifiant = $pdo->prepare("SELECT * FROM user_admin WHERE identifiant = ?");
        $verifidentifiant->execute([$identifiant]);
        $resultidentifiant = $verifidentifiant->rowCount();
        if ($resultidentifiant ==0) {

            //on verifie que le mdp correspond au mdp confirm//
            if ($_POST["mdp"] == $_POST["mdp_confirm"]) {
                $sql = $pdo->prepare("INSERT INTO user_admin (identifiant, mdp) VALUES (?,?)");
                $sql->execute([$identifiant, $mdp]);
                $succes = 'Votre compte à bien été créer !';
                header("Refresh: 2; url='list_admin.php'");
            } else {
                $erreur = 'Les mots de passe ne corresponde pas !';
            }

        }

        else{
            $erreur = 'Ce pseudo est déja pris';
        }
    }

    else{
        $erreur = 'Votre pseudo ne doit pas dépasser 255 caractères !';
    }

}


?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log.css">
    <title>Inscription</title>
</head>
<body>

<div class="form_register">
    <h2>Inscription</h2>
    <form method="post" action="" >

        <input type="text" name="identifiant" placeholder="Identifiant" class="form-control">
        </br>
        <input type="password" name="mdp" placeholder="Mot de passe" class="form-control">
        </br>
        <input type="password" name="mdp_confirm" placeholder="Confirmer mot de passe" class="form-control">
        </br>
        <button type="submit" name="form_submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <?php
    if (isset($erreur)) {
        echo "<p style='color: red'>$erreur<p>";
    }
    if (isset($succes)){
        echo "<p style='color: green'>$succes</p>";
    }
    ?>
</div>

</body>
</html>



<?php
}
else {
    header('Location: login.php');
}
?>