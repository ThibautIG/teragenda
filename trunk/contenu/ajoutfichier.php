<?php
if (isset($_SESSION["ses_projet"]))
{
	if (isset($_POST["description"])) 
	{
		if ($_FILES['fichier']['error']) {
			switch ($_FILES['replay']['error']){
				case 1: // UPLOAD_ERR_INI_SIZE
				echo"Replay trop gros. (Server)";
				break;
				case 2: // UPLOAD_ERR_FORM_SIZE
				echo "Replay trop gros. (HTML)";
				break;
				case 3: // UPLOAD_ERR_PARTIAL
				echo "L'envoi du fichier a été interrompu pendant le transfert.";
				break;
				case 4: // UPLOAD_ERR_NO_FILE
				echo "Tu n'as pas envoyé de replay.";
				break;
			}
		}
		else
		{
			echo "fichier envoye";
			$nom = $_FILES['fichier']['name'];
			mysql_query("INSERT INTO fichiers(id_comptes_envoyer,id_projets_comprend,id_rdv_contenir,nom,description) VALUES('".$_SESSION['ses_id']."','".$_SESSION['ses_projet']."',1, '".$nom."', '".$_POST["description"]."')") or die("INSERT INTO fichiers : ".mysql_error());
			$lien = "fichiers/".$nom;
			move_uploaded_file($_FILES['fichier']['tmp_name'], $lien);
			chmod($lien, 0755);
		}
	}
}
?>
<form method="post" enctype="multipart/form-data" action="">
	<p>
		<label for="description">Description :</label><input type="text" name="description" id="description"></input><br />
		<label for="replay">Fichier :</label> <input type="file" name="fichier" id="fichier"><br />
		<input type="submit" value="Envoyer">
	</p>
</form>