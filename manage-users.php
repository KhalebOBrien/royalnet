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
    
    require_once './app/Controllers/UserController.php';
    require_once './app/Controllers/PackageController.php';
    
    $user = new UserController();
    $members = $user->fetchAllUsers();
    // $user->createAdmin($_POST);
    
    $p = new PackageController();
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

        <?php include_once './partials/__dashboard-sidenav.php' ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php include_once './partials/__dashboard-topnav.php'?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Manage Users</h1>
                    </div>

                    <!-- List of all admins and their details -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Our Users</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Referral Code</th>
                                        <th scope="col">Referred By</th>
                                        <th scope="col">Package</th>
                                        <th scope="col">Date Joined</th>
                                        <th scope="col">Approved</th>
                                        <th scope="col">Status</th>
                                        <!-- <th scope="col">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($members)) :
                                            foreach ($members as $member) :
                                                $reff = $user->fetchUserReferrer($member['referrers_code']);
                                    ?>
                                    <tr>
                                        <td><?= $member['surname'].', '.$member['other_names'] ?></td>
                                        <td><?= $member['email'] ?></td>
                                        <td><?= $member['referral_code'] ?></td>
                                        <td><?= !empty($reff) ? $reff['email'] : '-' ?></td>
                                        <td><?= $p->getPackage($member['package'])['name'] ?></td>
                                        <td><?= $member['created_at'] ?></td>
                                        <td><?= $member['is_approved'] ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-secondary">No</span>' ?></td>
                                        <td><?= $member['is_suspended'] ? '<span class="badge badge-danger">Suspended</span>' : '<span class="badge badge-success">Active</span>' ?></td>
                                        <!-- <td><button type="button" class="btn btn-primary">Suspend</button></td> -->
                                    </tr>
                                    <?php
                                            endforeach;
                                        else :
                                    ?>
                                    <tr>
                                        <td colspan="8"><i>No Users FOUND</i> </td>
                                    </tr>
                                    <?php
                                        endif;
                                    ?>
                                </tbody>
                            </table>
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