<?php

if(!isset($_SESSION['id_s']) AND isset($_COOKIE['user_id'],$_COOKIE['password']) AND !empty($_COOKIE['user_id']) AND !empty($_COOKIE['password']))
{
     $requser = $bdd->prepare("SELECT * FROM salarie WHERE identifiant = ? AND mot_de_passe = ?");
        $requser->execute(array($_COOKIE['user_id'], $_COOKIE['password']));
        $userexist = $requser->rowCount();

        if($userexist == 1)
        {
            
            $userinfo = $requser->fetch();
            $_SESSION['id_s'] = $userinfo['id_s'];
            $_SESSION['identifiant'] = $userinfo['identifiant'];
            $_SESSION['mot_de_passe'] = $userinfo['mot_de_passe'];
            $_SESSION['chef'] = $userinfo['chef'];
            $_SESSION['admin'] = $userinfo['admin'];
        }
}

?>