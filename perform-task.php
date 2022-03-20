<?php
    session_start();
    require_once './app/Services/Helpers.php';
    require_once './app/Controllers/TaskController.php';
    use App\Services\Helpers;

    if (!isset($_GET['v'])) {
        header('location: /');
    }
    
    $task = new TaskController();
    $taskData = $task->getTaskBySlug($_GET['v']);

    if (empty($taskData)) {
        //header('location: 404');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Task - <?= Helpers::APPLICATION_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="icon" href="/images/logo.png">
    <link href="css/dashboard-temp.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="container">
        <div class="task-body col-sm-12 col-lg-6 col-md-12">
            <div class="card mb-4 task-body">
                <img src="upL04ds/<?= $taskData['image'] ?>" class="card-img-top" alt="<?= $taskData['title'] ?>">
                <div class="card-body">
                    <h5 class="card-title text-success text-center"> <span><?= $taskData['title'] ?></span> </h5>
                    <p class="card-text">
                        <?= html_entity_decode($taskData['body']) ?>
                    </p>
                </div>

                <div>
                    <div class="text-center" style="background-color: rgba(0, 0, 0, 0.05);">
                        <div class="text-center mt-5">&copy; <?= Date('Y') . ' ' . Helpers::APPLICATION_NAME ?> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>