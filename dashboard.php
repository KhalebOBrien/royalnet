<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }
    
    require_once './app/Controllers/UserController.php';
    
    $u = new UserController();
    $referrals = $u->fetchUserReferrals();
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
    <link rel="icon" href="/images/logo.png">
    <link href="css/dashboard-temp.css" rel="stylesheet">
    <link rel="stylesheet" href="css/user-dashboard.css">
</head>

<body id="page-top">
    <div id="wrapper">

        <?php 
            if ($_SESSION['user']['is_admin']) {
                include_once './partials/__admin-dashboard-sidenav.php';
            }
            else {
                include_once './partials/__dashboard-sidenav.php';
            }
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php
                    include_once './partials/__dashboard-topnav.php';

                    // decide dashboard view by user type
                    if ($_SESSION['user']['is_admin']) :
                        // show admin dashboard
                ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
                        </div>

                        <div class="row">
                            <!-- Total num of users -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total Users
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <span>0</span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill btn-lg"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total num of people reffered -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Total number of people referred
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <span>0</span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="bi bi-people-fill btn-lg"></i>
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
                                <!-- search, filter and sort -->
                                <div class="container mb-4">
                                    <div class="row justify-content-end">
                                        <!-- search -->
                                        <div class="col-lg-4 col-sm-12 col-md-12">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Search by emial" aria-label="Search by emial" aria-describedby="basic-addon2">
                                                <button class="input-group-text"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-sm-12 col-md-12 ">
                                            <div class="float-end">
                                                <!-- filter -->
                                                <span class="dropdown">
                                                    <button class="btn btn-light dropdown-toggle border-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Filter
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Date joined</a></li>
                                                        <li><a class="dropdown-item" href="#">Verified users</a></li>
                                                        <li><a class="dropdown-item" href="#">Unverified users</a></li>
                                                    </ul>
                                                </span>
                                                <!-- sort -->
                                                <span class="dropdown ">
                                                    <button class="btn btn-light dropdown-toggle border-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Sort by plan
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Member</a></li>
                                                        <li><a class="dropdown-item" href="#">Agent</a></li>
                                                        <li><a class="dropdown-item" href="#">VIP 1</a></li>
                                                        <li><a class="dropdown-item" href="#">VIP 2</a></li>
                                                        <li><a class="dropdown-item" href="#">VIP 3</a></li>
                                                        <li><a class="dropdown-item" href="#">Deputy Manager</a></li>
                                                        <li><a class="dropdown-item" href="#">Manager</a></li>
                                                        <li><a class="dropdown-item" href="#">Assistant Director</a></li>
                                                        <li><a class="dropdown-item" href="#">Director</a></li>
                                                        <li><a class="dropdown-item" href="#">Shareholder</a></li>
                                                    </ul>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Table -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date joined</th>
                                            <th scope="col">Number of referral(s)</th>
                                            <th scope="col">Social Media Handle</th>
                                            <th scope="col">Plan</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Users full name </td>
                                            <td>1/1/1111</td>
                                            <td>000</td>
                                            <td>@mdo/twitter...</td>
                                            <td>plan type</td>
                                            <td><button type="button" class="btn btn-primary">Verify</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php 
                    else :
                        // show user dashboard
                ?>
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>

                        <!-- Referal link -->
                        <div class="card border-left-warning shadow mb-3">
                            <span class="referral-link">Referral link: <span><?= Helpers::APPLICATION_DOMAIN.'register?r='.$_SESSION['user']['referral_code'] ?></span></span>
                        </div>

                        <div class="row">
                            <!-- Total earnings -->
                            <div class="col-xl-6 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Total Earnings
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <strike>N</strike><span>0</span>
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
                                    <p>Step 3, Download the sponsored image and copy the sponsored content</p>
                                    <p>Step 4, Upload it on your Social media timeline, then you are done. You can add any text or write up as you wish either for promotion and getting referrals.</p>
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

    <script src="js/dashboard-temp.js"></script>
</body>

</html>