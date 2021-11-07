<?php
include("vues/v_comptable.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];
switch($action){
    case 'suivrePaiement':{
		include("vues/v_afficherFichesFrais.php");
		break;
    }
}
?>