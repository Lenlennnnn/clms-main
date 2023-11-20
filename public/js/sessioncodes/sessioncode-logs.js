let attendeesTable;
$(document).ready(function () {
  topbar.hide();

  attendeesTable = $("#attendeesTable").DataTable({
    //AJAX CALLING
    ajax: {
      type: "POST",
      url: "api/logs.php",
      dataType: "json",
      data: function (d) {
        return JSON.stringify({
          mode: "attendees_logs",
          sessionCode: $("#sessionCodeAttendee").val(),
        });
      },
      dataSrc: "data",
    },
    rowId: "id",
    columns: [
      { data: "id"},
      { data: "srcode" },
      { data: "fullname" },
      { data: "section" },
      { data: "department" },
      { data: "course" },
      { data: "session_code", searchable: false, visible: false },
      { data: "laboratory_name" },
      { data: "pc_number" },
      {
        data: "date",
        render: function (data, type, full, meta) {
          const dateArray = data.split(" ");
          const dateObj = new Date(dateArray);
          const options = { month: 'short', day: 'numeric', year: 'numeric' };
          const formattedDate = dateObj.toLocaleDateString('en-US', options);
          sessionStorage.setItem('dateAttendance', formattedDate) 
          return `${data}`;
        },
      },
      { data: "timein" },
      { data: "timeout" },
      { data: "faculty_name" },
      { data: "subject" },
    ],
    //Order by the column date in descending
    order: [
      [8, "asc"],
      [2, "asc"],
    ],
    dom: '<"cardheader-dark-bg py-2"<"asdasdsad text-start"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
            exportOptions: {
              columns: ':not(:first-child)'
          },

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
                <h5 class="text-center mt-3 fw-bold text-uppercase text-decoration-underline">Attendance - ${sessionStorage.getItem('labname')}</h5>
                <small>${sessionStorage.getItem('dateAttendance')}</small>
                </div>
                
                `
              );
              $(win.document.body).find("table").css("font-size", "11px");
            },
          },
        ],
      },
    ],
  });

  //header of the datatables
  $("div.asdasdsad").html(
    '<h5 class="card-title mb-0 ms-3"><i class="fa-solid fa-clock me-2"></i>Logs History</h5>'
  );
});
