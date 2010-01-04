<?php
require("req.php");
if (isset($_GET["a"]))
{
	if ($_GET["a"] == "affichage")
	{
		include("affichage.php");
	}
}

?>