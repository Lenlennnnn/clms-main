<?php
$currentpage = "Dashboard";
ob_start();
include("header.php");
include("navbar.php");
?>


<div class="container-fluid pt-4 px-4">
    <div class="card">
        <div class="card-header bg-light cardheader-dark-bg d-flex justify-content-between px-4 py-3">
            <div>
                <h5 class="card-title mb-0">Computer Management</h5>
            </div>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-secondary mx-2 hidden" id="timeOutAll"> <i class="fa-solid fa-plug-circle-xmark"></i> <span>Time Out
                        All</span></button>
                <button type="button" class="btn btn-primary mx-2 hidden" id="refreshDisplay"><i class="fa-solid fa-sync me-2" id="rotateIcon"></i><span>Refresh</span></button>
            </div>


        </div>

        <div class="row px-5 pb-3 card-dark-bg g-0 border-0 d-flex justify-content-between hidden" id="endSessionContainer">
            <div class="col-4 mt-3">
                <div class="accordion " id="sessionInfo">
                    <div class="accordion-item body-dark-bg">
                        <h2 class="accordion-header " id="headerSession">
                            <button class="accordion-button body-dark-bg" type="button" data-bs-toggle="collapse" data-bs-target="#sessionInfoBody" aria-expanded="true" aria-controls="sessionInfoBody">
                                <i class="fa-solid fa-file-circle-plus me-2"></i> Session Information
                            </button>
                        </h2>
                        <div id="sessionInfoBody" class="accordion-collapse collapse show" aria-labelledby="headerSession" data-bs-parent="#sessionInfo">
                            <div class="accordion-body" id="sessionInformationContainer">
                                <div class="row mb-2">
                                    <h6 class="m-0 me-3 fw-bold">Session Code: <span class="text-primary " id="sessionCodeText"> None</span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-footer">
                            <div class="fw-bold">Session Duration: <span class="text-primary" id="sessionDuration">0h 0m 0s</span> </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-4 d-flex justify-content-end mt-3" style="height: 100%">
                <button class="btn btn-danger" id="endSessionButton"><i class="fa-regular fa-circle-stop me-2 fa-fade"></i>End
                    session</button>
            </div>
        </div>

        <div class="row px-5 pb-3 card-dark-bg g-0 border-0">
            <div class="col-lg-4 col-md-5 g-3 col-sm-8 pt-3 hidden" id="additionalInfoContainer">
                <div class="accordion " id="additionalInfo">
                    <div class="accordion-item body-dark-bg">
                        <h2 class="accordion-header " id="headingOne">
                            <button class="accordion-button body-dark-bg" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="fa-solid fa-file-circle-plus me-2"></i> Additional Information
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#additionalInfo">
                            <div class="accordion-body">
                                <div class="list-group ">
                                    <p class="text-danger fw-bold"> <i class="fa-solid fa-circle-info me-2"></i> Please
                                        finalize all required information before creating a new session.</p>

                                    <div id="addInfoItems">
                                        <!-- CONTENT FOR THIS DIV CAN BE FOUND IN DASHBOARD-DISPLAY.JS -->
                                    </div>
                                    <button class="btn btn-primary mt-4" id="createNewSessionButton">Create new
                                        session</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 g-3" id="infoConfigurationContainer">
                <!-- CONTENT FOR THIS DIV CAN BE FOUND IN DASHBOARD-DISPLAY.JS -->
            </div>
        </div>
        <div class="row border-0">
            <div class="col-xl-12">
                <div class="card-dark-bg text-center p-4">
                    <div class="row" id="pc-card-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("footer.php");

?>