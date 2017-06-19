<?php
require_once('../models/connexionbdd.php');
session_start();

if(isset($_GET['deleteU']) AND !empty($_GET['deleteU']))
{
    $deleteU = (int) $_GET['deleteU'];
    $req = $bdd->prepare("DELETE FROM `salarie` WHERE `id_s` = ?");
    $req->execute(array($deleteU));
?>
<script type="text/javascript">
confirm("Etes-vous sûr de vouloir supprimer ce compte ?");
window.location.href = "../Views/Admin/admin_index.php";
</script>
<?php
}
?>