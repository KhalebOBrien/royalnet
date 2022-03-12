<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;
    if (!isset($_SESSION['CSRF'])) {
        $_SESSION['CSRF'] = Helpers::generateRandomToken();
    }

    require_once './app/Controllers/AuthController.php';

    $auth = new AuthController();
    $auth->register($_POST);
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
    <title>Sign Up - <?= Helpers::APPLICATION_NAME ?></title>
</head>
<body class="sign-body">

    <div class="container">
        <div class="text-center form-wrap col-sm-12 col-md-10 col-lg-6">
            <h2><?= Helpers::APPLICATION_NAME ?></h2>
            <h4>Sign up to get started</h4>
            <p style="color: gray;">It's fast and easy</p>
            <hr>
            <form action="" method="post" name="register-form">
                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                <input type="hidden" name="referrers_code" value="<?= isset($_GET['r'])?$_GET['r']:'' ?>">
                <input type="text" name="txtSurname" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="Surname">
                <input type="text" name="txtOtherNames" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="Other names">
                <select name="slPackage" class="form-control mt-2 form-select" required>
                    <option selected disabled>Select a Package</option>
                    <option value="Member - N3,000">Member - N3,000</option>
                    <option value="Agent - N5,000">Agent - N5,000</option>
                    <option value="VIP 1 - N10,000">VIP 1 - N10,000</option>
                    <option value="VIP 2 - N25,000">VIP 2 - N25,000</option>
                    <option value="VIP 3 - N60,000">VIP 3 - N60,000</option>
                    <option value="Deputy Manager - N150,000">Deputy Manager - N150,000</option>
                    <option value="Manager - N250,000">Manager - N250,000</option>
                    <option value="Assistant Director - N500,000">Assistant Director - N500,000</option>
                    <option value="Director - N1,000,000">Director - N1,000,000</option>
                    <option value="Shareholder - N2,000,000">Shareholder - N2,000,000</option>
                </select>
                <input type="email" name="txtEmail" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="E-mail">
                <input type="number" name="txtPhone" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="Phone number">
                <input type="password" name="txtPassword" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="Password">
                <input type="password" name="txtConfirmPassword" class="form-control mt-2 form-input" id="exampleFormControlInput1" placeholder="Re-enter Password">

                <p class="mt-1" style="font-size: 12px;">By signing up you agree to our <a href="privacy-policy"> Privacy Policy</a></p>

                <button name="btnRegister" class="submit-form mt-4 mb-2">Sign Up</button>
            </form> <br>
            <a href="login">Already have an account?</a>
        </div>

        <footer>
            <div class="text-center mt-5" id="cpright">© <span id="copyrightYear"><?= Date('Y') ?></span> <?= Helpers::APPLICATION_NAME ?> </div>
        </footer>

    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>