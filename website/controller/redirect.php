<?php

include_once("model/RestClient.class.php");


$client = new RestClient("http://raphael.jorel.emi.u-bordeaux.fr/REST/server");

if (isset($_GET['ajouter'])) {
    include("view/add.php");
}    
else if (isset($_GET['modifier']) && !empty($_GET['id'])) {
    $atelier = $client->getAtelierByID($_GET['id']);
    include("view/edit.php");
}
else if (isset($_GET['supprimer']) && !empty($_GET['id'])) {
    $client->delAtelier($_GET['id']);
       
    $ateliers = $client->getAteliers();
    include("view/list.php");
}
else {
    if (!empty($_POST['titre']) && !empty($_POST['theme']) && !empty($_POST['type']) && !empty($_POST['laboratoire']) 
        && !empty($_POST['lieu']) && !empty($_POST['duree']) && !empty($_POST['capacite']) && !empty($_POST['inscription']) 
        && !empty($_POST['resume']) && !empty($_POST['animateurs']) && !empty($_POST['partenaires']) && !empty($_POST['public'])
        && !empty($_POST['contenu'])) {

        if (!isset($_POST['horaires'])) $_POST['horaires'] = array();       // Juste pour les cas où aucun horaire est sélectionné,
        if (!empty($_POST['id']))                                           // pour pas que PHP fasse de warnings.
            $client->updateAtelier($_POST['id'],
                                    array(
                                        'titre' => $_POST['titre'],
                                        'theme' => $_POST['theme'],
                                        'type' => $_POST['type'],  
                                        'lundiAM' => in_array('LundiAm', $_POST['horaires']),
                                        'lundiPM' => in_array('LundiAp', $_POST['horaires']),
                                        'mardiAM' => in_array('MardiAm', $_POST['horaires']),
                                        'mardiPM' => in_array('MardiAp', $_POST['horaires']),
                                        'mercrediAM' => in_array('MercrediAm', $_POST['horaires']),
                                        'mercrediPM' => in_array('MercrediAp', $_POST['horaires']),
                                        'jeudiAM' => in_array('JeudiAm', $_POST['horaires']),
                                        'jeudiPM' => in_array('JeudiAp', $_POST['horaires']),
                                        'vendrediAM' => in_array('VendrediAm', $_POST['horaires']),
                                        'vendrediPM' => in_array('VendrediAp', $_POST['horaires']),
                                        'laboratoire' => $_POST['laboratoire'],
                                        'lieu' => $_POST['lieu'],
                                        'duree' => $_POST['duree'],
                                        'capacite' => $_POST['capacite'],
                                        'inscription' => ($_POST['inscription'] == "oui"),
                                        'resume' => $_POST['resume'],
                                        'animateurs' => $_POST['animateurs'],
                                        'partenaires' => $_POST['partenaires'],
                                        'public_vise' => $_POST['public'],
                                        'contenu' =>$_POST['contenu']));
        else
            $client->addAtelier(array('titre' => $_POST['titre'],
                                        'theme' => $_POST['theme'],
                                        'type' => $_POST['type'],  
                                        'lundiAM' => in_array('LundiAm', $_POST['horaires']),
                                        'lundiPM' => in_array('LundiAp', $_POST['horaires']),
                                        'mardiAM' => in_array('MardiAm', $_POST['horaires']),
                                        'mardiPM' => in_array('MardiAp', $_POST['horaires']),
                                        'mercrediAM' => in_array('MercrediAm', $_POST['horaires']),
                                        'mercrediPM' => in_array('MercrediAp', $_POST['horaires']),
                                        'jeudiAM' => in_array('JeudiAm', $_POST['horaires']),
                                        'jeudiPM' => in_array('JeudiAp', $_POST['horaires']),
                                        'vendrediAM' => in_array('VendrediAm', $_POST['horaires']),
                                        'vendrediPM' => in_array('VendrediAp', $_POST['horaires']),
                                        'laboratoire' => $_POST['laboratoire'],
                                        'lieu' => $_POST['lieu'],
                                        'duree' => $_POST['duree'],
                                        'capacite' => $_POST['capacite'],
                                        'inscription' => ($_POST['inscription'] == "oui"),
                                        'resume' => $_POST['resume'],
                                        'animateurs' => $_POST['animateurs'],
                                        'partenaires' => $_POST['partenaires'],
                                        'public_vise' => $_POST['public'],
                                        'contenu' =>$_POST['contenu']));
            
    }

    $ateliers = $client->getAteliers();
    include("view/list.php");
}
