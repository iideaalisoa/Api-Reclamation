<?php

class Post{
    private $conn;
    private $table = 'compte';

    public $idCompte;
    public $email;
    public $mdp;
    public $idReclam;

    //constructeur avec db connexion
    public function __construct($db){
        $this->conn = $db;
    }
    //getting posts from our database
    public function read(){
        //create query
        $query = 'SELECT
        idCompte,
        email,
        mdp
        FROM
        ' .$this->table . '
        ';

    //prepare statement
    $stmt = $this->conn->prepare($query);
    //execute query
    $stmt->execute();

    return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM etudiant WHERE idUnique = ? LIMIT 1';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //biding param
        $stmt->bindParam(1, $this->idUnique);
        //execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->idUnique = $row['idUnique'];
        $this->nom = $row['nom'];
        $this->ddn = $row['ddn'];
        $this->cin = $row['cin'];
        $this->mention = $row['mention'];
        $this->univ = $row['univ'];
        $this->tel = $row['tel'];
        $this->idEtudiant = $row['idEtudiant'];
        $this->compte_fk = $row['compte_fk'];
        
    }
   
    public function create(){
        //create query
        $query = 'INSERT INTO ' . $this->table . ' SET email = :email, mdp = :mdp';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mdp = htmlspecialchars(strip_tags($this->mdp));

        //binding of parameters
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mdp', $this->mdp);

        //execute the query
        if($stmt->execute()){
            return true;
        }
        //print error
        printf("Error %s. \n", $stmt->error);
        return false;
    }


    //update
    public function update(){
        //create query
        $query = 'UPDATE ' . $this->table . ' SET email = :email, mdp = :mdp
        WHERE idCompte = :idCompte';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->mdp = htmlspecialchars(strip_tags($this->mdp));
        $this->idCompte = htmlspecialchars(strip_tags($this->idCompte));

        //binding of parameters
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mdp', $this->mdp);
        $stmt->bindParam(':idCompte', $this->idCompte);

        //execute the query
        if($stmt->execute()){
            return true;
        }
        //print error
        printf("Error %s. \n", $stmt->error);
        return false;
    }

    //delete function
    public function delete(){
        //create query
        $query = 'DELETE FROM reclamation WHERE idReclam = :idReclam';

        //prepare statement
        $stmt = this->conn->prepare($query);

        //clean the data
        $this->idReclam = htmlspecialchars(strip_tags($this->idReclam));
        $stmt->bindParam('idReclam', $this->idReclam);

        //execute the query
        if($stmt->execute()){
            return true;
        }
        //print error
        printf("Error %s. \n", $stmt->error);
        return false;
    }

}


?>