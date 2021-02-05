<?php require 'back/db.php';

$sql = $pdo->prepare('SELECT villes, adresse, tel, horaire, lat, lon FROM villes');
$sql->execute();
$villes = $sql->fetchAll();

$villes_json = json_encode($villes);


if (isset($_POST['form_submit'])) {

    $centre = strip_tags(htmlspecialchars($_POST['centre']));
    $nom = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $message = strip_tags(htmlspecialchars($_POST['message']));
    $tel = strip_tags(htmlspecialchars($_POST['tel']));
    $adresse = strip_tags(htmlspecialchars($_POST['adresse']));


    $req = $pdo->prepare("INSERT INTO rdv (centre, email, nom, adresse, telephone, message) VALUES (?,?,?,?,?,?)");
    $req->execute([$centre, $email, $nom, $adresse, $tel, $message]);

    if ($req) {
        $succes = 'Votre compte à bien été créer !';
    } else {
        $erreur = 'Les mots de passe ne corresponde pas !';
    }
//parametre de l'envoie de message

    $to = 'dylan.silva.sanches@outlook.fr';
    $email_subject = "RepareOnlineGarage, message de $nom";
    $email_body = "Vous avez reçus un mail depuis le formulaire de contact de votre site. \n\n" . "Voici les détails: \n\nCentre: $centre\n\nName: $nom\n\nEmail: $email\n\nAdresse: $adresse\n\nTelephone: $tel\n\nMessage:\n$message";
    $headers = "From: dylan.silva.sanches@outlook.fr\n";
    $headers .= "Reply-to: $email";
    mail($to, $email_subject, $email_body, $headers);

}

?>


<!doctype html>
<html lang="dfr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules/leaflet/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css">
    <link rel="stylesheet" href="css/style.scss">

    <title>RepareOnlineGarage</title>
</head>
<body>

<header>

    <nav>
        <ul class="nav justify-content-center bg-dark m-0 ">
            <li class="nav-item">
                <a class="nav-link active" href="#nous">A propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#service">Service</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#maCarte">Carte</a>
            </li>
        </ul>
    </nav>
    <img class="logo_geek" src="img/logo_anim.gif" alt="logo geek garage">
</header>
<div id="corps">

    <div id="nous" class="section">

        <img class="img_nous " width="100%" height="680px" src="img/ordi_nous.jpg" alt="">

        <h3 style="padding-top: 50px">A propos de nous</h3>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dignissimos fugiat iste, magni maiores nulla
            odit tempore veritatis? Aspernatur blanditiis fugiat quisquam reprehenderit! Ad, aperiam illum ipsam
            laboriosam quam repudiandae.</p>

    </div>


    <div id="service">
        <h2>Nos services</h2>
        <ul>

            <li>
                <div class="card" style="width: 18rem;">
                    <img src="img/diag.jfif" class="card-img-top" alt="">
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title">Diagnostic</h5>
                    </div>
                </div>
            </li>

            <li>
                <div class="card" style="width: 18rem;">
                    <img src="img/maintenance.jfif" class="card-img-top" alt="">
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title">Maintenance</h5>
                    </div>
                </div>
            </li>
        </ul>
        <ul>
            <li>
                <div class="card" style="width: 18rem;">
                    <img src="img/software.jpg" class="card-img-top" alt="">
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title">Installation Software</h5>
                    </div>
                </div>
            </li>
            <li>
                <div class="card" style="width: 18rem;">
                    <img src="img/install.jpg" class="card-img-top" alt="">
                    <hr>
                    <div class="card-body">
                        <h5 class="card-title">Remaster</h5>
                    </div>
                </div>
            </li>
        </ul>


    </div>

    <div id="localisation">
        <h2>Nous trouver</h2>

        <div id="maCarte">

        </div>


        <!-- Modal -->
        <div class="contain_modal">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="exampleModalLabel">Contact</h5>
                        </div>
                        <div style="margin-left: 10px" class="modal-body">
                            <form class="w-100" method="post" action="">
                                <div class="form-group pt-3">
                                    <input type="hidden" class="form-control" id="contact_center"
                                           aria-describedby="emailHelp" name="centre" value="">
                                </div>
                                <div class="form-group pt-3">
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                           aria-describedby="emailHelp" placeholder="Adresse Email" name="email">
                                </div>
                                <div class="form-group pt-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Nom, Prénom, Raison social" name="name">
                                </div>
                                <div class="form-group pt-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Adresse" name="adresse">
                                </div>
                                <div class="form-group pt-3">
                                    <input type="text" class="form-control" id="exampleInputPassword1"
                                           placeholder="Numéro de téléphone" name="tel">
                                </div>
                                <div class="input-group pt-3">
                                    <textarea class="form-control" aria-label="With textarea"
                                              placeholder="Explication de votre problème" name="message"></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="form_submit" type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                        </form>

                        <?php
                        if (isset($erreur)) {
                            echo "<p style='color: red'>$erreur<p>";
                        }
                        if (isset($succes)) {
                            echo "<p style='color: green'>$succes</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <footer>

        <h5>Site conçus par Dylan Silva Sanches</h5>

        <a style="font-size: 0.5em" href="admin/index.php">Accés admin</a>
    </footer>
    <!-- Js -->
    <!--<script type="text/javascript" src="js/appmap.js"></script>-->


    <script type="text/javascript">

        var lat = 47.61634;
        var lon = 6.14439;
        var carte = null;

        // Fonction d'initialisation de la carte
        function initMap() {

            // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
            carte = L.map('maCarte').setView([lat, lon], 11);
            // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
            L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                // Il est toujours bien de laisser le lien vers la source des données
                attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                minZoom: 1,
                maxZoom: 20
            }).addTo(carte);
        }

        window.onload = function () {
            // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
            initMap();

            var villes = <?= $villes_json; ?>

            var tableauMarker = []

            var marqueurs = L.markerClusterGroup();


// creation de marqueur avec Popup

            for (ville in villes) {
                var marqueur1 =
                    L.marker([villes[ville].lat, villes[ville].lon]); //addTo(carte);
                marqueur1.bindPopup("<img src='img/logo_online_mini.png' alt='Onlineformapro'>" +
                    "<br>" +
                    [villes[ville].villes] +
                    "<br>" +
                    [villes[ville].adresse] +
                    "<br>" +
                    [villes[ville].horaire] +
                    "<br>" +
                    [villes[ville].tel] +
                    "<br>" +
                    "<button style='margin-top: 5px' type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal' onclick=\"document.getElementById('contact_center').value = '" + villes[ville].villes + "';\">Contacter </button>");
                marqueurs.addLayer(marqueur1);
            }


            //On ajoute le marqueur au tableau

            tableauMarker.push(marqueurs);

            //On regroupe les marqueurs dans un groupe lefleat
            var groupe = new L.featureGroup(tableauMarker);

            //On adapte le zoom au groupe
            carte.fitBounds(groupe.getBounds());

            carte.addLayer(marqueurs);
        };
    </script>


    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/app.js"></script>


</body>
</html>