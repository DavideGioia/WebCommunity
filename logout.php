<?php
include 'config.php';

session_destroy();
unset($_SESSION["login"]);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name ?> - Accedi</title>

    <?php include 'template/resource.php' ?>
</head>

<body>
    <?php include 'template/header.php' ?>

    <!-- INIZIO Hero Banner -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Disconnessione</p>
                <p class="subtitle">Uscita dal Profilo</p>
            </div>
        </div>
    </section>

    <!-- CONTENUTO PAGINA -->
    <section class="section">
        <?php if (isset($_SESSION["login"])) : ?>
            <div class="container is-max-desktop">

                <!-- MESSAGGIO DI DISCONNESSIONE -->
                <article class="message is-success">
                    <div class="message-header">
                        <p>Sei uscito dal Profilo</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        Sei uscito correttamente dal tuo profilo, verrai reindirizzato alla Homepage tra 5 secondi!
                    </div>
                </article>

                <!-- BARRA DI CARICAMENTO -->
                <progress class="progress is-small is-primary" max="100">15%</progress>
            </div>
        <?php else : ?>
            <div class="container is-max-desktop">
                <article class="message is-danger">
                    <div class="message-body">
                        Non hai accesso a questa pagina!
                    </div>
                </article>
            </div>
        <?php endif; ?>
    </section>

    <!-- REINDERIZZAMENTO ALL'INDEX CON TIMER DI 5 SECONDI -->
    <?php header("refresh:5;url=index.php"); ?>

    <?php include 'template/footer.php' ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>