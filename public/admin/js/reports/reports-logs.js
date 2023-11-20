let reportsLogsTable;
let start = moment().subtract(10, "days");
let end = moment();

let startdate = start.format("YYYY-MM-DD");
let enddate= end.format("YYYY-MM-DD");

$(document).ready(function () {
  topbar.hide();

  reportsLogsTable = $("#reportsLogsTable").DataTable({
    //AJAX CALLING
    ajax: {
      type: "POST",
      url: "../api/logs.php",
      dataType: "json",
      data: function (d) {
        return JSON.stringify({
          mode: "reports_logs",
          startdate: startdate,
          enddate: enddate,
          lab_id: sessionStorage.getItem("labid"),
        });
      },
      dataSrc: "data",
    },
    rowId: "id",
    columns: [
      { data: "id", searchable: false, visible: false },
      { data: "srcode" },
      { data: "fullname" },
      { data: "session_code" },
      { data: "laboratory_name" },
      { data: "pc_number"},
      { data: "date" },
      { data: "timein" },
      { data: "timeout" },
      { data: "faculty_name" },
      { data: "subject" },
      { data: "section" },
      { data: "department" },
      { data: "course" },
      { data: "purpose" },
      { data: "id",
      orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
          return (
            '<button class="btn btn-sm btn-danger " id="delete" onClick="deleteLog(' +
            data +
            ')"><i class="fa-solid fa-trash"></i></button>'
          );
        }, },
    ],
    //Order by the column date in descending
    order: [[6, "desc"], [7,"desc"]],
    dom: '<"cardheader-dark-bg py-2"<"logs-label text-start"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
            text: '<i class="fa-solid fa-print"></i> IL Print',
            className: "dropdown-item",
            exportOptions: { columns: [1, 2, 5, 6, 7, 8, 12, 13, 14] },

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
                <h5 class="text-center my-3 fw-bold text-uppercase text-decoration-underline">LOGSHEET - ${sessionStorage.getItem("labname")}</h5>
                </div>` 
              );
              $(win.document.body).find("table").css("font-size", "11px");
            },
          },
          {
            //print
            extend: "print",
            text: '<i class="fa-solid fa-print"></i> Print',
            className: "dropdown-item",
            exportOptions: { columns: [1, 2, 3, 5, 6, 7, 8, 9, 10, 11] },

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
                <h5 class="text-center mt-3 fw-bold text-uppercase text-decoration-underline">LOGSHEET - ${sessionStorage.getItem("labname")}</h5>
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
   $('div.logs-label').html('<h5 class="card-title mb-0"><i class="fa-solid fa-clock me-2"></i>Logs History</h5>');
});

function deleteLog(log_id) {
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
        url: "../api/logs.php",
        dataType: "TEXT",
        data: JSON.stringify({
          mode: "delete_log",
          log_id: log_id,
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd("Successfully deleted the log", icon_success); //alert message

            reportsLogsTable.ajax.reload();
          }else{
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
