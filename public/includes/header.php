<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <!-- <script src="../bootstrap/assets/js/color-modes.js"></script> -->
    <meta charset="UTF-8">
    <title><?= $match["name"] ?></title>
    <link rel="stylesheet" href="../bootstrap/assets/dist/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../bootstrap/assets/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header>
        <?php
        session_start();
        ?>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" class="t">
                    <img src="../images/avatar.png" alt="" width="35" height="35" class="d-inline-block rounded-circle">
                    <span class="text-white">Vote</span>
                </a>
                 <?php //dump($_SESSION)?>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true): ?>
                            <li class="nav-item">
                                <div class="dropdown me-3 bd-mode-toggle">
                                    <button class="btn btn-primary py-2 navbar-brand dropdown-toggle d-flex align-items-center"
                                        id="bd-theme"
                                        type="button"
                                        aria-expanded="false"
                                        data-bs-toggle="dropdown"
                                        aria-label="Toggle theme (auto)">
                                        <img src="<?= $_SESSION["company_logo"]?>" alt="" width="35" height="35" class="d-inline-block rounded-circle">
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false"> <?= $_SESSION["company_name"]?> </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item d-flex align-items-center text-primary" data-bs-theme-value="dark" aria-pressed="false">  <?= $_SESSION["company_email"]?> </button>
                                        </li>
                                        <li>
                                            <a type="button" data-bs-theme-value="auto" aria-pressed="true" class="nav-link dropdown-item d-flex align-items-center" href="/logout">Déconnexion</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <button type="button" class="btn btn-outline-primary text-uppercase fw-bold" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Connexion
                                </button>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="d-flex flex-column justify-content-center align-items-center">