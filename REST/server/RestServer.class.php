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
            $this->_db = new PDO("mysql:host=dbserver;dbname=rjorel",
                                 "rjorel",
                                 "truc");
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

        return false;
    }

    public function updateWorkshop()
    {
        if (empty($this->_query[1]) || empty($this->_data)) return false;

        return true;
    }

    public function delWorkshop()
    {
        if (empty($this->_query[1])) return false;
        
        echo "true";
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
