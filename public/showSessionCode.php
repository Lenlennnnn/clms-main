<?php
$currentpage = "Show Session Code";
include("header.php");
?>
<div class="showsessioncode-container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="#"><img id="MDB-logo" src="./img/bsu-lg.png" alt="MDB Logo" draggable="false"
                    height="30" />
                Computer Laboratory Management System
            </a>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="container">
        <div class="card border-0 shadow">
            <div class="card-header d-flex justify-content-between">
                <h4>Session Code <span class="text-primary fs-5" id="ssc-date"></span></h4>

                <select class="form-select ssc-select" id="ssc-select">

                </select>
            </div>

            <div class="card-body text-center py-5" id="ssc-container">
                <h3 class="fw-bold">Link:</h3>

                <div class="card border-0">
                    <div class="card-body">
                        <h1 class=" ">http://192.168.200.0/clms</h1>
                    </div>
                </div>
                <h3 class="fw-bold">Session Code:</h3>

                <div class="card border-0">
                    <div class="card-body">
                        <h1 class="fw-bold ssc-text" id="ssc-sessioncode"> <span class="fs-2 text-danger "> Choose
                                Laboratory</span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


<?php
include("footer.php");

?>