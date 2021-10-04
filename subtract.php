<?php 

	include "config.php";
	session_start();
	
$id_prodotto = $_SESSION["id_prodotto"];
$quantita = $_SESSION["in_stock"];

echo "<br>".$id_prodotto;
echo "<br>".$quantita;
if($quantita > 0){
  $quantita_sub = $quantita - 1;
}
echo "<br>".$quantita_sub;






$sql = "UPDATE `".$prefix."_postmeta` SET `meta_value` = ".$quantita_sub." WHERE `".$prefix."_postmeta`.`post_id` = ".$id_prodotto. " AND `".$prefix."_postmeta`.`meta_key` = '_stock'";
echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($quantita_sub == 0){
	$sql = "UPDATE `".$prefix."_postmeta` SET `meta_value` = 'outofstock' WHERE `".$prefix."_postmeta`.`post_id` = ".$id_prodotto." AND `".$prefix."_postmeta`.`meta_key` = '_stock_status'";
	echo $sql;
	$result = $conn->query($sql);
	
}
$conn->close();


echo "Ok, ho sottratto la quantità";
$_SESSION["in_stock"] = $_SESSION["in_stock"] - 1;
$_SESSION["aggiunto_ok"] = "aggiunto";
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

goback();
function goback()
{
	header('Location: https://sorrentinosport.com/magazzino');
	exit;
}




?>