let sessionContainerMap;
let userInfoMap;
let logInfo;
let displayInterval;
let sessionInterval;
$("document").ready(function () {
  topbar.hide();

  // map each checkbox to its respective container
  sessionContainerMap = {
    session_code: {
      name: "Session Code",
    },
    session_date: {
      name: "Session Date Time",
    },
    faculty_name: {
      name: "Faculty Name",
    },
    subject: {
      name: "Subject",
    },
    section: {
      name: "Section",
    },
    purpose: {
      name: "Purpose",
    },
  };

  userInfoMap = {
    srcode: {
      name: "SRCode",
    },
    fullname: {
      name: "Full Name",
    },
    department: {
      name: "Department",
    },
    course: {
      name: "Course",
    },
  };

  logInfo = {
    laboratory_name: {
      name: "Laboratory",
    },
    pc_number: {
      name: "PC Number",
    },
    timein: {
      name: "Time In",
    },
    date: {
      name: "Date",
    },
  };
  getIPAddress().then((ipaddress) => {
    sessionStorage.setItem("ipaddress", ipaddress);

    var ipaddress = sessionStorage.getItem("ipaddress");
    $.ajax({
      url: "api/pc-items.php",
      type: "POST",
      data: JSON.stringify({
        mode: "get_comp_info",
        ipaddress: ipaddress,
      }),
      dataType: "json",
      success: function (data) {
        if (data === "Not registered") {
          Swal.fire({
            title: `Computer is not registered`,
            text: "Unfortunately this computer is not registered in the database. Please contact your administrator to register this computer.",
            icon: "warning",
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
          });
        } else if (data[0].status === "available") {
          $("#labName").html(data[0].laboratory_name);
          $("#pcNumber").html(data[0].pc_number);

          $("#lab_name").val(data[0].laboratory_name);
          $("#lab_id").val(data[0].laboratory_id);
          $("#pc_number").val(data[0].pc_number);
          $("#pc_id").val(data[0].id);
          checkDisplayInterval();
          validatedSessionCode();
        } else if (data[0].status === "not available") {
          Swal.fire({
            title: `Computer is in maintenance`,
            text: "Unfortunately this computer is experiencing a problem. Please use other computer.",
            icon: "warning",
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
          });
        } else if (data[0].status === "occupied") {
          checkDisplayInterval();
          validatedSessionCode();
        }
      },
    });
  });
});

function validatedSessionCode() {
  var ipaddress = sessionStorage.getItem("ipaddress");
  $.ajax({
    url: "api/pc-items.php",
    type: "POST",
    data: JSON.stringify({
      mode: "get_comp_info",
      ipaddress: ipaddress,
    }),
    dataType: "json",
    success: function (data) {
      if (data[0].status === "available") {
        displayInterval = clearInterval(displayInterval);
        sessionInterval = clearInterval(sessionInterval);
        const inputs = [
          "timein-fullname",
          "timein-course",
          "timein-department",
          "sessioncode_insert",
          "srcodeid",
        ];

        inputs.forEach((input) => {
          $("#" + input).val("");
        });

        $("#insertSessionCode").modal("show");
        $("#student-module").addClass("hidden");
        $("#endStudentSessionContainer").addClass("hidden");
      } else {
        sessionStorage.setItem("date", data[0].date);
        sessionStorage.setItem("timein", data[0].time);
        sessionStorage.setItem("srcode", data[0].user_srcode);
        sessionStorage.setItem("lab_id", data[0].laboratory_id);
        sessionStorage.setItem("studentSessionCode", data[0].session_code);
        sessionStorage.setItem("pc_number", data[0].pc_number);
        sessionStorage.setItem("pc_id", data[0].id);

        displayInfo(
          data[0].user_srcode,
          data[0].session_code,
          data[0].date,
          data[0].time
        );
        $("#student-module").removeClass("hidden");
        $("#insertSessionCode").modal("hide");
        $("#endStudentSessionContainer").removeClass("hidden");
      }
    },
  });
}
function checkDisplayInterval() {
  if (sessionStorage.getItem("studentSessionCode") !== "none") {
    if (displayInterval === undefined) {
      displayInterval = setInterval(() => {
        validatedSessionCode();
      }, 5000);
    }
  } else {
    displayInterval = clearInterval(displayInterval);
  }
}

function displayInfo(srcode, sessionCode, date, timein) {
  $.ajax({
    url: "api/session.php",
    type: "POST",
    data: JSON.stringify({
      mode: "display_info",
      srcode: srcode,
      sessionCode: sessionCode,
      date: date,
      timein: timein,
    }),
    dataType: "json",
    success: function (result) {
      // Clear the containers
      const sessionInformationContainer = $("#sessionInformationContainer");
      const srcodeInformationContainer = $("#srcodeInformationContainer");
      const logInfoContainer = $("#logInfoContainer");

      sessionInformationContainer.empty();
      srcodeInformationContainer.empty();
      logInfoContainer.empty();

      // Update duration on the page every second
      const sessionDate = result[0].session_date;
      const sessionDuration = $("#sessionDuration");

      const updateDuration = () => {
        const duration = moment.duration(moment().diff(sessionDate));
        const durationString = `${duration.hours()}h ${duration.minutes()}m ${duration.seconds()}s`;
        sessionDuration.html(durationString);
      };

      // Append elements to the DOM
      const appendToContainer = (data, container) => {
        Object.entries(data).forEach(([mainName, item]) => {
          if (result[0][mainName] !== null && result[0][mainName] !== "") {
            container.append(`
        <div class="row mb-2">
          <h6 class="m-0 me-3 fw-bold">${item.name}: <span class="text-primary">${result[0][mainName]}</span></h6>
        </div>
      `);
          }
        });
      };

      appendToContainer(sessionContainerMap, sessionInformationContainer);
      appendToContainer(userInfoMap, srcodeInformationContainer);
      appendToContainer(logInfo, logInfoContainer);

      // Update duration every second
      sessionInterval = setInterval(updateDuration, 1000);
      // checkDisplayInterval();
    },
  });
}

async function getIPAddress() {
  const data = await $.ajax({
    url: "api/ipaddress.php",
    type: "POST",
    data: JSON.stringify({
      mode: "get_ip_address",
    }),
    dataType: "text",
  });
  $("#ip-address").html(data);
  return data;
}
