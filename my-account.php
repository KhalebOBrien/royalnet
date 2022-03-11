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
    <title>My Account - <?php Helpers::APPLICATION_NAME ?></title>
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
                        <h1 class="h3 mb-0 text-gray-800">My Account</h1>
                    </div>
                
                    <div class="card border-left-warning shadow mb-3">
                        <span class="referral-link">Referral link: <span><?= Helpers::APPLICATION_DOMAIN.'register?r='.$_SESSION['user']['referral_code'] ?></span></span>
                    </div>

                    <!-- Profile info -->
                    <div class="row justify-content-around">
                        <div class="card col-lg-4 col-12 mt-2">
                            <div class="card-body  profile">
                                <h5 class="card-title mb-4"><span><?= $_SESSION['user']['surname'].', '.$_SESSION['user']['other_names'] ?></span></h5>
                                <h6 class="card-text">
                                    <i class="bi bi-envelope"></i>
                                    E-mail   
                                    <span class="text-muted float-end"><?= $_SESSION['user']['email'] ?></span>
                                </h6>

                                <h6 class="card-text">
                                    <i class="bi bi-phone"></i>
                                    Phone   
                                    <span class="text-muted float-end"><?= $_SESSION['user']['phone'] ?></span>
                                </h6>
                                <div class="row mt-4">
                                    <p class="card-text col-6">
                                        <strike>N</strike> <span>0</span> <br>
                                        Total Earnings
                                    </p>
                                    <p class="card-text col-6"><span>0</span> <br>
                                        Referrals
                                    </p>
                                </div>
                                <hr>
                                <div class="d-grid gap-2">
                                    <button class="btn bg-gray-600" type="button"><a href="change-password" class="card-link change-password"><i class="bi bi-lock"></i> Change Password</a></button>
                                </div>
                            </div>
                        </div>

                        <!-- Set up account -->
                        <div class="card shadow mb-4 col-lg-7 col-12 mt-2">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Set up account</h6>
                                Do this before you start performing tasks
                            </div>
                            <div class="card-body">
                                <h6><strong> Account Details</strong></h6>
                                <form action="" method="POST">
                                    <select class="form-select" name="slBank" aria-label="Default select example">
                                        <option selected disabled>Select bank</option>
                                        <option value="access">Access Bank</option>
                                        <option value="access diamond">Access Bank (Diamond)</option>
                                        <option value="citi">Citibank</option>
                                        <option value="ecobank">Ecobank</option>
                                        <option value="fidelity">Fidelity Bank</option>
                                        <option value="first">First Bank</option>
                                        <option value="fcmb">First City Monument Bank (FCMB)</option>
                                        <option value="gtb">Guaranty Trust Bank (GTB)</option>
                                        <option value="heritage">Heritage Bank</option>
                                        <option value="jaiz">Jaiz Bank</option>
                                        <option value="keystone">Keystone Bank</option>
                                        <option value="kuda">Kuda Bank</option>
                                        <option value="parallex">Parallex Bank</option>
                                        <option value="polaris">Polaris Bank</option>
                                        <option value="providus">Providus Bank</option>
                                        <option value="skye">Skye Bank</option>
                                        <option value="stanbic">Stanbic IBTC Bank</option>
                                        <option value="standard">Standard Chartered Bank</option>
                                        <option value="sterling">Sterling Bank</option>
                                        <option value="suntrust">Suntrust Bank</option>
                                        <option value="titan trust"> Titan Trust Bank</option>
                                        <option value="union">Union Bank</option>
                                        <option value="uba">United Bank for Africa (UBA)</option>
                                        <option value="unity">Unity Bank</option>
                                        <option value="wema">Wema Bank</option>
                                        <option value="zenith">Zenith Bank</option>
                                    </select>
                                    <input type="number" name="acctNumber" class="form-control mt-3" placeholder="Account number">
                                    <input type="text" name="acctName" class="form-control mt-3" placeholder="Account name">
                                
                                    <h6 class="mt-4"><strong> Socoal Media Links</strong></h6>
                                    Enter the link of your social media where you will be posting your tasks.
                                    <div class="mb-3 mt-3"> 
                                        <div class="input-group mb-3">
                                        <span class="input-group-text bg-primary" id="basic-addon1"><i class="bi bi-facebook text-light"></i></span>
                                        <input type="text" name="fb_link" class="form-control" placeholder="https://m.facebook.com/username" value="<?= $_SESSION['user']['fb_link'] ?>" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-primary" id="basic-addon1"><i class="bi bi-twitter text-light"></i></span>
                                            <input type="text" name="tw_link" class="form-control" placeholder="https://twitter.com/username" value="<?= $_SESSION['user']['tw_link'] ?>" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-danger" id="basic-addon1"><i class="bi bi-instagram text-light"></i></span>
                                            <input type="text" name="ig_link" class="form-control" placeholder="https://instagram.com/username" value="<?= $_SESSION['user']['ig_link'] ?>" aria-describedby="basic-addon1">
                                        </div>
                                        
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-danger" id="basic-addon1"><i class="bi bi-youtube text-light"></i></span>
                                            <input type="text" name="yt_link" class="form-control" placeholder="https://youtube.com/username" value="<?= $_SESSION['user']['yt_link'] ?>" aria-describedby="basic-addon1">
                                        </div>
                                        
                                        <button type="submit" class="btn btn-success float-end">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- delete account section -->
                    <div class="card shadow mt-3 mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Delete Account</h6>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <i class="bi bi-exclamation-triangle col-1"></i> 
                                <div class="col-11">
                                    By deleting your account, you will loose every data. This action is irreversible.
                                </div>
                            </div>

                            <form action="">
                                <input type="password" class="form-control mt-3" placeholder="Enter password">
                                <button type="submit" class="btn btn-danger mt-3 float-end">Delete account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include_once './partials/__logout-modal.php' ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/dashboard-temp.js"></script>


</body>

</html>