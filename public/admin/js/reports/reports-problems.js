let reportsProblemsTable;

$(document).ready(function () {
  topbar.hide();

  $("#logsDateFilter").daterangepicker(
    {
      minDate: "10/01/2018",
      maxYear: 2100,
      startDate: start,
      endDate: end,
    },
    function date(start, end, label) {
      $("#logsDateFilter span").html(`<span class="bg-white px-3 py-2">
      ${
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      }</span>`);
      startdate = start.format("YYYY-MM-DD");
      enddate = end.format("YYYY-MM-DD");

          reportsLogsTable.ajax.reload();
      reportsProblemsTable.ajax.reload();
    }
  );

  $("#logsDateFilter span").html(`<span class="bg-white px-3 py-2">
  ${start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")}</span>`);

  reportsProblemsTable = $("#reportsProblemsTable").DataTable({
    //AJAX CALLING
    ajax: {
      type: "POST",
      url: "../api/problems.php",
      dataType: "json",
      data: function (d) {
        return JSON.stringify({
          mode: "report_problems",
          startdate: startdate,
          enddate: enddate,
        });
      },
      dataSrc: "data",
    },
    rowId: "id",
    columns: [
      { data: "id", searchable: false, visible: false },
      { data: "laboratory_id", searchable: false, visible: false },
      { data: "laboratory_name" },
      { data: "pc_number" },
      { data: "pc_id", searchable: false, visible: false },
      { data: "report_statement" },
      { data: "reported_by" },
      { data: "reported_date" },
      { data: "fixed_date" },
      {
        data: "report_status",
        render: function (data, type, full, meta) {
          if (data === "FIXED") {
            return `<span class="badge badge-success">${data}</span>`;
          } else {
            return `<span class="badge badge-danger">${data}</span>`;
          }
        },
      },
      {
        data: "id",
        orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
          return (
            '<button class="btn btn-sm btn-danger " id="delete" onClick="deleteProblem(' +
            data +
            ')"><i class="fa-solid fa-trash"></i></button>'
          );
        },
      },
    ],
    //Order by the column date in descending
    order: [
      [9, "desc"],
      [7, "desc"],
    ],
    dom: '<"cardheader-dark-bg py-2"<"problems-label text-start"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 10,
    lengthMenu: [10, 15, 25, 50, 75, 100],
    buttons: [
      {
        //dropdown button for export
        extend: "collection",
        className: "btn btn-label-primary dropdown-toggle me-2",
        text: '<i class="fa-solid fa-file-export"></i> Export',
        buttons: [
          {
            //print
            extend: "print",
            text: '<i class="fa-solid fa-print"></i> Print',
            className: "dropdown-item",
            exportOptions: { columns: [2, 3, 5, 6, 7, 8, 9] },

            customize: function (win) {
              $(win.document.head).find("title").remove();
              $(win.document.head).append(`<title>&nbsp</title>`);
              $(win.document.body).find("h1").remove();
              $(win.document.body).prepend(
                `<div class="d-flex justify-content-center border-bottom border-2 border-dark" ">
                  <div style="position: absolute; left: 0px; "> <img src="https://upload.wikimedia.org/wikipedia/en/b/bd/Batangas_State_Logo.png" alt="Logo" height="100"></div>
                 
                  <div class="text-center">
                    <h4 class="fw-bold" style="line-height: 18px">Batangas State University</h4>
                    <h6 class="text-danger" style="line-height: 15px">The National Engineering University</h6>
                    <h6 style="line-height: 15px">JPLPC-Malvar Campus</h6>
                    <p style="line-height: 1px !important">G. Leviste Street, Poblacion, Malvar, Btangas, Philippines 4233</p>
                    <p style="line-height: 1px">Tel Nos.: (+63 43)778-2170 local 502(+63 43)778-6633</p>
                    <p style="line-height: 1px">E-mail Address: <span class="text-primary text-decoration-underline">ict.malvar@g.batstate-u.edu.ph</span> | Website: <span class="text-primary text-decoration-underline">http://www.batstate-u.edu.ph</span></p>
                  </div>
                </div>
                <div class="text-center"> 
                <h5 class="text-center mt-3 fw-bold text-uppercase text-decoration-underline">PROBLEMS REPORTED</h5>
                </div>
                
                `
              );
              $(win.document.body).find("table").css("font-size", "11px");
            },
          },

          // {
          //   //csv
          //   extend: "csv",
          //   text: '<i class="fa-solid fa-file-csv"></i> Csv',
          //   className: "dropdown-item",
          //   exportOptions: { columns: ":not(:last-child)" },
          // },
          // {
          //   //excel
          //   extend: "excel",
          //   text: '<i class="fa-solid fa-file-excel"></i> Excel',
          //   className: "dropdown-item",
          //   exportOptions: { columns: ":not(:last-child)" },
          // },
          // {
          //   //pdf
          //   extend: "pdf",
          //   text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
          //   className: "dropdown-item",
          //   exportOptions: { columns: ":not(:last-child)" },
          // },
          // {
          //   //copy
          //   extend: "copy",
          //   text: '<i class="fa-solid fa-copy"></i> Copy',
          //   className: "dropdown-item",
          //   exportOptions: { columns: ":not(:last-child)" },
          // },
        ],
      },
    ],
  });

  //header of the datatables
  $("div.problems-label").html(
    '<h5 class="card-title mb-0"><i class="fa-solid fa-bug me-2"></i>Problems History</h5>'
  );
});

function deleteProblem(problem_id) {
  Swal.fire({
    title: "Are you sure you?",
    text: "You won't be able to revert this.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "../api/problems.php",
        dataType: "TEXT",
        data: JSON.stringify({
          mode: "delete_problem",
          problem_id: problem_id,
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd(
              "Successfully deleted the reported problem",
              icon_success
            ); //alert message

            reportsProblemsTable.ajax.reload();
          } else {
            alertTopEnd(somethingWentWrongContactIT, icon_error);
          }
        },
        error: function (error) {
          alertTopEnd(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });
}
