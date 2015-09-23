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
            $this->_db = new PDO("mysql:host=localhost;dbname=raphael_m4a1", "raphael_m4a1", "wfusdfcf");
        }
        catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }

        $this->_method = $_SERVER['REQUEST_METHOD'];
        $this->_query = explode('/', $_SERVER['QUERY_STRING']);
        $this->_data = json_decode(file_get_contents("php://input"));
    }

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

    public function getNews()
    {
        return $this->fetchall($this->_db->query("SELECT * FROM news"));
    }
    
    public function getNewsByID($id)
    {
        $req = $this->_db->prepare("SELECT * FROM news WHERE news.id = ?");
        $req->execute(array($id));
        return $this->fetch($req);
    }

    public function execute()
    {
        if ($this->_method == "GET") {
            if ($this->_query[0] == "news")
                echo json_encode($this->getNews());
            
            else if ($this->_query[0] == "new" and !empty($this->_query[1]))
                echo json_encode($this->getNewsByID($this->_query[1]));


        }
    }
}


$server = new RestServer();
$server->execute();
