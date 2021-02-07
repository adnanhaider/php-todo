<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'pdotasks';

    // set DSN 
    $dsn = 'mysql:host='.$host.';dbname='.$dbname;


    // create a PDO instanse
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    # PDO Query

    // $stmt = $pdo->query('SELECT * FROM tasks');

    // while($row = $stmt->fetch(PDO::FETCH_ASSOC))
    // {
    //     echo $row['id'] .'  '. $row['des'].'<br>';
    // }
    // while($row = $stmt->fetch(PDO::FETCH_OBJ))
    // {
    //     echo $row->id .'  '. $row->des.'<br>';
    // }
    # PREPARED STATEMENTS (prepare & execute)

    //UNSAFE WAY
    // $sql = "SELECT * FROM tasks WHERE id= $id";

    // FETCH MUTIPLE TASKS 

    // USER INPUT
    // $id= 1;
    // $limit = 1;

    // positional Params
    // $sql = 'SELECT * FROM tasks WHERE id = ? LIMIT ?';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$id,$limit]);
    // $tasks = $stmt->fetchAll();
    // foreach($tasks as $task){
    //         echo $task->des. '<br>';
    //     }
    //NAMED PARAMS
    // $sql = 'SELECT * FROM tasks WHERE id = :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['id'=>$id]);
    // $tasks = $stmt->fetch();
    // foreach($tasks as $task){
    //     echo $task->des. '<br>';
    // }
    // GET ROW COUNT
    // $stmt = $pdo->prepare('SELECT * FROM tasks WHERE id = ?');
    // $stmt->execute([$id]);
    // $taskCount = $stmt->rowCount();
    // echo $taskCount;

    //INSERT DATA
    // $id = 5;
    // $des = 'Do some workout';
    // $sql = 'INSERT INTO tasks(id, des) VALUES(:id, :des)';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['id'=>$id, 'des'=>$des]);
    // echo 'Task Added';

    // UPDATE DATA
    // $id = 2;
    // $des = 'DRINK WATER';
    // $sql = 'UPDATE tasks SET des= :des WHERE id= :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['des'=>$des,'id'=>$id]);
    // echo 'task updated';


    // DELETE DATA

    // $id = 5;
    // $sql = 'DELETE FROM tasks WHERE id= :id';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(['id'=>$id]);
    // echo 'TASK DELETED';

    // SEARCH DATA
    // $search = '%eat%';
    // $sql = 'SELECT * FROM tasks WHERE des LIKE ?';
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute([$search]);
    // $tasks = $stmt->fetchAll();

    // foreach($tasks as $task){
    //     echo $task->id .'<br>';
    // }

