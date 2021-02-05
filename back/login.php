<?php



//connexion bdd//
require 'db.php';



if(isset($_POST['form_connect'])){

    $logidf = $_POST['idf_connect'];
    $logmdp = $_POST['mdp_connect'];


    if (!empty($logidf) && !empty($logmdp)){

        $query = $pdo->prepare("SELECT * FROM user_admin WHERE identifiant = :identifiant");
        $query->bindParam(':identifiant', $logidf);
        $query->execute(['identifiant' => $logidf]);
        $result = $query->fetch();

        if ($result){

            $hash = $result['mdp'];

            if (password_verify($logmdp, $hash)){
                session_start();
                $_SESSION['auth'] = $logidf;
                header('Location: ../admin/');
            }
            else {
                $erreur = 'Le mot de passe est incorrect';
            }
        }
        else{
            $erreur = 'Le compte n\'existe pas';
        }
    }
    else {
        echo "Veuillez compléter l'ensemble des champs.";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/log.css">
</head>
<body>


<div class="form_register">
    <h2>Connexion</h2>
    <form method="post" action="">

        <input type="text" name="idf_connect" placeholder="identifiant" class="form-control" required>
        </br>
        <input type="password" name="mdp_connect" placeholder="Mot de passe" class="form-control" required>
        </br>
        <button class="btn btn-primary" type="submit" name="form_connect">Se connecter</button>

    </form>
    <br>
    <a href="../" class="btn btn-info">Retourner sur le site</a>
</div>

