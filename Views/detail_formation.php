<?php
session_start();
require_once('../models/connexionbdd.php');




if(isset($_SESSION['id_s']))
{
    $requser = $bdd->prepare('SELECT * FROM salarie WHERE id_s = :id_s');
    $requser->bindValue(":id_s",$_SESSION['id_s']);
    $requser->execute();
    $userinfo = $requser->fetch();

    if(isset($_GET['id_f']))
    {
        $reqform = $bdd->prepare('SELECT titre, cout, date_debut, nb_place, contenu, ville, rue, numero_rue, code_postal, raison_social, img FROM `formation` f, `adresse` a, `prestataire`p WHERE a.id_a = f.id_a AND id_f = :id_f AND p.id_p = f.id_p');
        $reqform->bindValue(":id_f",$_GET['id_f']);
        $reqform->execute();
        $formdetail = $reqform->fetch();
        

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


                    <li ><a href="m2l.php?id_s=<?php echo $_SESSION['id_s']; ?>">Accueil</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formations <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li ><a href="liste_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>">Liste de formations</a></li>
                            <li ><a href="historique.php?id_s=<?php echo $_SESSION['id_s']; ?>">Historique de formations</a></li>             
                        </ul>
                    </li> 
                    <li><a href="contact.php?id_s=<?php echo $_SESSION['id_s']; ?>">Contact</a></li>
                    <li><a href=""><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $userinfo['nbs_jour']; ?></a></li>
                    <?php
        if(isset($_SESSION['id_s']) AND $userinfo['id_s'] == $_SESSION['id_s'])
        {
                    ?>
                    <li><a href="../deconnexion.php"> se deconnecter</a></li>       
                    <?php
        }
                    ?>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <!-- End navbar -->


    <section id="imgbanner">  
        <h2>Details de la formation</h2>     
    </section>

    <section id="blogArchive">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="blogArchive_area">
                        <!-- start single archive post -->
                        <div class="single_archiveblog wow fadeInDown">
                            <div class="archiveblog_left">
                                
                                <p class="postdate">Durée de la formation: <?php echo $formdetail['cout']; ?> jours  </p>
                                <p class="postdate">Date de début : <br> <?php echo $formdetail['date_debut']; ?>  </p>
                                <p class="postdate">Places disponibles : <br> <?php echo $formdetail['nb_place']; ?>  </p>
                                <p class="postdate">Prestataire : <br> <?php echo $formdetail['raison_social']; ?>  </p>
                            </div>

                            <div class="archiveblog_right">
                                <h2><?php echo $formdetail['titre']; ?></h2>
                                <img src="../img/avatars/<?php echo $formdetail['img']; ?>" style="width:400px;height:230px;" alt="">
                                <div class="post_commentbox">
                                              
                                </div>
                                
                                 <h4>Lieux</h4>
                                 <p>Ville : <?php echo $formdetail['ville']; ?></p>
                                 <p>Rue : <?php echo $formdetail['rue']; ?></p>
                                 
                                 <h4>Description</h4>
                                <p><?php echo $formdetail['contenu']; ?></p>
                                
                               
                            </div>
                        </div>
                        <!-- End single archive post -->




                    </div>

                    </section>
                <!-- End image editing  -->

                <?php include('footer.php'); ?>
                <?php
    }
}
else
{

}
                ?>