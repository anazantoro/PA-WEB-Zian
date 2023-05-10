<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto" action="<?php end(explode('/', $_SERVER['PHP_SELF'])) ?>" method="GET">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element form-group">
            <input class="form-control" autocomplete="off" type="search" name="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn form-control" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block"><?= $data['nama_user'] ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title text-center"><?= $data['status'] ?></div>
                <a href="changeProfile.php" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Change Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="controllers/ControllerUser.php?logout=true" id="logout" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>