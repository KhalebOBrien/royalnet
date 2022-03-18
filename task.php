<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tasks - Royal Network</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="icon" href="/images/logo.png">
    <link href="css/dashboard-temp.css" rel="stylesheet">
    <link rel="stylesheet" href="css/user-dashboard.css">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Royal Network</div>
            </a>

            <hr class="sidebar-divider my-0">


            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="user-dashboard.html" >
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="task.html" >
                    <span>Tasks</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="withdraw.html">
                    <span>Withdraw</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Profile
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="my-account.html">
                    <span>My Account</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tables.html" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <span>Logout</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
          
        </ul>
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="bi bi-list text-success"></i> 
                        
                    </button>
                    <span class="brand-name">Royal Net</span>
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <div class="navbar-wrapper">
                            <nav class="navbar ">
                              <ul class="nav justify-content-end">
                                  <li class="nav-item"> 
                                    <div class="btn-group dropdown">
                                      <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span><i>User name</i></span>
                                        <i class="bi bi-person" style="width: 500px;"></i>
                                      </button>
                                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="my-account.html">My Account</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Log Out</a></li>
                                      </ul>
                                    </div>
                                  </li>
                              </ul>
                          </nav>
                        </div>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tasks</h1>
                    </div>

                        <!-- tasks -->
                     <div class="card shadow mb-4">
                          <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary">Available tasks</h6>
                          </div>
                          <div class="card-body">
                            <div class="card-body">
                                <p>Your Task: Make sure you read carefully before performing the task.</p>
                                <p>Step 1, Click on Tasks.</p>
                                <p>Step 2, Wait for few seconds to view the advert campaign and today news headlines with promoted links.</p>
                                <p>Step 3, Download the sponsored image and copy the sponsored content</p>
                                <p>Step 4, Upload it on your Social media timeline, then you are done. You can add any text or write up as you wish either for promotion and getting referrals.</p>
                            </div>

                            <h5 class="card-title">Tasks</h5>

                            <!-- tasks will be here -->

                            <div class="border-top">
                                <!-- Text about the task -->
                                <div class="mt-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget bibendum odio. Sed pulvinar arcu sapien, at tristique turpis aliquam id. Aliquam fringilla feugiat diam, eu bibendum augue rhoncus quis. Etiam at purus eu eros aliquam iaculis. In pharetra ornare nibh sit amet consectetur. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur egestas sapien id est hendrerit dapibus. Phasellus facilisis fermentum est, sed commodo tellus finibus ac.
                                </div>

                                <!--Task images -->

                                <div class="mt-3">
                                    <img src="" height="400" width="400" class="rounded" alt="task image">
                                    <img src="..." height="400" width="400" class="rounded ml-3" alt="task image">
                                </div>
                                
                            </div>

                             
                        </div>
                      </div>
                </div>
            
                </div>
                </div>

                    <!--Logout Modal -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to leave?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Select "Logout" below if you are ready to end your current session.
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">
                              <a href="sign-in.html" class="log-out-modal"> Logout</a>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                   

    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


    <script src="js/dashboard-temp.js"></script>


</body>

</html>