<?php

class Category{
    private $conn;
    private $table = 'reclamation';

    public $idReclam;
    public $reclam;
    public $resolu;
    public $etudiant_fk;

    //constructeur avec db connexion
    public function __construct($db){
        $this->conn = $db;
    }
    //getting posts from our database
    public function read(){
        //create query
        $query = 'SELECT
        *
        FROM
        ' .$this->table;

    //prepare statement
    $stmt = $this->conn->prepare($query);
    //execute query
    $stmt->execute();

    return $stmt;
    }

}

?>