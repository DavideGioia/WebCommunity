<?php include 'config.php'; ?>

<?php
if (isset($_POST["save"])) {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $oldpassword = md5($_POST["oldpassword"]);
    $newpassword = md5($_POST["newpassword"]);

    /* SE VENGONO MODIFICATI NOME O COGNOME */
    if ($name != $_SESSION["name"] || $surname != $_SESSION["surname"]) {
        $sql = "UPDATE utenti
                SET nome = '$name',cognome = '$surname'
                WHERE ID = '$_SESSION[ID]'";
        $result = mysqli_query($connection, $sql);

        $_SESSION["name"] = $name;
        $_SESSION["surname"] = $surname;
    }

    /* SE VIENE MODIFICATA LA PASSWORD */
    if ($oldpassword == $_SESSION["password"]) {
        $sql = "UPDATE utenti
                SET password = '$newpassword'
                WHERE ID = '$_SESSION[ID]'";
        $result = mysqli_query($connection, $sql);

        $_SESSION["password"] = $newpassword;
    }
}



?>

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

    <!-- INIZIO Hero Banner -->
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

    <!-- CONTENUTO PAGINA -->
    <section class="section">

        <!-- SE L'UTENTE HA EFFETTUATO L'ACCESSO -->
        <?php if (isset($_SESSION["login"])) : ?>
            <section class="section">
                <div class="container is-max-desktop">
                    <h4 class="title is-4">Impostazioni Profilo</h4>
                    <div class="box">
                        <form action="" method="post">
                            <div class="field">
                                <label class="label">Il tuo Nome Utente</label>
                                <p class="control has-icons-left">
                                    <input class="input" type="text" placeholder="<?php echo $_SESSION["username"] ?>" disabled> <!-- INPUT DISABILITATO Nome Utente -->
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">La tua E-Mail</label>
                                <p class="control has-icons-left">
                                    <input class="input" type="email" placeholder="<?php echo $_SESSION["email"] ?>" disabled> <!-- INPUT DISABILITATO E-Mail -->
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">Modifica Nome e Cognome</label>
                                <div class="field-body">
                                    <div class="field">
                                        <p class="control is-expanded has-icons-left">
                                            <input class="input" type="text" placeholder="Inserisci nuovo Nome" value="<?php echo $_SESSION["name"] ?>" name="name"> <!-- INPUT Nome -->
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <p class="control is-expanded has-icons-left has-icons-right">
                                            <input class="input" type="text" placeholder="Inserisci nuovo Cognome" value="<?php echo $_SESSION["surname"] ?>" name="surname"> <!-- INPUT Cognome -->
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Modifica Password</label>
                                <div class="field-body">
                                    <div class="field">
                                        <p class="control is-expanded has-icons-left">
                                            <input class="input" type="password" placeholder="Vecchia Password" name="oldpassword"> <!-- INPUT Vecchia Password -->
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="field">
                                        <p class="control is-expanded has-icons-left has-icons-right">
                                            <input class="input" type="password" placeholder="Nuova Password" name="newpassword"> <!-- INPUT Nuova Password -->
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="button is-primary" name="save">Salva nuove Impostazioni</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </section>
        <?php else : ?>
            <div class="container is-max-desktop">
                <article class="message is-danger">
                    <div class="message-header">
                        <p>Errore</p>
                        <button class="delete" aria-label="delete"></button>
                    </div>
                    <div class="message-body">
                        Al momento sei un Ospite. Effettua l'Accesso per accedere a questa pagina.
                    </div>
                </article>
            </div>
        <?php endif; ?>
    </section>

    <?php include 'template/footer.php'; ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>