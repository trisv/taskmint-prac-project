<?php 

class comments {
    //class properties
    private $u_id;
    private $task_id;
    private $comment_message;
    private $comment_date_added;
    private $comment_id;

    //creates a pdo instance to allow db to be passed to class through __construct function
    private $pdo;
    //provides db connection to class
    function __construct($db){
        $this->pdo = $db;
    }

    //class methods
    function setU_ID($u_id) {
        $this->u_id = $u_id;
    }

    function getU_ID() {
        if(empty($this->u_id)) {
            return false;
        }

        return $this->u_id;
    }

    function setTaskID($task_id) {
        $this->task_id = $task_id;
    }

    function getTaskID() {
        if(empty($this->task_id)) {
            return false;
        }

        return $this->task_id;
    }

    function setCommentMessage($comment_message) {
        $this->comment_message = $comment_message;
    }

    function getCommentMessage() {
        if(empty($this->comment_message)) {
            return false;
        }

        return $this->comment_message;
    }
    
    function setCommentDateAdded($comment_date_added) {
        $this->comment_date_added = $comment_date_added;
    }

    function getCommentDateAdded() {
        if(empty($this->comment_date_added)) {
            return false;
        }

        return $this->comment_date_added;
    }

    function setCommentID($comment_id) {
        $this->comment_id = $comment_id;
    }

    function getCommentID() {
        if(empty($this->comment_id)) {
            return false;
        }

        return $this->comment_id;
    }

    function createComment() {
        $comment_id = $this->getCommentID();
        $comment_message = $this->getCommentMessage();
        $task_id = $this->getTaskID();
        $sql = 'INSERT INTO comments (u_id, task_id, comment_message, comment_date_added) VALUES (:u_id, :task_id, :comment_message, :comment_date_added)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':u_id', $_SESSION['u_id']);
        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':comment_message', $comment_message);
        $stmt->bindParam(':comment_date_added', time());
        if(!$stmt->execute()){
            return false;
        }

        return true;
    }

    function viewComments() {
        $task_id = $this->getTaskID();
        $sql = 'SELECT * FROM comments WHERE  task_id = :task_id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':task_id', $task_id );
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


}