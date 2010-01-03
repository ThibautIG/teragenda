<?php
$ok = false;
$form = false;


if (isset($_POST["pseudo"]))
{
	$form = true;
	$pseudo = mysql_real_escape_string($_POST["pseudo"]);
	
	$pass = md5("teragenda".$_POST["pass"]);
	$passconf = md5("teragenda".$_POST["passconf"]);
	$email = mysql_real_escape_string($_POST["email"]);
	
	if ($pass == $passconf && strlen($_POST["pass"]) > 0 && preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']))
	{
		$ok = mysql_query("INSERT INTO comptes(pseudo,mdp,mail) VALUES('".$pseudo."','".$pass."','".$email."')",$sql);
	}
}
if ($ok)
{
	echo "Compte cr&eacute;&eacute;.";
}
else
{
	if ($form)
	{
		echo "Erreur";
	}
}
?>
<h1>Cr&eacute;ation de compte</h1>
Pour cr&eacute;er un compte, veuillez remplir les champs ci-dessous.
<form method="post" action="">
	<table>
		<tr><td><label>Pseudo</label></td><td><input type="text" name="pseudo" /></td></tr>
		<tr><td><label>Mot de passe</label></td><td><input type="password" name="pass" /></td></tr>
		<tr><td><label>Confirmation</label></td><td><input type="password" name="passconf" /></td></tr>
		<tr><td><label>Email</label></td><td><input type="text" name="email" /></td></tr>
	</table>
	<p style="text-align: center;">
		<input type="submit" value="Envoyer"/><input type="reset" value="Effacer"/>
	</p>
</form>
