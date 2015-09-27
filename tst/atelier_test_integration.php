<?php
  require_once(dirname(__FILE__) . '/simpletest/autorun.php');
  include('../REST/client/RestClient.class.php');

  class Atelier_Test_Integration extends UnitTestCase {

    # Ajouter, Modifier, et puis Supprimer un atelier avec le client REST
    function testE2E() {  
      $client = new RestClient("http://raphael.jorel.emi.u-bordeaux.fr/REST/server");
      $IDLePlusRecent = 0;

      $nombreDAtliersInitial = count($client->getAteliers());

      // Ajouter un atelier
      $client->addAtelier(array('titre' => "ExempleAjout"));
      $ateliers = $client->getAteliers();
      
      $this->assertTrue( $nombreDAtliersInitial < count($ateliers) );

       # Parcourir les IDs pour trouver le ID le plus recent 
       # Non-Optimisé
      foreach ($ateliers as $atelier) {
        if ($atelier->Id > $IDLePlusRecent)
          $IDLePlusRecent = $atelier->Id;
      }

      // Modifier l'atelier
      $client->updateAtelier($IDLePlusRecent, array('titre' => "ExempleAjoutModifie"));
      $atelierModifie = $client->getAtelierByID($IDLePlusRecent);
      $this->assertTrue($atelierModifie->Titre = "ExempleAjoutModifie");

      // Supprimer un atelier
      $client->delAtelier($IDLePlusRecent);
      # Vérifier qu'il y a autant d'ateliers qu'avant le test
      $this->AssertTrue($nombreDAtliersInitial === count($client->getAteliers()));
      $this->AssertFalse($client->getAtelierByID($IDLePlusRecent)); 
    }
  }


?>