    <!-- Division pour le sommaire -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>
            <ul id="menuList">
                  <li >
                        Comptable :<br>
                        <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
                  </li>
                  <li class="smenu">
                        <a href="index.php?uc=validerFrais&action=saisirFrais" title="Valider les fiche de frais">Valider fiche de frais</a>
                  </li>
                  <li class="smenu">
                        <a href="index.php?uc=afficherFrais&action=suivrePaiement" title="Suivre le paiement des fiches de frais">Suivre le paiement des fiches de frais</a>
                  </li>
                  <li class="smenu">
                        <?php
                        if(!empty($_SESSION['idVisiteur'])){
                              echo '<a href="index.php?uc=gererFrais&action=deconnexion" title="Se déconnecter">Déconnexion</a>';
                        }
                        ?>
                  </li>
            </ul>
    </div>
    