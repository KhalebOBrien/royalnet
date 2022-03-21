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
                        <h1 class="h3 mb-0 text-gray-800">Tasks</h1>
                    </div>

                    <!-- tasks -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Available tasks</h6>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <strong>Set up your account before performing tasks.</strong>
                                <p>Your Task: Make sure you read carefully before performing the task.</p>
                                <p>Step 1, Click on Tasks.</p>
                                <p>Step 2, Wait for few seconds to view the advert campaign and today news headlines with promoted links.</p>
                                <p>Step 3, Copy the link from your browser and share on your Social media timeline, then you are done. You can add any text or write up as you wish either for promotion and getting referrals.</p>
                            </div>
                        </div>
                    </div>

                    <!-- task container -->
                    <!-- <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Select a task you want to perform</h6>
                        </div> -->
                        
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
                                            <a href="task?view=<?= $taskData['slug'] ?>" class="btn btn-primary">View</a>
                                            <span class="btn btn-success float-right">Copy Link</span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                        endforeach;
                                    endif;
                                ?>
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
            
            <?php include_once './partials/__logout-modal.php' ?>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/dashboard-temp.js"></script>

</body>

</html>
