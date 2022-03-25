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
    
    require_once './app/Controllers/BankController.php';
    
    $b = new BankController();
    $banks = $b->getAll();
    $b->createBank($_POST);
    $b->updateBank($_POST);
    $b->deleteBank();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Manage Banks - <?= Helpers::APPLICATION_NAME ?></title>
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
                        <h1 class="h3 mb-0 text-gray-800">Banks</h1>
                        <h4 class="h4 btn btn-primary mb-0 text-white" data-bs-toggle="modal" data-bs-target="#createBankModal">Add Bank</h4>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Supported Banks</h6>
                        </div>
                        <div class="row">
                            
                            <?php
                                if (!empty($banks)) :
                                    foreach ($banks as $bank) :
                                        // $reff = $user->fetchUserReferrer($admin['referrers_code']);
                                        // count users under this bank
                            ?>
                            <div class="col-xl-3 col-md-3 mb-4">
                                <div class="card hover shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info mb-1">
                                                    <h6><?= $bank['name'] ?></h6>
                                                </div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    <i class="bi bi-people-fill btn-lg"></i><span><?= $b->sumBankUsers($bank['id']) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="btn btn-primary btn-sm p-0 mb-1 btn-show-update" data-bs-toggle="modal" data-bs-target="#updateBankModal" data-bankid="<?=$bank['id']?>" data-bankname="<?=$bank['name']?>"><i class="bi bi-pencil-square btn-lg"></i></span><br>
                                                <a href="manage-banks?delete=<?= $bank['id'] ?>" class="btn btn-danger btn-sm p-0 m-0 btn-delete"><i class="bi bi-trash btn-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!--Add Bank Modal -->
            <div class="modal fade" id="createBankModal" tabindex="-1" aria-labelledby="bankCreateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bankCreateModalLabel">Add A Bank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" name="create-bank-form">
                                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                                <input type="text" name="txtBankName" class="form-control mt-2 form-input" id="" placeholder="Bank Name">

                                <button name="btnAddBank" class="submit-form float-right btn btn-primary mt-4 mb-2">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--Update Bank Modal -->
            <div class="modal fade" id="updateBankModal" tabindex="-1" aria-labelledby="bankUpdateModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bankUpdateModalLabel">Update Bank</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" name="update-bank-form">
                                <input type="hidden" name="csrfToken" value="<?= $_SESSION['CSRF'] ?>">
                                <input type="hidden" name="txtBankId" id="txtBankId">
                                <div class="form-group mb-4">
                                    <label for="txtBankName" class="mb-0">Current Bank Name</label>
                                    <input type="text" class="form-control txtBankName mt-2 form-input" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="txtBankName" class="mb-0">New Bank Name</label>
                                    <input type="text" name="txtBankName" class="form-control mt-2 form-input" placeholder="Bank Name">
                                </div>

                                <button name="btnUpdateBank" class="submit-form float-right btn btn-primary mt-4 mb-2">Update</button>
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
            $('.btn-show-update').on('click', function(e){
                $('.txtBankName').val(this.dataset.bankname);
                $('#txtBankId').val(this.dataset.bankid);
            });
            $('.btn-delete').on('click', function(e){
                e.preventDefault();
                if(confirm('Are you sure you want to delete this bank? \n\nAll members who have added this bank will need to update their account again as this bank will be removed their account! \n\nDo you still want to proceed?')){
                    window.location = this.href;
                }
            });
        });
    </script>

</body>

</html>