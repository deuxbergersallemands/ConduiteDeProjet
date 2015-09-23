<?php

class RestClient
{
    private $_url;


    public function __construct($url)
    {
        $this->_url = $url;
    }


    public function getAteliers()
    {
        return json_decode(file_get_contents("$this->_url/?workshops/"));
    }

    public function getAtelierByID($id)
    {
        return json_decode(file_get_contents("$this->_url/?workshop/$id"));
    }

    public function addAtelier($valeurs = array())
    {

        $opts = array('http' => array('method'=>'POST'));
        $opts['http']['content'] = json_encode(array('title' =>             $valeurs['titre'],
                                                       'theme' =>           $valeurs['theme'],
                                                       'type' =>            $valeur['type'],
                                                       'monday' =>          $valeur['lundiAM'] + 2 * $valeur['lundiPM'],
                                                       'tuesday' =>         $valeur['mardiAM'] + 2 * $valeur['mardiPM'],
                                                       'wednesday' =>       $valeur['mercrediAM'] + 2 * $valeur['mercrediPM'],
                                                       'thursday' =>        $valeur['jeudiAM'] + 2 * $valeur['jeudiPM'],
                                                       'friday' =>          $valeur['vendrediAM'] + 2 * $valeur['vendrediPM'],
                                                       'lab' =>             $valeur['laboratoire'],
                                                       'place' =>           $valeur['lieu'],
                                                       'duration' =>        $valeur['duree'],
                                                       'capacity' =>        $valeur['capacite'],
                                                       'subscription' =>    $valeur['inscription'],
                                                       'summary' =>         $valeur['resume'],
                                                       'animators' =>       $valeur['animateurs'],
                                                       'partners' =>        $valeur['partenaires'],
                                                       'public' =>          $valeur['public_vise'],
                                                       'content' =>         $valeur['contenu']
                                                       ));

        $request = file_get_contents(
                        "$this->_url/?workshop", false, 
                        stream_context_create($opts));


        return $request;
    }
    
    public function updateAtelier($id, $valeurs = array())
    {

        $opts = array('http' => array('method'=>'PUT'));
        $opts['http']['content'] = json_encode(array('title' =>             $valeurs['titre'],
                                                       'theme' =>           $valeurs['theme'],
                                                       'type' =>            $valeur['type'],
                                                       'monday' =>          $valeur['lundiAM'] + 2 * $valeur['lundiPM'],
                                                       'tuesday' =>         $valeur['mardiAM'] + 2 * $valeur['mardiPM'],
                                                       'wednesday' =>       $valeur['mercrediAM'] + 2 * $valeur['mercrediPM'],
                                                       'thursday' =>        $valeur['jeudiAM'] + 2 * $valeur['jeudiPM'],
                                                       'friday' =>          $valeur['vendrediAM'] + 2 * $valeur['vendrediPM'],
                                                       'lab' =>             $valeur['laboratoire'],
                                                       'place' =>           $valeur['lieu'],
                                                       'duration' =>        $valeur['duree'],
                                                       'capacity' =>        $valeur['capacite'],
                                                       'subscription' =>    $valeur['inscription'],
                                                       'summary' =>         $valeur['resume'],
                                                       'animators' =>       $valeur['animateurs'],
                                                       'partners' =>        $valeur['partenaires'],
                                                       'public' =>          $valeur['public_vise'],
                                                       'content' =>         $valeur['contenu']
                                                       ));

        $request = file_get_contents(
                        "$this->_url/?workshop/$id", false, 
                        stream_context_create($opts));


        return $request;
    }

    public function delAtelier($id)
    {
        $opts = array('http' => array('method'=>'DEL'));
        $request = file_get_contents(
                        "$this->_url/?workshop/$id", false, 
                        stream_context_create($opts));

        return $request;
    }
}
