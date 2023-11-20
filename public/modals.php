<!----------------------------------------------
----------------Modal for CHANGING PASS
------------------------------------------------->
<div class="modal fade text-dark" id="updatePass" tabindex="-1" aria-labelledby="updatePassLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-dark-bg">
            <div class="modal-header cardheader-dark-bg">
                <h5 class="modal-title" id="updatePassLabel"> <i class="fa-solid fa-key me-2"></i> Update Password<span id="pc_id"></span>
                </h5>
            </div>
            <div class="modal-body">
                    <form>
                        <input type="hidden" id="currentuser" value="<?php echo $userid; ?>">
                        <div class="form-outline mb-4 text-left">
                            <label>Current Password</label>
                            <input type="password" class="form-control" placeholder="Current Password" id="currentpassword" required>
                        </div>
                        <div class="form-outline mb-4 text-left">
                            <label class="mb-1">New Password</label></br>
                            <input type="password" class="form-control mb-2" placeholder="New Password" id="newpassword">
                            <p class="mb-2 mt-3"> <span id="length-help-text" style="background: #e3e6e8; padding: 10px; border-radius: 10px;"> </span> </p>
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
                            <button type="button" class="btn btn-secondary" id="updatebttn"><i class="fas fa-user-edit"></i> Update Password</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>