<?php

session_start();
if (isset($_SESSION['auth'])) {

require 'db.php';

$sql = $pdo->prepare('SELECT * FROM villes');
$sql->execute();
$villes = $sql->fetchall();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/back.css">
    <title>Liste centre</title>
</head>
<body>

<header>
    <h1>Liste des centres</h1>
</header>

<div class="card" id="table_centre">
<table style="width: 100%" class="table">
    <thead>
    <th class="col">Ville</th>
    <th class="col">Adresse</th>
    <th class="col">Horaire</th>
    <th class="col">N° de téléphone</th>
    <th class="col">lat</th>
    <th class="col">lon</th>
    <th class="col">action</th>
    </thead>

    <tbody>
    <?php foreach ($villes as $ville): ?>
        <tr>
            <td><?= $ville['Villes'] ?></td>
            <td><?= $ville['adresse'] ?></td>
            <td><?= $ville['horaire'] ?></td>
            <td><?= $ville['tel'] ?></td>
            <td><?= $ville['lat'] ?></td>
            <td><?= $ville['lon'] ?></td>
            <td><a class="btn btn-warning" href="edit_ville.php?lign_edit=<?= intval($ville['id']) ?>">Edit</a> <a class="btn btn-danger" href="delete_center.php?lign_delete=<?= intval($ville['id']) ?>">Supprimer</a></td>
        </tr>
    <?php endforeach ; ?>

    </tbody>
</table>
</div>
<div class="btn_hea">
<a style="margin-left: 20px" href="insert_city.php" class="btn btn-primary">Ajouter un centre</a>
<a href="../admin" class="btn btn-secondary">Retour à l'acceuil</a>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="../js/app.js"></script>

</body>
</html>
<?php
}
else {
    header('Location: ../../back/login.php');
}
?>







