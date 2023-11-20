<?php
$currentpage = "Student Time In";
include("header.php");
?>


<div class="container pt-4 px-4">
    <div class="card hidden" id="student-module">
        <div class="card-header bg-light cardheader-dark-bg d-flex justify-content-between px-4 py-3">
            <div>
                <h5 class="card-title mb-0">Internet Laboratory</h5>
            </div>

            <button class="btn btn-danger" id="endStudentSessionButton"><i
                        class="fa-regular fa-circle-stop me-2 fa-fade"></i>Time Out</button>
        </div>
        <div class="row px-5 pb-3 card-dark-bg g-1 border-0 d-flex justify-content-center hidden"
            id="endStudentSessionContainer">
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3">
                <div class="accordion " id="sessionInfo">
                    <div class="accordion-item body-dark-bg">
                        <h2 class="accordion-header " id="headerSession">
                            <button class="accordion-button body-dark-bg" type="button" data-bs-toggle="collapse"
                                data-bs-target="#sessionInfoBody" aria-expanded="true" aria-controls="sessionInfoBody">
                                <i class="fa-solid fa-file-circle-plus me-2"></i> Session Information
                            </button>
                        </h2>
                        <div id="sessionInfoBody" class="accordion-collapse collapse show"
                            aria-labelledby="headerSession" data-bs-parent="#sessionInfo">
                            <div class="accordion-body" id="sessionInformationContainer">
                            </div>
                        </div>
                        <div class="accordion-footer">
                            <div class="fw-bold">Session Duration: <span class="text-primary" id="sessionDuration">0h 0m
                                    0s</span> </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-sm-12 mt-3 ">
                <div class="accordion " id="srcodeInfo">
                    <div class="accordion-item body-dark-bg">
                        <h2 class="accordion-header " id="headerSession">
                            <button class="accordion-button body-dark-bg" type="button" data-bs-toggle="collapse"
                                data-bs-target="#srcodeInfoBody" aria-expanded="true" aria-controls="srcodeInfoBody">
                                <i class="fa-solid fa-user me-2"></i> Student Information
                            </button>
                        </h2>
                        <div id="srcodeInfoBody" class="accordion-collapse collapse show"
                            aria-labelledby="headerSession" data-bs-parent="#srcodeInfo">
                            <div class="accordion-body" id="srcodeInformationContainer">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mt-3 ">
                <div class="accordion " id="logInfo">
                    <div class="accordion-item body-dark-bg">
                        <h2 class="accordion-header " id="headerSession">
                            <button class="accordion-button body-dark-bg" type="button" data-bs-toggle="collapse"
                                data-bs-target="#logInfoBody" aria-expanded="true" aria-controls="logInfoBody">
                                <i class="fa-solid fa-user me-2"></i> Log Information
                            </button>
                        </h2>
                        <div id="logInfoBody" class="accordion-collapse collapse show"
                            aria-labelledby="headerSession" data-bs-parent="#logInfo">
                            <div class="accordion-body" id="logInfoContainer">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- <div class="row border-0">
            <div class="col-xl-12">
                <div class="card-dark-bg text-center p-4">
                    <div class="row" id="pc-card-container">
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>

<?php
include("footer.php");

?>