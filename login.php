<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;
    
    if (!isset($_SESSION['CSRF'])) {
        $_SESSION['CSRF'] = Helpers::generateRandomToken();
    }

    require_once './app/Controllers/AuthController.php';

    $auth = new AuthController();
    $auth->login($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.default.css">
    <link rel="icon" href="/images/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign In - <?= Helpers::APPLICATION_NAME ?></title>
</head>
<body>
    <div class="container">
    <nav class="navbar"></nav>
    
    <div class="float-end">Don't have an account? <a href="register">Create new account</a></div>
       

        <div class="text-center form-wrap col-sm-12 col-md-10 col-lg-5">
            
            <h4 class="pt-3"><?= Helpers::APPLICATION_NAME ?></h4>
            <hr>
            <form action="" method="post" name="login-form" onsubmit="return validateLogin()">
                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                <input type="text" name="txtEmail" class="form-control mt-2 form-input" id="email" placeholder="Email">
                <input type="password" name="txtPassword" class="form-control mt-2 form-input" id="password" placeholder="Password"> 
                <a href="forgot-password">Forgot password?</a> <br>

                <div id="register-err-msg" class="alert-danger" role="alert"></div>

                <br>
                <a href="how-to-make-payment" class="mt-5">How to make payment </a>
                <br>
                <button name="btnRegister" class="submit-form mt-4 mb-2">Sign Up</button>
            </form> <br>
            <a href="index" style="font-size: 12px">Cancel and return to website</a>
        </div>

        <footer>
            <div class="text-center mt-5" id="cpright">© <span id="copyrightYear"><?= Date('Y') ?></span> <?= Helpers::APPLICATION_NAME ?> </div>
        </footer>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/alertify.min.js"></script>
    <script src="js/login.js"></script>
    
    <?php 
        if (isset($_SESSION['msg'])) :
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            alertify.error('<?= $_SESSION['msg'] ?>');
        });
    </script>
    <?php
            unset($_SESSION['msg']);
        endif;
    ?>
</body>
</html>