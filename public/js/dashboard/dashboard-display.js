//GLOBAL VARIABLES
let displayPC;
let timerIds = [];
let timerId = null;
let checkboxToContainerMap;
let sessionCode;
let facName;
let sessionInterval;
let checkSessionInterval;

$("document").ready(function () {
  topbar.hide();
  $("#additionalInfoContainer").removeClass("hidden");

  const laboratoryId = sessionStorage.getItem("labid");
  const labID = $("#labIDSession").val();

  const laboratoryName = sessionStorage.getItem("labname");
  const labName = $("#labNameSession").val();

  const facultyNameSession = sessionStorage.getItem("faculty_name");
  facName = $("#facultyNameSession").val();

  const userIDSession = sessionStorage.getItem("userID");
  userid = $("#userIDSession").val();

  if (!laboratoryName) {
    sessionStorage.setItem("labname", labName);
  }

  if (!laboratoryId) {
    sessionStorage.setItem("labid", labID);
  }

  if (!facultyNameSession) {
    sessionStorage.setItem("faculty_name", facName);
  }

  if (!userIDSession) {
    sessionStorage.setItem("userID", userid);
  }


  // map each checkbox to its respective container
  checkboxToContainerMap = {
    cb_faculty_name: {
      name: "Faculty Name",
      fieldId: "faculty_name",
      errorMessage: "&#9679 Faculty name field </br>",
      container: "faculty_name_container",
    },
    cb_subject: {
      name: "Subject",
      fieldId: "subject",
      errorMessage: "&#9679 Subject field </br>",
      container: "subject_container",
    },
    cb_section: {
      name: "Section",
      fieldId: "section",
      errorMessage: "&#9679 Section field </br>",
      container: "section_container",
    },
    cb_purpose: {
      name: "Purpose",
      fieldId: "purpose",
      errorMessage: "&#9679 Purpose field </br>",
      container: "purpose_container",
    },
  };

  // ----------------------------------------------------------------
  //         FUNCTION TO DISPLAY THE PC IN COMPUTER MANAGEMENT
  //----------------------------------------------------------------

  displayPC = async (show) => {
    const pcCardContainer = $("#pc-card-container");

    if (show === false) {
      pcCardContainer.empty();
      return;
    }

    $.ajax({
      type: "POST",
      url: "api/pc-items.php",
      dataType: "JSON",
      data: JSON.stringify({
        mode: "display_pc",
        lab_id: sessionStorage.getItem("labid"),
      }),
      success: function (response) {
        pcCardContainer.empty();
        if (response === "No pc found") {
          pcCardContainer.append(`
              <div class="container">
                <h1 class="text-danger mt-5 mb-3"> <i class="fa-solid fa-exclamation-circle fa-2xl"></i> </br></br> No records found!</h1>
                  No PC found in this laboratory. Add a computer by clicking the add computer button.
              </div>
            `);
        } else {
          let countOccupied = 0;
          response.forEach((item) => {
            const stringNum =
              item.pc_number < 10 ? `0${item.pc_number}` : item.pc_number;
            let cardClass, content;

            if (item.status === "occupied") {
              countOccupied++;
              let hours = 0;
              let minutes = 0;

              const updateTimeUsage = (time, date, id) => {
                const dbDate = date;
                const dbTime = time;
                const currentTime = moment();
                const dateTimeString = `${dbDate} ${dbTime}`;
                const specificTime = moment(
                  dateTimeString,
                  "YYYY-MM-DD hh:mm:ss a"
                ).format("YYYY-MM-DD HH:mm:ss");
                const timeDiff = moment.duration(
                  currentTime.diff(specificTime)
                );
                hours = timeDiff.hours();
                minutes = timeDiff.minutes();
                seconds = timeDiff.seconds();
                pcCardContainer
                  .find(`#timer-${id}`)
                  .html(`${hours}h ${minutes}m ${seconds}s`);
              };

              cardClass = "occupied pc-card";
              content = `<span class="img"> 
                <i class="fa-solid fa-desktop"></i>
                <span>Occupied By: </br> 
                  <span class="text-primary">${item.FULLNAME}</span> 
                </span>
                <span>Time Usage: </br> 
                  <span id="timer-${item.id}" class="text-primary"></span>
                </span> 
              </span>
              <div class="button-container">
                <button onClick="timeoutButtonClick(${item.id}, ${item.pc_number}, '${item.date}', '${item.time}', '${item.user_srcode}')"> Time OUT </button>
              </div>
              <h2>PC <span> ${stringNum}</span></h2>`;

              if (timerIds[item.id] === undefined) {
                timerIds[item.id] = setInterval(function () {
                  updateTimeUsage(item.time, item.date, item.id);
                }, 1000);
              }
            } else if (item.status === "not available") {
              cardClass = "not-available pc-card";
              content = `<span class="img"> 
              <i class="fa-solid fa-desktop"></i>
              <span>This PC is </br> 
                <span class="text-danger">Not Available</span>
              </span> 
            </span>
           
            <div class="button-container">

            </div>
            <h2>PC <span>${stringNum}</span></h2>`;
            } else if (item.status === "available") {
              cardClass = "pc-card";
              content = `<span class="img"> 
               <i class="fa-solid fa-desktop"></i>
               <span>This PC is </br> 
                 <span class="text-primary">Available</span>
                 <button class="btn btn-danger report-btn" data-bs-toggle="modal" onClick="reportPC(${item.id}, ${item.pc_number})" data-bs-target="#reportPCModal"> Report </button>
               </span> 
             </span>
            
             <div class="button-container">
               <button data-bs-toggle="modal" onClick="timeInClick(${item.id}, ${item.pc_number})" data-bs-target="#timeInModal"> Time IN </button>
             </div>
             <h2>PC <span>${stringNum}</span></h2>`;

              timerIds[item.id] = clearInterval(timerIds[item.id]);
            }
            pcCardContainer.append(`
              <div class="${cardClass}">
                <div class="blob"></div>
                ${content}
              </div>
            `);
          });
          if (countOccupied !== 0) {
            $("#timeOutAll").removeClass("hidden");
          } else {
            $("#timeOutAll").addClass("hidden");
          }
        }
      },
      error: function (response) {
        alertCenter(somethingWentWrongContactIT, icon_error);
      },
    });
  };

  // restore the state of the checkboxes on page reload
  Object.entries(checkboxToContainerMap).forEach(
    ([checkboxSelector, container]) => {
      $("#addInfoItems").append(`
      <label class="list-group-item card-dark-bg py-1 fs-6">
        <input class="form-check-input me-1" type="checkbox" id="${checkboxSelector}"
            value="">
      ${container.name}
    </label>`);

      if (container.fieldId === "purpose") {
        var content = `  <select class="form-select" id="${container.fieldId}">
      <option value="" selected>Choose Purpose</option>
      <option value="Studies">Studies</option>
      <option value="Assignments">Assignments</option>
      <option value="Research">Research</option>
      <option value="Others">Others</option>
  </select>`;
      } else {
        var content = ` <input type="text" id="${container.fieldId}" class="form-control"
      value="">`;
      }

      $("#infoConfigurationContainer").append(`
    <div class="row mb-2 hidden " id="${container.container}">
                    <div class="col-12">
                        <div class="fw-bold d-flex">${container.name}</div>
                    </div>
                    <div class="col-12">
                        ${content}
                    </div>
                </div>`);
    }
  );

  // restore the state of the checkboxes on page reload
  Object.entries(checkboxToContainerMap).forEach(
    ([checkboxSelector, container]) => {
      handleSessionStorageInput("" + container.fieldId + "");
    }
  );

  // ----------------------------------------------------------------
  //      Function Calling
  //----------------------------------------------------------------

  checkBoxesOnCLick();
  checkSessionCodeExist();

  if (sessionStorage.getItem("sessionCode")) {
    checkSessionInterval = setInterval(checkSessionCodeExist, 5000);
  }
});

function handleSessionStorageInput(inputId) {
  // if(inputId === "faculty_name") {
  //   sessionStorage.setItem("faculty_name", facName);
  // }
  var value = sessionStorage.getItem(inputId);
  if (value) {
    $("#" + inputId + "").val(value);
  }
  $(`#${inputId}`).on("input", function () {
    var inputValue = $(`#${inputId}`).val();
    sessionStorage.setItem(inputId, inputValue);
  });
}

function sessionInfo() {
  Object.entries(checkboxToContainerMap).forEach(
    ([checkboxSelector, container]) => {
      const isChecked = sessionStorage.getItem(checkboxSelector) === "true";
      if (isChecked) {
        const value = sessionStorage.getItem(container.fieldId);

        $("#sessionInformationContainer").append(` 
          <div class="row mb-2">
          <div class="fw-bold d-flex ">${container.name}:
              <span class=" ms-2 text-primary">
                  ${value}
              </span>
          </div>
      </div>`);
      }
    }
  );
}

function checkSessionCodeExist() {
  var sessionCode = sessionStorage.getItem("sessionCode");
  var sessionDateTime = sessionStorage.getItem("sessionDateTime");

  $.ajax({
    type: "POST",
    url: "api/session.php",
    dataType: "JSON",
    data: JSON.stringify({
      mode: "check_existing_session",
      userID: sessionStorage.getItem("userID"),
      lab_id: sessionStorage.getItem("labid"),
    }),
    success: function (data) {
      if (data === "Session code not existing") {
        $("#sessionCodeText").html("");
        $("#additionalInfoContainer").show();
        $("#infoConfigurationContainer").show();
        $("#endSessionContainer").addClass("hidden");
        $("#timeOutAll").addClass("hidden");
        $("#refreshDisplay").addClass("hidden");

        sessionInterval = clearInterval(sessionInterval);
        checkSessionInterval = clearInterval(checkSessionInterval);

        sessionInfo();
        restoreDisplay();
        displayPC(false);
        checkBoxesOnCLick();
      } else {
        if (sessionCode && sessionDateTime) {
          // Parse datetime string into Moment.js object
          const dateTime = moment(sessionDateTime);
          // Update duration on the page every second
          if (sessionInterval === undefined) {
            sessionInterval = setInterval(() => {
              // Calculate duration between current time and datetime value
              const duration = moment.duration(moment().diff(dateTime));

              // Format duration string
              const durationString = `${duration.hours()}h ${duration.minutes()}m ${duration.seconds()}s`;

              // Update duration element on the page
              $("#sessionDuration").html(durationString);
            }, 1000);
          }

          // $("#createNewSessionButton").hide();
          $("#additionalInfoContainer").hide();
          $("#infoConfigurationContainer").hide();
          $("#endSessionContainer").removeClass("hidden");
          $("#sessionInformationContainer").empty();

          $("#sessionInformationContainer").append(` 
    <div class="row mb-2">
    <div class="fw-bold d-flex ">Session Code:
        <span class=" ms-2 text-primary">
        ${sessionCode}
        </span>
    </div>
</div>`);
          sessionInfo();
          displayPC();

          $("#refreshDisplay").removeClass("hidden");
        } else {
          Swal.fire({
            title: `Session "${data[0].session_code}" is still active`,
            text: "You have an existing session that is still active. Do you want to continue using this or create a new session?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              checkSessionInterval = clearInterval(checkSessionInterval);
              sessionStorage.setItem("sessionCode", data[0].session_code);
              sessionStorage.setItem("sessionDateTime", data[0].session_date);

              Object.entries(checkboxToContainerMap).forEach(
                ([checkboxSelector, container]) => {
                  if (
                    data[0][container.fieldId] !== "" &&
                    data[0][container.fieldId] !== null
                  ) {
                    // const isChecked = $(`#${checkboxSelector}`).prop("checked");
                    sessionStorage.setItem(checkboxSelector, true);
                    sessionStorage.setItem(
                      container.fieldId,
                      data[0][container.fieldId]
                    );
                  }
                }
              );
              checkSessionCodeExist();
              checkSessionInterval = setInterval(checkSessionCodeExist, 5000);
            } else {
              sessionStorage.setItem("sessionCode", data[0].session_code);
              $("#endSessionButton").click();
            }
          });
        }
      }
    },
    error: function () {
      alertCenter(somethingWentWrongContactIT, icon_error);
    },
  });
}

function restoreDisplay() {
  // restore the state of the checkboxes on page reload
  Object.entries(checkboxToContainerMap).forEach(
    ([checkboxSelector, container]) => {
      const isChecked = sessionStorage.getItem(checkboxSelector) === "true";
      if (isChecked) {
        $(`#${container.container}`).removeClass("hidden");
      }
    }
  );
}

function checkBoxesOnCLick() {
  // when a checkbox is clicked, show or hide its respective container and store its state in session storage
  Object.entries(checkboxToContainerMap).forEach(
    ([checkboxSelector, container]) => {
      const isChecked = sessionStorage.getItem(checkboxSelector) === "true";
      $(`#${checkboxSelector}`).prop("checked", isChecked);

      if (!isChecked) {
        $(`#${container.container}`).addClass("hidden");
      }

      $(`#${checkboxSelector}`).click(() => {
        const isChecked = $(`#${checkboxSelector}`).prop("checked");
        sessionStorage.setItem(checkboxSelector, isChecked);

        if (isChecked) {
          $(`#${container.container}`).removeClass("hidden");
          if (checkboxSelector === "cb_faculty_name") {
            sessionStorage.setItem("faculty_name", facName);
            handleSessionStorageInput("" + container.fieldId + "");
          }
        } else {
          $(`#${container.container}`).addClass("hidden");
        }
      });
    }
  );
}

//function to fetch the pc id
function reportPC(pcid, pcnumber) {
  var pc_id = document.getElementById("report_pcid");
  var pc_number = document.getElementById("report_pcnumber");
  pc_id.value = pcid;
  pc_number.value = pcnumber;
}
