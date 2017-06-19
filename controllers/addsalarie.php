<?php
$bdd = new PDO('mysql:host=mysql-smichael.alwaysdata.net;dbname=smichael_sinakhobdd;charset=utf8', 'smichael', 'Mimimic95');
if(isset($_POST['adduser']))
{
    //htmlspecialchars pour empecher les injections de code
    $nom = htmlentities($_POST['nom']);
    $prenom =  htmlentities($_POST['prenom']);
    $Email =  htmlentities($_POST['Email']);
    $identifiant =  htmlentities($_POST['identifiant']);
    $mdp = sha1($_POST['mdp']);
    $credit = $_POST['credit'];
    $titre =  $_POST['titre'];


    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['Email']) AND !empty($_POST['identifiant']) AND !empty($_POST['mdp']))
    {


        //control par expression reguliere
        if(preg_match("/^([a-zA-ZéèàçêëïöüäËÄÏÖ ]{2,15})*$/", $_POST['nom']))
        {



            if(preg_match("/^([a-zA-Z'àâéèëäêôùûïîçÀÏÂÉÈÔÙÛÇ[:blank:]-]{2,15})$/", $_POST['prenom']))
            {



                if(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))
                {


                    if(preg_match("/^[0-9a-zA-Z_]{5,}$/", $_POST['identifiant']))
                    {


                        if(preg_match("/^.*(?=.{5,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/", $_POST['mdp']))
                        {
                            $insertform = $bdd->prepare("INSERT INTO `salarie` (`id_s`, `nom`, `prenom`, `Email`, `identifiant`, `mot_de_passe`, `nbs_jour`, `id_a`, `chef`, `admin`) VALUES (NULL, :nom, :prenom, :Email, :identifiant, :mdp, :credit, NULL, :titre, '0')");
                            $insertform->bindValue(':nom',$nom); 
                            $insertform->bindValue(':prenom',$prenom);
                            $insertform->bindValue(':Email',$Email);
                            $insertform->bindValue(':identifiant',$identifiant);
                            $insertform->bindValue(':mdp',$mdp);
                            $insertform->bindValue(':credit',$credit);
                            $insertform->bindValue(':titre',$titre);
                            $insertform->execute();
                            header('Location: ../Admin/admin_index.php#about-2');
                        }
                        else
                        {
                            $erreur2 = "Le mot de passe doit contrenir au moins 5 caractere et comprendre une minuscule et une majuscule";
                        }

                    }
                    else
                    {
                        $erreur2 = "L'identifiant doit contenir au moins 5 caractères";
                    }

                }
                else{
                    $erreur2 = "Mail non valide";
                }
            }
            else{
                $erreur2 ="Prénom non valide";
            }
        }
        else{
            $erreur2 ="Nom non valide";
        }
    }
    else
    {
        $erreur2 = "Tous les champs doivent etre complétés";
    }
}
?>