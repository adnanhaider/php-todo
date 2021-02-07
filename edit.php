$(document).ready(alert('hello'));

<?php

if(isset($_POST['id'])){
    require 'db_conn.php';
    
    $id = $_POST['id'];
    $des = $_POST['des']; # this description is comming from user input
    
    if(empty($id)){
        echo 'error';
    }else{
        $stmt = $pdo->prepare("SELECT id, des FROM tasks WHERE id=?");
        $stmt->execute([$id]);
        
        $task = $stmt->fetch();
        $_id = $task['id']; # this id is comming from db
        if($id != $_id){
            echo "ids don't match";
            $pdo = null;
            exit();
        }
        $response = $pdo->query("UPDATE tasks SET des=$des WHERE id=$_id");
        if($response){
            echo "Updated";
        }else{
            echo 'error';
        }
        $pdo = null;
        exit();
    }
}else{
    header("Location: index.php?mess=error");
}
?>


