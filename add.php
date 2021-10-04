<?php 
include "config.php";
	session_start();

$id_prodotto = $_SESSION["id_prodotto"];
$quantita = $_SESSION["in_stock"];

echo "<br>".$id_prodotto;
echo "<br>".$quantita;
$quantita_add = $quantita + 1;

echo "<br>".$quantita_add;






$sql = "UPDATE `".$prefix."_postmeta` SET `meta_value` = ".$quantita_add." WHERE `".$prefix."_postmeta`.`post_id` = ".$id_prodotto." AND `".$prefix."_postmeta`.`meta_key` = '_stock'";
echo "<br>".$sql."<br>";
$result = $conn->query($sql);
if($quantita_add > 0){
	$sql = "UPDATE `".$prefix."_postmeta` SET `meta_value` = 'instock' WHERE `".$prefix."_postmeta`.`post_id` = ".$id_prodotto." AND `".$prefix."_postmeta`.`meta_key` = '_stock_status' ";
	echo "<br>".$sql."<br>";
	$result = $conn->query($sql);
}
$conn->close();


echo "Ok, ho aggiunto la quantità";
$_SESSION["in_stock"] = $_SESSION["in_stock"] + 1;
$_SESSION["aggiunto_ok"] = "aggiunto";
goback();
function goback()
{
	header('Location: '.$indirizzo);
	exit;
}




?>