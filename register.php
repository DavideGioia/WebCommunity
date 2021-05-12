<?php include 'config.php' ?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $website_name ?> - Registrati</title>

    <?php include 'assets/template/resource.php' ?>
</head>

<body>
    <?php include 'assets/template/header.php' ?>
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
        <div class="container is-max-desktop">
            <form action="" method="post">
                <div class="field">
                    <label class="label">Nome Utente</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Nome Utente">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </p>
                </div>
                <div class="field">
                    <label class="label">E-Mail</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="E-Mail">
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
                                <input class="input" type="password" placeholder="Password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left has-icons-right">
                                <input class="input" type="password" placeholder="Conferma Password">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary">Registrati</button>
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

</html>