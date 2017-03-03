<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=m2l', 'root','');

if(isset($_POST['formconnexion']))
{
    $identifiantt = htmlspecialchars($_POST['identifiantt']);
    $mdpp = sha1($_POST['mdpp']);
    
    if(!empty($identifiantt) AND !empty($mdpp))
    {
        //on voit si l'utilisateur existe bien donc on fait une requete sur l'utilisateur
        $requser = $bdd->prepare("SELECT * FROM salarie WHERE identifiant = ? AND mot_de_passe = ?");
        $requser->execute(array($identifiantt, $mdpp));
        $userexist = $requser->rowCount();

        if($userexist == 1)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id_s'] = $userinfo['id_s'];
            $_SESSION['identifiant'] = $userinfo['identifiant'];
            $_SESSION['mot_de_passe'] = $userinfo['mot_de_passe'];
            $_SESSION['chef'] = $userinfo['chef'];
            //rediriger vers le profil de la personne
            header('Location: Views/m2l.php?id_s='.$_SESSION['id_s']);

            if($_SESSION['chef'] == 1){
                $userinfo = $requser->fetch();
                header('Location: Views/Chef/chef_index.php?id_s='.$_SESSION['id_s']);
            }
        }
        else
        {
            $erreur = "Mauvais identifiant ou mot de passe !";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent etre complétés !";
    }
}
?>