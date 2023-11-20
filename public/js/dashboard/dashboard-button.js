$('document').ready(function () {
  // ----------------------------------------------------------------
  //       BUTTON TO refresh display
  //----------------------------------------------------------------

  $('#refreshDisplay').click(function () {
    $('#rotateIcon').addClass('fa-spin');
    displayPC();
    setTimeout(function () {
      $('#rotateIcon').removeClass('fa-spin');
    }, 1000);
  });
  // ----------------------------------------------------------------
  //       CHECKBOX IN TIME IN
  //----------------------------------------------------------------

  $('#timein-checkbox').change(function () {
    if (this.checked) {
      //Color of the type of srcode
      $('.existing').css('color', '#ccc');
      $('.new-record').css('color', '#16af68');

      //Submit button in Time in Modal
      $('#addAndTimeInButton').removeClass('hidden'); //new record
      $('#timeInButton').addClass('hidden');

      //SRCODE text field
      $('#new-srcode').removeClass('hidden'); //new record
      $('#existing-srcode').addClass('hidden');

      //remove props of the default inputs
      $('#timein-fullname').prop('readonly', false);
      $('#timein-department').prop('readonly', false);
      $('#timein-course').prop('readonly', false);

      //additional Info
      $('#newrecord-add-info').removeClass('hidden'); //new record
      $('#timein-info').addClass('hidden');

      $.ajax({
        type: 'POST',
        url: 'api/users.php',
        dataType: 'json',
        data: JSON.stringify({
          mode: 'fetchDeptCourse',
        }),
        success: function (result) {
          $('#newrecord-department').html(
            `<option value="">Choose....</option>`
          );
          $('#newrecord-course').html(`<option value="">Choose....</option>`);
          result.department.forEach((item) => {
            $('#newrecord-department').append(
              `<option value="${item}">${item}</option>`
            );
          });

          result.course.forEach((item) => {
            $('#newrecord-course').append(
              `<option value="${item}">${item}</option>`
            );
          });
          // $('#timein-department').append(
          //   `<option value="${laboratory.laboratory_id}">${laboratory.laboratory_name}</option>`
          // );
        },
        error: function (error) {
          alertCenter(somethingWentWrongContactIT, icon_error);
        },
      });
    } else {
      //Color of the type of srcode
      $('.existing').css('color', '#2196f3');
      $('.new-record').css('color', '#ccc');

      //Submit button in Time in Modal
      $('#addAndTimeInButton').addClass('hidden'); //new record
      $('#timeInButton').removeClass('hidden');

      //SRCODE text field
      $('#new-srcode').addClass('hidden'); //new record
      $('#existing-srcode').removeClass('hidden');

      //add props of the default inputs
      $('#timein-fullname').prop('readonly', true);
      $('#timein-department').prop('readonly', true);
      $('#timein-course').prop('readonly', true);

      //additional Info
      $('#newrecord-add-info').addClass('hidden'); //new record
      $('#timein-info').removeClass('hidden');
    }
  });

  // ----------------------------------------------------------------
  //      BUTTON TO CREATE NEW SESSION
  //----------------------------------------------------------------

  $('#createNewSessionButton').click(function () {
    let isError = false;
    const errorMessage = [];
    Object.entries(checkboxToContainerMap).forEach(
      ([checkboxSelector, { fieldId, errorMessage: error }]) => {
        const isChecked = sessionStorage.getItem(checkboxSelector) === 'true';

        if (isChecked) {
          if ($('#' + fieldId).val() === '') {
            isError = true;
            errorMessage.push(error);
          }
        }
      }
    );
    if (isError) {
      alertCenter(
        'Please provide a value for the following field/s: </br></br>' +
          errorMessage +
          '',
        icon_error,
        'Missing Fields!'
      );
      return;
    }

    Swal.fire({
      title: 'Confirmation',
      text: 'Did you complete all the required information? If so, please note that you will not be able to edit it once you create a new session.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
    }).then((result) => {
      if (result.isConfirmed) {
        // Generate a new session code
        // const newSessionCode = generateSessionCode();

        generateSessionCode(function (newSessionCode, dateTime) {
          sessionStorage.setItem('sessionCode', newSessionCode);
          sessionStorage.setItem('sessionDateTime', dateTime);
          checkSessionInterval = setInterval(checkSessionCodeExist, 5000);
          checkSessionCodeExist();
        });
      }
    });
  });

  // ----------------------------------------------------------------
  //       BUTTON TO END THE CURRENT SESSION
  //----------------------------------------------------------------

  $('#endSessionButton').click(function () {
    Swal.fire({
      title: 'Confirmation',
      text: 'Are you sure you want to end this session?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        endSession();
      } else {
        checkSessionCodeExist();
      }
    });
  });

  // ----------------------------------------------------------------
  //       BUTTON TO FETCH DATA OF THE USER
  //----------------------------------------------------------------

  $('#search-srcode-button').click(function () {
    var srcodeid = $('#srcodeid').val();
    if (srcodeid === '') {
      $('#alertTimeIn').removeClass('hidden');
      return;
    }

    $.ajax({
      type: 'POST',
      url: 'api/users.php',
      dataType: 'JSON',
      data: JSON.stringify({
        mode: 'search_user',
        srcodeid: srcodeid,
      }),
      success: function (result) {
        if (result.length > 0) {
          //DISPLAY THE RESULT IN THESE IDS
          $('#timein-fullname').val(result[0].FULLNAME);
          $('#timein-department').val(result[0].DEPARTMENT_CODE);
          $('#timein-course').val(result[0].COURSE_CODE);

          //HIDE THE ERROR MESSAGE
          $('#alertTimeIn').addClass('hidden');
          $('#alertTimeInInputFields').addClass('hidden');
        }

        if (result === 'No Users found!') {
          //DISPLAY THE ERROR MESSAGE
          $('#alertTimeIn').removeClass('hidden');

          //CLEAR THE INPUT FIELD
          $('#timein-fullname').val('');
          $('#timein-department').val('');
          $('#timein-course').val('');
        }
      },
      error: function (error) {
        alertCenter(somethingWentWrongContactIT, icon_error);
      },
    });
  });

  // ----------------------------------------------------------------
  //       BUTTON TO INCREMENT AND DECREMENT THE NUMBER INPUT
  //----------------------------------------------------------------

  // const numberInput = $("#pcnumber");
  // const incrementButton = $("#increment");
  // const decrementButton = $("#decrement");
  // const INTERVAL_TIME = 100; // change this to your desired interval time in milliseconds

  // function incrementNumber() {
  //   if (numberInput.val() < 30) {
  //     numberInput.val(parseInt(numberInput.val()) + 1);
  //   }
  // }

  // function decrementNumber() {
  //   if (numberInput.val() > 1) {
  //     numberInput.val(parseInt(numberInput.val()) - 1);
  //   }
  // }

  // incrementButton
  //   .mousedown(function () {
  //     interval = setInterval(incrementNumber, INTERVAL_TIME);
  //   })
  //   .mouseup(function () {
  //     clearInterval(interval);
  //   })
  //   .click(incrementNumber);

  // decrementButton
  //   .mousedown(function () {
  //     interval = setInterval(decrementNumber, INTERVAL_TIME);
  //   })
  //   .mouseup(function () {
  //     clearInterval(interval);
  //   })
  //   .click(decrementNumber);

  // Add computer button click event

  //   const computerRow = `               <div class="row mb-1 ps-3 computer-row" >
  //   <div class="col">
  //       <!-- PC INFO -->
  //       <div class="col-sm-12 py-2 border-bottom">
  //           <div class="d-flex justify-content-end pb-2"><button class="remove-computer-btn btn btn-danger py-1 px-3"> <i class="fa-solid fa-times m-0"></i> </button></div>

  //           <div class="row mb-1 ps-3">
  //               <label for="" class="col-sm-4 col-form-label">PC Number<span class="text-danger">*</span></label>
  //               <div class="col-sm-7">
  //                   <div class="input-group">
  //                       <span class="input-group-text bg-primary text-light" id="basic-addon1"> <i class="fa-solid fa-hashtag"></i> </span>
  //                       <input type="text" id="pcnumber[]" class="form-control border-primary">
  //                   </div>
  //               </div>
  //           </div>
  //           <div class="row mb-1 ps-3">
  //               <label for="" class="col-sm-4 col-form-label">IP Address<span class="text-danger">*</span></label>
  //               <div class="col-sm-7">
  //                   <div class="input-group">
  //                       <span class="input-group-text bg-primary text-light" id="basic-addon1"> <i class="fa-solid fa-network-wired"></i></span>
  //                       <input type="text" id="pcIPaddress[]" class="form-control border-primary">
  //                   </div>
  //               </div>
  //           </div>
  //       </div>
  //   </div>
  // </div>`;

  // ----------------------------------------------------------------
  //      This button will submit the reported problem
  //----------------------------------------------------------------

  $('#submitReportProblem').on('click', function () {
    var reportStatement = $('#reportProblem').val();
    var reportPCID = $('#report_pcid').val();
    var reportPCNumber = $('#report_pcnumber').val();
    const currentDateTime = moment().format('YYYY-MM-DD HH:mm:ss');

    if (reportStatement === '') {
      $('#alertReportProblem')
        .removeClass('hidden')
        .html(
          `<i class="fa-solid fa-info-circle me-2"></i>Please provide a report statement`
        );
      return;
    } else {
      $('#alertReportProblem').addClass('hidden');
      $.ajax({
        type: 'POST',
        url: 'api/pc-items.php',
        dataType: 'json',
        data: JSON.stringify({
          mode: 'report_problem',
          reportStatement: reportStatement,
          reportPCID: reportPCID,
          reportPCNumber: reportPCNumber,
          labName: sessionStorage.getItem('labname'),
          lab_id: sessionStorage.getItem('labid'),
          reportedBy: sessionStorage.getItem('faculty_name'),
          reportedDate: currentDateTime,
        }),
        success: function (data) {
          if (data[0].message === 'Success') {
            alertTopEnd(
              'You have successfully submitted your report statement. Thank you!',
              icon_success
            );
            displayPC();
            // Clear input fields and hide modal
            $('#reportProblem').val('');
            $('#reportPCModal').modal('toggle');
          } else if (data[0].message == '') {
            alertTopEnd(
              'It seems there is a problem submitting your report. Please try again.',
              icon_error
            );
          }
        },
        error: function () {
          alertCenter(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });
});

// ----------------------------------------------------------------
//      This function will create new Session code
//----------------------------------------------------------------
function generateSessionCode(callback) {
  const sessionCode = generateCode();
  // Check if the code exists in the database
  checkDatabase(sessionCode, function (codeExists, currentDateTime) {
    // If the code exists, generate a new code by calling the function recursively
    if (codeExists) {
      return generateSessionCode();
    } else {
      // If the code doesn't exist, return the code and the currentDateTime
      callback(sessionCode, currentDateTime);
    }
  });
}

function generateCode() {
  // Current Laboratory
  const labName = sessionStorage.getItem('labname');

  // Extract initials of Laboratory's name
  const nameParts = labName.split(' ');
  const initials = nameParts.reduce((acc, part) => {
    if (part !== '') {
      acc += part[0];
    }
    return acc;
  }, '');

  // Generate random code based on current date and year
  const year = new Date().getFullYear().toString().substr(-2);
  const month = (new Date().getMonth() + 1).toString().padStart(2, '0');
  const day = new Date().getDate().toString().padStart(2, '0');
  const dateCode = month + day + year;

  // Generate a random number with four digits
  const randomNumber = Math.floor(Math.random() * 10000);
  const randomDigits = randomNumber.toString().padStart(4, '0');

  // Concatenate initials, year, date code, and random digits
  const randomCode = initials + '-' + dateCode + '-' + randomDigits;

  // Return random code
  return randomCode;
}

function checkDatabase(sessionCode, callback) {
  const currentDateTime = moment().format('YYYY-MM-DD HH:mm:ss');
  const labName = sessionStorage.getItem('labname');
  const facultyName = $('#faculty_name').val();
  const subject = $('#subject').val();
  const purpose = $('#purpose').val();
  const section = $('#section').val();

  $.ajax({
    type: 'POST',
    url: 'api/session.php',
    dataType: 'TEXT',
    data: JSON.stringify({
      mode: 'check_sessionCode',
      sessionCode: sessionCode,
    }),
    success: function (result) {
      if (result === 'No session code found') {
        $.ajax({
          type: 'POST',
          url: 'api/session.php',
          dataType: 'TEXT',
          data: JSON.stringify({
            mode: 'add_session',
            sessionCode: sessionCode,
            dateTime: currentDateTime,
            labName: labName,
            userID: sessionStorage.getItem('userID'),
            facultyName: facultyName,
            subject: subject,
            purpose: purpose,
            section: section,
            labID: sessionStorage.getItem('labid'),
          }),
          success: function (result) {
            if (result === 'Success') {
              callback(false, currentDateTime);
            }
          },
          error: function (error) {
            callback(undefined);
            return alertCenter(somethingWentWrongContactIT, icon_error);
          },
        });
      } else {
        callback(true);
      }
    },
    error: function (error) {
      callback(undefined);
      return alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}

function endSession() {
  $.ajax({
    type: 'POST',
    url: 'api/session.php',
    dataType: 'TEXT',
    data: JSON.stringify({
      mode: 'end_session',
      enddate: moment().format(DATE_TIME_FORMAT),
      sessionCode: sessionStorage.getItem('sessionCode'),
    }),
    success: function (result) {
      sessionStorage.removeItem('sessionCode');
      sessionStorage.removeItem('sessionDateTime');
      $('#sessionDuration').html('0h 0m 0s');
      sessionInterval = clearInterval(sessionInterval);
      checkSessionInterval = clearInterval(checkSessionInterval);
      Object.entries(checkboxToContainerMap).forEach(
        ([checkboxSelector, container]) => {
          sessionStorage.removeItem(container.fieldId);
          $('#' + container.fieldId + '').val('');
          sessionStorage.setItem(checkboxSelector, false);
          $(`#${checkboxSelector}`).prop('checked', false);
        }
      );
      timeOutAll(false);
      checkSessionCodeExist();
    },
    error: function (error) {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}
