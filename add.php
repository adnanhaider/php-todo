<?php

if(isset($_POST['des'])){
    require 'db_conn.php';

    $des = $_POST['des'];
    
    if(empty($des)){
        header("Location: index.php?mess=error");
    }else{
        $stmt = $pdo->prepare("INSERT INTO tasks(des) VALUES(?)");
        $response = $stmt->execute([$des]);
        if($response){
            header("Location: index.php?mess=success");
        }
        else{
           header("Location: index.php?mess=error");
        }
        header("Location: index.php");
        $pdo = null;
        exit();
    }
}else{
    header("Location: index.php?mess=error");
}
?>