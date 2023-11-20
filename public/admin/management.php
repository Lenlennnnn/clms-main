<?php
$currentpage = "Management";
include("header.php");
include("navbar.php");

if (empty($userid)) {
  header("location: index.php");
}
?>
<div class="container-fluid pt-4 page">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active show" data-bs-toggle="tab" data-bs-target="#userManagement" type="button" role="tab" aria-controls="userManagement" aria-selected="true">
        <i class="fa-solid fa-user-gear me-2"> </i> User Management
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#labManagement" type="button" role="tab" aria-controls="labManagement" aria-selected="true">
        <i class="fa-solid fa-computer me-2"> </i>Laboratory Management
      </button>
    </li>
  </ul>


  <div class="card card-dark-bg border-0 py-2 px-4">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade active show" id="userManagement" role="tabpanel" aria-labelledby="userManagement-tab">
        <?php
        include('user-management.php');
        ?>
      </div>

      <div class="tab-pane fade " id="labManagement" role="tabpanel" aria-labelledby="labManagement-tab">
      <?php
        include('lab-management.php');
        ?>
      </div>


    </div>
  </div>
</div>







<?php
include("footer.php");

?>