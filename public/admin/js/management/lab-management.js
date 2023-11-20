let laboratoryTable;
$(document).ready(function () {
  topbar.hide();

  laboratoryTable = $("#laboratoryTable").DataTable({
    //AJAX CALLING
    ajax: {
      type: "POST",
      url: "../api/laboratory.php",
      dataType: "json",
      data: function (d) {
        return JSON.stringify({
          mode: "fetch_lab_lists",
        });
      },
      dataSrc: function (json) {
        return json;
      },
    },
    rowId: "laboratory_id",
    columns: [
      { data: "laboratory_id" },
      { data: "laboratory_name" },
      { data: "laboratory_status" },
      {
        data: "laboratory_id",
        orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
         
          // Initialize all popovers on the page
          $('[data-bs-toggle="popover"]').popover();
          return `
            <button class="btn btn-sm text-success btn-icon px-2"  onClick="editLabInfo('${data}', '${full.laboratory_name}', '${full.laboratory_status}', '${full.user_role}')" data-bs-toggle="modal" data-bs-target="#editLaboratory"><i class="fa-solid fa-pen-to-square" data-bs-toggle="popover"  data-bs-placement="top" data-bs-title="Edit details" data-bs-trigger="hover"></i></button>
            <button class="btn btn-sm text-danger btn-icon  px-2" data-bs-toggle="popover" data-bs-title="Delete Laboratory" data-bs-trigger="hover" data-bs-placement="top" onClick="deleteLab('${data}')" ><i class="fa-solid fa-trash"></i></button>
            `;
        },
      },
    ],
    //Order by the column date in descending
    order: [[0, "asc"]],
    dom: '<"cardheader-dark-bg py-2"<"lab-label text-start"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
            exportOptions: { columns: ":not(:last-child)" },

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
                <h5 class="text-center mt-3 fw-bold text-uppercase text-decoration-underline">List of Laboratories</h5>
                </div>`
              );
              $(win.document.body).find("table").css("font-size", "11px");
            },
          },
        ],
      },
      {
        //Button for add new salary record
        html: '<button type="button" class="btn btn-primary" data-bs-toggle="modal" id="addLaboratoryModalButton" data-bs-target="#addLaboratory">  <i class="fa-solid fa-house-medical"></i> <span>Add Laboratory</span></button>',
        className: "create-new btn btn-primary",
      },
    ],
  });

  //header of the datatables
  $("div.lab-label").html(
    '<h5 class="card-title mb-0"><i class="fa-solid fa-user-gear me-2"></i>Laboratory Management</h5>'
  );
});

function deleteLab(lab_id) {
  Swal.fire({
    title: "Are you sure you?",
    text: "It will also delete all the PC registered in this Laboratory. You won't be able to revert this.",
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
        url: "../api/laboratory.php",
        dataType: "TEXT",
        data: JSON.stringify({
          mode: "delete_lab",
          lab_id: lab_id,
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd("Successfully deleted the laboratory", icon_success); //alert message
            laboratoryTable.ajax.reload();
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

function editLabInfo(lab_id, lab_name, status) {
  var anotherStatus = status === "Inactive" ? "Active" : "Inactive";

  $("#edit-labid").val(lab_id);
  $("#edit-labname").val(lab_name);

  $("#edit-status").empty();
  $("#edit-status").append(`
  <option value="${status}">${status}</option>
  <option value="${anotherStatus}">${anotherStatus}</option>
  `);
}
