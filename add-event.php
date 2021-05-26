<?php include 'config.php'; ?>

<?php
/* SE VIENE PREMUTO IL TASTO AGGIUNGI EVENTO */
if (isset($_POST["add-event"])) {

    /* SALVA LE INFORMAZIONI IN VARIABILI */
    $title = $_POST["title"];
    $country = $_POST["country"];
    $address = $_POST["address"];
    $province = $_POST["province"];
    $cap = $_POST["cap"];
    $category = $_POST["category"];
    $date = date("Y-m-d");
    $time = date("h:i:s");

    $athlete = $_POST["athlete"];

    /* INSERISCE L'EVENTO NEL DATABASE */
    $sql = "INSERT INTO eventi (paese, via, provincia, cap, data, ora, titolo, ID_utente, ID_categoria)
            VALUES ('$country', '$address', '$province', '$cap', '$date', '$time', '$title', '$_SESSION[ID]', '$category')";
    $result = mysqli_query($connection, $sql);

    /* ASSEGNA L'EVENTO AGLI ATLETI */
    $all_athlete = implode(',', $_POST['athlete']);
    $all_athlete2 = explode(',', $all_athlete);
    for ($i = 0; $i < count($all_athlete2); $i++) {
        $sql = "SELECT MAX(ID) AS MAXID
                FROM eventi";
        $result = mysqli_fetch_assoc(mysqli_query($connection, $sql));

        $sql = "UPDATE atleti
                SET ID_evento = $result[MAXID]
                WHERE ID = $all_athlete2[$i]";
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
    <title><?php echo $website_name ?> - Aggiungi Evento</title>

    <?php include 'template/resource.php' ?>
</head>

<body>
    <?php include 'template/header.php' ?>

    <!-- INIZIO Hero Banner -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Aggiungi Evento</p>
                <p class="subtitle">Inserisci un Nuovo evento sulla piattaforma</p>
            </div>
        </div>
    </section>

    <!-- CONTENUTO PAGINA -->
    <section class="section">
        <?php if (isset($_SESSION["login"])) : ?>
            <div class="container is-max-desktop box">

                <!-- MOSTRA MESSAGGIO IN CASO DI ERRORE -->
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
                        <label class="label">Titolo dell'Evento</label>
                        <p class="control has-icons-left">
                            <input class="input" type="text" placeholder="Titolo" name="title"> <!-- INPUT Titolo -->
                            <span class="icon is-small is-left">
                                <i class="fas fa-user"></i>
                            </span>
                        </p>
                    </div>
                    <div class="field">
                        <label class="label">Luogo</label>
                        <div class="field-body">
                            <div class="field">
                                <p class="control is-expanded has-icons-left">
                                    <input class="input" type="text" placeholder="Paese" name="country"> <!-- INPUT Paese -->
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control is-expanded has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Via" name="address" required> <!-- INPUT Via -->
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control is-expanded has-icons-left has-icons-right">
                                    <input class="input" type="text" placeholder="Provincia" name="province" required> <!-- INPUT Provincia -->
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <p class="control is-expanded has-icons-left has-icons-right">
                                    <input class="input" type="number" placeholder="CAP" name="cap" required> <!-- INPUT CAP -->
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <br>
                        <div class="field">
                            <label class="label">Categoria</label>
                            <div class="field-body">
                                <div class="field">
                                    <!-- STAMPA SU SCHERMO LE CATEGORIE INSERITE NEL DATABASE -->
                                    <?php
                                    $sql = "SELECT *
                                                FROM categorie";
                                    $results = mysqli_query($connection, $sql);

                                    while ($row = mysqli_fetch_array($results)) {
                                        $category_name = $row["nome"];
                                        $category_id = $row["ID"];
                                        echo "<label class='checkbox'>" . "<input type='radio' name='category' value='$category_id' required>" . " " . $category_name . "</label>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Atleti</label>
                            <div class="field-body">
                                <div class="field">
                                    <!-- STAMPA SU SCHERMO LE CATEGORIE INSERITE NEL DATABASE -->
                                    <?php
                                    $sql = "SELECT *
                                            FROM atleti
                                            WHERE ID_evento IS NULL";
                                    $results = mysqli_query($connection, $sql);

                                    while ($row = mysqli_fetch_array($results)) {
                                        $athlete_name = $row["nome"];
                                        $athlete_surname = $row["cognome"];
                                        $athlete_id = $row["ID"];
                                        echo "<label class='checkbox'>" . "<input type='checkbox' name='athlete[]' value='$athlete_id'>" . " " . $athlete_name . " " . $athlete_surname . "</label>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button is-primary" name="add-event">Aggiungi Evento</button> <!-- PULSANTE Conferma -->
                        </div>
                    </div>

                </form>
            </div>
        <?php else : ?>
            <!-- MESSAGGIO DI ERRORE SE L'UTENTE NON HA EFFETTUATO L'ACCESSO -->
            <div class="container is-max-desktop">
                <article class="message is-danger">
                    <div class="message-body">
                        Al momento sei un Ospite. Effettua l'Accesso per accedere a questa pagina.
                    </div>
                </article>
            </div>
        <?php endif ?>
    </section>

    <?php include 'template/footer.php'; ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>