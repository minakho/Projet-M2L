<?php
session_start();
$bdd = new PDO('mysql:host=mysql-smichael.alwaysdata.net;dbname=smichael_sinakhobdd;charset=utf8', 'smichael', 'Mimimic95');

include_once('cookie.php');

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
            if(isset($_POST['rememberme'])){
                setcookie('user_id',$identifiantt,time()+365*24*3600,null,null,false,true);
                setcookie('password',$mdpp,time()+365*24*3600,null,null,false,true);
                
            }
           
            $userinfo = $requser->fetch();
            $_SESSION['id_s'] = $userinfo['id_s'];
            $_SESSION['identifiant'] = $userinfo['identifiant'];
            $_SESSION['mot_de_passe'] = $userinfo['mot_de_passe'];
            $_SESSION['chef'] = $userinfo['chef'];
            $_SESSION['admin'] = $userinfo['admin'];
            //rediriger vers le profil de la personne
            header('Location: controllers/date_update.php?id_s='.$_SESSION['id_s']);

            
            if($_SESSION['admin'] == 1){
                header('Location: Views/Admin/admin_index.php?id_s='.$_SESSION['id_s']);
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