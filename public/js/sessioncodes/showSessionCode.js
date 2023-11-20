$(document).ready(function () {
  topbar.hide();

  fetchListLab = () => {
    $.ajax({
      type: 'POST',
      url: 'api/laboratory.php',
      dataType: 'json',
      cache: false,
      data: JSON.stringify({
        mode: 'fetch_lab_lists',
      }),
      success: function (laboratories) {
        $('#ssc-select').html(
          '    <option value="">Choose Laboratory</option>'
        );
        laboratories.forEach((laboratory) => {
          $('#ssc-select').append(
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

  const currentDate = new Date();
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const formattedDate = currentDate.toLocaleDateString('en-US', options);

  $('#ssc-date').html(`( ${formattedDate} )`);

  $('#ssc-select').on('change', function () {
    var selectedLab = $('#ssc-select').val();

    $.ajax({
      type: 'POST',
      url: 'api/session.php',
      dataType: 'JSON',
      data: JSON.stringify({
        mode: 'active_session',
        lab_id: selectedLab,
      }),
      success: function (result) {
        console.log('result:', result);
        if (result === 'No session') {
          $('#ssc-sessioncode').html(
            `<span class="fs-2 text-danger"> No active session code to ${$(
              '#ssc-select option:selected'
            ).text()}</span>`
          );
        } else {
          $('#ssc-sessioncode').html(result.data[0].session_code);
        }
      },
      error: function (error) {
        alertTopEnd(somethingWentWrongContactIT, icon_error);
      },
    });
  });
});
