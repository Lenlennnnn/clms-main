$(document).ready(function () {
  const inputFieldIds = ['fullname', 'department', 'course'];
  // Function executed when the Time IN button is clicked
  $('#timeInButton').click(async function () {
    try {
      let incompleteFields = false;
      const formData = {};
      inputFieldIds.forEach((fieldId) => {
        if ($('#timein-' + fieldId).val() != '') {
          formData[fieldId] = $('#timein-' + fieldId).val();
        } else {
          incompleteFields = true;
        }
      });
      formData.studentCode = $('#srcodeid').val();
      formData.computerId = $('#pc_id').val();
      formData.computernumber = $('#pc_number').val();
      formData.labName = $('#lab_name').val();
      formData.mode = 'timein_logs';
      formData.sessionCode = sessionStorage.getItem('sessionCode');
      formData.lab_id = sessionStorage.getItem('labid');
      formData.timeIn = moment().format(TIME_FORMAT);
      formData.date = moment().format(DATE_FORMAT);
      formData.currentDateTime = moment().format(DATE_TIME_FORMAT);

      const newDataObject = {};
      Object.entries(checkboxToContainerMap).forEach(
        ([checkboxSelector, { fieldId, errorMessage: error }]) => {
          const isChecked = sessionStorage.getItem(checkboxSelector) === 'true';

          if (isChecked) {
            newDataObject[fieldId] = $('#' + fieldId).val();
          } else {
            newDataObject[fieldId] = '';
          }
        }
      );

      const finalData = JSON.stringify({ ...formData, ...newDataObject });

      if (incompleteFields) {
        $('#alertTimeInInputFields').removeClass('hidden');
        return;
      } else {
        $.ajax({
          type: 'POST',
          url: 'api/logs.php',
          dataType: 'JSON',
          data: finalData,
          success: function (response) {
            if (response === 'Success') {
              alertTopEnd('Student successfully timed in.', icon_success);
              displayPC();
              // Clear input fields and hide modal
              $('#timein-fullname').val('');
              $('#timein-department').val('');
              $('#timein-course').val('');
              $('#srcodeid').val('');
              $('#pc_id').val('');
              $('#timeInModal').modal('toggle');
              return;
            } else if (response === 'Failed') {
              alertTopEnd(
                'Failed to log the student! Please try again, and if the problem is still not resolved, please contact the administrator!',
                icon_error
              );
              return;
            }

            if (response.length > 0) {
              Swal.fire({
                title: 'Failed to log the student!',
                html: `This student is currently using another computer in <span class="text-danger">${response[0].laboratory_name}</span> with PC number <span class="text-danger">${response[0].pc_number}</span> since <span class="text-danger">${response[0].time} of ${response[0].date}</span>. Please time out the student first.`,
                icon: 'error',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay',
              });
            }
          },
        });
      }
    } catch (error) {
      alertCenter(somethingWentWrongContactIT, icon_error);
    }
  });

  $('#addAndTimeInButton').click(function () {
    const addRecordInputFieldIds = [
      'fullname',
      'department',
      'course',
      'gender',
      'birthdate',
      'address',
      'srcode',
    ];
    let addRecordincompleteFields = false;
    const addRecordformData = {};
    addRecordInputFieldIds.forEach((fieldId) => {
      if (fieldId === 'department' || fieldId === 'course') {
        if ($('#newrecord-' + fieldId).val() != '') {
          addRecordformData[fieldId] = $('#newrecord-' + fieldId).val();
        } else {
          addRecordincompleteFields = true;
        }
      } else {
        if ($('#timein-' + fieldId).val() != '') {
          addRecordformData[fieldId] = $('#timein-' + fieldId).val();
        } else {
          addRecordincompleteFields = true;
        }
      }
    });

    if (addRecordincompleteFields) {
      $('#alertTimeInInputFields').removeClass('hidden');
      return;
    } else {
      addRecordformData.computerId = $('#pc_id').val();
      addRecordformData.computernumber = $('#pc_number').val();
      addRecordformData.labName = $('#lab_name').val();
      addRecordformData.mode = 'addRecord_timein_logs';
      addRecordformData.sessionCode = sessionStorage.getItem('sessionCode');
      addRecordformData.lab_id = sessionStorage.getItem('labid');
      addRecordformData.timeIn = moment().format(TIME_FORMAT);
      addRecordformData.date = moment().format(DATE_FORMAT);
      addRecordformData.currentDateTime = moment().format(DATE_TIME_FORMAT);

      const newDataObject = {};
      Object.entries(checkboxToContainerMap).forEach(
        ([checkboxSelector, { fieldId, errorMessage: error }]) => {
          const isChecked = sessionStorage.getItem(checkboxSelector) === 'true';

          if (isChecked) {
            newDataObject[fieldId] = $('#' + fieldId).val();
          } else {
            newDataObject[fieldId] = '';
          }
        }
      );

      const finalData = JSON.stringify({
        ...addRecordformData,
        ...newDataObject,
      });
      $.ajax({
        type: 'POST',
        url: 'api/logs.php',
        dataType: 'JSON',
        data: finalData,
        success: function (response) {
          if (response[0].message === 'Success') {
            alertTopEnd('Student successfully timed in.', icon_success);
            displayPC();
            $('#alertTimeInInputFields').addClass('hidden');
            $('#alertTimeIn').addClass('hidden');
            // Clear input fields and hide modal
            $('#timein-checkbox').prop('checked', false).change();
            $('#pc_id').val('');

            addRecordInputFieldIds.forEach((fieldId) => {
              $('#timein-' + fieldId).val('');
            });
            $('#timeInModal').modal('toggle');
            return;
          } else if (response[0].message === 'Failed') {
            alertTopEnd(
              'Failed to log the student! Please try again, and if the problem is still not resolved, please contact the administrator!',
              icon_error
            );
            return;
          } else if (response[0].message === 'Existing') {
            Swal.fire({
              title: 'Failed to register the user!',
              html: `This SRCODE is already existing in the database`,
              icon: 'error',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Okay',
            });
          }
        },
      });
    }
  });
});

// ----------------------------------------------------------------
//       Upon clicking the button, this function resposible in displaying the number of PC
//----------------------------------------------------------------

//function to display the number of pc
function timeInClick(pcid, pc_num) {
  var pc_id = document.getElementById('pc_id');
  var pc_number = document.getElementById('pc_id_name');
  var pcnumber = document.getElementById('pc_number');

  pcnumber.value = pc_num;
  //ADD "0" if less than 10
  if (pc_num < 10) {
    pc_num = '0' + pc_num;
  } else {
    pc_num = pc_num;
  }

  var pc_num = pc_num.toString(); //convert into string
  pc_id.value = pcid;

  pc_number.innerHTML = pc_num;
}
