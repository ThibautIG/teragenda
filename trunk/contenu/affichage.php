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
<div style="position:relative; width: <?php echo $largeur_gauche + $largeur_jour*7; ?>px; bottom:20px;"><br />
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


