<?php
session_start();
require_once('../../models/connexionbdd.php');
include('../../controllers/addformation.php');
include('../../controllers/addsalarie.php');

$reponse = $bdd->query("SELECT COUNT(`id_s`) AS inscrit_max FROM salarie");
$donnees = $reponse->fetch();

$reponse1 = $bdd->query("SELECT COUNT(`id_s`) AS salarie_max FROM salarie WHERE chef = 0 AND admin = 0");
$donnees1 = $reponse1->fetch();

$reponse2 = $bdd->query("SELECT COUNT(`id_s`) AS chef_max FROM salarie WHERE chef = 1");
$donnees2 = $reponse2->fetch();

$reponse3 = $bdd->query("SELECT COUNT(`id_f`) AS form_max FROM formation");
$donnees3 = $reponse3->fetch();

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

                    <div class="row" style="margin-bottom:5px;">


                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-group"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $donnees['inscrit_max']; ?></span>
                                    <strong>Total Inscrits</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-user"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $donnees1['salarie_max']; ?></span>
                                    <strong>Total salariés</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-user"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $donnees2['chef_max']; ?></span>
                                    <strong>Total chefs</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-paperclip"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $donnees3['form_max']; ?></span>
                                    <strong>Total formations</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Main row -->
                        <div class="row">
                            <!--tab nav start-->
                            <section class="panel general">
                                <header class="panel-heading tab-bg-dark-navy-blue">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a data-toggle="tab" href="#home-2">
                                                utilisateurs
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
                                                        Tableau utilisateurs
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
                                            </div><!--end col-6 -->
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
                                                                <input type="text" class="form-control" placeholder="Nom" name="nom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Prénom</label>
                                                                <input type="text" class="form-control" placeholder="Prénom" name="prenom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Adresse mail</label>
                                                                <input type="email" class="form-control" placeholder="Mail" name="Email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Identifiant</label>
                                                                <input type="text" class="form-control"  placeholder="Identifiant" name="identifiant">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputPassword1">Mot de passe </label>
                                                                <input type="password" class="form-control" placeholder="mot de passe" name="mdp">
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
                                                                            <input type="radio" value="1" name="titre" checked>
                                                                            Chef
                                                                        </label>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <label>
                                                                            <input type="radio"  value="0" name="titre">
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
                                        
                                        <!--  FORMATION-->
                                        <div id="contact-2" class="tab-pane ">
                                            <div class="col-lg-8">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        Formulaire ajout formations
                                                    </header>
                                                    <form role="form" method="post" action="">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Titre</label>
                                                            <input type="text" required name="titre" class="form-control"  placeholder="Titre de la formation">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Cout</label>
                                                            <input type="text" required name="cout" class="form-control"  placeholder="Cout de la formation">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Date de début</label>
                                                            <input type="date" required name="date" class="form-control" style="width:25%;"  placeholder="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Nombre de place</label>
                                                            <input type="text" required name="place" class="form-control" placeholder="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Contenu</label>
                                                            <textarea type="text" required name="contenu" class="form-control" placeholder="Description de la formation"></textarea>
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="exampleInputPassword1">Ville</label>
                                                            <input type="text" required name="ville" class="form-control" placeholder="Ville">
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="exampleInputPassword1">Rue</label>
                                                            <input type="text" required name="rue" class="form-control" placeholder="Nom de la rue">
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="exampleInputPassword1">Numéro de rue</label>
                                                            <input type="text" required name="numrue" class="form-control" placeholder="Numéro de la rue">
                                                        </div>
                                                         <div class="form-group">
                                                            <label for="exampleInputPassword1">Code postal</label>
                                                            <input type="text" required name="cp" class="form-control" placeholder="Code postal">
                                                        </div>

                                                        <input type="submit" name="addform" class="btn btn-info" value="Envoyer"><br><br>
                                                        <?php
                                                        if(isset($erreur))
                                                        {
                                                            echo '<font color="red">'.$erreur."</font>";
                                                        }
                                                        ?>
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