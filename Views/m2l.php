<?php
session_start();
require_once('../models/connexionbdd.php');
include_once('../controllers/cookie.php');

$sql1 = "SELECT `titre`,`cout`,`date_debut`,`nb_place`,`contenu`,`Etat` FROM `etat_formation`e,`formation`f WHERE e.id_f = f.id_f AND `Etat`= 'Validée' AND `id_s`= :id_s";
$etat1 = $bdd->prepare($sql1);
$etat1->bindValue(":id_s",$_SESSION['id_s']);
$etat1->execute();

$sql = "SELECT `id_f` FROM `etat_formation` WHERE `id_s`= :id_s";
$affichage = $bdd->prepare($sql);
$affichage->bindValue(":id_s",$_SESSION['id_s']);
$affichage->execute();
$data = $affichage->fetch();

if(isset($_SESSION['id_s']))
{
    $requser = $bdd->prepare('SELECT * FROM salarie WHERE id_s = :id_s');
    $requser->bindValue(":id_s",$_SESSION['id_s']);
    $requser->execute();
    $userinfo = $requser->fetch();
?>
<?php include('header.php'); ?>
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
                    <li class="active"><a href="m2l.php?id_s=<?php echo $_SESSION['id_s']; ?>">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formations <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li ><a href="liste_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>">Liste de formations</a></li>
                            <li ><a href="historique.php?id_s=<?php echo $_SESSION['id_s']; ?>">Historique de formations</a></li>             
                        </ul>
                    </li>
                    <li><a href="contact.php?id_s=<?php echo $_SESSION['id_s']; ?>">Contact</a></li>
                    <li><a href=""><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $userinfo['nbs_jour']; ?> </a></li>
                    <?php
                                           if(isset($_SESSION['id_s']) AND $userinfo['id_s'] == $_SESSION['id_s'])
                                           {
                    ?>

                    <li> <a href="../deconnexion.php"> se deconnecter</a></li>       
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
            <h2>Formations sportives </h2>
            <p>Réservez des formations sportives.</p>
          </div>
          <ul class="service_nav wow flipInX">
            <li>
              <a class="service_icon" href="#"><i class="fa fa-list-alt" aria-hidden="true"></i></a>
              <h2>Réservation de formation</h2>
              <p>La Maison des Ligues vous propose des formations sportives. Celles-ci sont accessibles vers <a href="liste_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>" style="color:#06d0d8;">la liste de formations</a>.</p>
              
            </li>
           <li>
              <a class="service_icon" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <h2>Historique de formation</h2>
              <p>Vous pouvez accéder à l'historique des formations qui vous ont été validées par votre chef d'équipe. L'historique est accessible vers <a href="historique.php?id_s=<?php echo $_SESSION['id_s']; ?>" style="color:#06d0d8;"> l'historique des formations</a></p>
              
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
                            <h2>Mes formations</h2><br><br>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="blog_sidebar">
                                <!-- Start single side bar -->
                                <div class="single_sidebar">
                                    <h2>Formations validées </h2><br>
                                    <ul class="small_catg similar_nav">
                                        <li>
                                            <div >
                                                <div >
                                                    <table class="table table-condensed">

                                                        <tr>
                                                            <th>Titre de formation</th>
                                                            <th>cout</th>
                                                            <th>date début</th>
                                                            <th>nombre de place</th>
                                                            <th>Contenu</th>

                                                        </tr>
                                                        <?php 
                                                        while ($row1 = $etat1->fetch())
                                                        { ?>
                                                        <tr>
                                                            <td><?php echo $row1['titre']; ?></td>
                                                            <td><?php echo $row1['cout']; ?></td>
                                                            <td><?php echo $row1['date_debut']; ?></td>
                                                            <td><?php echo $row1['nb_place']; ?></td>
                                                            <td><?php echo $row1['contenu']; ?></td>
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
     
      <!-- start Our Team area -->
 
  <!-- End Our Team area -->
    <!-- End featured blog area -->
    <?php include('footer.php'); ?>
    <?php
                                          }

else
{

}
    ?>