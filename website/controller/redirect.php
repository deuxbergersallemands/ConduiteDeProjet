<?php

include_once("model/RestClient.class.php");


$client = new RestClient("http://raphael.jorel.emi.u-bordeaux.fr/REST/server");

if (isset($_GET['ajouter'])) {
    include("view/add.php");
}
else if (isset($_GET['modifier']) && !empty($_GET['id'])) {

}
else if (isset($_GET['supprimer']) && !empty($_GET['id'])) {
    $client->delAtelier($_GET['id']);
       
    $ateliers = $client->getAteliers();
    include("view/list.php");
}
else {
    $ateliers = $client->getAteliers();
    include("view/list.php");
}
