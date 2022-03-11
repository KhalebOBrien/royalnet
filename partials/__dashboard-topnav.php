<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="bi bi-list text-success"></i>
    </button>
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- User actions - top right -->
        <div class="navbar-wrapper">
            <nav class="navbar ">
                <ul class="nav justify-content-end">
                    <li class="nav-item"> 
                        <div class="btn-group dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i><?= $_SESSION['user']['surname'] ?></i></span>
                                <i class="bi bi-person" style="width: 500px;"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="my-account">My Account</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>   
            </nav>
        </div>
    </ul>
</nav>