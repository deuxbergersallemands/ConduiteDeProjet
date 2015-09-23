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
           /* $this->_db = new PDO("mysql:host=dbserver;dbname=rjorel",
                                 "rjorel",
                                 "truc"); */

           $this->_db = new PDO("mysql:host=localhost;dbname=rjorel",
                                 "root",
                                 "wfusdfcf");
        }
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_query = explode('/', $_SERVER['QUERY_STRING']);
        $this->_data = json_decode(file_get_contents("php://input"));
    }


    // Utils.

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
        if (empty($this->_query[1])) return false;

        $req = $this->_db->prepare("SELECT * FROM atelier WHERE Id = ?");
        $req->execute(array($this->_query[1]));

        return $this->fetch($req);
    }

    public function addWorkshop()
    {
        if (empty($this->_data)) return false;
        
        $req = $this->_db->prepare("INSERT INTO atelier(Titre, Theme, Type, Lundi, Mardi, Mercredi, Jeudi, Vendredi,
                                        Laboratoire, Lieu, Duree, Capacite, Inscription, Resume, AnimConf, Partenaires,
                                        PublicVise, Contenu)
                                    VALUES(:ti, :th, :ty, :mon, :tue, :wed, :thu, :fri, :lab, :pl, :du, :ca, :sub, :su,
                                          :an, :pa, :pu, :co)");
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
        if (empty($this->_query[1])) return false;
        
        $req = $this->_db->prepare("DELETE FROM atelier WHERE Id = ?");
        $req->execute(array($this->_query[1]));

        $req->closeCursor();
        return true;
    }


    // Query processing.

    public function execute()
    {
        if ($this->_query[0] == "workshops" && $this->_method == "GET")
            echo json_encode($this->getWorkshops());

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
