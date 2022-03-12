<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }
    
    if (!isset($_SESSION['CSRF'])) {
        $_SESSION['CSRF'] = Helpers::generateRandomToken();
    }

    require_once './app/Controllers/AuthController.php';

    $auth = new AuthController();
    $auth->changePassword($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Change Password - <?= Helpers::APPLICATION_NAME ?></title>
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

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Change your account password</h6>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <form action="" method="POST" name="change-password-form">
                                    <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                                    <input type="password" name="txtOldPassword" class="form-control mt-3" placeholder="Enter current password">
                                    <input type="password" name="txtNewPassword" class="form-control mt-3" placeholder="Enter new password">
                                    <input type="password" name="txtConfirmNewPassword" class="form-control mt-3" placeholder="Re-enter new password">
                                    <button type="submit" name="btnChangePassword" class="btn btn-success mt-3 float-end">Change Password</button>
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
</body>

</html>