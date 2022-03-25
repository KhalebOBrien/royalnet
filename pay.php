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
    
    if (isset($_SESSION['user']) && $_SESSION['user']['is_super_admin'] != 1) {
        header('location: 403');
    }
    
    require_once './app/Controllers/TransactionController.php';
    require_once './app/Controllers/BankController.php';
    
    $tranx = new TransactionController();
    $bank = new BankController();
    $withdrawalRequests = $tranx->getAllWithdrawalRequest();
    $tranx->approveWithdrawal();
    $tranx->revokeWithdrawal();
    $tranx->switchWithdrawal(isset($_GET['switch']) ? $_GET['switch'] : null);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pay Users - <?= Helpers::APPLICATION_NAME ?></title>
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
                        <h1 class="h3 mb-0 text-gray-800">Withdrawal Requests</h1>
                        <?php
                            if($_SESSION['user']['is_super_admin']) :
                                if ($tranx->isWithdrawalTurnedOn()) :
                        ?>
                        <a href="pay?switch=off&back=pay" class="btn-turn-off-withdrawals"><h4 class="h4 btn btn-danger mb-0 text-white">Turn OFF Withdrawals</h4></a>
                        <?php
                                else :
                        ?>
                        <a href="pay?switch=on&back=pay" class="btn-turn-on-withdrawals"><h4 class="h4 btn btn-primary mb-0 text-white">Turn ON Withdrawals</h4></a>
                        <?php
                                endif;
                            endif;
                        ?>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users Withdrawal Request</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Account Details</th>
                                        <th scope="col">Social Media Handle</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($withdrawalRequests)) :
                                            foreach ($withdrawalRequests as $wr) :
                                                // get the bank name
                                                $b = $bank->getBank($wr['bank']);
                                                $bankName = empty($b) ? '' : $b['name'];
                                                // get social handles
                                                $tw = empty($wr['tw_link']) ? '' : '<a href="'.$wr['tw_link'].'" target="_blank"><i class="bi bi-facebook btn bg-primary text-light"></i></a>';
                                                $fb = empty($wr['fb_link']) ? '' : '<a href="'.$wr['fb_link'].'" target="_blank"><i class="bi bi-twitter btn bg-primary text-light"></i></a>';
                                                $ig = empty($wr['ig_link']) ? '' : '<a href="'.$wr['ig_link'].'" target="_blank"><i class="bi bi-instagram btn bg-danger text-light"></i></a>';
                                                $yt = empty($wr['yt_link']) ? '' : '<a href="'.$wr['yt_link'].'" target="_blank"><i class="bi bi-youtube btn bg-danger text-light"></i></a>';
                                    ?>
                                    <tr>
                                        <td><?= $wr['surname'].', '.$wr['other_names'] ?></td>
                                        <td>&#8358;<?= $wr['requestedAmount'] ?></td>
                                        <td><?= $bankName.', '.$wr['acct_name'].' '.$wr['acct_number'] ?></td>
                                        <td><?= $tw.' '.$fb.' '.$ig.' '.$yt ?></td>
                                        <td>
                                            <?= $wr['isApproved'] ? '<span class="badge badge-success">Approved</span>' : '' ?>
                                            <?= $wr['isRevoked'] ? '<span class="badge badge-warning">Revoked</span>' : '' ?>
                                            <?= (!$wr['isApproved'] && !$wr['isRevoked']) ? '<span class="badge badge-secondary">Pending</span>' : '' ?>
                                        </td>
                                        <td>
                                            <?= ($wr['isApproved'] || $wr['isRevoked']) ? '' : '<a href="pay?approve='.$wr['referenceCode'].'&back=pay" class="btn btn-primary">Approve</a> <a href="pay?revoke='.$wr['referenceCode'].'&back=pay" class="btn btn-danger">Revoke</a>' ?>
                                        </td>
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
            
            <?php include_once './partials/__logout-modal.php' ?>
        </div>
    </div>      


    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="js/dashboard-temp.js"></script>
    <script>
        $(document).ready(function(){
            $('.btn-turn-off-withdrawals').on('click', function(e){
                e.preventDefault();
                if(confirm('Are you sure you want to TURN OFF WITHDRAWALS? \n\nMembers will not be able to request for withdrawals.')){
                    window.location = this.href;
                }
            });
            $('.btn-turn-on-withdrawals').on('click', function(e){
                e.preventDefault();
                if(confirm('Are you sure you want to TURN ON WITHDRAWALS? \n\nMembers will be permitted to send in their withdrawal requests.')){
                    window.location = this.href;
                }
            });
        });
    </script>
</body>

</html>