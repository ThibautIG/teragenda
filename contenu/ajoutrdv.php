﻿<?php
if (!isset($_SESSION["ses_connecte"]))
{
?>

<?php
}
else
{
	if (isset($_POST["date"]))
	{
		$date = mysql_real_escape_string($_POST["date"]);
		$heuredeb = mysql_real_escape_string($_POST["heuredeb"]);
		$heurefin = mysql_real_escape_string($_POST["heurefin"]);
		$commentaire = mysql_real_escape_string($_POST["commentaire"]);
		$idprojet = mysql_real_escape_string($_GET["id"]);
		
		$ok = mysql_query("INSERT INTO rdv(id_compte_a_cree,id_projet_posseder,date,heuredeb,heurefin,commentaire) VALUES('".$_SESSION["ses_id"]."', '".$idprojet."', '".$date."','".$heuredeb."','".$heurefin."','".$commentaire."')",$sql) or die("INSERT INTO rdv : ".mysql_error());
	}
?>
<h1>Ajouter un rendez-vous </h1>

<form method="post" action="">
	<table>
		<tr><td><label>Date</label></td><td><input type="text" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" /></td></tr>
		<tr><td><label>Heure Début</label></td><td><input type="text" id="heure" name="heuredeb" /></td></tr>
		<tr><td><label>Heure Fin</label></td><td><input type="text" id="duree" name="heurefin" /></td></tr>
		<tr><td><label>Commentaire</label></td><td><input type="text" id="commentaire" name="commentaire" /></td></tr>
		
	</table>
	<p style="text-align: center;">
		<input type="submit" value="Envoyer"/><input type="reset" value="Effacer"/>
	</p>
</form>
<?php
$jours = Array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
?>
<ul>
<?php
for ($i = 0; $i < 7; $i++)
{
?><li><?php 
date_default_timezone_set('Europe/Paris');
echo $jours[(date("N")-1+$i)%7]; ?></li><?php
}
?>
</ul>
<div style="position: relative;">
<?php
$q = mysql_query("SELECT *, DATEDIFF(date,CURDATE()) as diff FROM rdv");
while ($d = mysql_fetch_array($q) )
{
$hd = $d["heuredeb"];
$hf = $d["heurefin"];
$top = substr($hd,0,2)*50+substr($hd,3,5);
$height = substr($hf,0,2)*50+substr($hf,3,5) - $top;
$left = $d["diff"]*100;
	?><div style="position: absolute; top: <?php echo $top; ?>px; left: <?php echo $left; ?>px; width: 100px; height: <?php echo $height; ?>px; background-color: red;"><?php echo $d["commentaire"]; ?></div>
	<?php

}
?>
</div>



<?php
}
?>