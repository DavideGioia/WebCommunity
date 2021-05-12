<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="http://localhost/ELABORATO/index.php">
                <strong><?php echo $website_name ?></strong>
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="http://localhost/ELABORATO/index.php">Eventi</a>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <?php if (isset($_SESSION["login"])) : ?>
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                <?php echo $_SESSION['username']; ?>
                            </a>
                            <div class="navbar-dropdown">
                                <a class="navbar-item" href="http://localhost/ELABORATO/user-settings.php">
                                    Pannello Utente
                                </a>
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="http://localhost/ELABORATO/logout.php">
                                    Esci dal profilo
                                </a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="buttons">
                            <a class="button is-primary" href="http://localhost/ELABORATO/register.php">
                                <strong>Registrati</strong>
                            </a>
                            <a class="button is-light" href="http://localhost/ELABORATO/login.php">
                                Accedi
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
</nav>