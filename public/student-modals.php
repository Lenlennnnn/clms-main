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
                                    <label for="pcnumber" class="col-sm-4 col-form-label">Session Code <span
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
                                                <button class="btn btn-primary" type="button"
                                                    id="search-srcode-button"><i
                                                        class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertTimeIn"><i
                                        class="fas fa-times-circle"></i> Please input a correct srcode!</div>
                                <input type="hidden" id="lab_id"> <!-- FETCH THE ID FOR THIS PC -->
                                <input type="hidden" id="lab_name">
                                <input type="hidden" id="pc_number">
                                <input type="hidden" id="pc_id">
                                <div class="row mb-1 ps-3">
                                    <label for="timein-fullname" class="col-sm-3 col-form-label">Fullname <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="timein-fullname" class="form-control border-secondary "
                                            required readonly>
                                    </div>
                                </div>
                                <div class="row mb-1 ps-3">
                                    <label for="savingsTotal" class="col-sm-3 col-form-label">Department <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="timein-department" class="form-control border-secondary "
                                            required readonly>
                                    </div>
                                </div>
                                <div class="row mb-1 ps-3">
                                    <label for="tithesAmount" class="col-sm-3 col-form-label">Course <span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="timein-course" class="form-control border-secondary "
                                            required readonly>
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