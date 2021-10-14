﻿<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
        $_SESSION = array();
        $login = $_REQUEST['login'];
        $mdp = $_REQUEST['mdp'];
        $visiteur = $pdo->getInfosVisiteurpublic($login,$mdp);
        if(!is_array( $visiteur)){
            ajouterErreur("Login ou mot de passe incorrect");
            include("vues/v_erreurs.php");
            include("vues/v_connexion.php");
        }
        else{
            $id = $visiteur['id'];
            $nom =  $visiteur['nom'];
            $prenom = $visiteur['prenom'];
            $typeUtilisateur = $visiteur['typeUtilisateur'];
            connecter($id,$nom,$prenom,$typeUtilisateur);
            include("vues/v_sommaire.php");
        }
        break;
    }
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>