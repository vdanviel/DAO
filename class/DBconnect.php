<?php
#DAO

class DBconnect extends PDO{

    private $conn;

    public function __construct($host,$dbname,$user,$password,$dbtype="mysql"){

        $this->conn = new PDO("$dbtype:host=$host;dbname=$dbname","$user","$password");

    }

    private function setParams($statment,$parameters = array()){

        foreach ($parameters as $key => &$value) {
            $statment->bindParam($key, $value);
        }

    }

    public function queryCommand($queryLine,$params = array()){

        $stmt = $this->conn->prepare($queryLine);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;
    }

    public function select($rawQuery,$params = array()):array
    {
        $stmt = $this->queryCommand($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>