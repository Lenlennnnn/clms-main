let sessionCodesTable;
$(document).ready(function () {
  topbar.hide();
  sessionCodesTable = $("#sessionCodesTable").DataTable({
    //AJAX CALLING
    ajax: {
      type: "POST",
      url: "api/session.php",
      dataType: "json",
      data: function (d) {
        return JSON.stringify({
          mode: "fetch_session_per_user",
          userID: sessionStorage.getItem("userID"),
        });
      },
      dataSrc: "data",
    },
    rowId: "session_id",
    columns: [
      { data: "session_id", },
      {
        data: "num_attendee",
      },
      { data: "session_code" },
      {
        data: "session_date",
        render: function (data, type, full, meta) {
          const dateArray = data.split(" ");
          const dateOnly = dateArray[0];
          return `${dateOnly}`;
        },
      },
      { data: "laboratory_id", searchable: false, visible: false },
      { data: "laboratory_name" },
      { data: "user_id", searchable: false, visible: false },
      { data: "faculty_name" },
      { data: "subject" },
      { data: "section" },
      {
        data: "session_date",
        render: function (data, type, full, meta) {
          const dateArray = data.split(" ");
          const timeOnly = dateArray[1];
          let hours = Number(timeOnly.substring(0, 2));
          let minutes = timeOnly.substring(3, 5);
          let ampm = hours >= 12 ? "pm" : "am";
          hours %= 12;
          hours = hours ? hours : 12;
          return hours + ":" + minutes + " " + ampm;
        },
      },
      {
        data: "end_date",
        render: function (data, type, full, meta) {
          if (data !== "" && data !== null) {
            const dateArray = data.split(" ");
            const timeOnly = dateArray[1];
            let hours = Number(timeOnly.substring(0, 2));
            let minutes = timeOnly.substring(3, 5);
            let ampm = hours >= 12 ? "pm" : "am";
            hours %= 12;
            hours = hours ? hours : 12;
            return hours + ":" + minutes + " " + ampm;
          } else {
            return "";
          }
        },
      },
      {
        data: "session_status",
        render: function (data, type, full, meta) {
          if (data === "Active") {
            return `<span class="badge badge-success">${data} </span>`;
          } else {
            return `<span class="badge badge-danger">${data}</span>`;
          }
        },
      },

      {
        // Actions
        data: "session_id",
        orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
          return `<button class="btn btn-sm btn-primary " onClick="viewAttendees('${full.session_code}', '${full.session_date}')" data-bs-toggle="modal" data-bs-target="#sessionAttendees"><i class="fa-solid fa-eye"></i></button>
            `;
        },
      },
    ],

    //Order by the column date in descending
    order: [
      [12, "asc"],
      [0, "desc"],
    ],
    language: {
      loadingRecords:
        '<i class="fa fa-spinner fa-spin fa-4x fa-fw text-primary"></i> </br> Please wait...',
      emptyTable:
        '<i class="fa-solid fa-file-exclamation fa-5x fa-fw text-primary"></i> </br>No data available in table',
    },
    dom: '<"cardheader-dark-bg py-2"<"problems-label text-start"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6  text-start"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row text-start"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
              columns: ":not(:last-child):not(:first-child)",
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
                <h5 class="text-center mt-3 fw-bold text-uppercase text-decoration-underline">List of Sessions</h5>
                <small> Faculty Name: <strong> ${sessionStorage.getItem(
                  "faculty_name"
                )}</strong></small>
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
  $("div.problems-label").html(
    '<h5 class="card-title mb-0"><i class="fa-solid fa-list me-2"></i>List of Sessions</h5>'
  );
});

function deletePC(pc_id) {
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
        url: "../api/pc-items.php",
        dataType: "TEXT",
        data: JSON.stringify({
          mode: "delete_pc",
          pc_id: pc_id,
          lab_id: sessionStorage.getItem("labid"),
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd("Successfully deleted the pc", icon_success); //alert message
            // Clear the interval timer associated with the occupied PC card
            // displayPC();
            count_pc();
            pcmanagementtable.ajax.reload();
          }
        },
        error: function (error) {
          alertTopEnd(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });
}

function viewAttendees(sessionCode, date) {
  const dateArray = date.split(" ");
  const dateObj = new Date(dateArray);
  const options = { month: "short", day: "numeric", year: "numeric" };
  const formattedDate = dateObj.toLocaleDateString("en-US", options);
  $("#sessionCodeAttendee").val(sessionCode);
  $("#attendeesHeader").html(
    `${formattedDate} - <span class="text-primary">(${sessionCode})</span>`
  );

  attendeesTable.ajax.reload();
}
