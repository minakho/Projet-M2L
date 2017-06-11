<?php
require_once('../models/connexionbdd.php');



if(isset($_GET['etat'])&&($_GET['etat']==="Validée"))
{
    $sql = "UPDATE `etat_formation` SET `Etat` = 'Validée' WHERE `etat_formation`.`id_etat` = :id_etat";
    $validation = $bdd->prepare($sql);
    //bindValue : assignation des parametres 
    $validation->bindValue(":id_etat",$_GET["id_etat"]);
    $validation->execute();

    $reqplace = $bdd->prepare('SELECT nb_place FROM formation WHERE id_f = :id_f');
    $reqplace->bindValue(":id_f",$_GET['id_f']);
    $reqplace->execute();
    $place = $reqplace->fetch();
    $newplace = $place['nb_place'];
    $newplace--;

    $sql = "UPDATE `formation` SET `nb_place` = :newplace WHERE `formation`.`id_f` = :id_f";
    $reqplace = $bdd->prepare($sql);
    $reqplace->bindValue(":id_f",$_GET['id_f']);
    $reqplace->bindValue(":newplace",$newplace);
    $reqplace->execute();

    header('Location:../Views/Chef/chef_index.php#table');
}
elseif(isset($_GET['etat'])&&($_GET['etat']==="Refusé"))
{
    $requser = $bdd->prepare('SELECT nbs_jour FROM salarie WHERE id_s = :id_s');
    $requser->bindValue(":id_s",$_GET['id_s']);
    $requser->execute();
    $userinfo = $requser->fetch();

    $reqcout = $bdd->prepare('SELECT cout, nb_place FROM formation WHERE id_f = :id_f');
    $reqcout->bindValue(":id_f",$_GET['id_f']);
    $reqcout->execute();
    $coutinfo = $reqcout->fetch();

    $cout = $userinfo['nbs_jour'] + $coutinfo['cout'];
    $sql = "UPDATE `salarie` SET `nbs_jour` = :cout WHERE `salarie`.`id_s` = :id_s";
    $newcredit = $bdd->prepare($sql);
    //bindValue : assignation des parametres 
    $newcredit->bindValue(":id_s",$_GET['id_s']);
    $newcredit->bindValue(":cout",$cout);
    $newcredit->execute();

    $sql = "UPDATE `etat_formation` SET `Etat` = 'Refusé' WHERE `etat_formation`.`id_etat` = :id_etat";
    $validation = $bdd->prepare($sql);
    //bindValue : assignation des parametres 
    $validation->bindValue(":id_etat",$_GET["id_etat"]);
    $validation->execute();
    header('Location:../Views/Chef/chef_index.php#table');

}
?>