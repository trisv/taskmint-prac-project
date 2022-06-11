<?php
//this file is for the user class. it is used as a library, not as a processing file. 

class users {
    //user properties
    private $u_id;
    private $email;
    private $username;
    private $password;
    
    //creates a pdo instance to allow db to be passed to class through __construct function
    private $pdo;
    
    //provides db connection to class
    function __construct($db){
        $this->pdo = $db;
    }

    //task methods 

    function setU_ID($u_id) {
        $this->u_id = $u_id;
    }

    function getU_ID() {
        if(empty($this->u_id)){
            return false;
        }
        return $this->u_id;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function getEmail() {
        if(empty($this->email)) {
            return false;
        }
        return $this->email;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function getUsername() {
        if(empty($this->username)) {
            return false;
        }
        return $this->username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function getPassword() {
        if(empty($this->password)) {
            return false;
        }
        return $this->password;
    }

    function getHashPassword() {
        $password = $this->getPassword();
        $hash_pw = password_hash($password, PASSWORD_BCRYPT,['cost' => 12]);
        return $hash_pw;
    }


    function createUser() {
        $email = $this->getEmail();
        $password = $this->getHashPassword();
        $username = $this->getUsername();
        //database query for insertion of details
        $sql = 'INSERT INTO users(u_email, u_password, u_username) VALUES (:u_email, :u_password, :u_username)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':u_email', $email);
        $stmt->bindParam(':u_password', $password);
        $stmt->bindParam(':u_username', $username);
        if(!$stmt->execute()){
            return false;
        }

        return true;

    }

    function deleteUser() {
        //set task id to avoid notice issue
        $user = $this->u_id();
        $sql = $this->pdo->prepare('DELETE FROM users WHERE u_id = :u_id LIMIT 1');
        $sql->bindParam(':u_id', $_SESSION['u_id']);
        $sql->execute();
          
    
    }

    function editUser() {
        $email = $this->getEmail();
        $password = $this->getHashPassword();
        $username = $this->getUsername();
        $sql = $this->pdo->prepare('UPDATE users SET u_email = :u_email, u_username = :u_username WHERE u_id = :u_id');
        $sql->bindParam(':u_id', $_SESSION['u_id']);
        $sql->bindParam(':u_email', $email);
        $sql->bindParam(':u_username', $username);
        if(!$sql->execute()){
            return false;
        }
        return true;
    }

    function viewUser() {
        //query to access database
        $sql = $this->pdo->prepare('SELECT * FROM users WHERE u_id = :u_id');
        $sql->bindParam(':u_id', $_SESSION['u_id']);
        if(!$sql->execute()){
            return false;
        }
        //fetching the result
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $result;
    }

    function viewUsername() {
         //query to access database
         $sql = $this->pdo->prepare('SELECT u_username FROM users WHERE u_id = :u_id');
         $sql->bindParam(':u_id', $_SESSION['u_id']);
         $sql->execute();
         //fetching the result
         $result = $sql->fetch(PDO::FETCH_ASSOC);
         
         return $result;
    }

    function viewEmail() {
         //query to access database
         $sql = $this->pdo->prepare('SELECT u_email FROM users WHERE u_id = :u_id');
         $sql->bindParam(':u_id', $_SESSION['u_id']);
         $sql->execute();
         //fetching the result
         $result = $sql->fetch(PDO::FETCH_ASSOC);
         
         return $result;
    }

    function viewPassword() {
         //query to access database
         $sql = $this->pdo->prepare('SELECT u_password FROM users WHERE u_id = :u_id');
         $sql->bindParam(':u_id', $_SESSION['u_id']);
         $sql->execute();
         //fetching the result
         $result = $sql->fetch(PDO::FETCH_ASSOC);
         
         return $result;
    }

    function editPassword() {
        $password = $this->getHashPassword();
        $sql = $this->pdo->prepare('UPDATE users SET u_password = :u_password WHERE u_id = :u_id');
        $sql->bindParam(':u_id', $_SESSION['u_id']);
        $sql->bindParam(':u_password', $password);
        if(!$sql->execute()){
            return false;
        }
        return true;
    }
}

