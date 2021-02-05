<?php


session_start();
if (isset($_SESSION['auth'])) {


error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../../back/db.php';

if (isset($_POST['form_submit'])) {
    $nom_ville = $_POST['ville_name'];
    $adress_ville = $_POST['ville_adress'];
    $tel = $_POST['tel'];
    $lat = $_POST['ville_lat'];
    $lon = $_POST['ville_lon'];
    $horaire = $_POST['ville_horaire'];

    $insert = $pdo->prepare("INSERT INTO villes (Villes, adresse, horaire, tel, lat, lon) VALUES (?,?,?,?,?,?)");
    $insert->execute([$nom_ville, $adress_ville,$horaire, $tel, $lat, $lon]);

}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div>
    <h3 style="margin-top: 100px">Ajouter une ville</h3>
    <form action="" method="post" class="form-group">

        <input type="text" name="ville_name" placeholder="Ville" class="form-control w-50 mt-2">

        <input type="text" name="ville_adress" placeholder="Adresse" class="form-control w-50 mt-2"">

        <input type="text" name="ville_horaire" placeholder="horaire" class="form-control w-50 mt-2">

        <input type="text" name="tel" placeholder="N° de téléphone" class="form-control w-50 mt-2">

        <input type="text" name="ville_lat" placeholder="lat" class="form-control w-50 mt-2"">

        <input type="text" name="ville_lon" placeholder="lon" class="form-control w-50 mt-2"">

        <button type="submit" name="form_submit" class="btn btn-primary mt-2">Enregistrer</button>

        <a href="list_centre.php" class="btn btn-secondary" style="margin-top: 10px">Liste des villes</a>

        <?php if (isset($insert)){
            echo '<div class="alert alert-success" role="alert">
            
  Enregistrer avec succés !
</div>';
            header('Location: list_centre.php');
        }
        ?>
    </form>
</div>
</body>
</html>


<?php
}
else{
    header('Location: ../../back/login.php');
}