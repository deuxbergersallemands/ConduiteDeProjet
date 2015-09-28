<?php
  require_once(dirname(__FILE__) . '/simpletest/autorun.php');
    include('../REST/client/RestClient.class.php');


  class Test_Connexion_BDD extends UnitTestCase {

  
    // Je ne sais pas que mettre pour que ce marche...
    /* function test_connexion_bdd() {
      $sql_host = "dbserver";
      $sql_user = "rjorel";
      $sql_pwd = "truc";
      $sql_db = "rjorel";

      if($connexion = mysql_connect($sql_host, $sql_user, $sql_pwd))  {
        if (mysql_select_db($sql_db)) {
          mysql_close($connexion);
     	  $this->assertTrue(true);
        }
        mysql_close($connexion);
      }
      $this->assertFalse(true);
    } */

    function test_connexion_serveur() {
      $this->assertNotNull(new RestClient("http://raphael.jorel.emi.u-bordeaux.fr/REST/server"));
    }
  }
?>