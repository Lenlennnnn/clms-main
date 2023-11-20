<?php
$currentpage = "List of Sessions";
include("header.php");
include("navbar.php");

if (empty($userid)) {
  header("location: index.php");
}
?>
<div class="container-fluid pt-4 px-4">
  <div class="card">
    <div class="card-header bg-light cardheader-dark-bg d-flex justify-content-between px-4 py-3">
      <div>
        <h5 class="card-title mb-0"> <i class="fa-solid fa-qrcode me-2"></i> Session Code History</h5>
      </div>
      <div class="d-flex align-items-center">
        <!-- <button type="button" class="btn btn-primary mx-2" id="refreshDisplay"><i class="fa-solid fa-sync me-2" id="rotateIcon"></i><span>Refresh</span></button> -->
      </div>
    </div>

    <div class="row border-0">
      <div class="col-xl-12">
        <div class="card-dark-bg text-center p-4">
          <div class="row">
            <div class="card-datatable table-responsive">
              <table class="table-dark-bg  datatables-basic table border-top dataTable no-footer dtr-column collapsed" id="sessionCodesTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>NO. of ATTENDEES</th>
                    <th>SESSION CODES</th>
                    <th>DATE</th>
                    <th>LABORATORY ID</th>
                    <th>LABORATORY</th>
                    <th>USER ID</th>
                    <th>FACULTY NAME</th>
                    <th>SUBJECT</th>
                    <th>SECTION</th>
                    <th>TIME IN</th>
                    <th>TIME OUT</th>
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
</div>

<?php
include("footer.php");
?>