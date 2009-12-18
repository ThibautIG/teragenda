<?php
if (!$_SESSION["ses_connecte"])
{
?>
<h1>Bonjour ;D </h1>

<?php
}
else
{
	if (isset($_POST["date"]))
	{
		$date = mysql_real_escape_string($_POST["date"]);
		$heure = mysql_real_escape_string($_POST["heure"]);
		$duree = mysql_real_escape_string($_POST["duree"]);
		$commentaire = mysql_real_escape_string($_POST["commentaire"]);
		
		$ok = mysql_query("INSERT INTO rdv(date,heure,duree,commentaire) VALUES('".$date."','".$heure."','".$duree."','".$commentaire."')",$sql);
	}
?>
<h1>Rendez-vous : </h1>
Ajouter RDV :
<form method="post" action="">
	<table>
		<tr><td><label>Date</label></td><td><input type="text" id="date" name="date" /></td></tr>
		<tr><td><label>Heure</label></td><td><input type="text" id="heure" name="heure" /></td></tr>
		<tr><td><label>Durée</label></td><td><input type="text" id="duree" name="duree" /></td></tr>
		<tr><td><label>Commentaire</label></td><td><input type="text" id="commentaire" name="commentaire" /></td></tr>
		
	</table>
	<p style="text-align: center;">
		<input type="submit" value="Envoyer"/><input type="reset" value="Effacer"/>
	</p>
</form>
<ul>
<li>Lundi</li>
<li>Mardi</li>
<li>Mercredi</li>
<li>Jeudi</li>
<li>Vendredi</li>
<li>Samedi</li>
<li>Dimanche</li>
</ul>
<div style="position: relative;">
<?php
$q = mysql_query("SELECT * FROM rdv");
while ($d = mysql_fetch_array($q) )
{
$h = $d["heure"];
$deb = substr($h,0,2)*60+substr($h,3,5);
echo $deb;
	?><div style="position: absolute; top: <?php echo $deb; ?>px; left: <?php echo $d["date"]; ?>px; width: 100px; height: <?php echo $d["duree"]; ?>px; background-color: red;"><?php echo $d["commentaire"]; ?></div>
	<?php

}
?>
</div>



<?php
}
?>