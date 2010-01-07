<?php
if (isset($_SESSION["ses_projet"]))
{
	$jours = Array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
?>
<?php
	date_default_timezone_set('Europe/Paris');
	$hauteur_jour = 20;
	$hauteur_heure = 42;
	$largeur_gauche = 42;
	$largeur_jour = 130;
	
?>
<script type="text/javascript">
var xhr;
var nickok = false;
if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
else if (window.ActiveXObject) xhr = new ActiveXObject('Microsoft.XMLHTTP');
else alert('AJAX Error...');
function affichage(decalage) {
	xhr.open("GET", "ajax.php?a=affichage&d="+decalage, true);
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			document.getElementById("affichage").innerHTML = xhr.responseText;
		}
	}
	xhr.send(null);
}
</script>
<div id="affichage">
<?php 
$decalage = 0;
if (isset($_GET["d"]))
{
	$decalage = $_GET["d"]; 
}
echo "decalage : ".$decalage;
?><br />
<span class="cliquable" style="text-decoration: underline; color: blue;" onclick="affichage(<?php echo $decalage-1; ?>);">GAUCHE</span>
<span class="cliquable" style="text-decoration: underline; color: blue;" onclick="affichage(<?php echo $decalage+1; ?>);">DROITE</span>
<br /><br /><br /><br /><br />
<div style="position:relative; width: <?php echo $largeur_gauche + $largeur_jour*7; ?>px; bottom:20px;"><br />
<?php
	for ($i = 0; $i < 7; $i++)
	{
		$prochain_jour = time() + (($decalage+$i)*24*60*60);
		?>
		<span style="position:absolute; left: <?php echo $largeur_gauche+$i*$largeur_jour; ?>px;"><?php 
		$n = (date("N")-1+$i+$decalage)%7;
		while ($n < 0) { $n += 7; }
		echo $jours[$n] . " : " . date("d/m",$prochain_jour); ?></span><?php
	}
?>
</div>


<div id="grille" style="border:1px solid black; height: 500px; overflow-y:scroll; position: relative;">
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
	$h = date("Hi");
	$top = (substr($h,0,2)*60+substr($h,2,4))/60*$hauteur_heure;
	
	
	
	// marche pas �a , � voir
	?>
	<script type="text/javascript">
		document.getElementById("grille").scrollX.value = 500;
	</script>
	<div style="position:absolute; top:<?php echo $top; ?>px; left:0px; width:500px; border-top : 2px solid #FF8080;"></div>
	
	<?php

	// CURDATE() mais avec $decalage....
$q = mysql_query("SELECT *, DATEDIFF(date,CURDATE() + interval ".$decalage." day) as diff FROM rdv WHERE id_projet_posseder = ".$_SESSION["ses_projet"]);
while ($d = mysql_fetch_array($q) )
{
	$diff = $d["diff"];
	// On affiche que les RDV de cette semaine la.
	if ($diff >= 0 && $diff < 7)
	{
		$hd = $d["heuredeb"];
		$hf = $d["heurefin"];
		$top = (substr($hd,0,2)*60+substr($hd,3,5))/60*$hauteur_heure;
		$height = (substr($hf,0,2)*60+substr($hf,3,5))/60*$hauteur_heure - $top;
		
		$left = $largeur_gauche + $d["diff"]*$largeur_jour;
		
		?><div class="cliquable" onclick="document.location.href='rdv.php?rdv=<?php echo $d["id"]; ?>';" style="position: absolute; top: <?php echo $top; ?>px; left: <?php echo $left; ?>px; width: <?php echo $largeur_jour; ?>px; height: <?php echo $height; ?>px; padding: 4px; border: 1px solid black; background-color: #CCCCFF;"><?php echo $d["commentaire"]; ?></div>
		<?php
	}
}
?>
</div>
</div>
<?php

}
else
{
echo "faudrait peut etre choisir un projet pour afficher la grille...";
}
?>
