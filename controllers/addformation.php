<?php
$bdd = new PDO('mysql:host=mysql-smichael.alwaysdata.net;dbname=smichael_sinakhobdd;charset=utf8', 'smichael', 'Mimimic95');


if(isset($_POST['addform']))
{
    //htmlspecialchars pour empecher les injections de code
    $titre = htmlentities($_POST['titre']);
    $cout =  htmlentities($_POST['cout']);
    $date =  htmlentities($_POST['date']);
    $place =  htmlentities($_POST['place']);
    $contenu =  htmlentities($_POST['contenu']);
    $ville = htmlentities($_POST['ville']);
    $rue = htmlentities($_POST['rue']);
    $numrue = htmlentities($_POST['numrue']);
    $cp = htmlentities($_POST['cp']);
    $presta = htmlentities($_POST['presta']);
    $datef = new DateTime($date);
    $datef->add(new DateInterval('P'.$cout.'D'));
    $fin = $datef->format('Y-m-d');
    $allowedExts = array("jpg", "jpeg", "png");
    $extension = pathinfo($_FILES["avatar"]['name'], PATHINFO_EXTENSION);


    if (((($_FILES["avatar"]["type"] == "image/jpeg") || ($_FILES["avatar"]["type"] == "image/jpg")) || ($_FILES["avatar"]["type"] == "image/png")) && ($_FILES["avatar"]["size"] < 2097152) && in_array($extension, $allowedExts))
    {
        if ($_FILES["avatar"]["error"] > 0)
        {
            $erreur = "Pb d'image, return Code: " . $_FILES["avatar"]["error"] . "<br />";
        }
        else
        {
            if (file_exists("../../img/avatars/" . $_FILES["avatar"]["name"]))
            {
                $erreur = $_FILES["avatar"]["name"] . " already exists. ";
            }
            else
            {
                move_uploaded_file($_FILES["avatar"]["tmp_name"], "../../img/avatars/" . $_FILES["avatar"]["name"]);

                $img = $_FILES["avatar"]["name"];

            }
        }
    }
    else
    {
        $erreur = 'invalid file';

    }

    if(!empty($_POST['titre']) AND !empty($_POST['cout']) AND !empty($_POST['date']) AND !empty($_POST['place']) AND !empty($_POST['contenu']) AND !empty($_POST['numrue']) AND !empty($_POST['cp']) AND !empty($_POST['presta']) AND isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    {
        if(preg_match("/^[0-9]{1,2}$/", $_POST['cout']))
        {
            if(preg_match("/^[0-9]{1,2}$/", $_POST['place']))
            {
                if(preg_match("/^[0-9]{1,2}$/", $_POST['numrue']))
                {
                    if(preg_match("/^(([0-8][0-9])|(9[0-5]))[0-9]{3}$/", $_POST['cp']))
                    {

                        if(!isset($erreur))
                        {



                            $insertform = $bdd->prepare("INSERT INTO `adresse` (`id_a`, `ville`, `rue`, `numero_rue`,`code_postal`) VALUES (NULL, :ville, :rue , :numrue , :cp);");
                            $insertform->bindValue(':ville',$ville);
                            $insertform->bindValue(':rue',$rue);
                            $insertform->bindValue(':numrue',$numrue);
                            $insertform->bindValue(':cp',$cp);
                            $insertform->execute();
                            $id_a = $bdd->lastInsertId();

                            $insertform1 = $bdd->prepare("INSERT INTO `prestataire` (`id_p`, `raison_social`, `id_a`) VALUES (NULL, :presta, :id_a);");
                            $insertform1->bindValue(':presta',$presta);
                            $insertform1->bindValue(':id_a',$id_a);
                            $insertform1->execute();
                            $id_p = $bdd->lastInsertId();


                            $insertform2 = $bdd->prepare("INSERT INTO `formation` (`id_f`, `titre`, `cout`, `date_debut`,`date_fin`, `nb_place`, `contenu`, `id_a`, `id_p`, `etat_f`, `img`) VALUES (NULL, :titre, :cout , :debut , :fin , :place , :contenu, :id_a, :id_p, 'Disponible', :img);");

                            $insertform2->bindValue(':titre',$titre);
                            $insertform2->bindValue(':cout',$cout);
                            $insertform2->bindValue(':debut',$date);
                            $insertform2->bindValue(':fin',$fin);
                            $insertform2->bindValue(':place',$place);
                            $insertform2->bindValue(':contenu',$contenu);
                            $insertform2->bindValue(':id_a',$id_a);
                            $insertform2->bindValue(':id_p',$id_p);
                            $insertform2->bindValue(':img',$img);
                            $insertform2->execute();
                            header('Location: ../Admin/admin_index.php#contact-2');


                        }
                        else
                        {
                            $erreurimg = $erreur;


                        }

                    }
                    else{
                        $erreurcp = "Ce champ doit correspondre au type XXYYY";
                    }
                }
                else{
                    $erreurnum = "Ce champ ne doit contenir que des chiffres";
                }
            }
            else{
                $erreurplace = "Ce champ ne doit contenir que des chiffres";
            }
        }
        else{
            $erreurcout = "Ce champ ne doit contenir que des chiffres";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent etre complétés";
    }
}


?>