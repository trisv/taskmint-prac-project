<?php 

class Database {
    //properties
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname='PHPv1';
    private $dbh;
    //private methods
    
    //connect to database
    public function connect(){
        //set dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        //create PDO instance
        try {
            //create new pdo instance as value for dbh
            $this->dbh = new PDO($dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            //if connection is successful, inform user
            if($this->dbh) {
             //echo "connected to databse successfully";
            }
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
    }
}