<?php
require_once('../models/connexionbdd.php');
session_start();
//récupère les éléments concernés
$requser = $bdd->prepare('SELECT nbs_jour FROM salarie WHERE id_s = :id_s');
$requser->bindValue(":id_s",$_SESSION['id_s']);
$requser->execute();
$userinfo = $requser->fetch();

$reqcout = $bdd->prepare('SELECT cout, nb_place FROM formation WHERE id_f = :id_f');
$reqcout->bindValue(":id_f",$_GET['id_f']);
$reqcout->execute();
$coutinfo = $reqcout->fetch();

//s'il n'y a plus de place
if($coutinfo['nb_place'] == 0)
{
    //echo "plus de place";
    //header("refresh:5;url=../Views/liste_formation.php");
?>

<script type="text/javascript">
    alert("Plus de place !");
    window.location.href = "../Views/liste_formation.php";
</script>


<?php
}

//s'il n'y a plus de crédit
elseif($userinfo['nbs_jour'] == 0)
{
?>
<script type="text/javascript">
    alert("Plus de crédit !");
    window.location.href = "../Views/liste_formation.php";
</script>
<?php
}

//s'il n'y a pas assez de crédit
elseif($coutinfo['cout'] > $userinfo['nbs_jour'])
{
?>
<script type="text/javascript">
    alert("Pas assez de crédit !");
    window.location.href = "../Views/liste_formation.php";
</script>
<?php
}

//formation choisie passe en attente
elseif(isset($_GET['id_f']))
{
    $sql = "SELECT `id_f`,`Etat` FROM `etat_formation` WHERE `id_s`= :id_s";
    $affichage = $bdd->prepare($sql);
    $affichage->bindValue(":id_s",$_SESSION['id_s']);
    $affichage->execute();
    $compte = 0;
    while ($data = $affichage->fetch())
    {
        if(($data['id_f'] == $_GET['id_f']) && (($data['Etat'] == "Attente") || ($data['Etat'] == "Validée")))
        {
            $compte++;
        }
    }

    if($compte != 0)
    {
?>
<script type="text/javascript">
    alert("Formation déjà en attente ou validée !");
    window.location.href = "../Views/liste_formation.php";
</script>
<?php
    }
    
    //soustrait les crédit à la réservation
    else
    {
        
        $cout = $userinfo['nbs_jour'] - $coutinfo['cout'];
        $sql = "UPDATE `salarie` SET `nbs_jour` = :cout WHERE `salarie`.`id_s` = :id_s";
        $newcredit = $bdd->prepare($sql);
        //bindValue : assignation des parametres 
        $newcredit->bindValue(":id_s",$_SESSION['id_s']);
        $newcredit->bindValue(":cout",$cout);
        $newcredit->execute();

        $sql1 = "INSERT INTO `etat_formation` (`id_etat`, `Etat`, `id_f`, `id_s`) VALUES (NULL, 'Attente', :id_f, :id_s)";
        $reqajout = $bdd->prepare($sql1);
        $reqajout->bindValue(":id_f",$_GET['id_f']);
        $reqajout->bindValue(":id_s",$_SESSION['id_s']);
        $reqajout->execute();
?>

<script type="text/javascript">
    alert("Demande envoyée");
    window.location.href = "../Views/liste_formation.php";
</script>
<?php
    }
}

?>