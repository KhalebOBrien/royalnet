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
    <title>Privacy Policy - <?= Helpers::APPLICATION_NAME ?></title>
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
                    <span class="privacy-subhead">PRIVACY POLICY</span>  <span class="line"></span>
                </div>
                <div class="text-muted">
                    To keep Royal Network Agency running, we use third-party advertising companies to serve ads when you visit our web site.
                    These companies may use information (not including your name, address email address or telephone number) about your visits to this and other Web sites in order to provide advertisements about goods and services of interest to you. If you would like more information about this practice and to know your choices about not having this information used by these companies.  We control the configuration of the tool and are responsible for any information sent to the search engines.
                </div>
            </div>

            <div class="p-4">
                <div class="mb-2">
                    <span class="privacy-subhead">COPYRIGHT</span>  <span class="line"></span>
                </div>
                <div class="text-muted">
                    We try not to infringe on any right-of-usage by reviewing the Terms of use/service of most of our sources and contents posted on this platform, but because Terms of use/service could change at any time and we do not guarantee to keep track of all our sources’ <br>
                    <strong>Terms of use/service.</strong> <br>
                    We implore any source or individual contents that feels we encroached on its copyright to give us notice of de-linking or removing contents via our contact us, we promise to remove the content from database within 48 hours of confirming the request originated from the right news source.
                </div>
            </div>

            <div class="p-4">
                <div class="mb-2">
                    <span class="privacy-subhead">PAYMENT</span>  <span class="line"></span>
                </div>
                <div class="text-muted">
                    Royal Network Agency has the right to approve and reject every payment withdrawals placed on our site by our subscribers. Feel free to complain via our customer care representative.
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include_once './partials/__site-footer.php' ?>
    
</body>
</html>