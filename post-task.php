<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;
    if (!isset($_SESSION['CSRF'])) {
        $_SESSION['CSRF'] = Helpers::generateRandomToken();
    }

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }
    
    if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] != 1) {
        header('location: 403');
    }
    
    require_once './app/Controllers/TaskController.php';
    
    $task = new TaskController();
    $task->createTask($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Create Task - <?= Helpers::APPLICATION_NAME ?></title>
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

                <?php include_once './partials/__dashboard-topnav.php'?>

                <div class="container-fluid">
                    <div class="container mt-4 mb-4">
                        <div class="row justify-content-md-center">
                            <div class="col-md-12 col-lg-8">
                                <h1 class="h2 mb-4">Write a post</h1>
                                <form action="" method="post" name="task-form" enctype="multipart/form-data">
                                    <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                                    <div class="mb-3">
                                        <input type="text" name="txtTitle" class="form-control" placeholder="Post Title" aria-describedby="basic-addon1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="flImage">Browse your device to upload an image</label>
                                        <input type="file" name="flImage" id="flImage" class="form-control" placeholder="Choose file">
                                    </div>
                                    <div class="form-group">
                                        <textarea id="editor" name="txtBody" placeholder="What do you want to post?"></textarea>
                                    </div>
                                    <button type="submit" name="btnAddTask" class="btn btn-primary mt-3 float-right">Publish</button>
                                </form>
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
    <script src="js/tinymce/js/tinymce/tinymce.min.js"></script>

    <script>
        tinymce.init({
          selector:'textarea',
          browser_spellcheck: true,
          menubar: false,
          branding: false,
        });
    </script>   

</body>

</html>