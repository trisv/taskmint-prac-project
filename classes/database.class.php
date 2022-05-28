<?php 

class Database {
    //public properties
    $dsn;

    //private methods
    
    //connect to database
    private function connectDatabase($database){
        try {
            //create new pdo instance
            $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            if($pdo) {
             
            }
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
    }
}