$("document").ready(function () {
  // ----------------------------------------------------------------
  //       BUTTON TO ADD NEW USER
  //----------------------------------------------------------------

  $("#addUserButton").click(function () {
    const fullname = $("#user-fullname").val();
    const username = $("#user-username").val();
    const role = $("#user-role").val();

    if (fullname === "" || username === "" || role === "") {
      $("#alertAddUser").removeClass("hidden");
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../api/users.php",
        data: JSON.stringify({
          mode: "add_user",
          fullname: fullname,
          username: username,
          role: role,
        }),
        dataType: "json",
        success: function (results) {
          console.log(results);
          if (results[0].message === "Success") {
            alertTopEnd(
              "Successfully added new user.",
              icon_success
            );
            userTable.ajax.reload();
            $("#user-fullname").val("");
            $("#user-username").val("");
            $("#user-role").val("");

            $("#addUser").modal("toggle");
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


    // ----------------------------------------------------------------
  //       BUTTON TO ADD NEW LABORATORY
  //----------------------------------------------------------------

  $("#addLaboratoryButton").click(function () {
    const labname = $("#lab-labname").val();

    if (labname === "") {
      $("#alertaddLaboratory").removeClass("hidden");
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../api/laboratory.php",
        data: JSON.stringify({
          mode: "add_lab",
          labname: labname,
        }),
        dataType: "json",
        success: function (results) {
          console.log(results);
          if (results[0].message === "Success") {
            alertTopEnd(
              "Successfully added new Laboratory.",
              icon_success
            );
            laboratoryTable.ajax.reload();
            $("#lab-labname").val("");
            $("#addLaboratory").modal("toggle");
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
});


  // ----------------------------------------------------------------
  //       BUTTON TO Edit USER's Info
  //----------------------------------------------------------------

  $("#edituserButton").click(function () {
    const fullname = $("#edit-fullname").val();
    const username = $("#edit-username").val();
    const role = $("#edit-role").val();
    const userid = $("#edit-userid").val();

    if (fullname === "" || username === "" || role === "") {
      $("#alertEditUser").removeClass("hidden");
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../api/users.php",
        data: JSON.stringify({
          mode: "edit_user",
          fullname: fullname,
          username: username,
          role: role,
          userid:userid,
        }),
        dataType: "json",
        success: function (results) {
          if (results[0].message === "Success") {
            alertTopEnd(
              "Successfully update user details.",
              icon_success
            );
            userTable.ajax.reload();
            $("#edit-fullname").val("");
            $("#edit-username").val("");
            $("#edit-role").val("");

            $("#editUserInfo").modal("toggle");
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


  
  // ----------------------------------------------------------------
  //       BUTTON TO Edit USER's Info
  //----------------------------------------------------------------

  $("#editLaboratoryButton").click(function () {
    const labname = $("#edit-labname").val();
    const status = $("#edit-status").val();
    const labid = $("#edit-labid").val();

    if (labname === "" || status === "" || labid === "") {
      $("#alerteditLaboratory").removeClass("hidden");
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../api/laboratory.php",
        data: JSON.stringify({
          mode: "edit_lab",
          labname: labname,
          status: status,
          labid: labid,
        }),
        dataType: "json",
        success: function (results) {
          if (results[0].message === "Success") {
            alertTopEnd(
              "Successfully update laboratory details.",
              icon_success
            );
            laboratoryTable.ajax.reload();
            $("#edit-labname").val("");
            $("#edit-status").val("");
            $("#edit-labid").val("");

            $("#editLaboratory").modal("toggle");
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
