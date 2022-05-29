<?php 

class Database {
    //properties
    // private $host = 'localhost';
    // private $user = 'root';
    // private $password = '';
    // private $dbname='PHPv1';
    private $dsn;
    // private $pdo;

    //constructor
    function __construct(
        $host = 'localhost',
        $dbname='PHPv1',
        $user = 'root',
        $password = '',) {
        //set dsn    
        $this->dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
    }
    //private methods
    
    //connect to database
    private function connectDatabase($dbname){
        //set dsn
        // $this->dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        //create PDO instance
        try {
            //create new pdo instance (also defining it as variable in here, not as private class property for security I guess)
            $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            //if connection is successful, inform user
            if($pdo) {
             //echo "connected to databse successfully";
            }
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
    }
}