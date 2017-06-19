<?php
session_start();
require_once('../../models/connexionbdd.php');

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
                                <li ><a href="">Liste de formations</a></li>
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
            <h2>Liste de formation</h2>     
        </section>

        <section id="featuredBlog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="featuredBlog_area">
                            <div class="team_title">
                                <hr>
                                <h2>Liste de formations</h2><br><br>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="blog_sidebar">
                                    <!-- Start single side bar -->
                                    <div class="single_sidebar">
                                        <h2>S'abonner aux formations</h2><br>
                                        <div class="search">
                                            <form action="chef_formation.php" method="post"><input type="search" class="form-control" name="search" placeholder="rechercher">
                                            <button type="submit" class="btn-search" name="rechercher"><i class="fa fa-search" aria-hidden="true"></i></button>
                                            </form>
                                        </div>
                                        
                                        <ul class="small_catg similar_nav">
                                           
                                            <li>
                                                <div >
                                                    <div >
                                                        <table class="table table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th>Titre</th>
                                                                    <th>Cout</th>
                                                                    <th>Date début</th>
                                                                    <th>nombre places</th>
                                                                    <th>Contenu</th>
                                                                    <th>Détails</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                             <?php
                                                            $reponse = $bdd->query("SELECT * FROM formation WHERE etat_f ='Disponible'");
                                                    if(isset($_POST['rechercher']))
                                                    {
                                                        $sql1="SELECT id_f, titre, cout, date_debut, nb_place, contenu FROM formation WHERE etat_f ='Disponible' AND `titre` LIKE :search";
                                                        $req1= $bdd->prepare($sql1);
                                                        $req1->bindvalue(":search",'%'.$_POST['search'].'%');
                                                        $req1->execute();
                                                        
                                                         while ($row1 = $req1->fetch())
                                                        { ?>
                                                    <tr>
                                                        <td><?php echo $row1['titre']; ?></td>
                                                        <td><?php echo $row1['cout']; ?></td>
                                                        <td><?php echo $row1['date_debut']; ?></td>
                                                        <td><?php echo $row1['nb_place']; ?></td>
                                                        <td><?php echo $row1['contenu']; ?></td>
                                                        <td><a href="../detail_formation.php?id_f=<?php echo $row1['id_f']; ?>" class="read_more">Voir</a></td>
                                                        <td><a href="../../controllers/ajout_formation_chef.php?id_f=<?php echo $row1['id_f']; ?>"><button type="submit" class="bouton" name="abonner">s'abonner</button></a></td>
                                                    </tr>
                                                    
                                                     <a href="chef_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>"><h4>Retour à la liste</h4></a><br>

                                                    <?php
                                                    }

                                                    }
                                                    else{
                                                    
                                                     while ($row1 = $reponse->fetch())
                                                        { ?>
                                                    <tr>
                                                        <td><?php echo $row1['titre']; ?></td>
                                                        <td><?php echo $row1['cout']; ?></td>
                                                        <td><?php echo $row1['date_debut']; ?></td>
                                                        <td><?php echo $row1['nb_place']; ?></td>
                                                        <td><?php echo $row1['contenu']; ?></td>
                                                        <td><a href="../detail_formation.php?id_f=<?php echo $row1['id_f']; ?>" class="read_more">Voir</a></td>
                                                        <td><a href="../../controllers/ajout_formation_chef.php?id_f=<?php echo $row1['id_f']; ?>"><button type="submit" class="bouton" name="abonner">s'abonner</button></a></td>
                                                        
                                                    </tr>

                                                    <?php
                                                    }
                                                    }

                                                    ?>
                                                            </tbody>
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