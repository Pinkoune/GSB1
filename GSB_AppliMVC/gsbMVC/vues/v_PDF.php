<?php
  session_start();
  include "../fpdf/fpdf.php";
  $bdd = new PDO('mysql:host=172.16.203.211;dbname=gsb_frais;charset=utf8', 'sio', 'slam');
  include '../include/class.pdogsb.inc.php';
  if ($bdd) {
    $user = $_SESSION['idVisiteur'];


    $PDF = new fpdf();
    $PDF->AddPage();
    $PDF->SetFont("Arial","B",16);
    $PDF->SetTextColor(0,0,0);
    $PDF->MultiCell(0, 10, "PDF de :\n" . $_SESSION['prenom'], 1, "C", 0);
    $PDF->Image("../images/logo.jpg", 80, 40, 50, 50);

    $position = 120; 
    $requete2 = $bdd->query("SELECT * FROM Visiteur WHERE login = '$user';");

    $PDF->SetTextColor(0,0,0);

    $PDF->SetY($position-16);
    $PDF->SetX(75);
    $PDF->MultiCell(60,8,utf8_decode("Prix Total"),1,'C');
    $PDF->SetFont("Arial","",16);
    $PDF->SetY($position-16);
    $PDF->SetX(135);

    $PDF->SetFont("Arial","B",16);
    $PDF->SetY($position-8);
    $PDF->SetX(15);
    $PDF->MultiCell(60,8,utf8_decode("Produit"),1,'C');

    $PDF->SetY($position-8);
    $PDF->SetX(75);
    $PDF->MultiCell(60,8,utf8_decode("Prix"),1,'C');

    $PDF->SetY($position-8);
    $PDF->SetX(135);
    $PDF->MultiCell(60,8,utf8_decode("Quantité"),1,'C');

    $PDF->SetTextColor(0,0,0);

    while ($donne = $requete2->fetch()) {
      $idProduit = $donne['idProduit'];
      $select = $bdd->query($bdd, "SELECT * FROM produit WHERE idProduit = '$idProduit';");
      $donneesProduit = $select->fetch();
      $PDF->SetFont("Arial","I",16);

      $PDF->SetY($position);
      $PDF->SetX(15);
      $PDF->MultiCell(60,8,utf8_decode($donneesProduit['titre']),1,'C');

      $PDF->SetY($position);
      $PDF->SetX(75);
      $PDF->MultiCell(60,8,utf8_decode($donneesProduit['prix']."e"),1,'C');

      $PDF->SetY($position);
      $PDF->SetX(135);
      $PDF->MultiCell(60,8,utf8_decode($donne['quantite']),1,'C');

      $position += 8;
    }

    $PDF->Output();
    $recupNbCommade = $bdd->query($bdd, "SELECT COUNT(*) AS nbCommade FROM commade WHERE userConnexion = '$user' ;");
    $resultatNbCommade = $recupNbCommade->fetch();
    $nbCommade = $resultatNbCommade['nbCommade'];
    $nbCommade = $nbCommade + 1;
    $PDF->Output("commande/".$user.$nbCommade.".PDF", "F");
  
  }
  else {
    echo "Erreur de connexion a la base de données";
  }

?>