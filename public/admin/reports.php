<?php
$currentpage = "Reports Page";
include("header.php");
include("navbar.php");

if (empty($userid)) {
  header("location: index.php");
}
?>
<div class="container-fluid pt-4 page">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active show" data-bs-toggle="tab" data-bs-target="#logsHistory" type="button" role="tab" aria-controls="logsHistory" aria-selected="true">
        <i class="fa-solid fa-clock me-2"> </i>Logs History
      </button>
    </li>

    <li class="nav-item" role="presentation">
      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#problemsHistory" type="button" role="tab" aria-controls="problemsHistory" aria-selected="true">
        <i class="fa-solid fa-bug me-2"> </i>Reported Problems
      </button>
    </li>
  </ul>


  <div class="card card-dark-bg border-0 py-2 px-4">
    <div class="card-header d-flex justify-content-end py-2">
      <div id="logsDateFilter" class="bg-light py-3 px-3" style="border-radius: 10px"> <i class="fa fa-calendar"></i> Date Range: <span></span> <i class="fa fa-caret-down"></i></div>
    </div>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade active show" id="logsHistory" role="tabpanel" aria-labelledby="logsHistory-tab">
        <?php
        include('logs-history.php');
        ?>
      </div>

      <div class="tab-pane fade " id="problemsHistory" role="tabpanel" aria-labelledby="problemsHistory-tab">
        <?php
        include('problems-history.php');
        ?>
      </div>


    </div>
  </div>
</div>







<?php
include("footer.php");

?>