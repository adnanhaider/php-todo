<?php
require 'db_conn.php';
// return $_POST['id'];
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $des = $_POST['des']; # this description is comming from user input
    echo '<script>alert($id.$des)</script>'; 
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
        $stmt = $pdo->prepare("UPDATE tasks SET des=? WHERE id=?");
        $response = $stmt->execute([$des, $id]);
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


