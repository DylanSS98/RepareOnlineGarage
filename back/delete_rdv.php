<?php
require 'db.php';

$id = $_REQUEST["lign_delete"];

$id = intval($id);

$req = $pdo->prepare("DELETE FROM rdv WHERE id = '$id'");

$req->execute();

header('Location: ../admin/dash/espace_rdv.php');