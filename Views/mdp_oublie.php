<?php
require_once('../controllers/connexion.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="../css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
		
		<div class="login-box ">
			<div class="box-header">
				<h2>Vérification mail</h2>
			</div>
			<form method="POST" action="">
			<label for="">Mail</label>
			<br/>
			<input type="email" name="mail_recup" placeholder="Votre adresse mail"/>
			<br/>
			
			<button type="submit" name="formconnexion" value="Se connecter">Valider</button>
			 </form>
         
        
           
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
