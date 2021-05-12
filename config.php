<!-- Questa configurazione 
viene utilizzata per gestire 
le variabili all'interno della pagina 
e facilitarmi il lavoro -->

<?php
/* Configurazione Generale */
$website_name = "Web Community";

/* Connessione DATABASE */
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "webcommunity";

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
?>