<?php


$sql = $pdo->prepare("SELECT id, centre, email, nom, adresse, telephone, message, status, DATE_FORMAT(date, '%d/%m/%Y') AS datefr FROM rdv WHERE status = 'En attente'");
$sql->execute();
$rdvlist = $sql->fetchAll();


?>


<table class="table w-60">
    <thead>
    <th class="col">Centre</th>
    <th class="col">Email</th>
    <th class="col">Nom</th>
    <th class="col">adresse</th>
    <th class="col">N° de téléphone</th>
    <th class="col">Message</th>
    <th class="col">Status</th>
    <th class="col">date</th>
    <th class="col">Action</th>
    </thead>

    <tbody>


    <?php foreach ($rdvlist as $rdv): ?>


        <tr>
            <td><?= $rdv['centre'] ?></td>
            <td><a href="mailto: <?= $rdv['email'] ?>"><?= $rdv['email'] ?></a></td>
            <td><?= $rdv['nom'] ?></td>
            <td><?= $rdv['adresse'] ?></td>
            <td><?= $rdv['telephone'] ?></td>
            <td class="message"> <?= $rdv['message'] ?></td>
            <td><?= $rdv['status'] ?></td>
            <td><?= $rdv['datefr'] ?></td>
            <td>

                <a href="../../back/update_status_encours.php?id_rdv=<?= intval($rdv['id']) ?>">
                    <img src="https://img.icons8.com/flat_round/30/000000/expand-arrow--v1.png"/>
                </a>

                <a href="../../back/delete_rdv.php?lign_delete=<?= intval($rdv['id']) ?>">
                    <img src="https://img.icons8.com/color/30/000000/delete-forever.png"/>
                </a>

            </td>
        </tr>
    <?php endforeach; ?>


    </tbody>
</table>

