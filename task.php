<?php
    session_start();
    require_once './app/Services/Helpers.php';
    require_once './app/Controllers/TaskController.php';
    use App\Services\Helpers;

    if (!isset($_GET['view'])) {
        header('location: /');
    }
    
    $task = new TaskController();
    $taskData = $task->getTaskBySlug($_GET['view']);

    if (empty($taskData)) {
        header('location: 404');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $taskData['title'] ?> - <?= Helpers::APPLICATION_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="icon" href="/images/logo.png">
    <link href="css/dashboard-temp.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="flexbox-container" style="padding: 0px !important;">
        <div class="col-12 d-flex align-items-center justify-content-center" style="padding: 0px !important;">
            <div class="col-lg-5 col-md-7 col-12 pb-0" style="padding: 0px !important;">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="card shadow col-12 p-0" style="border: 0px; min-height:100vh">
                        <div class="media-container p-0">
                            <img class="card-img-top" src="upL04ds/<?= $taskData['image'] ?>" alt="<?= $taskData['title'] ?>">
                        </div>
                        <div class="card-content collapse show" style="margin-top: -2px;">
                            <div class="card-header bg-success">
                                <div class="row">
                                    <div class="col-12 text-white text-center">
                                        <h5 class="card-title"><?= $taskData['title'] ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" style="padding-bottom:6rem">
                                <?= html_entity_decode($taskData['body']) ?>
                            </div>
                            <div class="card-footer" style="background-color: #ffffff; position: absolute; right: 0; bottom: 0; left: 0;">
                                <div class="row">
                                    <div class="col-12 text-center text-muted" style="">
                                        &copy; <?= Date('Y') . ' - ' . Helpers::APPLICATION_NAME ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>