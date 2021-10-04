<?php 

	include "config.php";
	session_start();
	

	echo "<b>Scarico</b><br>";
	if(isset($_POST["ean"])){
	$searched_ean = $_POST["ean"];
}else{
    echo "<script>window.alert('Errore sconosciuto);</script>";
    header("location:https://sorrentisport.com/magazzino");
}

$sql = "SELECT `post_id` FROM `".$prefix."_postmeta` WHERE `meta_value` = '".$searched_ean."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $id_prodotto = $row["post_id"];
    echo "ID PRODOTTO: ".$id_prodotto."<br>";
}
}


$sql = "SELECT post_title FROM ".$prefix."_posts WHERE ID = ".$id_prodotto;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $nome_variazione = $row["post_title"];
}
echo "<b>Prodotto selezionato: ".$nome_variazione."</b><br>";
	
} else {
    	echo "<body style='background-color:red'>";
    $myAudioFile = "errore.mp3";
echo '<audio autoplay="true" style="display:none;">
         <source src="'.$myAudioFile.'" type="audio/wav">
      </audio>';
echo "NESSUN PRODOTTO TROVATO CON QUESTO EAN!";
}


$sql = "SELECT meta_value FROM ".$prefix."_postmeta WHERE post_id = '".$id_prodotto."' AND meta_key = '_stock'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    	
    $in_stock = $row["meta_value"];
    echo "<b>Quantità: ".$in_stock."</b><br>";
}
} else {
    	echo "<body style='background-color:red'>";
    $myAudioFile = "errore.mp3";
echo '<audio autoplay="true" style="display:none;">
         <source src="'.$myAudioFile.'" type="audio/wav">
      </audio>';
echo "Prodotto fuori stock";
}





if($in_stock > 0){
  $quantita_sub = $in_stock - 1;
}else{
        	echo "<body style='background-color:red'>";
    $myAudioFile = "errore.mp3";
echo '<audio autoplay="true" style="display:none;">
         <source src="'.$myAudioFile.'" type="audio/wav">
      </audio>';
echo "Prodotto fuori stock";
}







$sql = "UPDATE `".$prefix."_postmeta` SET `meta_value` = ".$quantita_sub." WHERE `".$prefix."_postmeta`.`post_id` = ".$id_prodotto. " AND `".$prefix."_postmeta`.`meta_key` = '_stock'";

$result = $conn->query($sql);
if($quantita_sub == 0){
	$sql = "UPDATE `".$prefix."_postmeta` SET `meta_value` = 'outofstock' WHERE `".$prefix."_postmeta`.`post_id` = ".$id_prodotto." AND `".$prefix."_postmeta`.`meta_key` = '_stock_status'";

	$result = $conn->query($sql);
	
}
$conn->close();
echo "<body style='background-color:green'>";
$myAudioFile = "ok.wav";
echo '<audio autoplay="true" style="display:none;">
         <source src="'.$myAudioFile.'" type="audio/wav">
      </audio>';


header( "refresh:1;url=index.php" );



?>