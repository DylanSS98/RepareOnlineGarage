<?php
//index pour admin
session_start();
if (isset($_SESSION['auth'])) {

    ?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../css/back.css">
        <title>admin</title>

    </head>
    <body>
    <header>
        <h2 class="title_back">BIENVENUE <?= $_SESSION['auth'] ?></h2>
    </header>
    <div class="index_back">


        <table>
            <tbody>

            <tr>
                <td><a style="margin-bottom: 50px" class="btn btn-info" href="dash/espace_rdv.php">Accéder aux
                        rendez-vous</a></td>
            </tr>

            <tr>
                <td><a style="margin-bottom: 50px" class="btn btn-info" href="../back/list_centre.php">Liste des centres</a></td>
            </tr>

            <tr>
                <td><a style="margin-bottom: 50px" class="btn btn-info" href="../back/list_admin.php">Liste des administrateurs</a></td>
            </tr>

            <tr>
                <td><a  style="margin-bottom: 50px" class="btn btn-secondary" href="../">Retourner sur le site</a></td>
            </tr>
            <tr>
                <td><a href="../back/disconnect.php" class="btn btn-danger">Se déconnecter</a></td>
            </tr>

            </tbody>
        </table>
    </div>


    </body>
    </html>

    <?php
} else {
    header('Location: ../back/login.php');
}
?>
