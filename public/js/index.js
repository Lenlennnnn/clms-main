let fetchListLab;
let fetchListLabInterval;
$("document").ready(function () {
  fetchListLab = () => {
    $.ajax({
      type: "POST",
      url: "api/laboratory.php",
      dataType: "json",
      cache: false,
      data: JSON.stringify({
        mode: "fetch_lab_lists",
      }),
      success: function (laboratories) {
        $("#laboratory").empty();
        laboratories.forEach((laboratory) => {
          $("#laboratory").append(
            `<option value="${laboratory.laboratory_id}">${laboratory.laboratory_name}</option>`
          );
        });
      },
      error: function () {
        alertCenter(somethingWentWrongContactIT, icon_error);
      },
    });
  };

  fetchListLab();

  $("#loginbttn").prop("disabled", true);

  $("#username, #password").on("keyup", function () {
    if ($("#username").val() == "" || $("#password").val() == "") {
      $("#loginbttn").prop("disabled", true);
      $("#loginbttn").removeClass("button--telesto");
      $("#loginbttn").html(
        '<span><span><i class="fas fa-info-circle"></i> Incomplete fields</span></span>'
      );
    } else {
      $("#loginbttn").prop("disabled", false);
      $("#loginbttn").addClass("button--telesto");
      $("#loginbttn").html(
        '<span><span><i class="fas fa-sign-in-alt"></i> Login</span></span>'
      );
    }
  });
  $("#password").keypress(function (event) {
    if (event.keyCode === 13) {
      $("#loginbttn").click();
    }
  });

  $("#loginbttn").click(function () {
    $("#loginbttn").html(
      '<span><span> Logging in... <i class="fa fa-spinner fa-spin fa-1x fa-fw text-danger"></i></span></span>'
    );
    $("#loginbttn").prop("disabled", true);

    $.ajax({
      type: "POST",
      url: "api/index.php",
      dataType: "json",
      cache: false,
      data: JSON.stringify({
        mode: "authenticate",
        username: $("#username").val(),
        password: $("#password").val(),
        laboratory_id: $("#laboratory").val(),
        laboratory_name: $("#laboratory option:selected").text(),
      }),
      success: function (result) {
        console.log(result.result)
        switch (result.result) {
          case "login":
            // extract the user role from the response (replace with your actual property name)
            const userRole = result.user_role;

            // store the user role in sessionStorage
            sessionStorage.setItem("userRole", userRole);

            clearInterval(fetchListLabInterval);

            // redirect to the dashboard page
            window.location.replace("dashboard.php");
            break;
          case "admin-login":
            // extract the user role from the response (replace with your actual property name)
            const adminuserRole = result.user_role;

            // store the user role in sessionStorage
            sessionStorage.setItem("userRole", adminuserRole);
            clearInterval(fetchListLabInterval);
            // redirect to the dashboard page
            window.location.replace("admin/dashboard.php");
            break;
          case "occupied":
            alertCenter(
              "Unfortunately, someone is using the laboratory. Please wait for it to be available again.",
              icon_error,
              "FAILED!"
            );
            break;
          case "default pass":
            let timerInterval;
            Swal.fire({
              icon: "warning",
              title: "Default Password Detected",
              html: "Your password needs to be updated. Redirecting...",
              timer: 2000,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
                const b = Swal.getHtmlContainer().querySelector("b");
                timerInterval = setInterval(() => {
                  b.textContent = Swal.getTimerLeft();
                }, 100);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                window.location.replace("updatepassword.php");
              }
            });
            break;
          case "invalidpass":
            alertCenter(invalidPassword, icon_error, "FAILED!");
            break;
          case "notexist":
            alertCenter(userNotExist, icon_error, "FAILED!");
            break;
          case "failed":
            alertCenterTimer(
              somethingWentWrongContactIT,
              icon_error,
              "FAILED!"
            ).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                window.location.reload();
              }
            });
            break;
        }
        $("#loginbttn").html(
          '<span><span><i class="fas fa-sign-in-alt"></i> Login</span></span>'
        );
        $("#loginbttn").prop("disabled", false);
      },
      error: function () {
        alertCenter(somethingWentWrongContactIT, icon_error);
        $("#loginbttn").html(
          '<span><span><i class="fas fa-sign-in-alt"></i> Login</span></span>'
        );
        $("#loginbttn").prop("disabled", false);
      },
    });
  });
});
