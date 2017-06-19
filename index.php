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
        
        <h1>M2L</h1>
		
		<div class="login-box ">
			<div class="box-header">
				<h2>Connexion</h2>
			</div>
			 <?php
            if(isset($erreur))
            {
                echo '<font color="red">'.$erreur."</font>";
            }
            ?>
			<form method="POST" action="">
			<label for="">Identifiant</label>
			<br/>
			<input type="text" name="identifiantt" placeholder="Identifiant"/>
			<br/>
			<label for="">Mot de passe</label>
			<br/>
			<input type="password" name="mdpp" placeholder="Mot de passe"/>
			<br/>
<!--			<input type="checkbox" name="rememberme" id="remember"/><label for="remember">Se souvenir de moi</label><br>-->
			
			<button type="submit" name="formconnexion" value="Se connecter">Valider</button>
			 </form><br>
         
          <a href="Views/mdp_oublie.php">mot de passe oublié?</a>
           <br>
           
		</div>
	</div>
    </body>
</html>