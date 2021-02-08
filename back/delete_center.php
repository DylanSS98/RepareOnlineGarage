<?php
session_start();


if (isset($_SESSION['auth'])) {


    require 'db.php';

    $id = $_REQUEST["lign_delete"];

    $id = intval($id);

    $req = $pdo->prepare("DELETE FROM villes WHERE id = '$id'");

    $req->execute();

    header('Location: list_centre.php');

}
else{
    header('Location: login.php');
}

