$("document").ready(function () {
  $("#validateSessionCode").click(function () {
    const sessionCodeEntered = $("#sessioncode_insert").val();
    const srcodeentered = $("#srcodeid").val();
    const fullname = $("#timein-fullname").val();
    const department = $("#timein-department").val();
    const course = $("#timein-course").val();
    const lab_id = $("#lab_id").val();
    const lab_name = $("#lab_name").val();
    const pc_number = $("#pc_number").val();
    const pc_id = $("#pc_id").val();
    const timeIn = moment().format(TIME_FORMAT);
    const date = moment().format(DATE_FORMAT);
  
    if ([sessionCodeEntered, srcodeentered, fullname, department, course].some((value) => !value)) {
      $("#alertErrorSessionCode").removeClass("hidden").html(
        ` <i class="fa-solid fa-circle-info me-2"></i> Please fill out the required information`
      );
      return;
    }
  
    $.ajax({
      type: "POST",
      url: "api/session.php",
      dataType: "json",
      data: JSON.stringify({
        mode: "validate_session_code",
        sessionCode: sessionCodeEntered,
        srcode: srcodeentered,
      }),
      success: function (result) {
        if (result === "No session code found") {
          alertTopEnd(
            "Session code not found in the database or session code already expired.",
            icon_error
          );
        } else {
          const { faculty_name, subject, section, purpose, laboratory_id } = result.session[0];
  
          if (lab_id !== laboratory_id) {
            alertTopEnd(
              "The computer you are using is not in the laboratory that is recorded in this session.",
              icon_error
            );
          } else {
            $.ajax({
              type: "POST",
              url: "api/logs.php",
              dataType: "JSON",
              data: JSON.stringify({
                mode: "timein_logs",
                studentCode: srcodeentered,
                fullname,
                sessionCode: sessionCodeEntered,
                lab_id,
                labName: lab_name,
                timeIn,
                date,
                faculty_name,
                subject,
                section,
                computernumber: pc_number,
                department,
                course,
                purpose,
                computerId: pc_id,
              }),
              success: function (response) {
                if (response === "Success") {
                  alertTopEnd("You have successfully timed in.", icon_success);
                  checkDisplayInterval();
                  sessionStorage.setItem("studentSessionCode", sessionCodeEntered);

                  validatedSessionCode();
                } else if (response === "Failed") {
                  alertTopEnd(
                    "Failed to time in! Please try again, and if the problem is still not resolved, please contact the administrator!",
                    icon_error
                  );
                } else if (response.length > 0) {
                  Swal.fire({
                    title: "Failed to log the student!",
                    html: `This student is currently using another computer in <span class="text-danger">${response[0].laboratory_name}</span> with PC number <span class="text-danger">${response[0].pc_number}</span> since <span class="text-danger">${response[0].time} of ${response[0].date}</span>. Please time out the student first.`,
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Okay",
                  });
                }
              },
              error: function (error) {
                alertTopEnd(somethingWentWrongContactIT, icon_error);
              },
            });
          }
        }
      }
    });
  });

  $("#endStudentSessionButton").on("click", function () {
    var pc_number = sessionStorage.getItem('pc_number');
    var pc_id = sessionStorage.getItem('pc_id');
    const timeOut = moment().format(TIME_FORMAT);

    Swal.fire({
      title: "Confirmation",
      text: "Are you sure you want to time out?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "api/logs.php",
          dataType: "JSON",
          data: JSON.stringify({
            mode: "timeout_logs",
            pc_id: pc_id,
            pc_number: pc_number,
            date: sessionStorage.getItem("date"),
            time: sessionStorage.getItem("timein"),
            srcode: sessionStorage.getItem("srcode"),
            timeOut: timeOut,
            lab_id: sessionStorage.getItem("lab_id"),
          }),
          success: function (result) {
            if (result === "Success") {
              //if success in adding new record
              alertTopEnd("Student successfully timed out.", icon_success); //alert message
              // Clear the interval timer associated with the occupied PC card
              validatedSessionCode();
              // sessionStorage.clear();
            } else {
              alertCenter(result, icon_error);
            }
          },
          error: function (error) {
            alertTopEnd(somethingWentWrongContactIT, icon_error);
          },
        });
      }
    });
  });

  $("#sessioncode_insert").on("keyup", function (event) {
    $("#alertErrorSessionCode").addClass("hidden");
    if (event.which == 8) {
      //if user type backspace
      return;
    }

    var val = $(this).val();
    if (val.length === 2 && val.charAt(2) !== "-") {
      val += "-";
    } else if (val.charAt(3) === "-" && val.length === 4) {
      val = val.substr(0, 3);
    } else if (val.length === 9 && val.charAt(9) !== "-") {
      val += "-";
    } else if (val.charAt(10) === "-" && val.length === 10) {
      val = val.substr(0, 10);
    }
    $(this).val(val.toUpperCase());
  });

  // ----------------------------------------------------------------
  //       BUTTON TO FETCH DATA OF THE USER
  //----------------------------------------------------------------

  $("#search-srcode-button").click(function () {
    var srcodeid = $("#srcodeid").val();
    if (srcodeid === "") {
      $("#alertTimeIn").removeClass("hidden");
      return;
    }

    $.ajax({
      type: "POST",
      url: "api/users.php",
      dataType: "JSON",
      data: JSON.stringify({
        mode: "search_user",
        srcodeid: srcodeid,
      }),
      success: function (result) {
        if (result.length > 0) {
          //DISPLAY THE RESULT IN THESE IDS
          $("#timein-fullname").val(result[0].FULLNAME);
          $("#timein-department").val(result[0].DEPARTMENT_CODE);
          $("#timein-course").val(result[0].COURSE_CODE);

          //HIDE THE ERROR MESSAGE
          $("#alertTimeIn").addClass("hidden");
          $("#alertTimeInInputFields").addClass("hidden");
        }

        if (result === "No Users found!") {
          //DISPLAY THE ERROR MESSAGE
          $("#alertTimeIn").removeClass("hidden");

          //CLEAR THE INPUT FIELD
          $("#timein-fullname").val("");
          $("#timein-department").val("");
          $("#timein-course").val("");
        }
      },
      error: function (error) {
        alertCenter(somethingWentWrongContactIT, icon_error);
      },
    });
  });

  // Swal.fire({
  //   title: 'Please insert a session code:',
  //   input: 'text',
  //   inputPlaceholder: 'Session Code',
  //   allowOutsideClick: false,
  //   showCancelButton: false,
  //   confirmButtonText: 'Validate',
  //   showLoaderOnConfirm: true,
  //   preConfirm: (login) => {
  //     return $.ajax({
  //       url: `//api.github.com/users/${login}`,
  //       method: "GET",
  //       dataType: "json",
  //       success: function (response) {

  //       },
  //       error: function (jqXHR, textStatus, error){
  //         Swal.showValidationMessage(`Request failed: ${textStatus}`);
  //       }
  //     });
  //   },
  // }).then((result) => {
  //   if (result.isConfirmed) {
  //     Swal.fire({
  //       title: `${result.value.login}'s avatar`,
  //       imageUrl: result.value.avatar_url
  //     })
  //   }
  // });

});
