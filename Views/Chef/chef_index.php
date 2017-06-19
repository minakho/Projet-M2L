<?php
session_start();
require_once('../../models/connexionbdd.php');

$sql3 = "SELECT * FROM salarie";
$etat3 = $bdd->prepare($sql3);
$etat3->execute();

$sql = "SELECT s.id_s, f.id_f, id_etat, Etat, titre, date_debut, nom, prenom FROM `etat_formation` e, `formation` f, `salarie` s WHERE `Etat`= 'Attente' AND e.id_f = f.id_f AND e.id_s = s.id_s";
$etat = $bdd->prepare($sql);
$etat->execute();

$sql1 = "SELECT Etat, titre, date_debut, nom, prenom FROM `etat_formation` e, `formation` f, `salarie` s WHERE `Etat`= 'Validée' AND e.id_f = f.id_f AND e.id_s = s.id_s";
$etat1 = $bdd->prepare($sql1);
$etat1->execute();

$sql2 = "SELECT Etat, titre, date_debut, nom, prenom FROM `etat_formation` e, `formation` f, `salarie` s WHERE `Etat`= 'Refusé' AND e.id_f = f.id_f AND e.id_s = s.id_s";
$etat2 = $bdd->prepare($sql2);
$etat2->execute();

$sql4 = "SELECT Etat, titre, date_debut, nom, prenom FROM `etat_formation` e, `formation` f, `salarie` s WHERE `Etat`= 'Effectuée' AND e.id_f = f.id_f AND e.id_s = s.id_s";
$etat4 = $bdd->prepare($sql4);
$etat4->execute();

if(isset($_SESSION['id_s']))
{
    $requser = $bdd->prepare('SELECT * FROM salarie WHERE id_s = :id_s');
    $requser->bindValue(":id_s",$_SESSION['id_s']);
    $requser->execute();
    $userinfo = $requser->fetch();
    
?>

<?php include ('chef_header.php') ?>
<body>

    <!-- start navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
               <div class="welcome">Bonjour <span><?php echo $_SESSION['identifiant']; ?></span></div>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="m2l.php">M2<span>L</span></a>
                <!-- <a class="navbar-brand" href="index.html"><img src="img/logo.png" alt="logo"></a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse navbar_area">          
                <ul class="nav navbar-nav navbar-right custom_nav">
                    <li class="active"><a href="chef_index.php?id_s=<?php echo $_SESSION['id_s']; ?>">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formations <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li ><a href="chef_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>">Liste de formations</a></li>
                            <li ><a href="chef_historique.php?id_s=<?php echo $_SESSION['id_s']; ?>">Historique de formations</a></li>             
                        </ul>
                    </li>  
                    <li><a href="chef_contact.php?id_s=<?php echo $_SESSION['id_s']; ?>">Contact</a></li> 
                    <li><a href=""><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $userinfo['nbs_jour']; ?></a></li>
                    <?php
                                           if(isset($_SESSION['id_s']) AND $userinfo['id_s'] == $_SESSION['id_s'])
                                           {
                    ?>

                    <li> <a href="../../deconnexion.php"> se deconnecter</a></li>       
                    <?php  
                                           }
                    ?>                   
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <!-- End navbar -->

    <section id="imgbanner">  
        <h2>Accueil</h2>     
    </section>
    
     <section id="service">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="service_area">
          <div class="service_title">
            <hr>
            <h2>Chef d'équipe </h2>
            <p>gestion des formations pour le chef d’équipe.</p>
          </div>
          <ul class="service_nav wow flipInX">
            <li>
              <a class="service_icon" href="#"><i class="fa fa-check-circle" aria-hidden="true"></i></a>
              <h2>Validation de formaion </h2>
              <p>Le chef d'équipe a la possibilité de valiser les formations de ses employé(e)s</p>
              
            </li>
           <li>
              <a class="service_icon" href="#"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
              <h2>Réservation de formation</h2>
              <p>Le chef d’équipe a les mêmes droits aux formations que les autres employé(e)s de la Maison des Ligues. Les offres de formations sont accessibles vers <a href="chef_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>" style="color:#06d0d8;">la liste de formations</a>.</p>
              
            </li>
           
          </ul>
        </div>
      </div>
    </div>
  </section>

    <section id="featuredBlog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="featuredBlog_area">
                        <div class="team_title">
                            <hr>
                            <h2>Détails</h2><br><br>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="blog_sidebar">
                                <!-- Start single side bar -->
                                <div class="single_sidebar">
                                    <h2>Validation des formations</h2><br>
                                    <h3>Formations en attente</h3>
                                    <ul class="small_catg similar_nav">
                                        <li>
                                            <div >
                                                <div >
                                                    <table class="table table-condensed" id="table">
                                                        <tr>
                                                            <th>Etat</th>
                                                            <th>titre</th>
                                                            <th>Nom du salarié</th>
                                                            <th>Prénom du salarié</th>
                                                            <th>Valider</th>
                                                            <th>Refusé</th>
                                                        </tr>
                                                        <?php while ($row = $etat->fetch()){ ?>
                                                        <tr>
                                                            <td><?php echo $row['Etat']; ?></td>
                                                            <td><?php echo $row['titre']; ?></td>
                                                            <td><?php echo $row['nom']; ?></td>
                                                            <td><?php echo $row['prenom']; ?></td>
                                                            <td><a href="../../controllers/valider_formation.php?id_etat=<?php echo $row['id_etat']; ?>&etat=Validée&id_f=<?php echo $row['id_f']; ?>"><i class="fa fa-check fa-2x check" aria-hidden="true"></i></a></td>
                                                            <td><a href="../../controllers/valider_formation.php?id_etat=<?php echo $row['id_etat']; ?>&etat=Refusé&id_s=<?php echo $row['id_s']; ?>&id_f=<?php echo $row['id_f']; ?>"><i class="fa fa-times cross fa-2x" aria-hidden="true"></i></a></td>
                                                        </tr>
                                                        <?php
                                                                                           } 
                                                

                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>                    
                                    </ul>
                                    
<!--                                    VALIDEE-->
                                    <h3>Formation Validées</h3><br>
                                    <ul class="small_catg similar_nav">
                                        <li>
                                            <div >
                                                <div >
                                                    <table class="table table-condensed">
                                                        <tr>
                                                            <th>Etat</th>
                                                            <th>Titre</th>
                                                            <th>Date</th>
                                                            <th>Nom du salarie</th>
                                                            <th>Prénom du salarie</th>
                                                        </tr>
                                                        <?php while ($row1 = $etat1->fetch()){ ?>
                                                        <tr>
                                                            <td><?php echo '<font color="green"><strong>'.$row1['Etat'];'</strong></font>' ?></td>
                                                            <td><?php echo $row1['titre']; ?></td>
                                                            <td><?php echo $row1['date_debut']; ?></td>
                                                            <td><?php echo $row1['nom']; ?></td>
                                                            <td><?php echo $row1['prenom']; ?></td>
                                                        </tr>
                                                        <?php
                                                                                             } 

                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>                    
                                    </ul>
                                    
<!--                                    REFUSEE-->
                                    <h3>Formation Refusées</h3><br>
                                    <ul class="small_catg similar_nav">
                                        <li>
                                            <div >
                                                <div >
                                                    <table class="table table-condensed">
                                                        <tr>
                                                            <th>Etat</th>
                                                            <th>titre</th>
                                                            <th>Date</th>
                                                            <th>nom du salarié</th>
                                                            <th>prénom du salarié</th>
                                                        </tr>
                                                        <?php while ($row2 = $etat2->fetch()){ ?>
                                                        <tr>
                                                            <td><?php echo '<font color="red"><strong>'.$row2['Etat'];'</strong></font>' ?></td>
                                                            <td><?php echo $row2['titre']; ?></td>
                                                            <td><?php echo $row2['date_debut']; ?></td>
                                                            <td><?php echo $row2['nom']; ?></td>
                                                            <td><?php echo $row2['prenom']; ?></td>
                                                        </tr>
                                                        <?php
                                                                                             } 

                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>                    
                                    </ul>
                                    
<!--                                    EFFECTUEE-->
                                    <h3>Formations Effectuées</h3><br>
                                    <ul class="small_catg similar_nav">
                                        <li>
                                            <div >
                                                <div >
                                                    <table class="table table-condensed">
                                                        <tr>
                                                            <th>Etat</th>
                                                            <th>titre</th>
                                                            <th>Date</th>
                                                            <th>nom du salarié</th>
                                                            <th>prénom du salarié</th>
                                                        </tr>
                                                        <?php while ($row4 = $etat4->fetch()){ ?>
                                                        <tr>
                                                            <td><?php echo '<font color="#06d0d8"><strong>'.$row4['Etat'];'</strong></font>' ?></td>
                                                            <td><?php echo $row4['titre']; ?></td>
                                                            <td><?php echo $row4['date_debut']; ?></td>
                                                            <td><?php echo $row4['nom']; ?></td>
                                                            <td><?php echo $row4['prenom']; ?></td>
                                                        </tr>
                                                        <?php
                                                                                             } 

                                                        ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </li>                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include ('chef_footer.php'); ?>
    <?php                             
}
else
{

}
    ?>