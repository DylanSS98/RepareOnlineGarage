<?php
session_start();


if (isset($_SESSION['auth'])){
require '../../back/db.php';

$sql1 = $pdo->prepare("SELECT count(*) FROM rdv WHERE status = 'En attente'");
$sql1->execute();
$nb_waiting = $sql1->fetch();

$sql2 = $pdo->prepare("SELECT count(*) FROM rdv WHERE status = 'En cours de traitement'");
$sql2->execute();
$nb_being_processed = $sql2->fetch();

$sql3 = $pdo->prepare("SELECT count(*) FROM rdv WHERE status = 'Traité'");
$sql3->execute();
$nb_process = $sql3->fetch();


?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/back.css">
    <title>ADMIN</title>
</head>
<body>
<header>
    <h1>DASHBORD rendez-vous</h1>
        <nav>
            <ul>
                <li><a href="../" class="btn btn-secondary">Retour à l'acceuil</a></li>
            </ul>
        </nav>

</header>



<div id="rdv_attente"  class="card">
    <h5>En attentes : <?php foreach ($nb_waiting as $nb): ?><?php endforeach; ?><?= $nb ?></h5> <?php foreach ($nb_waiting as $nb): ?><?php endforeach; ?>
    <?php require '../../back/rdv_waiting.php'; ?>
</div>


<div id="rdv_encours" class="card">
    <h5>En cours de traitements : <?php foreach ($nb_being_processed as $nb): ?><?php endforeach; ?><?= $nb ?></h5> <?php foreach ($nb_waiting

                                                                                                  as $nb): ?> <?php endforeach; ?></h4>
    <?php require '../../back/rdv_being_processed.php'; ?>
</div>

<div id="rdv_traite" class="card">
    <h5>Traités : <?php foreach ($nb_process as $nb): ?><?php endforeach; ?><?= $nb ?></h5> <?php foreach ($nb_waiting

                                                                                                          as $nb): ?> <?php endforeach; ?></h4>
    <?php require '../../back/rdv-process.php'; ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<script src="../../js/app.js"></script>
</body>
</html>
<?php

}
else {
    header('Location: ../../back/login.php');
}
?>

