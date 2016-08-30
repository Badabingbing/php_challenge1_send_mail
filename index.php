<!DOCTYPE html>
<html>
<head>
	<title>Challenge 1 PHP</title>
	<meta charset="UTF-8">
</head>
<body>
	<h1>Envoyez un e-mail !</h1>
	<form method="post">
		Entrez votre adresse e-mail :
		<input type="text" name="adresse1"></input> <br>
	<?php
		if (!(filter_var($_POST["adresse1"], FILTER_VALIDATE_EMAIL)) AND isset($_POST['adresse1'])) {
			echo "Cette adresse n'est pas valide. Le format demandé est exemple@email.com";
		}

	?>	<br>
		Entrez l'adresse e-mail du ou des destinataire(s) :
		<input type="text" name="adresse2"></input> <br>

	<?php
		$decoupEmail = explode(", ", $_POST["adresse2"]); /* si plusieurs destinataires = vérifier chaque adresse */	
		foreach ($decoupEmail as $email) {
			if (!(filter_var($email, FILTER_VALIDATE_EMAIL)) AND isset($_POST["adresse2"])) {
			echo "Cette adresse n'est pas valide. Le format demandé est exemple@email.com";
			}
		}
		
		/*if (!(filter_var($_POST["adresse2"], FILTER_VALIDATE_EMAIL)) AND isset($_POST['adresse2'])) {
			echo "Cette adresse n'est pas valide. Le format demandé est exemple@email.com";
		}*/

	?>	<br>	
		Sujet du message : 		
		<input type="text" name="sujet"></input> <br>
		Message (limité à 500 caractères) : <br>	
		<textarea name="message" rows="8" cols="45" maxlength="500">
		</textarea> <br>
		<input type="submit" value="Envoyer l'e-mail"></input>
	</form>

<?php

	$headers = "From: " . $_POST["adresse1"];
	
	
	if ((filter_var($_POST["adresse1"], FILTER_VALIDATE_EMAIL))
		/*AND (filter_var($_POST["adresse2"], FILTER_VALIDATE_EMAIL))*/)
		 {
	mail($_POST["adresse2"], $_POST["sujet"], $_POST["message"], $headers);
	echo "Votre message a bien été envoyé.";
	}

	/*verif encore incomplète si plusieurs destinataires.
	Methode que j'emploierais => créer un array avec tous les éléments de $decoupEmail passés à la moulinette du filter_validate_email. Si in_array, on trouve false => l'email n'est pas envoyé. Ou on pourrait sans doute retirer la mauvaise adresse de l'array et envoyer à tous les autres destinataires.
	 */
?>	

</body>
</html>