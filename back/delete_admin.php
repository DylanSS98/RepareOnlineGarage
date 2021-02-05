<?php

session_start();


if (isset($_SESSION['auth'])) {


    require 'db.php';

    $id = $_REQUEST["admin_delete"];

    $id = intval($id);

    $req = $pdo->prepare("DELETE FROM user_admin WHERE id = '$id'");

    $req->execute();

    header('Location: list_admin.php');

}
else{
    header('Location: login.php');
}
