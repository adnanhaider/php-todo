<?php

if(isset($_POST['id'])){
    require 'db_conn.php';

    $id = $_POST['id'];
    
    if(empty($id)){
        echo 'error';
    }else{
        $stmt = $pdo->prepare("SELECT id, checked FROM tasks WHERE id=?");
        $stmt->execute([$id]);
        
        $task = $stmt->fetch();
        $_id = $task['id'];
        $checked = $task['checked'];
        $_checked = $checked ? 0: 1; # this means reverse the value of checked

        $response = $pdo->query("UPDATE tasks SET checked=$_checked WHERE id=$_id");
        if($response){
            echo $checked;
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