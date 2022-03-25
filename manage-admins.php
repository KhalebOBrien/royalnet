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
    
    $user = new UserController();
    $admins = $user->fetchAdmins();
    if($_SESSION['user']['is_super_admin']){
        $user->createAdmin($_POST);
        $user->suspendUser($_POST);
        $user->reviveUser($_POST);
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
                        <h1 class="h3 mb-0 text-gray-800">Admin Users</h1>
                        <?php
                            if($_SESSION['user']['is_super_admin']) :
                        ?>
                        <h4 class="h4 btn btn-primary mb-0 text-white" data-bs-toggle="modal" data-bs-target="#createAdminModal">Add Admin</h4>
                        <?php
                            endif;
                        ?>
                    </div>

                    <!-- List of all admins and their details -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Our Admins</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Unique Code</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Date Created</th>
                                        <th scope="col">Status</th>
                                        <?php
                                            if($_SESSION['user']['is_super_admin']) :
                                        ?>
                                        <th scope="col">Action</th>
                                        <?php
                                            endif;
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($admins)) :
                                            foreach ($admins as $admin) :
                                                $reff = $user->fetchUserReferrer($admin['referrers_code']);
                                                $btn = '';
                                                if(!$admin['is_super_admin']) {
                                                    if ($admin['is_suspended']) {
                                                        $btn = '<a href="manage-admins?revive='.$admin['referral_code'].'" class="btn btn-primary revive-link">Revive</a>';
                                                    }
                                                    else {
                                                        $btn = '<a href="manage-admins?suspend='.$admin['referral_code'].'" class="btn btn-danger suspension-link">Suspend</a>';
                                                    }
                                                }
                                    ?>
                                    <tr>
                                        <td><?= $admin['surname'].', '.$admin['other_names'] ?></td>
                                        <td><?= $admin['email'] ?></td>
                                        <td><?= $admin['referral_code'] ?></td>
                                        <td><?= !empty($reff) ? $reff['email'] : '' ?></td>
                                        <td><?= $admin['created_at'] ?></td>
                                        <td><?= $admin['is_suspended'] ? '<span class="badge badge-secondary">Suspended</span>' : '<span class="badge badge-primary">Active</span>' ?></td>
                                        <?php
                                            if($_SESSION['user']['is_super_admin']) :
                                        ?>
                                        <td>
                                            <?= $btn ?>
                                        </td>
                                        <?php
                                            endif;
                                        ?>
                                    </tr>
                                    <?php
                                            endforeach;
                                        else :
                                    ?>
                                    <tr>
                                        <td colspan="">Users full name </td>
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

            <!--Add Admin Modal -->
            <div class="modal fade" id="createAdminModal" tabindex="-1" aria-labelledby="adminCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="adminCreateModalLabel">Create An Admin</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" name="create-admin-form">
                                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                                <input type="hidden" name="referrers_code" value="<?= $_SESSION['user']['referral_code'] ?>">
                                <input type="text" name="txtSurname" class="form-control mt-2 form-input" id="" placeholder="Surname">
                                <input type="text" name="txtOtherNames" class="form-control mt-2 form-input" id="" placeholder="Other names">
                                <input type="number" name="txtPhone" class="form-control mt-2 form-input" id="" placeholder="Phone number">
                                <input type="email" name="txtEmail" class="form-control mt-2 form-input" id="" placeholder="E-mail">
                                <input type="password" name="txtPassword" class="form-control mt-2 form-input" id="" placeholder="Password">

                                <button name="btnAddAdmin" class="submit-form float-right btn btn-primary mt-4 mb-2">Create</button>
                            </form>
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
    <script>
        $(document).ready(function(){
            // warn before performing action
            $('.revive-link').on('click', function(e){
                e.preventDefault();
                if(confirm('Are you sure you want to revive this admin?')){
                    window.location = this.href;
                }
            });
            $('.suspension-link').on('click', function(e){
                e.preventDefault();
                if(confirm('Are you sure you want to suspend this admin?')){
                    window.location = this.href;
                }
            });
        });
    </script>

</body>

</html>