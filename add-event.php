<?php include 'config.php'; ?>

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
    <!-- Hero -->
    <section class="hero is-small is-primary">
        <div class="hero-body">
            <div class="container">
                <p class="title">Aggiungi Evento</p>
                <p class="subtitle">Inserisci un Nuovo evento sulla piattaforma</p>
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
                    <label class="label">Titolo dell'Evento</label>
                    <p class="control has-icons-left">
                        <input class="input" type="text" placeholder="Titolo" name="title">
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
                                <input class="input" type="text" placeholder="Paese" name="country">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left has-icons-right">
                                <input class="input" type="text" placeholder="Via" name="address">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left has-icons-right">
                                <input class="input" type="text" placeholder="Provincia" name="province">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field">
                            <p class="control is-expanded has-icons-left has-icons-right">
                                <input class="input" type="password" placeholder="CAP" name="cap">
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary" name="add-event">Aggiungi Evento</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <?php include 'template/footer.php'; ?>

    <?php include 'template/debug.php'; ?>
</body>

</html>