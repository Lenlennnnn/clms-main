$("document").ready(function () {

  // ----------------------------------------------------------------
  //       BUTTON TO ADD NEW PC
  //----------------------------------------------------------------

  $(".add-computer-btn").click(function () {
    //Clone the first row
    var newRow = $(".computer-row").first().clone();
    // Clear the values of the inputs in the new row
    newRow.find("input").val("");
    //Append the new row to the form
    $("#computerRowContainer").append(newRow);
  });

  $(document).on("click", ".remove-computer-btn", function () {
    // Find all computer rows
    var rows = $(".computer-row");
    // If there is only one row, do not remove it
    if (rows.length === 1) {
      return;
    }
    // Find the parent row of the button that was clicked
    var row = $(this).closest(".computer-row");
    // Remove the row from the form
    row.remove();
  });

  $("#addPCButton").click(function () {
    var pcnumberData = [];
    var pcIPaddressData = [];
    var incompleteFields = false;
    $(".computer-row").each(function (index, row) {
      var pcNumber = $(row).find("#pcnumber\\[\\]").val();
      var pcIPAddress = $(row).find("#pcIPaddress\\[\\]").val();

      if (pcNumber == "" || pcIPAddress == "") {
        $("#alertIncompleteFields")
          .removeClass("hidden")
          .html(
            `<i class="fa-solid fa-info-circle me-2"> </i>Please complete the required fields`
          );
        return (incompleteFields = true);
      } else {
        pcnumberData.push(pcNumber);
        pcIPaddressData.push(pcIPAddress);
      }
    });

    if (!incompleteFields) {
      // Convert the data to a JSON string
      var jsonData = JSON.stringify({
        mode: "add_pc",
        pcnumber: pcnumberData,
        pcIPaddress: pcIPaddressData,
        lab_id: sessionStorage.getItem("labid"),
      });
      $.ajax({
        type: "POST",
        url: "../api/pc-items.php",
        dataType: "TEXT",
        data: jsonData,
        success: function (result) {
          if (result === "Success") {
            //if success in adding new record
            alertTopEnd(addedOneRecord, icon_success); //alert message
            // displayPC(); //update the display
            count_pc();
            fetchCountProblems()
            pcmanagementtable.ajax.reload();
            // Reset the input fields to default
            $("#pcnumber\\[\\], #pcIPaddress\\[\\]").val("");
            $("#addPC").modal("toggle");
          } else {
            alertTopEnd(addedFailed, icon_error);
          }
        },
        error: function (error) {
          alertTopEnd(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });


  $("#fixedButton").click(function(){
    const report_id  = $("#reportID").val(); 
    const currentDateTime = moment().format(DATE_TIME_FORMAT);
    $.ajax({
      type: "POST",
      url: "../api/problems.php",
      data: JSON.stringify({
        mode: "fixed_pc",
        reportID : report_id,
        currentDateTime: currentDateTime,
      }),
      dataType: "json",
      success: function(results){
        console.log(results)
        if(results[0].message === "Success"){
          alertTopEnd("Successfully updated the status of the computer", icon_success);
          count_pc();
          fetchCountProblems()
  
          fetchPendingReport();
          pcmanagementtable.ajax.reload();
          $("#problemDetails").modal("toggle");
        }else{
          alertTopEnd(somethingWentWrongContactIT, icon_error);
        }
      },
      error: function (error) {
        alertTopEnd(somethingWentWrongContactIT, icon_error);
      },
    })
  })


});
