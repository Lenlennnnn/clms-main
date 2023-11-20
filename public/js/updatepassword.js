var passwordscore;
$('document').ready(function () {
  $('#updatebttn').click(function () {
    $.ajax({
      type: 'POST',
      url: 'api/index.php',
      dataType: 'json',
      cache: false,
      data: JSON.stringify({
        mode: 'updatepass',
        currentpassword: $('#currentpassword').val(),
        newpassword: $('#verifynewpassword').val(),
        currentuser: $('#currentuser').val(),
      }),
      success: function (result) {
        console.log(result);
        switch (result) {
          case 'Success':
            let timerInterval;
            Swal.fire({
              title: 'Success!',
              html: 'Your password has been succesfully updated. Redirecting...',
              timer: 2000,
              timerProgressBar: true,
              allowOutsideClick: false,
              didOpen: () => {
                Swal.showLoading();
                timerInterval = setInterval(() => {
                  const content = Swal.getContent();
                  if (content) {
                    const b = content.querySelector('b');
                    if (b) {
                      b.textContent = Swal.getTimerLeft();
                    }
                  }
                }, 100);
              },
              willClose: () => {
                clearInterval(timerInterval);
              },
            }).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                window.location.replace('logout.php');
              }
            });
            break;
          case 'currentnotmatch':
            alertCenter(currentPasswordNotMatch, icon_error, 'FAILED!');
            break;
          case 'useanotherpass':
            alertCenter(useAnotherPassword, icon_error, 'FAILED!');
            break;
          case 'failed':
            alertCenterTimer(
              somethingWentWrongContactIT,
              icon_error,
              'FAILED!'
            ).then((result) => {
              /* Read more about handling dismissals below */
              if (result.dismiss === Swal.DismissReason.timer) {
                window.location.reload();
              }
            });
            break;
        }
      },
      error: function () {
        alertCenter(somethingWentWrongContactIT, icon_error);
      },
    });
  });

  $('#newpassword').pwstrength({
    common: {
      minChar: 8,
      usernameField: '#currentpassword',
      onKeyUp: function (evt, data) {
        if (data.score != undefined) {
          $('#length-help-text').html(
            "Score: <span id='validscore' class='capsule capsule-danger px-2' style='padding-top: 1px;padding-bottom: 1px;' >" +
              Math.floor(data.score) +
              '</span>'
          );
        } else {
          $('#length-help-text').html(
            "Score: <span id='validscore' class='capsule capsule-danger px-2' style='padding-top: 1px;padding-bottom: 1px;' >0</span>"
          );
        }
      },
      onScore: function (options, word, totalScoreCalculated) {
        passwordscore = totalScoreCalculated;
        return totalScoreCalculated;
      },
    },
    rules: {
      activated: {
        wordDigits: true,
        wordSpecialChar: true,
        wordNotEmail: true, // reject passwords that contain the user's email address
        wordBlackList: commonPasswords,
      },
    },
    ui: {
      verdicts: ['Weak', 'Normal', 'Medium', 'Strong', 'Very Strong'],
      showVerdictsInsideProgressBar: true,
      showVerdictsInitially: true,
      showScore: false,
    },
  });

  $('#updatebttn').prop('disabled', true);

  $('#verifynewpassword, #currentpassword, #newpassword').on(
    'focusin',
    function () {
      $('#status').removeClass('hidden');
    }
  );

  $('#verifynewpassword, #currentpassword, #newpassword').on(
    'keyup',
    function () {
      if ($('#currentpassword').val() != '') {
        $('#alertcurrentpass').html(
          "<small><i class='fas fa-check me-3'></i>Current password is provided </small>"
        );
        $('#alertcurrentpass')
          .removeClass('alert-danger')
          .addClass('alert-success');
      } else {
        $('#alertcurrentpass').html(
          "<small><i class='fas fa-times me-3'></i>Current password is provided </small>"
        );
        $('#alertcurrentpass')
          .removeClass('alert-success')
          .addClass('alert-danger');
      }

      if ($('#newpassword').val() != '' && passwordscore > 30) {
        $('#alertnewpass').html(
          " <small><i class='fas fa-check me-3'></i>New Password is valid </small>"
        );
        $('#validscore')
          .removeClass('capsule-danger')
          .addClass('capsule-success');
        $('#alertnewpass')
          .removeClass('alert-danger')
          .addClass('alert-success');
      } else {
        $('#alertnewpass').html(
          " <small><i class='fas fa-times me-3'></i>New Password is valid </small>"
        );
        $('#alertnewpass')
          .removeClass('alert-success')
          .addClass('alert-danger');
      }

      if (
        $('#newpassword').val() == $('#verifynewpassword').val() &&
        $('#newpassword').val() != '' &&
        $('#verifynewpassword') != ''
      ) {
        $('#alertverifypass').html(
          " <small><i class='fas fa-check me-3'></i>Verify Password matched </small>"
        );
        $('#alertverifypass')
          .removeClass('alert-danger')
          .addClass('alert-success');
      } else {
        $('#alertverifypass').html(
          " <small><i class='fas fa-times me-3'></i>Verify Password matched </small>"
        );
        $('#alertverifypass')
          .removeClass('alert-success')
          .addClass('alert-danger');
      }

      if (
        $('#newpassword').val() == $('#verifynewpassword').val() &&
        passwordscore > 30 &&
        $('#currentpassword').val() != '' &&
        $('#newpassword').val() != '' &&
        $('#verifynewpassword').val() != ''
      ) {
        $('#status').removeClass('alert-danger').addClass('alert-success');
        $('#updatebttn').removeClass('btn-secondary').addClass('btn-primary');
        $('#updatebttn').prop('disabled', false);
      } else {
        $('#status').removeClass('alert-success').addClass('alert-danger');
        $('#updatebttn').removeClass('btn-primary').addClass('btn-secondary');
        $('#updatebttn').prop('disabled', true);
      }
    }
  );
});
