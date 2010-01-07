<?php
if (isset($_SESSION["ses_connecte"]))
{
?>

<h3>Creation d'un projet</h3>
<form method="post" action="projet.php">
<input type="hidden" name="creationprojet" value="1" />
<table>
		<tr><td><label>Nom du projet : </label></td><td><input type="text" id="nom" name="nom" /></td></tr>
		<tr><td><label>Description : </label></td><td><input type="text" id="description" name="description" /></td></tr>
</table>	
	
	<p style="text-align: center;">
		<input type="submit" value="Envoyer"/><input type="reset" value="Effacer"/>
	</p>
	
	
<?php
}
?>