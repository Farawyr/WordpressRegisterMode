<html>



<?php
	include "config.php";
	session_start();
	?>

<br><br><br><br>
<form action="search.php" method="post">
EAN: <input type="text" name="ean" autofocus><br>
<input type="submit" value="Cerca">
</form>


<?php
if($_SESSION["trovato"] == "NO"){
	echo "NON E' STATO TROVATO ALCUN PRODOTTO CON QUESTO EAN";
	unset($_SESSION['trovato']);
}else if ($_SESSION["trovato"] == "SI"){

	$id_prodotto = $_SESSION["id_prodotto"];
	$nome_variazione = $_SESSION["nome_variazione"];
	$in_stock = $_SESSION["in_stock"];

	echo "<br><br><br>in questo momento id prodotto è:".$id_prodotto;
	echo "<br><br><br>in questo momento nome variazione è:".$nome_variazione;
	echo "<br><br><br>in questo momento in stock è:".$in_stock;


	echo '<form action="add.php" method="post">
	    <input type="submit" name="add" id="add" value="&nbsp;&nbsp;&nbsp;&nbsp;+&nbsp;&nbsp;&nbsp;&nbsp;" /><br/>
	</form>';
	echo '<form action="subtract.php" method="post">
	    <input type="submit" name="sub" id="sub" value="&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;" /><br/>
	</form>';
	unset($_SESSION['trovato']);
}
if($_SESSION["aggiunto_ok"] == "aggiunto"){
	$in_stock = $_SESSION["in_stock"];
	echo "Ho aggiunto/sottratto con successo una quantità al prodotto ".$nome_variazione.". Ora ce ne sono ".$in_stock."<br>";
	unset($_SESSION['aggiunto_ok']);
	echo '<form action="add.php" method="post">
	    <input type="submit" name="add" id="add" value="Aggiungine un altro" /><br/>
	</form>';
	echo '<form action="subtract.php" method="post">
	    <input type="submit" name="sub" id="sub" value="Sottraine un altro" /><br/>
	</form>';
}
?>


</html>

