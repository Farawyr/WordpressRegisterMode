
<?php
	include "config.php";
	session_start();
	

if(isset($_POST["ean"])){
	$searched_ean = $_POST["ean"];
}
$sql = "SELECT `post_id` FROM `".$prefix."_postmeta` WHERE `meta_value` = '".$searched_ean."'";
echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$_SESSION["trovato"] = "SI";
// output data of each row
while($row = $result->fetch_assoc()) {
    $id_prodotto = $row["post_id"];
}
} else {
echo "NESSUN PRODOTTO TROVATO CON QUESTO EAN!";
$_SESSION["trovato"] = "NO";
header("Location: {$_SERVER['HTTP_REFERER']}");

}

echo "<br><br><br><br>ho finito la prima query e il valore di id prodotto è: ".$id_prodotto;
$_SESSION["id_prodotto"] = $id_prodotto;



$sql = "SELECT post_title FROM ".$prefix."_posts WHERE ID = ".$id_prodotto;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $nome_variazione = $row["post_title"];
}
} else {
echo "NESSUN PRODOTTO TROVATO CON QUESTO EAN!";
}


echo "<br><br><br><br>ho finito la seconda query e il valore di nome variazione è: ".$nome_variazione;
$_SESSION["nome_variazione"] = $nome_variazione;







$sql = "SELECT meta_value FROM ".$prefix."_postmeta WHERE post_id = '".$id_prodotto."' AND meta_key = '_stock'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $in_stock = $row["meta_value"];
}
} else {
echo "NESSUN PRODOTTO TROVATO CON QUESTO EAN!";
}
$conn->close();


echo "<br><br><br><br>ho finito la terza query e il valore di stock magazzino è: ".$in_stock;
$_SESSION["in_stock"] = $in_stock;

goback();


function goback()
{
	header("Location: {$_SERVER['HTTP_REFERER']}");
	exit;
}

echo $_SESSION["in_stock"]." - ".$_SESSION["id_prodotto"]." - ".$_SESSION["nome_variazione"];   



?>