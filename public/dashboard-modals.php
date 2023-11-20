<!----------------------------------------------
----------------Modal for TIME IN
------------------------------------------------->
<div class="modal fade text-dark" id="timeInModal" tabindex="-1" aria-labelledby="timeInModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="timeInModalLabel"> <i class="fa-solid fa-computer"></i> Time In for PC <span
                        id="pc_id_name"></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertTimeIn"><i
                        class="fas fa-times-circle"></i> Please input a correct srcode!</div>
                <h6 class="mb-4 fw-bold">Type of SRCode:</h6>
                <div class="d-flex align-items-center mb-4 container-switch">
                    <span class="existing" style="color: #2196f3;">Existing</span>
                    <label class="timein-switch">
                        <input type="checkbox" id="timein-checkbox">
                        <div class="timein-slider"></div>
                    </label>
                    <span class="new-record">New Record</span>
                </div>
                <h6 class="mb-4 fw-bold">SRCode Information</h6>
                <div class="row mb-1 ps-3">
                    <label for="srcodeid" class="col-sm-4 col-form-label">SRCode # <span class="text-danger">*</span>
                    </label>
                    <div class="col-sm-7">
                        <div class="input-group mb-3 inputgrp" id="existing-srcode">
                            <span class="input-group-text border-0"><i class="fa-solid fa-qrcode"></i></span>
                            <input type="text" class="form-control" id="srcodeid" required>
                            <button class="btn btn-primary" type="button" id="search-srcode-button"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </div>

                        <div class="input-group mb-3 inputgrp hidden" id="new-srcode">
                            <span class="input-group-text border-0 bg-success"><i class="fa-solid fa-qrcode"></i></span>
                            <input type="text" class="form-control border-success" id="timein-srcode" required>
                        </div>
                    </div>
                </div>
                <hr>

                <h6 class="mb-4 fw-bold">Student Information</h6>
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertTimeInInputFields"><i
                        class="fas fa-times-circle"></i> Please make sure these input fields are completely filled
                    out!
                </div>
                <input type="hidden" id="pc_id"> <!-- FETCH THE ID FOR THIS PC -->
                <input type="hidden" id="pc_number">
                <input type="hidden" id="lab_name" value="<?php echo $lab_name ?>">

                <div class="row mb-1 ps-3">
                    <label for="timein-fullname" class="col-sm-3 col-form-label">Fullname <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="timein-fullname" class="form-control border-secondary "
                            oninput="this.value = this.value.toUpperCase()" placeholder="SURNAME, FIRSTNAME MIDDLENAME"
                            readonly>
                    </div>
                </div>

                <div id="timein-info">
                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Department <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="timein-department" class="form-control border-secondary "
                                oninput="this.value = this.value.toUpperCase()" readonly>
                        </div>
                    </div>
                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Course <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" id="timein-course" class="form-control border-secondary "
                                oninput="this.value = this.value.toUpperCase()" readonly>
                        </div>
                    </div>
                </div>


                <div class="hidden" id="newrecord-add-info">
                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Department <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select border-secondary " id="newrecord-department">
                                <option value="" selected>Choose...</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Course <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select border-secondary " id="newrecord-course">
                                <option value="" selected>Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Gender <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select border-secondary " id="timein-gender">
                                <option value="" selected>Choose...</option>
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Birthdate <span
                                class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" id="timein-birthdate" class="form-control border-secondary " required>
                        </div>
                    </div>

                    <div class="row mb-1 ps-3">
                        <label for="" class="col-sm-3 col-form-label">Address <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="form-floating">
                                <textarea class="form-control" id="timein-address" style="height: 100px"
                                    oninput="this.value = this.value.toUpperCase()"></textarea>
                                <label for="floatingTextarea2">Permanent Address</label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Cancel</button>
                <button type="button" class="btn btn-primary" id="timeInButton"><i class="fa-regular fa-clock"></i>
                    Time IN</button>

                <button type="button" class="btn btn-success hidden" id="addAndTimeInButton"><i
                        class="fa-regular fa-plus"></i>
                    Add Record</button>
            </div>
        </div>
    </div>
</div>


<!----------------------------------------------
----------------Modal for Inser Session COde
------------------------------------------------->
<div class="modal fade text-dark" id="insertSessionCode" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="insertSessionCodeLabel" aria-hidden="true" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable ">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="insertSessionCodeLabel"> <i class="fa-solid fa-computer me-2"></i>Insert
                    Session
                    Code <span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body mb-1">
                <div class="row">
                    <div class="col-12 bg-light p-4">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Computer Information:
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <ul class="list-group list-group-flush fw-bold">
                                        <li class="list-group-item">IP Address: <span class="text-primary"
                                                id="ip-address"></span></li>
                                        <li class="list-group-item">Laboratory: <span class="text-primary"
                                                id="labName"></span></li>
                                        <li class="list-group-item">PC Number: <span class="text-primary"
                                                id="pcNumber"></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="alert alert-danger m-0 py-2 mt-3 hidden" id="alertErrorSessionCode"></div>
                <div class="row my-2 ps-3">
                    <div class="col">
                        <!-- PC INFO -->
                        <div class="col-sm-12">
                            <div class="row my-4 ps-3">
                                <h6 class="mb-4 fw-bold">Session Code Information</h6>
                                <div class="d-flex mb-2">
                                    <label for="sessioncode_insert" class="col-sm-4 col-form-label">Session Code <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="sessioncode_insert"
                                            placeholder="Ex: IL-010199-A123">
                                    </div>
                                </div>

                                <h6 class="mb-4 fw-bold">Student Information</h6>
                                <div class="d-flex my-2">
                                    <div class="row mb-1 ps-3">
                                        <label for="srcodeid" class="col-sm-4 col-form-label">SRCode # <span
                                                class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3 inputgrp">
                                                <span class="input-group-text border-0"><i
                                                        class="fa-solid fa-qrcode"></i></span>
                                                <input type="text" class="form-control" id="srcodeid" required>
                                                <button class="btn btn-primary search-srcode-button" type="button"><i
                                                        class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertTimeInInputFields"><i
                                        class="fas fa-times-circle"></i> Please make sure these input fields are
                                    completely filled
                                    out!
                                </div>
                                <input type="hidden" id="pc_id"> <!-- FETCH THE ID FOR THIS PC -->
                                <input type="hidden" id="pc_number">
                                <input type="hidden" id="lab_name" value="<?php echo $lab_name ?>">
                                <div class="row mb-1 ps-3">
                                    <label for="fullname" class="col-sm-3 col-form-label">Fullname <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="fullname" class="form-control border-secondary " required
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-1 ps-3">
                                    <label for="savingsTotal" class="col-sm-3 col-form-label">Department <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="department" class="form-control border-secondary "
                                            required readonly>
                                    </div>
                                </div>
                                <div class="row mb-1 ps-3">
                                    <label for="tithesAmount" class="col-sm-3 col-form-label">Course <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="course" class="form-control border-secondary " required
                                            readonly>
                                    </div>
                                </div>




                            </div>
                            <h6 class="text-primary mt-5"> <i class="fa-solid fa-circle-info me-2"></i>The session code
                                will be provided by your Professor.</h6>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-primary" id="validateSessionCode"><i
                        class="fa-regular fa-circle-check"></i>
                    Validate</button>
            </div>
        </div>
    </div>
</div>


<!----------------------------------------------
----------------Modal for Reporting a problem
------------------------------------------------->
<div class="modal fade text-dark" id="reportPCModal" tabindex="-1" aria-labelledby="reportPCModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="reportPCModalLabel"> <i class="fa-solid fa-bug me-2"></i> Report a
                    problem<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="report_pcid">
                <input type="hidden" id="report_pcnumber">
                <div class="alert alert-danger m-0 hidden mb-3" id="alertReportProblem"></div>
                <div class="row mb-1 ps-3">
                    <h3>What's the problem?</h3>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <textarea class="form-control" id="reportProblem" style="height: 150px"
                                placeholder="Please tell us what problem you've encountered with this computer, provide as much detail as possible."></textarea>
                            <!-- <label for="floatingTextarea2">Please state the problem clearly.</label> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
                <button type="button" class="btn btn-primary" id="submitReportProblem"><i
                        class="fa-solid fa-paper-plane me-2"></i>
                    Submit</button>
            </div>
        </div>
    </div>
</div>