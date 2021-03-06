<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;
    
    if (!isset($_SESSION['CSRF'])) {
        $_SESSION['CSRF'] = Helpers::generateRandomToken();
    }

    require_once './app/Controllers/AuthController.php';

    $auth = new AuthController();
    $auth->passwordResetTokenRequest($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="icon" href="/images/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Forgotten Password - <?= Helpers::APPLICATION_NAME ?></title>
</head>
<body>
    
    <div class="container">

        <div class="text-center form-wrap col-sm-12 col-md-10 col-lg-5">
            
            <h4 class="pt-3">Forgot Password</h4>
            <hr>
            
            <form action="" method="post">
                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                <input type="email" name="txtEmail" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="Email">

                <button name="btnSendResetToken" class="submit-form mt-4 mb-2">Send Reset Link</button>
            </form>
            
            <br>
        </div>

        <footer>
            <div class="text-center mt-5" id="cpright">© <span id="copyrightYear"><?= Date('Y') ?></span> <?= Helpers::APPLICATION_NAME ?> </div>
        </footer>


    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>