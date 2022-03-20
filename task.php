<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }
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
                                <p>Your Task: Make sure you read carefully before performing the task.</p>
                                <p>Step 1, Click on Tasks.</p>
                                <p>Step 2, Wait for few seconds to view the advert campaign and today news headlines with promoted links.</p>
                                <p>Step 3, Download the sponsored image and copy the sponsored content</p>
                                <p>Step 4, Upload it on your Social media timeline, then you are done. You can add any text or write up as you wish either for promotion and getting referrals.</p>
                            </div>

                            <h5 class="card-title">Tasks</h5>

                            <div class="border-top mb-4">
                                <div class="mt-1">
                                    Choose a task you want to perform
                                </div>
                                
                            </div>

                            <!-- task container -->
                            <div class="row justify-content-around"> 
                                <!-- task body -->
                                <div class="col-lg-5 col-md-12 col-sm-10">
                                    <div class="card mb-3" >
                                        <img src="images/hero.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-success"> <span>Task title</span> </h5>
                                            <p class="card-text"> <span>Some text about the task</span> </p>
        
                                            
                                            <p class="card-text">
                                                Click the link below for more details about the task <br>
                                                 <a href="perform-task"> <span>task link</span> </a>
                                            </p>
        
                                            
                                            <a href="perform-task" class="btn btn-primary task-link mb-3">Perform tast</a>
                                            <a href="#" class="btn btn-success float-end task-link">Task done</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- task body -->
                                <div class="col-lg-5 col-md-12 col-sm-12 ">
                                    <div class="card mb-4">
                                        <img src="images/hero.jpg" class="image-fluid card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title text-success"> <span>Task title</span> </h5>
                                            <p class="card-text"> <span>Some text about the task</span> </p>
        
                                            
                                            <p class="card-text">
                                                Click the link below for more details about the task <br>
                                                 <a href="perform-task"> <span>task link</span> </a>
                                            </p>
        
                                            <a href="perform-task" class="btn btn-primary task-link mb-3">Perform tast</a>
                                            <a href="#" class="btn btn-success float-end task-link">Task done</a>
                                        </div>
                                    </div>
                                </div>
                                </div>
    
                             
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

    <script src="js/dashboard-temp.js"></script>

</body>

</html>
