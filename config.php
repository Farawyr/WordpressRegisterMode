<?php
  $servername = "localhost";
  $username = "user";
  $password = "pass";
  $dbname = "databasename";
  $prefix = "wpbn";
  $indirizzo = "addressofthewebsite";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
  die("Connessione effettuata con errori. Clicca qui per chiedere assistenza per questo errore <a href='#'>Clicca qui</a>"  . $conn->connect_error);
  }else{
	echo "Connesso al Database.";
}
session_start();
?>
