$("document").ready(function () {
  //function that will time out all the occupied pc
  $("#timeOutAll").click(function () {
    Swal.fire({
      title: "Confirmation",
      text: "Are you sure you want to timeout all the users?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        timeOutAll();
      }
    });
  });
});

// ----------------------------------------------------------------
//      This function is responsible for timing out the students
//----------------------------------------------------------------
function timeoutButtonClick(pc_id, pc_number, date, time, srcode) {
  const timeOut = moment().format(TIME_FORMAT);

  Swal.fire({
    title: "Confirmation",
    text: "Are you sure you want to timeout this user?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
    allowOutsideClick: false,
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
          date: date,
          time: time,
          srcode: srcode,
          timeOut: timeOut,
          lab_id: sessionStorage.getItem("labid"),
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd("Student successfully timed out.", icon_success); //alert message
            // Clear the interval timer associated with the occupied PC card
            timerIds[pc_id] = clearInterval(timerIds[pc_id]);
            displayPC();
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
}

// ----------------------------------------------------------------
//      This function will timeout all the occupied PC
//----------------------------------------------------------------
function timeOutAll(display) {
  $.ajax({
    type: "POST",
    url: "api/pc-items.php",
    dataType: "JSON",
    data: JSON.stringify({ mode: "display_list", lab_id: sessionStorage.getItem("labid")}),
    success: function (data) {
      console.log(data.data)
      const occupiedObject = [];

      data.data.forEach((pc) => {
        if (pc.status === "occupied") {
          occupiedObject.push(pc);
        }
      });

      const pc_id = [];
      const pc_number = [];
      const date = [];
      const time = [];
      const srcode = [];

      data.data.forEach((pc) => {
        pc_id.push(pc.id);
        pc_number.push(pc.pc_number);
        date.push(pc.date);
        time.push(pc.time);
        srcode.push(pc.user_srcode);
      });

      const timeOut = moment().format(TIME_FORMAT);

      $.ajax({
        type: "POST",
        url: "api/logs.php",
        dataType: "JSON",
        data: JSON.stringify({
          mode: "timeout_logs",
          pc_id: pc_id,
          pc_number: pc_number,
          date: date,
          time: time,
          srcode: srcode,
          timeOut: timeOut,
          lab_id: sessionStorage.getItem("labid"),
        }),
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd("Success!", icon_success); //alert message
            // Clear the interval timer associated with the occupied PC card
            timerIds[pc_id] = clearInterval(timerIds[pc_id]);
            if(display !== false){
              displayPC();
            }
           
          }
        },
        error: function (error) {
          somethingWentWrongContactIT, icon_error;
          alertTopEnd;
        },
      });
    },
    error: function (jqXHR, textStatus, errorThrown) {},
  });
}
