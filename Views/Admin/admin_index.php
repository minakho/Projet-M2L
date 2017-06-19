<?php
session_start();
require_once('../../models/connexionbdd.php');
include('../../controllers/addformation.php');
include('../../controllers/addsalarie.php');


if(isset($_SESSION['id_s']))
{
    $requser = $bdd->prepare('SELECT * FROM salarie WHERE id_s = :id_s');
    $requser->bindValue(":id_s",$_SESSION['id_s']);
    $requser->execute();
    $userinfo = $requser->fetch();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ADMIN</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <meta name="description" content="Developed By M Abdur Rokib Promy">
        <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <!-- Theme style -->
        <link href="../../css/style2.css" rel="stylesheet" type="text/css" />

        <style type="text/css">

        </style>
    </head>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                ADMIN
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo $_SESSION['identifiant']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Option</li>

                                <li class="divider"></li>


                                <li>
                                    <a href="../../deconnexion.php"><i class="fa fa-sign-out pull-right"></i> déconnexion</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">

                        <div class="pull-left info">
                            <p>Hello, <?php echo $_SESSION['identifiant']; ?></p>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
                    <div class="col-lg-12">
                        <!-- Main row -->
                        <div class="row">
                            <!--tab nav start-->
                            <section class="panel general">
                                <header class="panel-heading tab-bg-dark-navy-blue">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a data-toggle="tab" href="#home-2">
                                                utilisateurs/formations
                                            </a>
                                        </li>
                                        <li >
                                            <a data-toggle="tab" href="#about-2">

                                                Ajout utilisateurs
                                            </a>
                                        </li>
                                        <li >
                                            <a data-toggle="tab" href="#contact-2">

                                                Ajout formations
                                            </a>
                                        </li>
                                    </ul>
                                </header>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="home-2" class="tab-pane active ">
                                            <div class="col-md-12">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        Tableau des utilisateurs
                                                    </header>
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#id</th>
                                                                    <th>Identidiant</th>
                                                                    <th>Nom</th>
                                                                    <th>Prenom</th>
                                                                    <th>Mail</th>
                                                                    <th>Titre</th> 
                                                                    <th>Action</th> 
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            $reponse = $bdd->query('SELECT * FROM salarie');

                                                            while ($donnees = $reponse->fetch())
                                                            {
                                                                if($donnees['chef'] == 1)
                                                                {
                                                                    $titre = '<span class="label label-danger">chef</span>';
                                                                }
                                                                elseif($donnees['admin'] == 1)
                                                                {
                                                                    $titre = '<span class="label label-success">admin</span>';
                                                                }
                                                                else
                                                                {
                                                                    $titre = '<span class="label label-info">salarie</span>';
                                                                }
                                                            ?>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $donnees['id_s']; ?></td>
                                                                    <td><?php echo $donnees['identifiant']; ?></td>
                                                                    <td><?php echo $donnees['nom']; ?></td>
                                                                    <td><?php echo $donnees['prenom']; ?></td>
                                                                    <td><?php echo $donnees['Email']; ?></td>
                                                                    <td><?php echo $titre; ?></td>
                                                                    <td><a href="../../controllers/delete_user.php?deleteU=<?= $donnees['id_s']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                                                    
                                                                </tr>
                                                                <?php 
                                                            }
                                                            $reponse->closeCursor();
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </section>
                                                
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        Tableau des formations
                                                    </header>
                                                    <div class="panel-body table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>#id</th>
                                                                    <th>Titre</th>
                                                                    <th>Cout</th>
                                                                    <th>Date de début</th>
                                                                    <th>Nombre de place</th>
                                                                    <th>Etat</th>
                                                                    
<!--                                                                    <th>Action</th>-->
                                                                </tr>
                                                            </thead>
                                                            <?php
                                                            $reponse = $bdd->query('SELECT * FROM formation');

                                                            while ($donnees = $reponse->fetch())
                                                            {
                                                            ?>
                                                            <tbody>
                                                                <tr>
                                                                    <td><?php echo $donnees['id_f']; ?></td>
                                                                    <td><?php echo $donnees['titre']; ?></td>
                                                                    <td><?php echo $donnees['cout']; ?></td>
                                                                    <td><?php echo $donnees['date_debut']; ?></td>
                                                                    <td><?php echo $donnees['nb_place']; ?></td>
                                                                    <td><?php echo $donnees['etat_f']; ?></td>
<!--                                                                    <td><a href="../../controllers/delete_formation.php?deleteF=<?= $donnees['id_f']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>-->
                                                
                                                                    <!--                                                                <td><span class="label label-danger"></span></td>-->
                                                                </tr>
                                                                <?php 
                                                            }
                                                            $reponse->closeCursor();
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </section>
                                            </div><!--end col-12 -->
                                        </div>
                                        
                                        
                                        
                                        
                                        <!-- UTILISATEURS -->
                                        <div id="about-2" class="tab-pane ">
                                            <div class="col-lg-8">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        Formulaire ajout utilisateurs
                                                    </header>
                                                    <div class="panel-body">
                                                        <form role="form" method="post" action="" >
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Nom</label>
                                                                <input type="text" class="form-control" required placeholder="Nom" name="nom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Prénom</label>
                                                                <input type="text" class="form-control" required placeholder="Prénom" name="prenom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Adresse mail</label>
                                                                <input type="email" class="form-control" required placeholder="Mail" name="Email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Identifiant</label>
                                                                <input type="text" class="form-control" required  placeholder="Identifiant (5 caractères minimum)" name="identifiant">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Mot de passe </label>
                                                                <input type="password" class="form-control" required placeholder="mot de passe" name="mdp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Crédits et titre du salarié </label>
                                                                <div class="col-lg-10">
                                                                    <div class="checkbox">
                                                                        <label>
                                                                            <input type="checkbox" value="15" name="credit" checked>
                                                                            15 crédits (base)
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" value="1" name="titre">
                                                                            Chef
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio" value="0" name="titre">
                                                                            Salarié
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                          
                                                            <br><br><br>

                                                            <button type="submit" class="btn btn-info" name="adduser">Submit</button>
                                                        </form>
                                                         <?php
                                                        if(isset($erreur2))
                                                        {
                                                            echo '<font color="red">'.$erreur2."</font>";
                                                        }
                                                        ?>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        
                                        <!--  FORMATION  ----------------------------------------------------------------------------------->
                                        <div id="contact-2" class="tab-pane ">
                                            <div class="col-lg-8">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        Formulaire ajout formations
                                                    </header>
                                                    <div class="panel-body">
                                                     
                                                    <form role="form" method="post" action="" enctype="multipart/form-data">
<!--                                                    <form role="form" method="post" action="../../controllers/addformation.php" enctype="multipart/form-data">-->
                                                      
                                                       <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label >Titre</label>
                                                            <input type="text" required name="titre" class="form-control"  placeholder="Titre de la formation">
                                                        </div>
                                                        <div class="form-group">
                                                            <label >Date de début</label>
                                                            <input type="date" required name="date" class="form-control" style="width:30%;"  placeholder="">
                                                        </div>
                                                         <?php
                                                        if(isset($erreurcout))
                                                        {
                                                            echo '<font color="red">'.$erreurcout."</font>";
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                            <label >Cout</label>
                                                            <input type="text" required name="cout" class="form-control" style="width:20%;" placeholder="N° Cout" >
                                                        </div>
                                                         <?php
                                                        if(isset($erreurplace))
                                                        {
                                                            echo '<font color="red">'.$erreurplace."</font>";
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                            <label >Nombre de places</label>
                                                            <input type="text" required name="place" class="form-control" style="width:20%;" placeholder="N° Place">
                                                        </div>
                                                          
                                                        <div class="form-group">
                                                            <label >Icone</label>
                                                            <?php
                                                        if(isset($erreurimg))
                                                        {
                                                            echo '<font color="red">'.$erreurimg."</font>";
                                                        }
                                                        ?>
                                                            <input type="file" name="avatar" id="icone" class="form-control"  placeholder="">
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label >Contenu</label>
                                                            <textarea type="text" required name="contenu" class="form-control" style="width:100%;" placeholder="Description de la formation"></textarea>
                                                        </div>
                                                        <input type="submit" name="addform" class="btn btn-info" value="Envoyer"><br><br>
                                                        </div>
                                                        <div class="col-md-6">
                                                         <div class="form-group">
                                                            <label >Ville</label>
                                                            <input type="text" required name="ville" class="form-control" placeholder="Ville">
                                                        </div>
                                                         <div class="form-group">
                                                            <label >Rue</label>
                                                            <input type="text" required name="rue" class="form-control" placeholder="Nom de la rue">
                                                        </div>
                                                        <?php
                                                        if(isset($erreurnum))
                                                        {
                                                            echo '<font color="red">'.$erreurnum."</font>";
                                                        }
                                                        ?>
                                                         <div class="form-group">
                                                            <label >Numéro de rue</label>
                                                            <input type="text" required name="numrue" class="form-control" style="width:20%;" placeholder="N° Rue">
                                                        </div>
                                                        <?php
                                                        if(isset($erreurcp))
                                                        {
                                                            echo '<font color="red">'.$erreurcp."</font>";
                                                        }
                                                        ?>
                                                         <div class="form-group">
                                                            <label >Code postal</label>
                                                            <input type="text" required name="cp" class="form-control" placeholder="Code postal">
                                                        </div>
                                                         <div class="form-group">
                                                            <label >Prestataire</label>
                                                            <input type="text" required name="presta" class="form-control" placeholder="Raison sociale">
                                                        </div>
                                                        
                                                        </div>

                                                        
                                                       
                                                        </div>
                                                    </form>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!--tab nav end-->
                        </div>
                    </div>
                    <div class="row">
                        <!-- row end -->
                        </section><!-- /.content -->
                    <div class="footer-main">
                        Copyright &copy Admin, 2017
                    </div>
                    </aside><!-- /.right-side -->

                </div><!-- ./wrapper -->

            <!-- jQuery 2.0.2 -->
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
            <script src="../../js2/jquery.min.js" type="text/javascript"></script>

            <!-- jQuery UI 1.10.3 -->
            <script src="../../js2/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
            <!-- Bootstrap -->
            <script src="../../js2/bootstrap.min.js" type="text/javascript"></script>
            <!-- daterangepicker -->
            <script src="../../js2/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

            <script src="../../js2/plugins/chart.js" type="text/javascript"></script>

            <script src="../../js2/Director/app.js" type="text/javascript"></script>

            <!-- Director dashboard demo njjjnj(This is only for demo purposes) -->
            <script src="../../js2/Director/dashboard.js" type="text/javascript"></script>

            </body>
        </html>
    <?php

}
else
{

}
    ?>