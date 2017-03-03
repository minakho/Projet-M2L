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
 
      </div>
      <div id="navbar" class="navbar-collapse collapse navbar_area">          
         <ul class="nav navbar-nav navbar-right custom_nav">
                        <li><a href="chef_index.php?id_s=<?php echo $_SESSION['id_s']; ?>">Accueil</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formations <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li ><a href="chef_formation.php?id_s=<?php echo $_SESSION['id_s']; ?>">Liste de formations</a></li>
                                <li ><a href="chef_historique.php?id_s=<?php echo $_SESSION['id_s']; ?>">Historique de formations</a></li>            
                            </ul>
                        </li> 
                        <li class="active"><a href="chef_contact.php?id_s=<?php echo $_SESSION['id_s']; ?>">Contact</a></li>
                        <li><a href=""><i class="fa fa-credit-card" aria-hidden="true"></i> <?php echo $userinfo['nbs_jour']; ?></a></li> 
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
            <h2>Contact</h2>     
        </section>
        
  <!-- start Contact section -->
  <section id="contact">
    
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="contact_area">
           <div class="client_title">
              <hr>
              <h2>Contacter l'admin</h2>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="contact_left wow fadeInLeft">
                  <form class="submitphoto_form">
                    <input type="text" class="form-control wpcf7-text" placeholder="nom">
                    <input type="mail" class="form-control wpcf7-email" placeholder="Email ">          
                    <input type="text" class="form-control wpcf7-text" placeholder="Objet">
                    <textarea class="form-control wpcf7-textarea" cols="30" rows="10" placeholder="Votre texte..."></textarea>
                    <button type="submit" value="Submit" class="wpcf7-submit photo-submit">Envoyer</button>                
                  </form>
                </div>                  
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="contact_right wow fadeInRight">
                  <img src="../../img/phone_icon.png" alt="img">
                 
                </div>
              </div>
            </div>              
         </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Contact section -->
      
  
 <?php include ('chef_footer.php'); ?>
<?php
    }
}
else
{
    
}
?>