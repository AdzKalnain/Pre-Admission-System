<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title><?php echo $title;?></title>
    <link rel="icon" href="<?php echo web_root; ?>assets/seal/wmsu-logo.png" sizes="32x32" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo web_root; ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="<?php echo web_root; ?>assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="<?php echo web_root; ?>node_modules/sweetalert2/dist/sweetalert2.min.css">

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="<?php echo web_root; ?>assets/DataTables/datatables.css">

    <!-- Custom Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">

</head>
      
<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-danger p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <img class="d-block mt-5 w-50" src="<?php echo web_root; ?>assets/seal/wmsu-logo.png" alt="">
                </a>
                <hr class="sidebar-divider my-0 mt-5">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <?php
                        if (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admin") {
                    ?>
                            <li class="nav-item"><a class="nav-link <?php echo $dashboard; ?>" href="<?php echo web_root; ?>admin/controller.php?page=dashboard"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $application; ?>" href="<?php echo web_root; ?>admin/controller.php?page=application"><i class="fas fa-user"></i><span>Applications</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $interview; ?>" href="<?php echo web_root; ?>admin/controller.php?page=interview"><i class="fas fa-table"></i><span>Interviewing</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $qualified; ?>" href="<?php echo web_root; ?>admin/controller.php?page=qualified"><i class="far fa-user-circle"></i><span>Qualified</span></a></li>
                            <!-- <li class="nav-item"><a class="nav-link <?php echo $admitted; ?>" href="<?php echo web_root; ?>admin/controller.php?page=admitted"><i class="fas fa-user"></i><span>Admitted</span></a></li> -->
                            <li class="nav-item"><a class="nav-link <?php echo $waiting; ?>" href="<?php echo web_root; ?>admin/controller.php?page=waiting"><i class="fas fa-user"></i><span>Waiting</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $rejected; ?>" href="<?php echo web_root; ?>admin/controller.php?page=rejected"><i class="fas fa-user"></i><span>Rejected</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $setting; ?>" href="<?php echo web_root; ?>admin/controller.php?page=setting"><i class="fas fa-cog"></i><span>Setting</span></a></li>
                    <?php    
                        } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "interviewer") {
                    ?>
                            <li class="nav-item"><a class="nav-link <?php echo $dashboard; ?>" href="<?php echo web_root; ?>admin/controller.php?page=dashboard"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $application; ?>" href="<?php echo web_root; ?>admin/controller.php?page=application"><i class="fas fa-user"></i><span>Applications</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $interview; ?>" href="<?php echo web_root; ?>admin/controller.php?page=interview"><i class="fas fa-table"></i><span>Interviewing</span></a></li>
                    <?php
                        } elseif (isset($_SESSION["user_type"]) && $_SESSION["user_type"] == "admission officer") {
                    ?>
                            <li class="nav-item"><a class="nav-link <?php echo $dashboard; ?>" href="<?php echo web_root; ?>admin/controller.php?page=dashboard"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $application; ?>" href="<?php echo web_root; ?>admin/controller.php?page=application"><i class="fas fa-user"></i><span>Applications</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $interview; ?>" href="<?php echo web_root; ?>admin/controller.php?page=interview"><i class="fas fa-table"></i><span>Interviewing</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $qualified; ?>" href="<?php echo web_root; ?>admin/controller.php?page=qualified"><i class="far fa-user-circle"></i><span>Qualified</span></a></li>
                            <!-- <li class="nav-item"><a class="nav-link <?php echo $admitted; ?>" href="<?php echo web_root; ?>admin/controller.php?page=admitted"><i class="fas fa-user"></i><span>Admitted</span></a></li> -->
                            <li class="nav-item"><a class="nav-link <?php echo $waiting; ?>" href="<?php echo web_root; ?>admin/controller.php?page=waiting"><i class="fas fa-user"></i><span>Waiting</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $rejected; ?>" href="<?php echo web_root; ?>admin/controller.php?page=rejected"><i class="fas fa-user"></i><span>Rejected</span></a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $setting; ?>" href="<?php echo web_root; ?>admin/controller.php?page=setting"><i class="fas fa-cog"></i><span>Setting</span></a></li>
                    <?php
                        }
                    ?>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <ul class="navbar-nav flex-nowrap ml-auto">
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $_SESSION['login_user']; ?></span>
                                        <img class="border rounded-circle img-profile" src="../assets/img/avatars/avatar1.jpeg">
                                    </a>
                                    <div class="dropdown-menu shadow dropdown-menu-right animated--grow-in">
                                        <a class="dropdown-item" href="<?php echo web_root; ?>include/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                    <div class="message"><?php check_message();?></div>
                    <input id="error_alert" onclick="error_alert()" hidden />
                    <input id="success_alert" onclick="success_alert()" hidden />
                    <?php require_once $content; ?>
            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto mt-3">
                    <div class="text-center my-auto copyright"><span>Copyright © WMSU ONLINE PRE-ADMISSION 2021</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    
    <script src="<?php echo web_root; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo web_root; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo web_root; ?>assets/js/chart.min.js"></script>
    <script src="<?php echo web_root; ?>assets/js/bs-init.js"></script>
    <script src="<?php echo web_root; ?>assets/js/theme.js"></script>
    <script src="<?php echo web_root; ?>assets/js/fixedtab.js"></script>
    <script src="<?php echo web_root; ?>assets/js/sweetalert.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="<?php echo web_root; ?>node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?php echo web_root; ?>assets/DataTables/datatables.js"></script>
    <script src="<?php echo web_root; ?>assets/js/table_controller.js"></script>

    <!--This javascript prevent the resubmission of form when refresh button(f5) is clicked-->
    <script>
        if (window.history.replaceState) {
          window.history.replaceState (null, null, window.location.href);
        }
    </script>

</body>
</html>