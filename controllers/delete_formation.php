<?php
require_once('../models/connexionbdd.php');
session_start();

if(isset($_GET['deleteF']) AND !empty($_GET['deleteF']))
{
    $deleteF = (int) $_GET['deleteF'];
    $req = $bdd->prepare("DELETE FROM `formation` WHERE `id_f` = ?");
    $req->execute(array($deleteF));
?>
<script type="text/javascript">
confirm("Etes-vous sûr de vouloir supprimer cette formation ?");
window.location.href = "../Views/Admin/admin_index.php";
</script>
<?php
}
?>