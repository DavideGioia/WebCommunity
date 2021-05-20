<?php include 'config.php'; ?>

<?php
/* SE VIENE PREMUTO IL TASTO AGGIUNGI COMMENTO */
if (isset($_POST["add-comment"])) {

    /* SALVA LE INFORMAZIONI IN VARIABILI */
    $comment = $_POST["comment"];
    $vote = $_POST["vote"];
    $date = date("Y-m-d"); // Usa la funzione che restituisce la data di oggi

    /* SELEZIONA GLI UTENTI CHE HANNO UN POST NEL DATABASE PER L'EVENTO SELEZIONATO */
    $sql = "SELECT *
            FROM post
            WHERE ID_utente = '$_SESSION[ID]' AND ID_evento = '$_GET[event]' LIMIT 1"; // L'evento viene passato in GET dalla pagina Index.php (Pagina Eventi)
    $result = mysqli_query($connection, $sql);

    /* SE L'UTENTE HA GIÁ INSERITO UN POST PER L'EVENTO SELEZIONATO */
    if (mysqli_num_rows($result) == 1) {
        $_SESSION["error"] = 1;
        $error = "Hai giá inserito un commento per questo Evento. Prova con un altro!";
    } else {
        /* INSERISCE NEL DATABASE IL POST DELL'UTENTE */
        $sql = "INSERT INTO post (commento, voto, data, ID_utente, ID_Evento)
                VALUES ('$comment', ' $vote', '$date', '$_SESSION[ID]', '$_GET[event]')";
        mysqli_query($connection, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name ?> - Aggiungi Commento</title>

    <?php include 'template/resource.php' ?>
</head>

<body>
    <?php include 'template/header.php' ?>

    <!-- INIZIO Hero Banner -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Aggiungi Commento</p>
                <p class="subtitle">Scrivi un Commento sotto all'Evento selezionato</p>
            </div>
        </div>
    </section>

    <!-- CONTENUTO PAGINA -->
    <section class="section">
        <div class="container is-max-desktop box">

            <!-- MOSTRA ERRORE SU SCHERMO -->
            <?php if ($_SESSION["error"] == 1) : ?>
                <article class="message is-danger">
                    <div class="message-body">
                        <?php echo $error; ?>
                    </div>
                </article>
            <?php endif; ?>

            <!-- INIZIO Form -->
            <form action="" method="post">
                <div class="field">
                    <label class="label">Commento</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Commento" name="comment" required> <!-- INPUT Commento -->
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">Valutazione Evento</label>
                    <p class="control has-icons-left">
                        <input class="input" type="number" placeholder="Voto da 1 a 10" name="vote" max="10" min="1" required> <!-- INPUT Voto -->
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" name="add-comment">Scrivi Commento</button> <!-- PULSANTE Conferma -->
                    </div>
                </div>
            </form>

        </div>
    </section>

    <?php include 'template/footer.php'; ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>