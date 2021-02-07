<?php
 $host = 'localhost';
 $userName = 'root';
 $password = '';
 $db_name = 'pdotasks';
 try{
    $pdo = new PDO("mysql:host=$host;dbname=$db_name",$userName,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $e){
     echo "connection failed: ". $e->getMessage();
 }