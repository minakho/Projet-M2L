<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=m2l;charset=utf8', 'root', '');

if(isset($_GET['id_s']) AND $_GET['id_s'] > 0)
{
    $getid_s = intval($_GET['id_s']);
    $requser = $bdd->prepare('SELECT * FROM salarie WHERE id_s = ?');
    $requser->execute(array($getid_s));
    $userinfo = $requser->fetch();
    if($_SESSION['id_s'] == $_GET['id_s']){
?>
<?php include ('chef_header.php'); ?>
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
                        <li ><a href="chef_index.php?id_s=<?php echo $_SESSION['id_s']; ?>">Accueil</a></li>
                        <li class="dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formations <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li ><a href="chef_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>">Liste de formations</a></li>
                                <li ><a href="">Historique de formations</a></li>             
                            </ul>
                        </li>  
                        
                        <li><a href="chef_contact.php?id_s=<?php echo $_SESSION['id_s']; ?>">Contact</a></li>
                        <li><a href=""><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $userinfo['nbs_jour']; ?></a></li>                    
                        <?php
                            if(isset($_SESSION['id_s']) AND $userinfo['id_s'] == $_SESSION['id_s'])
                            {
                            ?>
                            <li> <a href="../../controllers/deconnexion.php"> se deconnecter</a></li>       
                            <?php  
                            }
                            ?>                  
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- End navbar -->
         <section id="imgbanner">  
            <h2>Historique de formation</h2>     
        </section>

        <section id="featuredBlog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="featuredBlog_area">
                            <div class="team_title">
                                <hr>
                                <h2>Historique</h2><br><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="blog_sidebar">
                                    <!-- Start single side bar -->
                                    <div class="single_sidebar">
                                        <h2>Historique de formation</h2><br>
                                        <ul class="small_catg similar_nav">
                                           
                                            <li>
                                                <div >
                                                    <div >
                                                        
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
}
else
{
    
}
?>