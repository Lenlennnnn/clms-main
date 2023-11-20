</div>
<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top hidden" data-bs-trigger="hover"
    data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top"
    data-bs-content="Click to scroll to the top"><i class="fa-solid fa-arrow-up"></i></a>
</div>

</div>
<!-- Content End -->


<!-- IMPORT ALL THE MODALS -->
<?php
if ($currentpage === "Dashboard") {
  include("dashboard-modals.php");
} else if ($currentpage === "Student Time In") {
  include("student-modals.php");
} else if ($currentpage === "List of Sessions") {
  include("sessioncode-modals.php");
}
include("modals.php");
?>

</div>

<!-- JQUERY -->
<script src="js/includes/jquery-3.5.1.min.js"></script>
<script src="js/includes/bootstrap.bundle.min.js"></script>
<!-- v4 -->
<script src='js/includes/tesseract.js'></script>

<script src="lib/tempusdominus/js/moment.min.js"></script>
<script src="lib/tempusdominus/js/moment-timezone.min.js"></script>


<!-- Sweet Alert-->
<script src="js/includes/sweetalert2.all.min.js"></script>
<!-- <script src="lib/DataTables/datatables.js"></script> -->

<!-- BS table js -->
<script src="lib/DataTables/datatables/jquery.dataTables.js"></script>
<script src="lib/DataTables/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="lib/DataTables/datatables-responsive/datatables.responsive.js"></script>
<script src="lib/DataTables/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
<script src="lib/DataTables/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
<script src="lib/DataTables/datatables-buttons/datatables-buttons.js"></script>
<script src="lib/DataTables/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
<script src="lib/DataTables/jszip/jszip.js"></script>
<script src="lib/DataTables/pdfmake/pdfmake.js"></script>
<script src="lib/DataTables/datatables-buttons/buttons.html5.js"></script>
<script src="lib/DataTables/datatables-buttons/buttons.print.js"></script>

<script src="js/includes/perfect-scrollbar.min.js"></script>
<script src="js/includes/smooth-scrollbar.min.js"></script>
<script src="js/includes/topbarloading.js"></script>

<!-- Template Javascript -->
<script src="js/custom/general.js"></script>
<script src="js/custom/constants.js"></script>
<script src="js/custom/alert.js"></script>
<script src="js/custom/time.js"></script>

<!-- Change Pass -->
<script src="js/updatepassword.js"></script>
<script src="js/includes/pwstrength-bootstrap.min.js"></script>

<script>
var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');
if (current === 'dashboard.php') {
    $.getScript("js/dashboard/dashboard-display.js");
    $.getScript("js/dashboard/dashboard-button.js");
    $.getScript("js/dashboard/dashboard-timein.js");
    $.getScript("js/dashboard/dashboard-timeout.js");

} else if (current === 'reports.php') {
    $.getScript("js/reports/reports-logs.js");
} else if (current === 'student-timein.php') {
    $.getScript("js/student-timein/student-timein-display.js");
    $.getScript("js/student-timein/student-timein-button.js");
} else if (current === 'sessioncodes.php') {
    $.getScript("js/sessioncodes/sessioncodes-display.js");
    $.getScript("js/sessioncodes/sessioncode-logs.js");
} else if (current === 'showSessionCode.php') {
    $.getScript("js/sessioncodes/showSessionCode.js");
}
</script>
</body>

</html>