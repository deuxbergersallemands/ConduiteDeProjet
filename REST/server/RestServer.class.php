<?php

class RestServer
{
    private $_db;

    private $_method;
    private $_query;
    private $_data;
    

    public function __construct()
    {
        try {
            // The database is just a example.
            $this->_db = new PDO("mysql:host=dbserver;dbname=rjorel",
                                 "rjorel",
                                 "truc");
        }
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->_method = $_SERVER['REQUEST_METHOD'];                    // GET, POST, PUT or DEL here.
        $this->_query = explode('/', $_SERVER['QUERY_STRING']);         // Everything after '?' in the URL.
        $this->_data = json_decode(file_get_contents("php://input"));   // Data given by the client.
    }


    // Util functions for more convenient data fetching.

    public function fetch($req)
    {
        if (!$req) return null;
        
        $data = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
    }

    public function fetchAll($req)
    {
        if (!$req) return null;

        $data = $req->fetchAll(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $data;
    }

    
    // Database handling.

    public function getWorkshops()
    {
        return $this->fetchall($this->_db->query("SELECT * FROM atelier"));
    }
    
    public function getWorkshopByID()
    {
        // Workshop ID be given.
        if (empty($this->_query[1])) return false;

        $req = $this->_db->prepare("SELECT * FROM atelier WHERE Id = ?");
        $req->execute(array($this->_query[1]));

        return $this->fetch($req);
    }

    public function addWorkshop()
    {
        // Data must be given.
        if (empty($this->_data)) return false;
        
        $req = $this->_db->prepare("INSERT INTO atelier(Titre, Theme, Type, Lundi, Mardi, Mercredi, Jeudi, Vendredi,
                                        Laboratoire, Lieu, Duree, Capacite, Inscription, Resume, AnimConf, Partenaires,
                                        PublicVise, Contenu)
                                    VALUES(:ti, :th, :ty, :mon, :tue, :wed, :thu, :fri, :lab, :pl, :du, :ca, :sub, :su,
                                          :an, :pa, :pu, :co)");

        // No checks, we assume the client give the good data (not safe).
        $req->execute(array(
                            'ti' => $this->_data->title,      'pl' => $this->_data->place,
                            'th' => $this->_data->theme,      'du' => $this->_data->duration,
                            'ty' => $this->_data->type,       'ca' => $this->_data->capacity,
                            'mon' => $this->_data->monday,    'sub' => $this->_data->subscription,
                            'tue' => $this->_data->tuesday,   'su' => $this->_data->summary,
                            'wed' => $this->_data->wednesday, 'an' => $this->_data->animators,
                            'thu' => $this->_data->thursday,  'pa' => $this->_data->partners,
                            'fri' => $this->_data->friday,    'pu' => $this->_data->public,
                            'lab' => $this->_data->lab,       'co' => $this->_data->content
                        ));

        $req->closeCursor();
        return true;
    }

    public function updateWorkshop()
    {
        // Workshop ID and data must be given.
        if (empty($this->_query[1]) || empty($this->_data)) return false;
        
        $req = $this->_db->prepare("UPDATE atelier SET Titre = :ti, Theme = :th, Type = :ty, Lundi = :mon, 
                                        Mardi = :tue, Mercredi = :wed, Jeudi = :thu, Vendredi = :fri,
                                        Laboratoire = :lab, Lieu = :pl, Duree = :du, Capacite = :ca, Inscription = :sub,
                                        Resume = :su, AnimConf = :an, Partenaires = :pa,
                                        PublicVise = :pu, Contenu = :co WHERE Id = :id");
        $req->execute(array(
                            'ti' => $this->_data->title,      'pl' => $this->_data->place,
                            'th' => $this->_data->theme,      'du' => $this->_data->duration,
                            'ty' => $this->_data->type,       'ca' => $this->_data->capacity,
                            'mon' => $this->_data->monday,    'sub' => $this->_data->subscription,
                            'tue' => $this->_data->tuesday,   'su' => $this->_data->summary,
                            'wed' => $this->_data->wednesday, 'an' => $this->_data->animators,
                            'thu' => $this->_data->thursday,  'pa' => $this->_data->partners,
                            'fri' => $this->_data->friday,    'pu' => $this->_data->public,
                            'lab' => $this->_data->lab,       'co' => $this->_data->content,
                            'id' => $this->_query[1]
                        ));

        $req->closeCursor();
        return true;
    }

    public function delWorkshop()
    {
        // Workshop ID must be given.
        if (empty($this->_query[1])) return false;
        
        $req = $this->_db->prepare("DELETE FROM atelier WHERE Id = ?");
        $req->execute(array($this->_query[1]));

        $req->closeCursor();
        return true;
    }


    // Query processing.

    public function execute()
    {
        // If the query it's not this one, we assume the client gave something more.
        if ($this->_query[0] == "workshops" && $this->_method == "GET")
            echo json_encode($this->getWorkshops());

        // For get, update or delete particular workshop, $_query[1] must be contain the workshop ID.
        // For add and update, data must be given too.
        else if ($this->_query[0] == "workshop") {
            switch ($this->_method) {
                case "GET":
                    echo json_encode($this->getWorkshopByID()); 
                    break;

                case "POST":
                    $this->addWorkshop();
                    break;

                case "PUT":
                    $this->updateWorkshop();
                    break;

                case "DEL":
                    $this->delWorkshop();
                    break;

                default: break;
            }
        }
    }
}
