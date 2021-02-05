<?php


require 'db.php';

$id = $_GET["idville"];

$id = intval($id);


$ville_nom = $_POST['ville_name'];
$ville_adresse = $_POST['ville_adresse'];
$ville_horaire = $_POST['horaire'];
$ville_tel = $_POST['tel'];
$ville_lat = $_POST['ville_lat'];
$ville_lon =$_POST['ville_lon'];



$sql = $pdo->prepare("UPDATE villes SET Villes = '$ville_nom', adresse = '$ville_adresse', horaire = '$ville_horaire', tel = '$ville_tel', lat = '$ville_lat', lon = '$ville_lon' WHERE id = '$id'");
$sql->execute();

if ($sql){

    header('Location: ../admin/dash/list_centre.php');
}
else {
    echo 'erreur';
}