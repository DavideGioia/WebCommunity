<?php include 'config.php' ?>
<?php
session_start();

$_SESSION["login"] = true;

$error = false; ?>


<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name ?> - Accedi</title>

    <?php include 'assets/template/resource.php' ?>
</head>

<body>
    <?php include 'assets/template/header.php' ?>
    <!-- Hero -->
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
        <div class="container is-max-desktop">
            <?php if ($error == true) : ?>
                <article class="message is-danger">
                    <div class="message-body">
                        Nome Utente o Password errati.
                    </div>
                </article>
            <?php endif; ?>
            <form action="" method="post">
                <div class="field">
                    <label class="label">Nome Utente</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Nome Utente" name="username" required>
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <p class="control has-icons-left">
                        <input class="input" type="password" placeholder="Password" name="password" required>
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
                        <button class="button is-primary" name="accedi">Accedi</button>
                    </div>
                    <div class="control">
                        <button class="button is-light">Cancella</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include 'assets/template/footer.php' ?>
</body>

<?php
if (isset($_POST["accedi"])) {
    $error = false;
    $user_username = mysqli_real_escape_string($connection, stripslashes($_POST["username"]));
    $user_password = mysqli_real_escape_string($connection, stripslashes($_POST["password"]));
    $user_password_md5 = md5($user_password);

    $sql = "SELECT *
            FROM utenti
            WHERE Username = '$user_username' AND Password = '$user_password_md5'";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 1) {
        $error = false;
        $_SESSION['username'] = $user_username;
        $_SESSION['password'] = $user_password_md5;
        header("Location: user-settings.php"); // reinderizzamento all'area riservata
    } else {
        $error = true;
    }
}
?>

</html>