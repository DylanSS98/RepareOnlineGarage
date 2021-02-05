<?php

session_start();


if (isset($_SESSION['auth'])) {

    require 'db.php';
    $id = $_GET["lign_edit"];

    $id = intval($id);

    $sql = $pdo->prepare("SELECT * FROM villes WHERE id = '$id'");
    $sql->execute();
    $villes = $sql->fetch();




    if (isset($_POST['submit_edit'])){

        $ville_nom = $_POST['ville_name'];
        $ville_adresse = $_POST['ville_adress'];
        $ville_horaire = $_POST['horaire'];
        $ville_tel = $_POST['tel'];
        $ville_lat = $_POST['ville_lat'];
        $ville_lon =$_POST['ville_lon'];
        $id_ville = $villes['id'];

        $req = $pdo->prepare("UPDATE villes SET Villes = '$ville_nom', adresse = '$ville_adresse', horaire = '$ville_horaire', tel = '$ville_tel', lat = '$ville_lat', lon = '$ville_lon' WHERE id = '$id_ville'");
        $req->execute();
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

    <title>Edition de ville</title>
</head>
<body>

<div>
    <h3 style="margin-top: 100px">Modifier</h3>
    <form action="" method="post" class="form-group">

        <input type="text" name="ville_name" placeholder="Ville" class="form-control w-50 mt-2" value="<?= $villes['Villes'] ?>">

        <input type="text" name="ville_adress" placeholder="Adresse" class="form-control w-50 mt-2" value="<?= $villes['adresse'] ?>">

        <input type="text" name="horaire" placeholder="horaire" class="form-control w-50 mt-2" value="<?= $villes['horaire'] ?>">

        <input type="text" name="tel" placeholder="N° de téléphone" class="form-control w-50 mt-2" value="<?= $villes['tel'] ?>">

        <input type="text" name="ville_lat" placeholder="lat" class="form-control w-50 mt-2" value="<?= $villes['lat'] ?>">

        <input type="text" name="ville_lon" placeholder="lon" class="form-control w-50 mt-2" value="<?= $villes['lon'] ?>">

        <button name="submit_edit" type="submit" class="btn btn-primary mt-2" >Modifier</button>

        <a href="list_centre.php" class="btn btn-secondary" style="margin-top: 10px">Liste des villes</a>

        <?php if (isset($req)){
            echo '<div class="alert alert-success" role="alert">
            
  Enregistrer avec succés ! Redirection dans 3 secondes...
</div>';
            header("Refresh: 3;url=../admin/dash/list_centre.php");
        }
        ?>
    </form>
</div>
</body>
</html>

<?php
}

else{
     header('Location: login.php');
}
?>
