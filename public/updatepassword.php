<?php
session_start();
$currentpage = 'Update Password';
include("header.php");

if (empty($_SESSION['clms_userid'])) {
    header("location: index.php");
    }
?>
<!-- Sign In Start -->
<section class="vh-100" id="login" data-aos="zoom-in-up">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow " style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center logincard-container">
                        <div class="login-card-logo">
                            <img src="img/bsu-lg.png" alt="logo">
                            <p>Batangas State University<br><span style="color: #e60505;">The National Engineering University</span></p>
                        </div>

                        <h2 class="login-title m-0 mt-4 mb-3" style="font-weight: 700;"> Update Password</h2>
                        <form>
                            <input type="hidden" id="currentuser" value="<?php echo $_SESSION['clms_userid']; ?>">
                            <div class="form-outline mb-4 text-start">
                                <label  class="mb-2 fw-bold">Current Password</label>
                                <input type="password" class="form-control" placeholder="Current Password" id="currentpassword" required>
                            </div>
                            <div class="form-outline mb-4 text-start">
                                <label class="mb-2 fw-bold">New Password</label></br>
                                <input type="password" class="form-control mb-2" placeholder="New Password" id="newpassword">
                                <p class="mb-2 mt-3"> <span id="length-help-text" style="background: #e3e6e8; padding: 10px; border-radius: 10px;"> </span> </p>
                                <small> <i class="fas fa-info-circle text-danger"></i> The score must be 30 or more</small>
                            </div>


                            <div class="form-outline mb-4 text-start">
                                <label class="mb-2 fw-bold">Verify New Password</label>
                                <input type="password" class="form-control" placeholder="Verify Password" id="verifynewpassword">
                            </div>
                            <div class="form-group ">
                                <div class="alert alert-danger alert-success hidden" role="alert" id="status">
                                    <div class="alert alert-danger mb-1 py-1" role="alert" id="alertcurrentpass">
                                        <small><i class='fas fa-times me-3'></i>Current password is provided </small>
                                    </div>

                                    <div class="alert alert-danger alert-success mb-1 py-1" role="alert" id="alertnewpass">
                                        <small><i class='fas fa-times me-3'></i>New Password is valid </small>
                                    </div>

                                    <div class="alert alert-danger alert-success mb-1 py-1" role="alert" id="alertverifypass">
                                        <small><i class='fas fa-times me-3'></i>Verify Password matched </small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group px-5">
                                <button type="button" class="btn btn-secondary" id="updatebttn"><i class="fas fa-user-edit"></i> Update Password</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Sign In End -->

<!-- JavaScript Libraries -->
<script src="js/includes/jquery-3.5.1.min.js"></script>

<script src="js/includes/bootstrap.bundle.min.js"></script>
<script src="lib/chart/chart.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
<script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- Constants variable  JAVASCRIPT -->
<script src="js/custom/constants.js"></script>

<!--  Font Awesone -->
<script src="js/includes/all.min.js"></script>

<!-- Sweet Alert-->
<script src="js/includes/sweetalert2.all.min.js"></script>
<!-- Template Javascript -->
<script src="js/updatepassword.js"></script>
<script src="js/includes/zxcvbn.js"></script>
<script src="js/includes/pwstrength-bootstrap.min.js"></script>

<!-- ALERT JAVASCRIPT -->
<script src="js/custom/alert.js"></script>
</body>

</html>