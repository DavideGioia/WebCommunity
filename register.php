<?php include 'config.php' ?>

<?php
/* SE VIENE PREMUTO IL TASTO REGISTRATI */
if (isset($_POST["register"])) {
    /* RICEZIONE INPUT DAL FORM */
    $user_username = mysqli_real_escape_string($connection, stripslashes($_POST["username"]));
    $user_name = mysqli_real_escape_string($connection, stripslashes($_POST["name"]));
    $user_surname = mysqli_real_escape_string($connection, stripslashes($_POST["surname"]));
    $user_email = mysqli_real_escape_string($connection, stripslashes($_POST["email"]));
    $user_password = mysqli_real_escape_string($connection, stripslashes($_POST["password"]));
    $user_confirmpassword = mysqli_real_escape_string($connection, stripslashes($_POST["confirmpassword"]));

    /* SE L'UTENTE LASCIA UN CAMPO VUOTO */
    if (empty($user_username) || empty($user_name) || empty($user_surname) || empty($user_email) || empty($user_password) || empty($user_confirmpassword)) {
        $_SESSION["error"] = 1;
        $error = "Devi compilare tutti i campi!";
    } elseif ($user_password != $user_confirmpassword) {
        $_SESSION["error"] = 1;
        $error = "Le Password inserite non coincidono!";
    }

    /* CONTROLLO DATABASE UTENTI CON DATI UGUALI */
    $sql = "SELECT *
            FROM utenti 
            WHERE username = '$user_username' OR email = '$user_email' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($result); // trasforma i dati dell'utente in un array associativo

    /* SE L'UTENTE ESISTE */
    if ($user) {
        if ($user["username"] === $user_username) {
            $_SESSION["error"] = 1;
            $error = "Questo Nome Utente é giá stato utilizzato!";
        } elseif ($user["email"] === $user_email) {
            $_SESSION["error"] = 1;
            $error = "Questa EMail é giá stata utilizzata!";
        }
    }

    /* SE NON SONO PRESENTI ERRORI */
    if ($_SESSION["error"] == 0) {
        $user_password = md5($user_confirmpassword); // Salva la password in MD5

        // Inserisce nella tabella utenti le informazioni prese dal form
        $sql = "INSERT INTO utenti (username, nome, cognome, email, password)
                VALUES ('$user_username', '$user_name', '$user_surname', '$user_email', '$user_password')";

        mysqli_query($connection, $sql);

        // Inserisce nella tabella scelte le categorie scelte dall'utente
        $sql = "SELECT *
                FROM categorie";
        $results = mysqli_query($connection, $sql);

        while ($row = mysqli_fetch_array($results)) {
            $category_name = $row["nome"];
            $category_id = $row["ID"];

            /* Se la categoria ha un valore */
            if (isset($_POST["$category_name"])) {
                // seleziona l'utente che ha effettuato la registrazione
                $sql = "SELECT ID
                        FROM utenti
                        WHERE username = '$user_username' AND email = '$user_email' LIMIT 1";
                $result = mysqli_query($connection, $sql);
                $user = mysqli_fetch_assoc($result);

                $is_checked = $category_id;
                // inserisce nel database le scelte dell'utente
                $sql = "INSERT INTO scelte (ID_utente, ID_categoria)
                        VALUES ('$user[ID]', '$is_checked')";
                mysqli_query($connection, $sql);
                echo "variabile: " . $is_checked;
            }
        }

        header('refresh:0;url=login.php'); // reinderizzamento pannello utente
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name ?> - Registrati</title>

    <?php include 'template/resource.php' ?>
</head>

<body>
    <?php include 'template/header.php' ?>
    <!-- Hero -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Registrati</p>
                <p class="subtitle">Crea un nuovo Account</p>
            </div>
        </div>
    </section>
    <!-- Sezione Form -->
    <section class="section">
        <div class="container is-max-desktop box">
            <?php if ($_SESSION["error"] == 1) : ?>
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
                    <label class="label">Nome</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Nome" name="name">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">Cognome</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Cognome" name="surname">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">E-Mail</label>
                    <p class="control has-icons-left">
                        <input class="input" type="email" placeholder="E-Mail" name="email">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="field-body">
                        <div class="field">
                            <p class="control is-expanded has-icons-left">
                                <input class="input" type="password" placeholder="Password" name="password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left has-icons-right">
                                <input class="input" type="password" placeholder="Conferma Password" name="confirmpassword">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Seleziona le Categorie che preferisci</label>
                    <div class="field-body">
                        <!-- STAMPA SU SCHERMO LE CATEGORIE INSERITE NEL DATABASE -->
                        <?php
                        $sql = "SELECT *
                                FROM categorie";
                        $results = mysqli_query($connection, $sql);

                        while ($row = mysqli_fetch_array($results)) {
                            $category_name = $row["nome"];
                            $category_id = $row["ID"];
                            echo "<label class='checkbox'>" . "<input type='checkbox' name='$category_name' value='$category_id'>" . $category_name . "</label>";
                        }
                        ?>

                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" name="register">Registrati</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <?php include 'template/footer.php'; ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>