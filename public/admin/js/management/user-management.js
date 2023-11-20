let userTable;
$(document).ready(function () {
  topbar.hide();

  userTable = $("#userTable").DataTable({
    //AJAX CALLING
    ajax: {
      type: "POST",
      url: "../api/users.php",
      dataType: "json",
      data: function (d) {
        return JSON.stringify({
          mode: "user_list",
        });
      },
      dataSrc: "data",
    },
    rowId: "user_id",
    columns: [
      { data: "user_id" },
      { data: "fullname" },
      { data: "username" },
      { data: "user_role" },
      {
        data: "user_id",
        orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
         
          // Initialize all popovers on the page
          $('[data-bs-toggle="popover"]').popover();
          return `<button class="btn btn-sm text-primary btn-icon  px-2" onClick="defaultPass('${data}', '${full.username}')" data-bs-toggle="popover" data-bs-placement="top" data-bs-title="Reset Password" data-bs-trigger="hover"><i class="fa-solid fa-key"></i></button>
            <button class="btn btn-sm text-success btn-icon px-2"  onClick="editUserInfo('${data}', '${full.fullname}', '${full.username}', '${full.user_role}')" data-bs-toggle="modal" data-bs-target="#editUserInfo"><i class="fa-solid fa-pen-to-square" data-bs-toggle="popover"  data-bs-placement="top" data-bs-title="Edit details" data-bs-trigger="hover"></i></button>
            <button class="btn btn-sm text-danger btn-icon  px-2" data-bs-toggle="popover" data-bs-title="Delete User" data-bs-trigger="hover" data-bs-placement="top" onClick="deleteUser('${data}')" ><i class="fa-solid fa-trash"></i></button>
            `;
        },
      },
    ],
    //Order by the column date in descending
    order: [[0, "asc"]],
    dom: '<"cardheader-dark-bg py-2"<"user-label text-start"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
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
                <h5 class="text-center mt-3 fw-bold text-uppercase text-decoration-underline">List of Users</h5>
                </div>`
              );
              $(win.document.body).find("table").css("font-size", "11px");
            },
          },
        ],
      },
      {
        //Button for add new salary record
        html: '<button type="button" class="btn btn-primary" data-bs-toggle="modal" id="addUserModalButton" data-bs-target="#addUser">  <i class="fa-solid fa-user-plus"></i> <span>Add User</span></button>',
        className: "create-new btn btn-primary",
      },
    ],
  });

  //header of the datatables
  $("div.user-label").html(
    '<h5 class="card-title mb-0"><i class="fa-solid fa-user-gear me-2"></i>User Management</h5>'
  );
});

function deleteUser(userid) {
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
        url: "../api/users.php",
        dataType: "TEXT",
        data: JSON.stringify({
          mode: "delete_user",
          userid: userid,
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd("Successfully deleted the user", icon_success); //alert message
            userTable.ajax.reload();
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

function defaultPass(userid, username) {
  Swal.fire({
    title: "Are you sure you?",
    text: "You want to set the user's password into default password?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, update it!",
    cancelButtonText: "No, cancel!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "../api/users.php",
        dataType: "JSON",
        data: JSON.stringify({
          mode: "default_password",
          currentuser: userid,
          defaultpassword: username,
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd(
              "Successfully set the user's password to default",
              icon_success
            ); //alert message
            userTable.ajax.reload();
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

function editUserInfo(userid, fullname, username, role) {
  var anotherRole = role === "User" ? "Admin" : "User";

  $("#edit-userid").val(userid);
  $("#edit-fullname").val(fullname);
  $("#edit-username").val(username);

  $("#edit-role").empty();
  $("#edit-role").append(`
  <option value="${role}">${role}</option>
  <option value="${anotherRole}">${anotherRole}</option>
  `);
}
