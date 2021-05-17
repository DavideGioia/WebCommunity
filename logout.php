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
    <section class="section">
        <div class="container is-max-desktop">
            <article class="message is-success">
                <div class="message-header">
                    <p>Sei uscito dal Profilo</p>
                    <button class="delete" aria-label="delete"></button>
                </div>
                <div class="message-body">
                    Sei uscito correttamente dal tuo profilo, verrai reindirizzato alla Homepage tra 5 secondi!
                </div>
            </article>
            <progress class="progress is-small is-primary" max="100">15%</progress>
        </div>
    </section>
    <?php header("refresh:5;url=http://localhost/ELABORATO/index.php"); ?>
</body>

</html>