<?php 
//this file is for the task class. it is used as a library, not as a processing file. 


class tasks {
    //task properties
    private $u_id;
    private $task_name = '';
    private $task_details;
    private $task_date_added;
    //creates a pdo instance to allow db to be passed to class through __construct function
    private $pdo;
    //provides db connection to class
    function __construct($db){
        $this->pdo = $db;
    }

    //task methods
    function setU_ID($u_id) {
        $this->u_id=$u_id;
    }
    
    function getU_ID() {
        if(empty($this->u_id)) {
            return false;
        }
        return $this->u_id;
    }

    function setTaskID($task_id) {
        $this->task_id=$task_id;
    }

    function getTaskID() {
        if(empty($this->task_id)) {
            return false;
        }
        return $this->task_id;
    }

    function setTaskName($task_name) {
        $this->task_name= $task_name;
    }
    
    function getTaskName() {
        if(empty($this->task_name)){
            return false;
        }
        return $this->task_name;
    }

    function setTaskDetails($task_details) {
        $this->task_details=$task_details;
    }

    function getTaskDetails() {
        if(empty($this->task_details)){
            return false;
        }
        return $this->task_details;
    }

    function setTaskDateAdded($task_date_added) {
        $this->task_date_added=$task_date_added;
    }

    function getTaskDateAdded() {
        if(empty($this->task_date_added)) {
            return false;
        }
        return $this->task_date_added;
    }

    function createTask() {
        try {
            //set variables manually to avoid notice issue
            $task_name=$this->getTaskName();
            $task_details=$this->getTaskDetails();
            $task_date_added=$this->getTaskDateAdded();
            $sql = 'INSERT INTO tasks (u_id, task_name, task_details, task_date_added) VALUES (:u_id, :task_name, :task_details, :task_date_added)';
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':u_id', $_SESSION['u_id']);
            $stmt->bindParam(':task_name', /*$this->getTaskName()*/ $task_name);
            $stmt->bindParam(':task_details', /*$this->getTaskDetails()*/$task_details);
            $stmt->bindParam(':task_date_added', /*$this->getTaskDateAdded()*/$task_date_added);
            $stmt->execute();
        
        } catch(PDOException $e) {
        //if there is an error in the statement, this will display it
        // echo $e->getMessage();
        return false;
        }
        //if this function works, return true;
        return true;
    }
    
    function viewTasks() {
        //query to access database
        $sql = $this->pdo->prepare('SELECT * FROM tasks WHERE u_id = :u_id');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->execute();
        //fetching the result
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
        
    }

    function viewTaskID() {
        //query to access database
        $sql = $this->pdo->prepare('SELECT task_id FROM tasks WHERE u_id = :u_id');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->execute();
        //fetching the result
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $result;

    }

    function viewTaskName() {
        //query to access database
        $sql = $this->pdo->prepare('SELECT task_name FROM tasks WHERE u_id = :u_id');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->execute();
        //fetching the result
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $result;
        
    }

    function viewTaskDetails() {
        //query to access database
        $sql = $this->pdo->prepare('SELECT task_details FROM tasks WHERE u_id = :u_id');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->execute();
        //fetching the result
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $result;

    }

    function viewTaskDateAdded() {
        //query to access database
        $sql = $this->pdo->prepare('SELECT task_date_added FROM tasks WHERE u_id = :u_id');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->execute();
        //fetching the result
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $result;

    }
//this works much better without fetchAll
    function viewTaskSingle() {
        //set task id to avoid notice issue
        $task_id = $this->getTaskID();
        $sql = $this->pdo->prepare('SELECT * FROM tasks WHERE u_id = :u_id AND task_id = :task_id LIMIT 1');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/ $_SESSION['u_id']);
        $sql->bindParam(':task_id', /*$this->getTaskID()*/$task_id);
        if(!$sql->execute()) {
            return false;
        }

        //fetching the result
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if(empty($result)){
            return false;
        }
        
        return $result;
    }

    function deleteTask() {
        //set task id to avoid notice issue
        $task_id = $this->getTaskID();
        $sql = $this->pdo->prepare('DELETE FROM tasks WHERE u_id = :u_id AND task_id = :task_id LIMIT 1');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->bindParam(':task_id', /*$this->getTaskID()*/$task_id);
        $sql->execute();
      
    }

    function editTask() {
        //set task id, task name and task details manually to avoid notice issue
        $task_id = $this->getTaskID();
        $task_name = $this->getTaskName();
        $task_details = $this->getTaskDetails();
        $sql = $this->pdo->prepare('UPDATE tasks SET task_name = :task_name, task_details = :task_details WHERE u_id = :u_id AND task_id = :task_id');
        $sql->bindParam(':u_id', /*$this->getU_ID()*/$_SESSION['u_id']);
        $sql->bindParam(':task_id', /*$this->getTaskID()*/$task_id);
        $sql->bindParam(':task_name', /*$this->getTaskName()*/$task_name);
        $sql->bindParam(':task_details', /*$this->getTaskDetails()*/$task_details);
        if(!$sql->execute()){
            return false;
        }

        return true;
    }

}


//$t = new Task();

//var_dump($t->getTaskName());

//$t->setTaskName('tris');

//echo $t->getTaskName();