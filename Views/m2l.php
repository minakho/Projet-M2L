<?php
session_start();
include('../models/connexionbdd.php');

if(isset($_GET['id_s']) AND $_GET['id_s'] > 0)
{
    $getid_s = intval($_GET['id_s']);
    $requser = $bdd->prepare('SELECT * FROM salarie WHERE id_s = ?');
    $requser->execute(array($getid_s));
    $userinfo = $requser->fetch();
    if($_SESSION['id_s'] == $_GET['id_s']){
?>
<?php include('header.php'); ?>
    <body>
        
        <!-- start navbar -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
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
                                <li ><a href="">Historique de formations</a></li>             
                            </ul>
                        </li>
                        <li><a href="contact.php?id_s=<?php echo $_SESSION['id_s']; ?>">Contact</a></li>
                        <li><a href=""><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $userinfo['nbs_jour']; ?> </a></li>
                        <?php
                            if(isset($_SESSION['id_s']) AND $userinfo['id_s'] == $_SESSION['id_s'])
                            {
                            ?>
                           
                            <li> <a href="../controllers/deconnexion.php"> se deconnecter</a></li>       
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

        <!-- start featured blog area -->
        <section id="featuredBlog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="featuredBlog_area">
                            
                            <!-- start featured blog -->
                            <div class="featured_blog">
                                <h2>Mes Formations</h2><hr>
                                <div class="row">

                                    <!-- start single featured blog -->
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="single_featured_blog">               
                                            <img alt="img" src="../img/jquery.gif">
                                            <h2>JQuery - formation deux semaines </h2><br>
                                            <p>Présentation de jQuery : objectifs, alternatives...
                                                Cas d'utilisation, exemples de sites 
                                                Principes spécifiques et astuces 
                                                Cohabitation avec d'autres frameworks</p>

                                        </div>
                                    </div>
                                    <!-- start single featured blog -->
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="single_featured_blog">                      
                                            <img alt="img" src="../img/php.png">
                                            <h2>PHP - formation une semaine </h2><br>
                                            <p>PHP est devenu un langage de programmation incontournable pour tous les webmasters ou informaticiens de PME gérant des sites Web, sites E-Commerce ou Intranet de gestion.</p>

                                        </div>
                                    </div>
                                    <!-- start single featured blog -->
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="single_featured_blog">                      
                                            <img alt="img" src="../img/HTML5_Logo_512.png">
                                            <h2>HTML - formation 1 semaine</h2><br>
                                            <p>Spécifications HTML : historique et évolutions
                                                Vision HTML 5 et contextes d'utilisation</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End featured blog area -->
<?php include('footer.php'); ?>
<?php
    }
}
else
{
    
}
?>