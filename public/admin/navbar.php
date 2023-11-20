<?php
session_start();
$username = $_SESSION['clms_username'];
$fullname = $_SESSION['clms_fullname'];
$userRole = $_SESSION['clms_userRole'];
$lab_id = $_SESSION['clms_lab_id'];
$lab_name = $_SESSION['clms_lab_name'];
$userid = $_SESSION['clms_userid'];
if (empty($userid)) {
    header("location: ../index.php");
}

if ($_SESSION['clms_userRole'] === "User") {
    header("location: ../dashboard.php");
}
?>

<input type="hidden" id="labNameSession" value="<?php echo $_SESSION['clms_lab_name'] ?>">
<input type="hidden" id="labIDSession" value="<?php echo $_SESSION['clms_lab_id'] ?>">
<input type="hidden" id="facultyNameSession" value="<?php echo $_SESSION['clms_fullname'] ?>">

<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3 navbar-dark-bg">
    <nav class="navbar bg-transparent">
        <div class="navbar-header">
            <img src="img/bsu-lg.png" alt="">
            <a href="dashboard.php" class="navbar-brand mx-4 mb-0">
                <h2 class="text-primary fw-bold">CLMS</h2>
            </a>
            <small>Computer Laboratory Management System</small>
        </div>
        <div class="divider"></div>
        <div class="d-flex align-items-center ms-4 mb-4" style="cursor: pointer;">
            <div class="position-relative">
                <img class="rounded-circle" src="img/user.png" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">
                    <?php echo $fullname ?>
                </h6>
                <span><?php echo $userRole ?></span>
            </div>
        </div>


        <div class="navbar-nav w-100">
            <a href="dashboard.php" class="nav-item nav-link <?php echo $currentpage == "Dashboard" ? "active" : null; ?>"><i class="icon-dark-bg fa fa-tachometer-alt me-2"></i>Dashboard</a>

            <a href="reports.php" class="nav-item nav-link <?php echo $currentpage == "Reports Page" ? "active" : null; ?>"><i class="icon-dark-bg fa fa-file me-2"></i>Reports</a>

            <a href="management.php" class="nav-item nav-link <?php echo $currentpage == "Management" ? "active" : null; ?>"><i class="icon-dark-bg fa fa-bars-progress me-2"></i>Management</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->


<!-- Content Start -->
<div class="content content-dark-bg">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand  sticky-top px-4 py-0 navbar-dark-bg">
        <a href="dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa-solid fa-desktop"></i></h2>
        </a>
        <a href="#" class="card-dark-bg sidebar-toggler flex-shrink-0">
            <i class="fa-solid fa-bars"></i>
        </a>
        <div class="date-lab">

            <select class="fs-3 fw-bold  form-select border-0 bg-transparent ps-0" id="selectLaboratory">

            </select>
            <div id="dateTime"></div>
        </div>


        <div class="navbar-nav align-items-center ms-auto ">
            <div class="nav-item dropdown ">
                <a href="#" class="nav-link dropdown-toggle ms-3" data-bs-toggle="dropdown">
                    <img class="rounded-circle " src="img/user.png" alt="" style="width: 40px; height: 40px;">
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0 ">
                    <a href="#" class="dropdown-item cursor-pointer" data-bs-toggle="modal" data-bs-target="#updatePass"><i class="fa fa-key text-dark" aria-hidden="true"></i> Change Password</a>
                    <a href="#" class="dropdown-item" id="logoutbttn"><i class="fa-solid fa-right-from-bracket"></i> Log
                        Out</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->