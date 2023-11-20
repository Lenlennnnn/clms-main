<?php
$currentpage = "Dashboard";
include("header.php");
include("navbar.php");

if (empty($userid)) {
    header("location: index.php");
}
?>
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3 ">
            <div class="card-dark-bg card-light-bg rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-computer fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Total Computer</p>
                    <h2 class="mb-0 fw-bold text-end" id="totalcomputer">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card-dark-bg card-light-bg rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-plug-circle-check fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Available Computer</p>
                    <h2 class="mb-0 fw-bold text-end" id="availablecomputer">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card-dark-bg card-light-bg rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-solid fa-plug-circle-xmark fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Occupied Computer</p>
                    <h2 class="mb-0 fw-bold text-end" id="occupiedcomputer">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h2>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card-dark-bg card-light-bg rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa-regular fa-rectangle-xmark fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Not Available Computer</p>
                    <h2 class="mb-0 fw-bold text-end" id="notavailable-pc">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </h2>
                </div>
            </div>
        </div>
    </div>


</div>



<div class="container-fluid pt-4 px-4">
    <div class="card">
        <div class="card-header bg-light cardheader-dark-bg d-flex justify-content-between px-4 py-3">
            <div class="d-flex align-items-center">
                <h5 class="card-title mb-0"> <div class="fa-solid fa-bug"></div>  Reported Problems</h5>
            </div>
            <div class="d-flex align-items-center">

                <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#addPC">
                    <i class="fa-solid fa-computer"></i> <span>Add Computer</span>
                </button>

                <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#PCManagement">
                    <i class="fa-solid fa-network-wired"></i> <span>PC Management</span>
                </button>
            </div>
        </div>

        <div class="row border-0 p-4">
            <div class="col-xl-4">
                <div class="col-sm-12">
                    <div class="h-100 bg-light rounded py-4 px-3">
                        <div class="d-flex align-items-center justify-content-between mb-2 px-3">
                            <h4 class="mb-0 fw-bold">Laboratories</h4>
                        </div>
                        <div id="labContainer">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="col-sm-12">
                    <div class="h-100 bg-light rounded py-4 px-1">
                        <div class="d-flex align-items-center justify-content-between mb-2 px-3">
                            <h6 class="mb-0">Pending Reported Problems</h6>
                        </div>
                        <div id="pendingReportContainer">

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");

?>