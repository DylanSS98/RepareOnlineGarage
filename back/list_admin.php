<?php
session_start();
if (isset($_SESSION['auth'])) {

    require 'db.php';

    $sql = $pdo->prepare("SELECT * FROM user_admin");
    $sql->execute();
    $admins = $sql->fetchall();
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
        <title>Liste administrateur</title>
    </head>
    <body>

    <header>
        <h1>Liste des administrateurs</h1>
    </header>
    <br>
    <div id="table_admin" class="card">
    <table style="width: 100%" class="table">
        <thead>
        <th class="col">administrateur</th>
        <th class="col">Action</th>
        </thead>

        <tbody>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?= $admin['identifiant'] ?></td>
                <td>
                    <a class="btn btn-danger"
                       href="delete_admin.php?admin_delete=<?= intval($admin['id']) ?>">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <div class="btn_hea">
    <a class="btn btn-primary" href="register.php">Ajouter un administrateur</a>
    <a class="btn btn-secondary" href="../admin/">Retour à l'acceuil</a>
    </div>
    </body>
    </html>

    <?php
} else {
    header('Location: login.php');
}
?>