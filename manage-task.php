<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }
    
    require_once './app/Controllers/TaskController.php';

    $task = new TaskController();
    $tasks = $task->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tasks - <?= Helpers::APPLICATION_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.default.css">
    <link rel="icon" href="/images/logo.png">
    <link href="css/dashboard-temp.css" rel="stylesheet">
    <link rel="stylesheet" href="css/user-dashboard.css">

</head>

<body id="page-top">
    <div id="wrapper">
        <?php include_once './partials/__dashboard-sidenav.php' ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                
                <?php include_once './partials/__dashboard-topnav.php' ?>

                <div class="container">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Tasks</h1>
                        <a href="post-task"><h4 class="h4 btn btn-primary mb-0 text-white">Create Task</h4></a>
                    </div>
                        
                    <div class="card-body">
                        <div class="row justify-content-around"> 
                            <?php
                                if (!empty($tasks)) :
                                    foreach ($tasks as $taskData) :
                            ?>
                            <div class="col-lg-3 col-md-12 col-sm-12">
                                <div class="card mb-3">
                                    <img src="upL04ds/<?= $taskData['image'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-success"> <a href="task?view=<?= $taskData['slug'] ?>"><?= $taskData['title'] ?></a> </h5>
                                        <p class="card-text"> <span><?= Helpers::wordCount(html_entity_decode($taskData['body']), 30) ?></span> </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="task?view=<?= $taskData['slug'] ?>" target="_blank" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                                        <span style="display:none;"><?= Helpers::APPLICATION_DOMAIN.'task?view='.$taskData['slug'] ?></span>
                                        <span class="btn btn-success"><i class="bi bi-clipboard"></i></span>
                                        <a href="task?view=<?= $taskData['slug'] ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
                                        <a href="task?view=<?= $taskData['slug'] ?>" class="btn btn-danger delete-btn"><i class="bi bi-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <?php include_once './partials/__logout-modal.php' ?>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/alertify.min.js"></script>
    <script src="js/dashboard-temp.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete-btn').on('click', function(){
                e.preventDefault();
                console.
                alertify.confirm('Confirm Delete', 'Are you sure you want to delete this task? This action CANNOT be undone!',
                            function(){ return true }
                );
            })
        });
    </script>

</body>

</html>
