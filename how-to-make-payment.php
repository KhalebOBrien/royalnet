<?php
  require_once './app/Services/Helpers.php';
  use App\Services\Helpers;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/images/logo.png">
    <title>How to make payment - <?= Helpers::APPLICATION_NAME ?></title>
</head>
<body>
    
    <?php include_once './partials/__whatsapp-button.php' ?>

    <div class="container">
        <div class="privacy pt-4 col-sm-12 col-md-10 col-lg-8">
            <div class="text-center ">
                <h2><?= Helpers::APPLICATION_NAME ?></h2>
            </div>
            <div class="p-4">
                <div class="mb-2">
                    <span class="privacy-subhead">HOW TO SUCCESSFULLY MAKE PAYMENT WITH OPAY</span>  <span class="line"></span>
                </div>
                <div class="col-12 mb-3">
                  <img src="images/opay icon.png" alt="opay icon" width="50%">
                </div>
                
                <div class="text-muted">
                1. Download the Opay mobile app from your phones Play Store
                <br>

                2. Fund your Opay account 
                <br>

                3. Transfer to our Agency's official Opay number <em><strong>+234 703 349 9876 or +234 909 616 7191</strong></em>
                <br>

                4. Send our Customer Care a proof of payment via Whatsapp, click the Whatsapp icon at the bottom right of the screen 
                <br>

                5. Wait for a confirmation of your payment
                <br>
                </div>
            </div>

            <div class="p-4">
                <div class="mb-2">
                    <span class="privacy-subhead">Or</span> 
                </div>
                <div class="text-muted">
                1. Visit a nearby Opay POS Stand 
                <br>

                2. Deposit the required amount via the Opay POS Agent to our Official Opay Number <em><strong>+234 703 349 9876 or +234 909 616 7191</strong></em>
                <br>

                3. Send a proof of payment to our customer care via Whatsapp, click the Whatsapp icon at the bottom right of the screen
                <br>

                4. Wait for a confirmation of your payment 
                <br>
                <br>

                <strong>All payments made should be confirmed within 24 hours.</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once './partials/__site-footer.php' ?>
    
</body>
</html>