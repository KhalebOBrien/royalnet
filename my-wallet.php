<?php
    session_start();
    require_once './app/Services/Helpers.php';
    use App\Services\Helpers;

    if (!isset($_SESSION['user'])) {
        header('location: login');
    }

    if (!isset($_SESSION['CSRF'])) {
        $_SESSION['CSRF'] = Helpers::generateRandomToken();
    }

    require_once './app/Controllers/TransactionController.php';
    require_once './app/Controllers/UserController.php';
    
    $u = new UserController();

    $tranx = new TransactionController();
    $transactions = $tranx->getAllTransactionByUser($_SESSION['user']['id']);
    $walletBalance = $u->fetchUserWalletBalance();
    $tranx->withdrawalRequest($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Withdraw - <?= Helpers::APPLICATION_NAME ?></title>
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
                        <h1 class="h3 mb-0 text-gray-800">My Wallet</h1>
                        <h4 class="h4 btn btn-primary mb-0 text-white" data-bs-toggle="modal" data-bs-target="#withdrawalRequestModal">Request Withdrawal</h4>
                    </div>

                    <div class="row">
                        <!-- Available balance -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
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

                        <!-- Total referral bonus -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Referral Bonus
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                &#8358;<?= $tranx->sumUserTransactionsByType($_SESSION['user']['id'], 'referral bonus') ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-currency-exchange btn-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total withdrawal -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                All Time Withdrawals
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                &#8358;<?= $tranx->sumUserTransactionsByType($_SESSION['user']['id'], 'withdrawal') ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-currency-exchange btn-lg"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Total earnings -->
                        <div class="col-xl-3 col-md-3 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                All Time Total Earnings
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                &#8358;<?= $tranx->sumUserTransactionsByType($_SESSION['user']['id']) ?>
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
                    
                    <!-- Transactions -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transactions</h6>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Reference Code</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Amount (&#8358;)</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Approval Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($transactions)) :
                                            foreach ($transactions as $transaction) :
                                    ?>
                                    <tr>
                                        <td><?= $transaction['reference_code'] ?></td>
                                        <td><?= ucwords($transaction['type']) ?></td>
                                        <td><?= $transaction['amount'] ?></td>
                                        <td><?= $transaction['created_at'] ?></td>
                                        <td><?= $transaction['is_approved'] ? '<span class="badge badge-primary">Approved</span>' : '<span class="badge badge-secondary">Pending</span>' ?></td>
                                        <td><?= $transaction['updated_at'] ?></td>
                                    </tr>
                                    <?php
                                            endforeach;
                                        else :
                                    ?>
                                    <tr>
                                        <td colspan="6">No Transactions FOUND!</td>
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

            <!-- Withdrawal Request Modal -->
            <div class="modal fade" id="withdrawalRequestModal" tabindex="-1" aria-labelledby="withdrawalRequestModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-weight-40" id="withdrawalRequestModalLabel">Request Withdrawal</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><b>NOTE:</b> When withdrawal has been placed, you have to wait a bit for the Admin to confirm and make payment. </p>

                            <form action="" method="post" name="withdrawal-form">
                                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">&#8358;</span>
                                    <input type="text" name="txtAmount" class="form-control" placeholder="Enter Amount" aria-describedby="basic-addon1">
                                </div>
                                    <small class="text-danger">Maximum withdrawable amount: <b>&#8358;<?= $walletBalance ?></b></small>

                                <button name="btnRequestWithdrawal" class="submit-form float-right btn btn-primary mt-4 mb-2">Submit</button>
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
