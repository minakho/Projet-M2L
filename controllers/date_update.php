<?php
require_once("../models/connexionbdd.php");
session_start();
//contient la date d'aujourd'hui
$date = date('Y-m-d');
//nouvelle année
$date1 = date('Y-01-01');
//remet les crédits à 15 si la nouvelle année est arrivée
if($date == $date1)
{
    $sql = "UPDATE salarie SET nbs_jour = 15 where id_s = :id_s";
    $reqdate = $bdd->prepare($sql);
    $reqdate->bindValue(":id_s", $_SESSION['id_s']);
    $reqdate->execute();

}
//enleve les formations dont les dates sont passées
$sql = "SELECT id_f, date_debut, date_fin FROM formation";
$formation_d = $bdd->prepare($sql);
$formation_d->execute();

while($row = $formation_d->fetch())
{
   
    if(($date >= $row['date_debut']) && ($date < $row['date_fin']))
    {
        $sql ="UPDATE formation SET etat_f = 'En cours' WHERE id_f = :id_f";
        $reqetat = $bdd->prepare($sql);
        $reqetat->bindValue(":id_f", $row['id_f']);
        $reqetat->execute();
    }
    if($date >= $row['date_fin'])
    {
        $sql ="UPDATE formation SET etat_f = 'Expirée' WHERE id_f = :id_f";
        $reqetat = $bdd->prepare($sql);
        $reqetat->bindValue(":id_f", $row['id_f']);
        $reqetat->execute();
    }
    if($date >= $row['date_fin'])
    {
        $sql ="UPDATE etat_formation SET Etat = 'Effectuée' WHERE id_f = :id_f AND id_s = :id_s";
        $reqetat = $bdd->prepare($sql);
        $reqetat->bindValue(":id_f", $row['id_f']);
        $reqetat->bindValue(":id_s", $_SESSION['id_s']);
        $reqetat->execute();
    }
    
}

//si la date de la formation validée par le chef est passé -> etat = effectué


if($_SESSION['chef'] == 1)
{
    header('Location: ../Views/Chef/chef_index.php');
}
else
{
    header('Location: ../Views/m2l.php');
}

?>