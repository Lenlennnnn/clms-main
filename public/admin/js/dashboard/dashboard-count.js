let count_pc;
// let count_admin;
$("document").ready(function () {

    
// ----------------------------------------------------------------
//       FUNCTION TO COUNT NUMBER OF PC (OCCUPIED AND AVAILABLE)
//----------------------------------------------------------------

  count_pc = function () {
    $.ajax({
      type: "POST",
      url: "../api/pc-items.php",
      dataType: "JSON",
      data: JSON.stringify({
        mode: "count_pc",
        lab_id: sessionStorage.getItem("labid") ? sessionStorage.getItem("labid") : $("#labIDSession").val(),
      }),
      success: function (result) {
        $("#totalcomputer").html(result[0].total); //Total computer display in HTML
        $("#availablecomputer").html(
          result[0].available ? result[0].available : "0"
        ); //Available Computer display in HTML
        $("#occupiedcomputer").html(
          result[0].occupied ? result[0].occupied : "0"
        ); //Occupied Computer display in HTML

        $("#notavailable-pc").html(
          result[0].not_available ? result[0].not_available : "0"
        ); //Not Available Computer display in HTML
      },
      error: function (error) {
        alertCenter(somethingWentWrongContactIT, icon_error);
      },
    });
  };

  
// ----------------------------------------------------------------
//       FUNCTION TO COUNT NUMBER OF USERS
//----------------------------------------------------------------


  // count_admin = function () {
  //   $.ajax({
  //     type: "POST",
  //     url: "api/users.php",
  //     dataType: "JSON",
  //     data: JSON.stringify({
  //       mode: "count_admin",
  //     }),
  //     success: function (result) {
  //       $("#total-admin").html(result[0].totalAdmin); //Total admin display in HTML
  //     },
  //     error: function (error) {
  //       alertCenter(somethingWentWrongContactIT, icon_error);
  //     },
  //   });
  // };

  count_pc(); //--call the function to display the count of PC items
  // count_admin(); //--call the function to display the count of admin
});
