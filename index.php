<?php
require_once('controllers/connexion.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
		
		<div class="login-box ">
			<div class="box-header">
				<h2>Connexion</h2>
			</div>
			<form method="POST" action="">
			<label for="">Identifiant</label>
			<br/>
			<input type="text" name="identifiantt" placeholder="Identifiant"/>
			<br/>
			<label for="">Mot de passe</label>
			<br/>
			<input type="password" name="mdpp" placeholder="Mot de passe"/>
			<br/><br>
			<button type="submit" name="formconnexion" value="Se connecter">Valider</button>
			 </form><br>
          <a href="Views/contactmail.php">mot de passe oublié?</a>
           <br>
            <?php
            if(isset($erreur))
            {
                echo '<font color="red">'.$erreur."</font>";
            }
            ?>
		</div>
	</div>
    </body>
</html>