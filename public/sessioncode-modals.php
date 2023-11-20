<!----------------------------------------------
----------------Modal for PC MANAGEMENT
------------------------------------------------->
<div class="modal fade text-dark" id="sessionAttendees" tabindex="-1" aria-labelledby="sessionAttendeesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="sessionAttendeesLabel"> <i class="fa-solid fa-users"></i> Session Attendees <span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="sessionCodeAttendee">
                <h5 class="mb-4 ">Attendees for the date of: <span class="fw-bold" id="attendeesHeader"></span></h5>
                <div class="row ">
                    <!-- PC INFO -->
                    <div class="col-sm-12">
                        <div class="row">

                            <div class="card p-0">
                                <div class="card-datatable table-responsive ">
                                    <table class="table-dark-bg  datatables-basic table border-top dataTable no-footer dtr-column collapsed" id="attendeesTable">
                                        <thead>
                                            <tr>
                                                <th>LOG ID</th>
                                                <th>SRCODE</th>
                                                <th>NAME</th>
                                                <th>SECTION</th>
                                                <th>DEPARTMENT</th>
                                                <th>COURSE</th>
                                                <th>SESSION CODE</th>
                                                <th>LABORATORY</th>
                                                <th>PC No.</th>
                                                <th>DATE</th>
                                                <th>IN</th>
                                                <th>OUT</th>
                                                <th>FACULTY NAME</th>
                                                <th>SUBJECT</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i> Close</button>
            </div>
        </div>
    </div>
</div>