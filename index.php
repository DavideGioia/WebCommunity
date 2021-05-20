<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name ?> - Homepage</title>

    <?php include 'template/resource.php' ?>
</head>

<body>
    <?php include 'template/header.php' ?>

    <section class="hero is-primary">
        <div class="hero-body ">
            <div class="container">
                <p class="title">Eventi</p>
                <p class="subtitle">Qui vengono visualizzati tutti gli eventi</p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container is-max-desktop">
            <h1 class="title">Lista Eventi</h1>
            <?php if (isset($_SESSION["login"])) : ?>
                <div class="control">
                    <a class="button is-primary" href="add-event.php">Inserisci nuovo Evento</a>
                </div>
            <?php else : ?>
                <article class="message is-info">
                    <div class="message-header">
                        <p>Info</p>
                    </div>
                    <div class="message-body">
                        Ciao! Al momento stai visualizzando il sito web in modalitá Ospite!
                        Effettua l'Accesso per poter inserire nuovi Eventi e scrivere Post!
                    </div>
                </article>
            <?php endif; ?>
            <?php
            $sql = "SELECT *,eventi.ID AS IDEvento, utenti.ID AS IDUtente
                    FROM eventi INNER JOIN utenti
                    ON ID_utente = utenti.ID ";
            $result = mysqli_query($connection, $sql);
            while ($row = mysqli_fetch_array($result)) : ?>
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-4"><?php echo $row["titolo"] ?></p>
                                <p class="subtitle is-6"><?php echo "Pubblicato da " . $row["username"] . " - " . $row["paese"] . ", " . $row["via"];  ?></p>
                            </div>
                        </div>
                        <div class="content">
                            <br>
                            <time datetime="2016-1-1"><?php echo "Pubblicato il " . $row["data"] . " alle " . $row["ora"] ?></time>
                        </div>
                        <div class="buttons">
                            <button class="button is-primary is-light" id="show-comment<?php echo $row["IDEvento"] ?>">Mostra Commenti</button>
                        </div>
                    </div>
                </div>
                <div class="modal" id="comment-list<?php echo $row["IDEvento"]; ?>">
                    <div class="modal-background"></div>
                    <div class="modal-card">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Commenti</p>
                            <button class="delete" aria-label="close"></button>
                        </header>
                        <section class="modal-card-body">
                            <?php
                            $sql = "SELECT *
                                    FROM post INNER JOIN utenti ON ID_utente = utenti.ID
                                    WHERE ID_evento = $row[IDEvento]";
                            $results2 = mysqli_query($connection, $sql);
                            if (mysqli_num_rows($results2) > 0) : ?>
                                <?php while ($row2 = mysqli_fetch_array($results2)) : ?>
                                    <strong>[Voto: <?php echo $row2["voto"]; ?>] <?php echo $row2["username"]; ?>: </strong><?php echo $row2["commento"]; ?>
                                    <br>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <p>Al momento non ci sono commenti, scrivine uno!</p>
                            <?php endif; ?>
                        </section>
                        <footer class="modal-card-foot">
                            <a class="button is-success" href="add-comment.php?event=<?php echo $row["IDEvento"] ?>">Scrivi un Commento</a>
                        </footer>
                    </div>
                </div>
                <br>
                <script>
                    $("#show-comment<?php echo $row['IDEvento'] ?>").click(function() {
                        $("#comment-list<?php echo $row["IDEvento"]; ?>").toggleClass("is-active");
                    });
                </script>
            <?php endwhile; ?>
        </div>
    </section>
    <?php include 'template/footer.php' ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>