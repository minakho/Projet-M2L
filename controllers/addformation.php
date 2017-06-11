<?php
$bdd = new PDO('mysql:host=localhost;dbname=m2l;charset=utf8', 'root', '');
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
    
    $datef = new DateTime($date);
    $datef->add(new DateInterval('P'.$cout.'D'));
    $fin = $datef->format('Y-m-d');
    

    if(!empty($_POST['titre']) AND !empty($_POST['cout']) AND !empty($_POST['date']) AND !empty($_POST['place']) AND !empty($_POST['contenu']))
    {
         

        $insertform = $bdd->prepare("INSERT INTO `adresse` (`id_a`, `ville`, `rue`, `numero_rue`,`code_postal`) VALUES (NULL, :ville, :rue , :numrue , :cp);
        ");
    
        $insertform->bindValue(':ville',$ville);
        $insertform->bindValue(':rue',$rue);
        $insertform->bindValue(':numrue',$numrue);
        $insertform->bindValue(':cp',$cp);
        $insertform->execute();
        $id_a = $bdd->lastInsertId();
        

        $insertform2 = $bdd->prepare("INSERT INTO `formation` (`id_f`, `titre`, `cout`, `date_debut`,`date_fin`, `nb_place`, `contenu`, `id_a`, `id_p`, `etat_f`) VALUES (NULL, :titre, :cout , :debut , :fin , :place , :contenu, :id_a, NULL, 'Disponible');");
        
        $insertform2->bindValue(':titre',$titre);
        $insertform2->bindValue(':cout',$cout);
        $insertform2->bindValue(':debut',$date);
        $insertform2->bindValue(':fin',$fin);
        $insertform2->bindValue(':place',$place);
        $insertform2->bindValue(':contenu',$contenu);
        $insertform2->bindValue(':id_a',$id_a);
        $insertform2->execute();
        

        header('Location: ../Admin/admin_index.php');
    }
    else
    {
        $erreur = "Tous les champs doivent etre complétés";
    }
}
?>