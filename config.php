<?php
/* Configurazione Generale */
$website_name = "Web Community"; // Modifica il nome del Sito Web in tutte le pagine
$show_debug = false; // Mostra le variabili per il debug


/* Connessione DATABASE */
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "webcommunity";

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

/* AVVIO SESSIONE */
session_start();

/* GESTIONE ERRORI */
$_SESSION["error"] = 0; // Decide se ci sono errori o meno
$error = ""; // Salva un messaggio di errore
