<table>
<tr><th>Horaires</th>
	<th>Lundi</th>
	<th>Mardi</th>
	<th>Mercredi</th>
	<th>Jeudi</th>
	<th>Vendredi</th>
	<th>Samedi</th>
	<th>Dimanche</th></tr>
	
	<?php
	for ($i=0; $i < 30; $i++)
	{
		?>
		<tr><td><?php AfficheHoraires () ?></td><td></td><td></td><td></td><td></td><td></td><td></td><td>a</td></tr>
		<?php
	}
	?>
</table>
<div id="rdv1">mon RDV</div>
<div id="rdv2">mon RDV</div>
<script type="text/javascript">
document.getElementById("rdv1").style.top = 5;
document.getElementById("rdv1").innerHTML = "thomas";

</script>

<?php
function AfficheHoraires ()
{
	
}
?>

