<?php

require("fpdf/fpdf.php");
session_start();

$bdd = new PDO('mysql:host=mysql-smichael.alwaysdata.net;dbname=smichael_sinakhobdd;charset=utf8', 'smichael', 'Mimimic95');

$requser = $bdd->prepare("SELECT * FROM salarie WHERE id_s = :id ");
$requser->bindValue(":id",$_SESSION['id_s']);
$requser->execute();
$row = $requser->fetch();

$reqformation =  $bdd->prepare("SELECT `id_f`,`titre`,`cout`,`date_debut`,`date_fin`,`nb_place`,`contenu`,`ville`,`rue`,`numero_rue`,`code_postal`,`raison_social` FROM `formation`f, `prestataire`p, `adresse`a WHERE f.id_a = a.id_a AND f.id_p = p.id_p AND f.id_f = :id");
$reqformation->bindValue(":id", $_GET['id_f']);
$reqformation->execute();
$row2 = $reqformation->fetch();


class PDF extends FPDF
{
    //    function salarie()
    //    {
    //        $bdd = new PDO('mysql:host=localhost;dbname=m2l;charset=utf8', 'root', '');
    //
    //        $requser = $bdd->prepare("SELECT * FROM salarie WHERE id_s = :id ");
    //        $requser->bindValue(":id",$_SESSION['id_s']);
    //        $requser->execute();
    //        return $requser->fetch(PDO::FETCH_OBJ);
    //    }

    // Pied de page
    function Footer()
    {

        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->SetTextColor(128);
        $this->Cell(0,10,'Page ',0,0,'C');
    }

    function Header()
    {
        global $row;
        // Logo
        $this->Image('../img/logo.png',10,6,40,20);
        // Police Arial gras 15
        $this->SetFont('Arial','',15);
        $this->Text(10,32,'Gestion de formations');
        $this->Text(10,38,'sportives');
        // Décalage à droite
        $this->SetX(80);
        $this->Cell(0,35,'',1);
        $this->SetFont('Arial','B',14);
        $this->Text(90,16, utf8_decode('Salarié :'));
        $this->SetFont('Arial','',14);
        $this->Text(90,24,'Nom : ');
        $this->Text(130,24, $row['nom']);
        $this->Text(90,32,'Prenom :');
        $this->Text(130,32, $row['prenom']);
        $this->Text(90,40,'Email:');
        $this->Text(130,40, $row['Email']);
        //    // Titre
        //    $this->MultiCell(0,5,'Titre',1,'L',0);
        //     $this->Cell(80);
        //    $this->MultiCell(0,5,'Titre',1,'L',0);
        // Saut de ligne
        $this->Ln(20);
    }
}

$pdf=new PDF('P',"mm","A4");
$pdf->AddPage();
$pdf->SetTitle("Fiche formation");

$pdf->SetFont('Arial','B',14);
$pdf->Text(10,55,'FICHE DESCRIPTIVE');

//TITRE
$pdf->SetY(60);
$pdf->Cell(0,200,'',1);
$pdf->Text(30,80,'Formation :');
$pdf->SetFont('Arial','I',16);
$pdf->Text(70,80,$row2['titre']);

// DETAIL FORMATION
$pdf->SetFont('Arial','',14);
$pdf->Text(30,90,'Adresse:');
$pdf->Text(30,100,$row2['ville']);
$pdf->Text(30,105,$row2['numero_rue']);
$pdf->Text(35,105,$row2['rue']);
$pdf->Text(30,110,$row2['code_postal']);

//DATE
$pdf->Text(120,90,'Date:');
$pdf->Text(120,100,'Debut - Fin:');
$pdf->Text(120,105,$row2['date_debut']);
$pdf->Text(150,105,$row2['date_fin']);
$pdf->Text(120,120,'Duree:');
$pdf->Text(120,130,$row2['cout']);
$pdf->Text(125,130,'jours');

//PRESTATAIRE
$pdf->Text(30,120,'Prestataire :');
$pdf->Text(30,130,$row2['raison_social']);

//CONTENU
$pdf->Text(30,145,'Description :');
$pdf->Text(30,165,$row2['contenu']);




$pdf->output();





?>