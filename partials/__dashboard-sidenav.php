<?php

use App\Services\Helpers;
?>

<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"><?= Helpers::APPLICATION_NAME ?></div>
    </a>

    <hr class="sidebar-divider my-0">

    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard" >
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
        <a class="nav-link collapsed" href="my-account">
            <span>My Account</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <span>Logout</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">
    
</ul>