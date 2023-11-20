
$("document").ready(function () {
  topbar.hide();

    // ----------------------------------------------------------------
  //       BUTTON TO CHANGE THE DEFAULT LABORATORY
  //----------------------------------------------------------------

  $("#selectLaboratory").change(function () {
    var selectedOptionText = $(this).find("option:selected").text();
    var selectedOptionValue = $(this).find("option:selected").val();

      sessionStorage.setItem("labname", selectedOptionText);
      sessionStorage.setItem("labid", selectedOptionValue);

      var current = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, '');

      if (current === 'dashboard.php') {
        // displayPC(); //update the display
        count_pc();
        fetchCountProblems()

        fetchPendingReport();
        pcmanagementtable.ajax.reload();
      } else if (current === 'reports.php') {
        reportsLogsTable.ajax.reload();
      }

      fetchlaboratory(selectedOptionValue, selectedOptionText);
  });

  // ----------------------------------------------------------------
  //      Function Calling
  //----------------------------------------------------------------

  fetchlaboratory(
    sessionStorage.getItem("labid") ? sessionStorage.getItem("labid") : $("#labIDSession").val(),
    sessionStorage.getItem("labname") ? sessionStorage.getItem("labname") : $("#labNameSession").val()
  );



});

function fetchlaboratory(labID, labName) {
  $("#selectLaboratory").html(
    `<option value="${labID}" class="fs-6" id="displayLabName">${labName}</option>`
  );
  $.ajax({
    type: "POST",
    url: "../api/laboratory.php",
    dataType: "json",
    cache: false,
    data: JSON.stringify({
      mode: "fetch_lab_lists",
    }),
    success: function (laboratories) {
      laboratories.forEach((laboratory) => {
        if (laboratory.laboratory_id !== labID) {
          $("#selectLaboratory").append(
            `<option class="fs-6" value="${laboratory.laboratory_id}">${laboratory.laboratory_name}</option>`
          );
        }
      });
    },
    error: function () {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}
