<?php include 'config.php' ?>

<?php
/* SE VIENE PREMUTO IL TASTO ACCEDI */
if (isset($_POST["login"])) {
    /* RICEZIONE INPUT DAL FORM */
    $user_username = mysqli_real_escape_string($connection, stripslashes($_POST["username"]));
    $user_password = md5(mysqli_real_escape_string($connection, stripslashes($_POST["password"])));

    /* SE L'UTENTE LASCIA UN CAMPO VUOTO */
    if (empty($user_username) || empty($user_password)) {
        $_SESSION["error"] = 1;
        $error = "Devi compilare tutti i campi!";
    }

    /* SE L'UTENTE É PRESENTE NEL DATABASE*/
    $sql = "SELECT *
            FROM utenti
            WHERE Username = '$user_username' AND Password = '$user_password'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION["login"] = 1;
        $_SESSION['username'] = $user_username;

        header("Location: user-settings.php"); // reinderizzamento all'area riservata
    } else {
        $_SESSION["error"] = 1;
        $error = "Nome utente o password errati!";
    }
}
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
    <!-- Hero Banner -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Accedi</p>
                <p class="subtitle">Effettua l'accesso al tuo Account</p>
            </div>
        </div>
    </section>
    <!-- Sezione Form -->
    <section class="section">
        <div class="container is-max-desktop box">
            <?php if ($_SESSION["error"] == 1) :  ?>
                <article class="message is-danger">
                    <div class="message-body">
                        <?php echo $error; ?>
                    </div>
                </article>
            <?php endif; ?>
            <form action="" method="post">
                <div class="field">
                    <label class="label">Nome Utente</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Nome Utente" name="username">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Password" name="password">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox">
                            Ricordati di me
                        </label>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" type="submit" name="login">Accedi</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include 'template/footer.php'; ?>
</body>

</html>