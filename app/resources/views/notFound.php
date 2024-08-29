<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        include './app/resources/template.php';
    ?>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/notFound.css" crossorigin="anonymous">
    <title>Not found</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h1 class="display-4">404</h1>
                <p class="lead">La pagina no existe</p>
                <a href="<?=BASE_URL?>/" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">Regresar</a>
            </div>
        </div>
    </div>
</body>