<!-- File di Configurazione -->

<?php
/* Configurazione Generale */
$website_name = "Web Community";

/* Connessione DATABASE */
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "webcommunity";

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

/* Inizio Sessione */
session_start();

$_SESSION["error"] = 0;
$error = "";
?>