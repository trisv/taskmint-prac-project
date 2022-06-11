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
    function __construct(){
        //set dsn
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

        //create PDO instance
        try {
            //create new pdo instance as value for dbh
            $this->dbh = new PDO($dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            //if connection is successful, inform user
            if(isset($this->dbh)) {
             //echo "connected to databse successfully";
            }
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
    }
    //use getDB to give database connection like so: $u = new users($conn->getDB)
    public function getDB() {
        return $this->dbh;
    }
}