//GLOBAL VARIABLES
// let displayPC;
let timerIds = [];
let timerId = null;
let checkboxToContainerMap;
let sessionCode;
let facName;
let sessionInterval;
let checkSessionInterval;

$("document").ready(function () {
  topbar.hide();

  const laboratoryId = sessionStorage.getItem("labid");
  const labID = $("#labIDSession").val();
  const laboratoryName = sessionStorage.getItem("labname");
  const labName = $("#labNameSession").val();
  const facultyNameSession = sessionStorage.getItem("faculty_name");
  const facName = $("#facultyNameSession").val();

  if (!laboratoryName) {
    sessionStorage.setItem("labname", labName);
  }

  if (!laboratoryId) {
    sessionStorage.setItem("labid", labID);
  }

  if (!facultyNameSession) {
    sessionStorage.setItem("faculty_name", facName);
  }

  // ----------------------------------------------------------------
  //      Function Calling
  //----------------------------------------------------------------

  fetchPendingReport();
  setInterval(function () {
    fetchPendingReport();
  }, 5000);

  fetchCountProblems();
  setInterval(function () {
    fetchCountProblems();
  }, 5000);

});

function fetchPendingReport() {
  $.ajax({
    type: "POST",
    url: "../api/problems.php",
    dataType: "json",
    data: JSON.stringify({
      mode: "fetch_problems",
      lab_id: sessionStorage.getItem("labid"),
    }),
    success: function (reports) {
      $("#pendingReportContainer").empty();
      if (reports[0].message == "No reports found") {
        $("#pendingReportContainer").append(`
        <div class="d-flex align-items-center justify-content-center py-3">
          <div class="w-100 reported-content text-center">
          <h3 class="text-success mt-5 mb-3"> <i class="fa-solid fa-check-circle fa-2xl"></i> </br></br> No problems reported</h3>
            </div>
          </div>
        </div>
      `);
      } else {
        reports.forEach((report) => {
          const statement = report.report_statement;
          const reported_date = report.reported_date;
          const { formattedDate, reportStatement } = formatDateAndStatement(
            statement,
            reported_date
          );

          $("#pendingReportContainer").append(`
            <div class="d-flex align-items-center py-3 reported-item" onClick="fetchReportData(${report.id})" data-bs-toggle="modal" data-bs-target="#problemDetails">
              <img class="rounded-circle flex-shrink-0" src="img/user.png" alt="" style="width: 40px; height: 40px;">
              <div class="w-100 ms-3 reported-content">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-0">${report.reported_by} <span class="text-primary">(${report.laboratory_name} - PC ${report.pc_number})</span> </h6>
                  <small><span class="badge badge-danger">${report.report_status}</span> </small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                  <span>${reportStatement}</span>
                  <small>${formattedDate}</small>
                </div>
              </div>
            </div>
          `);
        });
      }
    },
    error: function () {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}

function fetchCountProblems() {
  $.ajax({
    type: "POST",
    url: "../api/problems.php",
    dataType: "json",
    data: JSON.stringify({
      mode: "count_problems",
    }),
    success: function (counts) {
      $("#labContainer").empty();
      counts.forEach((count) => {
        let card_css = "";
        let badgeColor = "success";
        let visibility = "hidden";

        if (count.problem_count > 0) {
          badgeColor = "danger";
        }

        if (count.laboratory_name === sessionStorage.getItem("labname")) {
          card_css = "border-primary border shadow";
        }

        if (count.laboratory_status === "Active") {
          visibility = "visible";
        }


        $("#labContainer").append(`
          <div class="d-flex align-items-center py-3 mb-3 bg-white reported-item ${card_css}" onClick="changeLab('${count.laboratory_id}', '${count.laboratory_name}')">
            <div class="position-relative">
              <img class="rounded-circle" src="img/lab.png" alt="" style="width: 40px; height: 40px;">
              <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1 ${visibility}"></div>
            </div>
            <div class="w-100 ms-3 reported-content ">
              <div class="d-flex w-100 justify-content-between ">
                <h6 class="mb-0">${count.laboratory_name} <span class="text-primary"> (${count.computer_count})</span></h6>
                <small><span class="badge badge-${badgeColor}">${
          count.problem_count > 0 ? count.problem_count : "No"
        }  Problem/s Reported</span> </small>
              </div>
             </div>
           </div>
          `);
      });
    },
    error: function () {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}

function formatDateAndStatement(statement, reported_date) {
  const reportStatement =
    statement.length > 20 ? statement.substr(0, 20) + "..." : statement;

  const reportedDate = new Date(reported_date);
  const formattedDate = reportedDate.toLocaleString("en-us", {
    month: "short",
    day: "numeric",
    year: "numeric",
    hour: "numeric",
    minute: "numeric",
    hour12: true,
  });

  return { formattedDate, reportStatement };
}

function fetchReportData(id) {
  $.ajax({
    type: "POST",
    url: "../api/problems.php",
    dataType: "json",
    data: JSON.stringify({
      mode: "fetch_problems_details",
      reportID: id,
    }),
    success: function (results) {
      if (results[0].message == "Failed") {
        alertCenter(somethingWentWrongContactIT, icon_error);
      } else {
        $("#reported_by").html(results[0].reported_by);
        $("#reported_date").html(results[0].reported_date);
        $("#reported_lab").html(results[0].laboratory_name);
        $("#reported_pcnum").html(results[0].pc_number);
        $("#reported_status").html(results[0].report_status);
        $("#reported_statement").html(results[0].report_statement);

        $("#reportID").val(results[0].id);
      }
    },
    error: function () {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}

function changeLab(labid, labname ){
  sessionStorage.setItem("labname", labname);
  sessionStorage.setItem("labid", labid);

  var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');

  if (current === 'dashboard.php') {
    // displayPC(); //update the display
    count_pc();
    fetchCountProblems()
    pcmanagementtable.ajax.reload();
    fetchPendingReport();

  } else if (current === 'reports.php') {
    reportsLogsTable.ajax.reload();
  }

  fetchlaboratory(labid, labname);
}
