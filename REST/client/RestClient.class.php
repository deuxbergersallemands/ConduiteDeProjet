<?php


class RestClient
{
    private $_url;

    // Defaults values, to don't have to fill all the array fields.
    private $_defaultKeys = array('titre' => null, 'theme' => null, 'type' => null, 'lundiAM' => 0, 'lundiPM' => 0,
                                    'mardiAM' => 0, 'mardiPM' => 0, 'mercrediAM' => 0, 'mercrediPM' => 0, 'jeudiAM' => 0,
                                    'jeudiPM' => 0, 'vendrediAM' => 0, 'vendrediAM' => 0, 'vendrediPM' => 0, 'laboratoire' => null,
                                    'lieu' => null, 'duree' => null, 'capacite' => null, 'inscription' => null,
                                    'resume' => null, 'animateurs' => null, 'partenaires' => null, 'public_vise' => null,
                                    'contenu' => null);


    public function __construct($url)
    {
        $this->_url = $url;
    }


    // GET method for all the ateliers.
    public function getAteliers()
    {
        return json_decode(file_get_contents("$this->_url/?workshops/"));
    }

    // Specific GET for just one atelier.
    public function getAtelierByID($id)
    {
        return json_decode(file_get_contents("$this->_url/?workshop/$id"));
    }

    // Atelier adding, POST method.
    public function addAtelier($valeurs = array())
    {
        $valeurs = array_merge($this->_defaultKeys, $valeurs);
        $opts = array('http' => array('method'=>'POST',
                                        'header'=>'Content-type: application/x-www-form-urlencoded'));

        // All these fields come from the original view.
        $opts['http']['content'] = json_encode(array('title' =>             $valeurs['titre'],
                                                       'theme' =>           $valeurs['theme'],
                                                       'type' =>            $valeurs['type'],
                                                       'monday' =>          $valeurs['lundiAM']     + 2 * $valeurs['lundiPM'],
                                                       'tuesday' =>         $valeurs['mardiAM']     + 2 * $valeurs['mardiPM'],
                                                       'wednesday' =>       $valeurs['mercrediAM']  + 2 * $valeurs['mercrediPM'],
                                                       'thursday' =>        $valeurs['jeudiAM']     + 2 * $valeurs['jeudiPM'],
                                                       'friday' =>          $valeurs['vendrediAM']  + 2 * $valeurs['vendrediPM'],
                                                       'lab' =>             $valeurs['laboratoire'],
                                                       'place' =>           $valeurs['lieu'],
                                                       'duration' =>        $valeurs['duree'],
                                                       'capacity' =>        $valeurs['capacite'],
                                                       'subscription' =>    $valeurs['inscription'],
                                                       'summary' =>         $valeurs['resume'],
                                                       'animators' =>       $valeurs['animateurs'],
                                                       'partners' =>        $valeurs['partenaires'],
                                                       'public' =>          $valeurs['public_vise'],
                                                       'content' =>         $valeurs['contenu']
                                                       ));

        // Execute the request.
        $request = file_get_contents(
                        "$this->_url/?workshop", false, 
                        stream_context_create($opts));
    }
   
    // The same, but with PUT method. Just the atelier ID more.
    public function updateAtelier($id, $valeurs = array())
    {
        $valeurs = array_merge($this->_defaultKeys, $valeurs);
        $opts = array('http' => array('method'=>'PUT',
                                        'header'=>'Content-type: application/x-www-form-urlencoded'));
        $opts['http']['content'] = json_encode(array('title' =>             $valeurs['titre'],
                                                       'theme' =>           $valeurs['theme'],
                                                       'type' =>            $valeurs['type'],
                                                       'monday' =>          $valeurs['lundiAM']     + 2 * $valeurs['lundiPM'],
                                                       'tuesday' =>         $valeurs['mardiAM']     + 2 * $valeurs['mardiPM'],
                                                       'wednesday' =>       $valeurs['mercrediAM']  + 2 * $valeurs['mercrediPM'],
                                                       'thursday' =>        $valeurs['jeudiAM']     + 2 * $valeurs['jeudiPM'],
                                                       'friday' =>          $valeurs['vendrediAM']  + 2 * $valeurs['vendrediPM'],
                                                       'lab' =>             $valeurs['laboratoire'],
                                                       'place' =>           $valeurs['lieu'],
                                                       'duration' =>        $valeurs['duree'],
                                                       'capacity' =>        $valeurs['capacite'],
                                                       'subscription' =>    $valeurs['inscription'],
                                                       'summary' =>         $valeurs['resume'],
                                                       'animators' =>       $valeurs['animateurs'],
                                                       'partners' =>        $valeurs['partenaires'],
                                                       'public' =>          $valeurs['public_vise'],
                                                       'content' =>         $valeurs['contenu']
                                                       ));

        $request = file_get_contents(
                        "$this->_url/?workshop/$id", false, 
                        stream_context_create($opts));
    }

    // And the DEL method.
    public function delAtelier($id)
    {
        $opts = array('http' => array('method'=>'DEL',
                                        'header'=>'Content-type: application/x-www-form-urlencoded'));
        $request = file_get_contents(
                        "$this->_url/?workshop/$id", false, 
                        stream_context_create($opts));
    }
}
