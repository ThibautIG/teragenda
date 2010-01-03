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
		<input type="submit" value="Envoyer"/><input type="reset" value="Effacer"/><br /><br />
	</p>
</form>
<?php
	$jours = Array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
?>
<?php
	date_default_timezone_set('Europe/Paris');
	$hauteur_jour = 20;
	$hauteur_heure = 42;
	$largeur_gauche = 42;
	$largeur_jour = 130;
	
?>
<div style="position:relative; width: <?php echo $largeur_gauche + $largeur_jour*7; ?>px; bottom:20px;">
<?php
	for ($i = 0; $i < 7; $i++)
	{
		$prochain_jour = time() + ($i*24*60*60);
		?>
		<span style="position:absolute; left: <?php echo $largeur_gauche+$i*$largeur_jour; ?>px;"><?php 
		
		echo $jours[(date("N")-1+$i)%7] . " : " . date("d-m",$prochain_jour); ?></span><?php
	}
?>
</div>


<div style="border:1px solid black; height: 500px; overflow-y:scroll; position: relative;">
<?php


//$minutes = 0; $heures = 0;
for ($i=0; $i < 24; $i++)
{
/*
	if ($minutes == 60)
	{
		$heures = $heures + 1;
		$minutes = 0;
	}
	*/
	?>
	<div style="position:absolute; top:<?php echo $i*$hauteur_heure; ?>px; width:<?php echo $largeur_gauche + $largeur_jour*7; ?>px; border-top : 1px solid #D9D9D9;"></div>
	<div style="position:absolute; top:<?php echo $i*$hauteur_heure+$hauteur_heure/2; ?>px; width:<?php echo $largeur_gauche + $largeur_jour*7; ?>px; border-top : 1px dotted #D9D9D9;"></div>
	
	
	<span style="position:absolute; text-align: right; width: <?php echo $largeur_gauche; ?>px; top:<?php echo $i*$hauteur_heure; ?>px;"><?php echo $i; ?>:00</span>
	<?php
//$minutes = $minutes + 30;



}

	// Affichage des lignes verticales
	for ($j=0 ; $j < 7; $j++)
	{
		?>
		<div style="position:absolute; height: <?php echo 24*$hauteur_heure; ?>px; top:0px; left:<?php echo $largeur_gauche + $largeur_jour*$j; ?>px; width:<?php echo $largeur_jour; ?>px; border-left : 1px solid #D9D9D9;"></div>
		<?php
	}	
	
$q = mysql_query("SELECT *, DATEDIFF(date,CURDATE()) as diff FROM rdv");
while ($d = mysql_fetch_array($q) )
{
	$hd = $d["heuredeb"];
	$hf = $d["heurefin"];
	$top = (substr($hd,0,2)*60+substr($hd,3,5))/60*$hauteur_heure;
	$height = (substr($hf,0,2)*60+substr($hf,3,5))/60*$hauteur_heure - $top;
	$left = $largeur_gauche + $d["diff"]*$largeur_jour;
	?><div class="cliquable" onclick="alert('test');" style="position: absolute; top: <?php echo $top; ?>px; left: <?php echo $left; ?>px; width: <?php echo $largeur_jour; ?>px; height: <?php echo $height; ?>px; background-color: red;"><?php echo $d["commentaire"]; ?></div>
	<?php

}
?>
</div>



<?php
}
?>