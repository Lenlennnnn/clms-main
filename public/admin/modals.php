<!----------------------------------------------
----------------Modal for ADD PC
------------------------------------------------->
<div class="modal fade text-dark" id="addPC" tabindex="-1" aria-labelledby="addPCLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="addPCLabel"> <i class="fa-solid fa-computer"></i> Add PC <span
                        id="pc_id"></span>
                </h5>
                <!-- <button class="btn btn-primary"> <i class="fa-solid fa-plus me-2"></i> Add item</button> -->


            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertIncompleteFields"></div>
                <!-- <p class="text-primary fw-bold"> <i class="fa-solid fa-circle-info me-2"></i> The maximum limit to add
                    new PC is 30. </p> -->

                <div class="d-flex justify-content-start pb-4">
                    <button class="add-computer-btn btn btn-success"> <fa-solid class="fa-plus"></fa-solid> Add
                        Item</button>
                </div>
                <div class="container" id="computerRowContainer">
                    <div class="row mb-1 ps-3 computer-row">
                        <div class="col">
                            <div class="col-sm-12 py-2 border-bottom">
                                <div class="d-flex justify-content-end pb-2"><button
                                        class="remove-computer-btn btn btn-danger py-1 px-3"> <i
                                            class="fa-solid fa-times m-0"></i> </button></div>

                                <div class="row mb-1 ps-3">
                                    <label for="" class="col-sm-4 col-form-label">PC Number<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-light" id="basic-addon1"> <i
                                                    class="fa-solid fa-hashtag"></i> </span>
                                            <input type="text" id="pcnumber[]" class="form-control border-primary">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1 ps-3">
                                    <label for="" class="col-sm-4 col-form-label">IP Address<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <div class="input-group">
                                            <span class="input-group-text bg-primary text-light" id="basic-addon1"> <i
                                                    class="fa-solid fa-network-wired"></i></span>
                                            <input type="text" id="pcIPaddress[]" class="form-control border-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Cancel</button>
                <button type="button" class="btn btn-primary" type="submit" id="addPCButton"><i
                        class="fa-solid fa-plus"></i> Add
                    Record</button>
            </div>
        </div>
    </div>
</div>


<!----------------------------------------------
----------------Modal for Edit PC Info
------------------------------------------------->
<div class="modal fade text-dark" id="editpc" tabindex="-1" aria-labelledby="editpcLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="editpcLabel"> <i class="fa-solid fa-house-medical me-2"></i> Laboratory
                    Details<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-pcid">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alerteditpc"> <i
                        class="fa-solid fa-info-circle me-2"></i> Please fill out the required fields</div>
                <div class="row mb-3 ps-3">
                    <label for="editpcnum" class="col-sm-3 col-form-label"> PC Number* <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="editpcnum" class="form-control border-primary " placeholder="1">
                    </div>
                </div>

                <div class="row mb-3 ps-3">
                    <label for="editpcip" class="col-sm-3 col-form-label"> IP Address <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="editpcip" class="form-control border-primary "
                            placeholder="Ex: 192.168.123.0">
                    </div>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
                <button type="button" class="btn btn-success" id="editPCButton"><i class="fas fa-edit"></i>
                    Update</button>
            </div>
        </div>
    </div>
</div>


<!----------------------------------------------
----------------Modal for PC MANAGEMENT
------------------------------------------------->
<div class="modal fade text-dark" id="PCManagement" tabindex="-1" aria-labelledby="PCManagementLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="PCManagementLabel"> <i class="fa-solid fa-computer"></i> PC Management <span
                        id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <h6 class="mb-4 fw-bold">PC List</h6>
                <div class="row ">
                    <!-- PC INFO -->
                    <div class="col-sm-12">
                        <div class="row">

                            <div class="card card-dark-bg">
                                <div class="card-datatable table-responsive shadow">
                                    <table
                                        class="table-dark-bg  datatables-basic table border-top dataTable no-footer dtr-column collapsed"
                                        id="pcmanagementtable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>PC NUMBER</th>
                                                <th>IP ADDRESS</th>
                                                <th>STATUS</th>
                                                <th>ACTION</th>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------
----------------Modal for Reporting a problem
------------------------------------------------->
<div class="modal fade text-dark" id="problemDetails" tabindex="-1" aria-labelledby="problemDetailsLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="problemDetailsLabel"> <i class="fa-solid fa-bug me-2"></i> Report
                    Details<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="reportID">
                <div class="row mb-2">
                    <h6 class="m-0 me-3 fw-bold">Reported By: <span class="text-primary" id="reported_by"> </span>
                    </h6>
                </div>
                <div class="row mb-2">
                    <h6 class="m-0 me-3 fw-bold">Reported Date: <span class="text-primary " id="reported_date"> </span>
                    </h6>
                </div>
                <div class="row mb-2">
                    <h6 class="m-0 me-3 fw-bold">Laboratory: <span class="text-primary " id="reported_lab"> </span>
                    </h6>
                </div>
                <div class="row mb-2">
                    <h6 class="m-0 me-3 fw-bold">PC Number: <span class="text-primary" id="reported_pcnum"> </span>
                    </h6>
                </div>
                <div class="row mb-2">
                    <h6 class="m-0 me-3 fw-bold">Status: <span class="text-primary "> <span class="badge badge-danger"
                                id="reported_status"></span> </span>
                    </h6>
                </div>
                <div class="row mb-2">
                    <h6 class="m-0 me-3 fw-bold">Problem: </br><span class="text-primary fs-5"
                            id="reported_statement"></span>
                    </h6>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
                <button type="button" class="btn btn-primary" id="fixedButton"><i class="fa-solid fa-bug-slash"></i>
                    Fixed</button>
            </div>
        </div>
    </div>
</div>


<!----------------------------------------------
----------------Modal for Adding new User
------------------------------------------------->
<div class="modal fade text-dark" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="addUserLabel"> <i class="fa-solid fa-user-plus me-2"></i> Add New User<span
                        id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertAddUser"> <i
                        class="fa-solid fa-info-circle me-2"></i> Please fill out the required fields</div>
                <div class="row mb-3 ps-3">
                    <label for="user-fullname" class="col-sm-3 col-form-label">Fullname <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="user-fullname" class="form-control border-primary "
                            oninput="this.value = this.value.toUpperCase()" placeholder="Ex: JUAN DELA CRUZ">
                    </div>
                </div>
                <div class="row mb-3 ps-3">
                    <label for="user-username" class="col-sm-3 col-form-label">Username <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="user-username" class="form-control border-primary "
                            placeholder="Ex. juandelacruz">
                    </div>
                </div>
                <div class="row mb-5 ps-3">
                    <label for="user-fullname" class="col-sm-3 col-form-label">Role <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select id="user-role" class="form-select border-primary">
                            <option value="">Choose Role...</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>

                    </div>
                </div>

                <div class="row mb-3 ps-3">
                    <div class="col-sm-9">
                        <p class="text-danger"> <i class="fa-solid fa-key"></i> The default password is same as the
                            username.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
                <button type="button" class="btn btn-primary" id="addUserButton"><i class="fa-solid fa-user-plus"></i>
                    Add Record</button>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------
----------------Modal for Adding new laboratory
------------------------------------------------->
<div class="modal fade text-dark" id="addLaboratory" tabindex="-1" aria-labelledby="addLaboratoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="addLaboratoryLabel"> <i class="fa-solid fa-house-medical me-2"></i> Add New
                    Laboratory<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertaddLaboratory"> <i
                        class="fa-solid fa-info-circle me-2"></i> Please fill out the required fields</div>
                <div class="row mb-3 ps-3">
                    <label for="lab-labname" class="col-sm-3 col-form-label"> Lab Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="lab-labname" class="form-control border-primary "
                            placeholder="Ex: Internet Laboratory">
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
                <button type="button" class="btn btn-primary" id="addLaboratoryButton"><i
                        class="fa-solid fa-user-plus"></i> Add Record</button>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------
----------------Modal for CHANGING PASS
------------------------------------------------->
<div class="modal fade text-dark" id="updatePass" tabindex="-1" aria-labelledby="updatePassLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="updatePassLabel"> <i class="fa-solid fa-key me-2"></i> Update Password<span
                        id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">

                <input type="hidden" id="currentuser" value="<?php echo $userid; ?>">
                <div class="form-outline mb-4 text-left">
                    <label>Current Password</label>
                    <input type="password" class="form-control" placeholder="Current Password" id="currentpassword"
                        required>
                </div>
                <div class="form-outline mb-4 text-left">
                    <label class="mb-1">New Password</label></br>
                    <input type="password" class="form-control mb-2" placeholder="New Password" id="newpassword">
                    <p class="mb-2 mt-3"> <span id="length-help-text"
                            style="background: #e3e6e8; padding: 10px; border-radius: 10px;"> </span> </p>
                    <small> <i class="fas fa-info-circle text-danger"></i> The score must be 30 or more</small>
                </div>


                <div class="form-outline mb-4 text-left">
                    <label>Verify New Password</label>
                    <input type="password" class="form-control" placeholder="Verify Password" id="verifynewpassword">
                </div>
                <div class="form-group">
                    <div class="alert alert-danger alert-success" role="alert" id="status">
                        <div class="alert alert-danger mb-1 py-1" role="alert" id="alertcurrentpass">
                            <small><i class='fas fa-times mr-3'></i>Current password is provided </small>
                        </div>

                        <div class="alert alert-danger alert-success mb-1 py-1" role="alert" id="alertnewpass">
                            <small><i class='fas fa-times mr-3'></i>New Password is valid </small>
                        </div>

                        <div class="alert alert-danger alert-success mb-1 py-1" role="alert" id="alertverifypass">
                            <small><i class='fas fa-times mr-3'></i>Verify Password matched </small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary" id="updatebttn"><i class="fas fa-user-edit"></i>
                        Update Password</button>
                </div>
            </div>
        </div>
    </div>
</div>



<!----------------------------------------------
----------------Modal for CHANGING PASS
------------------------------------------------->
<div class="modal fade text-dark" id="editUserInfo" tabindex="-1" aria-labelledby="editUserInfoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="editUserInfoLabel"> <i class="fa-solid fa-user me-2"></i> User
                    Information<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-userid">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alertEditUser"> <i
                        class="fa-solid fa-info-circle me-2"></i> Please fill out the required fields</div>
                <div class="row mb-3 ps-3">
                    <label for="edit-fullname" class="col-sm-3 col-form-label">Fullname <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="edit-fullname" class="form-control border-primary "
                            oninput="this.value = this.value.toUpperCase()" placeholder="Ex: JUAN DELA CRUZ">
                    </div>
                </div>
                <div class="row mb-3 ps-3">
                    <label for="edit-username" class="col-sm-3 col-form-label">Username <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="edit-username" class="form-control border-primary "
                            placeholder="Ex. juandelacruz">
                    </div>
                </div>
                <div class="row mb-1 ps-3">
                    <label for="edit-role" class="col-sm-3 col-form-label">Role <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select id="edit-role" class="form-select border-primary">
                        </select>

                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="edituserButton"><i class="fas fa-user-edit"></i>
                    Update</button>
            </div>
        </div>
    </div>
</div>

<!----------------------------------------------
----------------Modal for Edit Lab Info
------------------------------------------------->
<div class="modal fade text-dark" id="editLaboratory" tabindex="-1" aria-labelledby="editLaboratoryLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="editLaboratoryLabel"> <i class="fa-solid fa-house-medical me-2"></i>
                    Laboratory Details<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit-labid">
                <div class="alert alert-danger m-0 py-2 mb-3 hidden" id="alerteditLaboratory"> <i
                        class="fa-solid fa-info-circle me-2"></i> Please fill out the required fields</div>
                <div class="row mb-3 ps-3">
                    <label for="edit-labname" class="col-sm-3 col-form-label"> Lab Name <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" id="edit-labname" class="form-control border-primary "
                            placeholder="Ex: Internet Laboratory">
                    </div>
                </div>
                <div class="row mb-1 ps-3">
                    <label for="edit-role" class="col-sm-3 col-form-label">Status <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select id="edit-status" class="form-select border-primary">
                        </select>

                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa-solid fa-xmark"></i> Close</button>
                <button type="button" class="btn btn-success" id="editLaboratoryButton"><i class="fas fa-edit"></i>
                    Update</button>
            </div>
        </div>
    </div>
</div>