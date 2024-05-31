<?php 
    
    require_once("./database/conn.php");

    $tasks = [];

    $sql = $pdo->query("SELECT * FROM task ORDER BY id ASC");

    if($sql->rowCount() > 0){
        $tasks = $sql->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($tasks);
    }

?><!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>TODO LIST</title>
</head>
<body>
    <div id="todo">
        <h1>Things to do</h1>
        <form action="actions/create.php" method="POST" class="to-do-form">
            <input type="text" name="description" placeholder="Write your text here" required>
            <button type="submit" class="form-button"><i class="fa-solid fa-plus"></i></button>
        </form>
        <div id="tasks">
            <?php foreach($tasks as $task) :?>
                <div class="task">
                    <input 
                        type="checkbox" 
                        name="progress" 
                        class="progress <?= $task['completed'] ? 'done' : '' ?>"
                        data-task-id="<?=$task["id"]?>"
                        <?= $task['completed'] ? 'checked' : '' ?>
                    >
                    <p class="task-description">
                        <?= $task["description"] ?>
                    </p>
                    
                    <div class="task-actions">
                        <a class="action-button edit-button"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="actions/delete.php?id=<?= $task["id"] ?>" class="action-button delete-button"><i class="fa-regular fa-trash-can"></i></a>
                    </div>

                    <form action="actions/update.php" method="POST" class="to-do-form edit-task hidden">
                        <input type="text" name="id" value="<?= $task["id"] ?>" class="hidden">
                        <input type="text" name="description" placeholder="Edit your task here" value="<?= $task["description"] ?>">
                        <button type="submit" class="form-button confirm-button"><i class="fa-solid fa-check"></i></button>
                    </form>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="src/js/script.js"></script>
</body>
</html>