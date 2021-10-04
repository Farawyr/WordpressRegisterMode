<html>



<?php
	include "config.php";
	session_start();
	?>

<br><br><br><br>
<form action="scarica.php" method="post">
EAN: <input type="text" name="ean" autofocus><br>
<input type="submit" value="Sottrai">
</form>
<br><br><br>
<a href="index_old.php">Carica prodotti</a>
<?php

?>


</html>

