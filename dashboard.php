<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }
    
    require_once './app/Controllers/UserController.php';
    require_once './app/Controllers/PackageController.php';
    require_once './app/Controllers/TransactionController.php';
    
    $u = new UserController();
    $referrals = $u->fetchUserReferrals();
    $u->approveUser();
    
    $p = new PackageController();

    $tranx = new TransactionController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard - <?= Helpers::APPLICATION_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.core.css">
    <link rel="stylesheet" type="text/css" href="css/alertify.default.css">
    <link rel="icon" href="/images/logo.png">
    <link href="css/dashboard-temp.css" rel="stylesheet">
    <link rel="stylesheet" href="css/user-dashboard.css">
</head>

<body id="page-top">
    <div id="wrapper">

        <?php include_once './partials/__dashboard-sidenav.php' ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php
                    include_once './partials/__dashboard-topnav.php';

                    // decide dashboard view by user type
                    if ($_SESSION['user']['is_admin']) :
                        // show admin dashboard
                        $allUsers = $u->fetchAllUsers(true);
                        $allApprovedUsers = $u->fetchAllApprovedUsers(true);
                        $pendingUsers = $u->fetchAllUnapprovedUsers(true);
                        $accWorth = $u->getAccumulatedWorth();
                        $payOuts = $tranx->sumAllApprovedTransactions('withdrawal')
                ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
                        </div>

                        <div class="row">
                            <!-- Total num of users -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Users
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <span><?= count($allUsers['users']) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total num of pending users -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Pending Users
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <span><?= count($pendingUsers['users']) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total num of approved users -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Approved Users
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <span><?= count($allApprovedUsers['users']) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total users accummulated balance -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Users Wallet Bal.
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    &#8358;<?= $accWorth ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-currency-exchange btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total users estimated worth -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    User Estimated Worth
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    &#8358;<?= $allUsers['summedDeposits'] ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-currency-exchange btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total users pending deposits -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Pending Deposits
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    &#8358;<?= $pendingUsers['summedDeposits'] ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-currency-exchange btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total users approved deposits -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Approved Deposits.
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    &#8358;<?= $allApprovedUsers['summedDeposits'] ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-currency-exchange btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total payouts -->
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Paid Out
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    &#8358;<?= $payOuts ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-currency-exchange btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- List of all users and some of their details -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Pending Users</h6>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Date Joined</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if(!empty($pendingUsers['users'])) :
                                                foreach($pendingUsers['users'] as $unapproved) :
                                        ?>
                                        <tr>
                                            <td><?= $unapproved['surname'].', '.$unapproved['other_names'] ?></td>
                                            <td><?= $unapproved['email'] ?></td>
                                            <td><?= $unapproved['phone'] ?></td>
                                            <td><?= $unapproved['created_at'] ?></td>
                                            <td><?= $p->getPackage($unapproved['package'])['name'] ?></td>
                                            <td><a href="dashboard?approve=<?=$unapproved['referral_code']?>&back=dashboard" class="btn btn-primary">Approve</a></td>
                                        </tr>
                                        <?php
                                                endforeach;
                                            endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php 
                    else :
                        // show user dashboard
                        $walletBalance = $u->fetchUserWalletBalance();
                ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>

                        <!-- Referal link -->
                        <div class="card border-left-warning shadow mb-3">
                            <span class="referral-link">Referral link: <span id="ref-link"><?= Helpers::APPLICATION_DOMAIN.'register?r='.$_SESSION['user']['referral_code'] ?></span>
                                <span class="float-end">
                                    <button class="btn" id="copy-ref-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard"> <i class="bi bi-clipboard"></i></button>
                                </span>
                            </span>
                        </div>

                        <div class="row">
                            <!-- Wallet Balance -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Available Balance
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    &#8358;<?= $walletBalance ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-currency-exchange btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total referral -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Referrals</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <span><?= count($referrals) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- How to perform task -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">How to perform a task</h6>
                                </div>
                                <div class="card-body">
                                    <p>Make sure you read carefully before performing the task.</p>
                                    <p>Step 1, Click on Tasks.</p>
                                    <p>Step 2, Wait for few seconds to view the advert campaign and today news headlines with promoted links.</p>
                                    <p>Step 3, Copy the link from your browser and share on your Social media timeline, then you are done. You can add any text or write up as you wish either for promotion and getting referrals.</p>
                                </div>
                            </div>

                            <!-- My referrals -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">My referrals</h6>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Dated Joined</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if (!empty($referrals)) :
                                                    foreach ($referrals as $referral) :
                                                        $dt = new \DateTime($referral['created_at']);
                                            ?>
                                            <tr>
                                                <td><?= $referral['surname'].', '.$referral['other_names'] ?></td>
                                                <td><?= $dt->format('d F Y') ?></td>
                                            </tr>
                                            <?php
                                                    endforeach;
                                                endif;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    endif;
                ?>

            </div>
            
            <?php include_once './partials/__logout-modal.php' ?>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/alertify.min.js"></script>
    <script src="js/dashboard-temp.js"></script>
    <script src="js/copy-to-clipboard.js"></script>
    
    <?php 
        if (isset($_SESSION['msg'])) :
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            alertify.success('<?= $_SESSION['msg'] ?>');
        });
    </script>
    <?php
            unset($_SESSION['msg']);
        endif;
    ?>
</body>

</html>
