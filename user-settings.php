<?php include 'config.php' ?>

<?php
session_start();
if (isset($_SESSION["login"])) : ?>

    <!DOCTYPE html>
    <html lang="it">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $website_name ?> - Pannello Utente</title>

        <?php include 'assets/template/resource.php' ?>
    </head>

    <body>
        <?php include 'assets/template/header.php' ?>
        <h1>Benvenuto nel Pannello Utente</h1>
        <?php include 'assets/template/footer.php' ?>
    </body>

    </html>
<?php endif; ?>