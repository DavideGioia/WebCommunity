<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name; ?> - Pannello Utente</title>

    <?php include 'template/resource.php' ?>
</head>

<body>
    <?php include 'template/header.php' ?>
    <!-- Hero Banner -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Pannello Utente</p>
                <!-- MESSAGGIO DI BENVENUTO -->
                <?php if (isset($_SESSION["login"])) : ?>
                    <p class="subtitle">Ciao <strong><?php echo $_SESSION['username']; ?></strong>, Qui puoi gestire il tuo Profilo.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Section -->
    <section class="section">
        <!-- PANNELLO UTENTE -->
        <?php if (isset($_SESSION["login"])) : ?>
            <section class="section">
                <div class="container is-max-desktop">
                    <h4 class="title is-4">Impostazioni Profilo</h4>
                    <div class="box">
                        <h5 class="title is-5">Elimina il tuo Profilo</h5>
                        <div class="buttons">
                            <button class="button is-danger" id="delete-profile">Elimina Profilo</button>
                        </div>
                        <div class="modal" id="delete-profile-popup">
                            <div class="modal-background"></div>
                            <div class="modal-card">
                                <header class="modal-card-head">
                                    <p class="modal-card-title" onclick="deleteprofile()">Eliminazione Profilo</p>
                                    <button class="delete" aria-label="close" id="close-popup"></button>
                                </header>
                                <section class="modal-card-body">
                                    Sei sicuro di voler eliminare il profilo? Se confermi non sarai
                                    piú in grado di recuperarlo!
                                </section>
                                <footer class="modal-card-foot">
                                    <button class="button is-danger">Conferma Eliminazione</button>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ERRORE SE L'UTENTE ENTRA NELLA PAGINA SENZA ACCESSO -->
        <?php else : ?>
            <div class="container is-max-desktop">
                <article class="message is-danger">
                    <div class="message-header">
                        <p>Errore</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        Al momento sei un Ospite. Per avere accesso al Pannello Utente effettua l'Accesso!
                    </div>
                </article>
            </div>
        <?php endif; ?>
    </section>

    <?php include 'template/footer.php';
    print_r($_SESSION);
    ?>
</body>

</html>