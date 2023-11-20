let pcmanagementtable;
$(document).ready(function () {
  pcmanagementtable = $('#pcmanagementtable').DataTable({
    //AJAX CALLING
    ajax: {
      type: 'POST',
      url: '../api/pc-items.php',
      dataType: 'json',
      data: function (d) {
        return JSON.stringify({
          mode: 'display_list',
          lab_id: sessionStorage.getItem('labid'),
        });
      },
      dataSrc: 'data',
    },
    rowId: 'id',
    columns: [
      { data: 'id', searchable: false, visible: false },
      { data: 'pc_number' },
      { data: 'ip_address' },
      {
        data: 'status',
        render: function (data, type, full, meta) {
          if (data === 'available') {
            return '<span class="badge badge-success">Available</span>';
          } else if (data === 'occupied') {
            return '<span class="badge badge-danger">Occupied</span>';
          } else if (data === 'not available') {
            return '<span class="badge badge-secondary">Not Available</span>';
          }
        },
      },
      {
        data: 'id',
        orderable: false,
        searchable: false,
        render: function (data, type, full, meta) {
          return `  <button class="btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#editpc" onClick="editPC('${full.ip_address}', '${full.pc_number}', '${full.id}', '${full.status}')"><i class="fa-solid fa-edit"></i></button>
          <button class="btn btn-sm btn-danger " id="delete" onClick="deletePC(${data})"  ><i class="fa-solid fa-trash"></i></button>
          `;
        },
      },
    ],

    //Order by the column date in descending
    order: [[3, 'desc']],
    language: {
      loadingRecords:
        '<i class="fa fa-spinner fa-spin fa-4x fa-fw text-primary"></i> </br> Please wait...',
      emptyTable:
        '<i class="fa-solid fa-file-exclamation fa-5x fa-fw text-primary"></i> </br>No data available in table',
    },
    dom: '<"card-header bg-light cardheader-dark-bg"<"head-label text-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
    displayLength: 10,
    lengthMenu: [10, 15, 25, 50, 75, 100],
    buttons: [
      {
        //dropdown button for export
        extend: 'collection',
        className: 'btn btn-label-primary dropdown-toggle me-2',
        text: '<i class="fa-solid fa-file-export"></i> Export',
        buttons: [
          {
            //print
            extend: 'print',
            text: '<i class="fa-solid fa-print"></i> Print',
            className: 'dropdown-item',
            exportOptions: { columns: ':not(:last-child)' },
          },
          {
            //csv
            extend: 'csv',
            text: '<i class="fa-solid fa-file-csv"></i> Csv',
            className: 'dropdown-item',
            exportOptions: { columns: ':not(:last-child)' },
          },
          {
            //excel
            extend: 'excel',
            text: '<i class="fa-solid fa-file-excel"></i> Excel',
            className: 'dropdown-item',
            exportOptions: { columns: ':not(:last-child)' },
          },
          {
            //pdf
            extend: 'pdf',
            text: '<i class="fa-solid fa-file-pdf"></i> Pdf',
            className: 'dropdown-item',
            exportOptions: { columns: ':not(:last-child)' },
          },
          {
            //copy
            extend: 'copy',
            text: '<i class="fa-solid fa-copy"></i> Copy',
            className: 'dropdown-item',
            exportOptions: { columns: ':not(:last-child)' },
          },
        ],
      },
    ],
  });

  $('#editPCButton').click(function () {
    const pcnum = $('#editpcnum').val();
    const ipaddress = $('#editpcip').val();
    const pcid = $('#edit-pcid').val();

    if (pcnum === '' || ipaddress === '') {
      $('#alerteditpc').removeClass('hidden');
      return;
    } else {
      $.ajax({
        type: 'POST',
        url: '../api/pc-items.php',
        data: JSON.stringify({
          mode: 'edit_pc',
          pcnum: pcnum,
          ipaddress: ipaddress,
          pcid: pcid,
        }),
        dataType: 'text',
        success: function (results) {
          if (results === 'Success') {
            alertTopEnd('Successfully update pc details.', icon_success);
            pcmanagementtable.ajax.reload();
            $('#editpc').modal('toggle');
            $('#PCManagement').modal('toggle');
          } else {
            alertTopEnd(somethingWentWrongContactIT, icon_error);
          }
        },
        error: function (error) {
          alertTopEnd(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });
});

function deletePC(pc_id) {
  Swal.fire({
    title: 'Are you sure you?',
    text: "You won't be able to revert this.",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: 'POST',
        url: '../api/pc-items.php',
        dataType: 'TEXT',
        data: JSON.stringify({
          mode: 'delete_pc',
          pc_id: pc_id,
          lab_id: sessionStorage.getItem('labid'),
        }),
        success: function (result) {
          if (result === 'Success') {
            //if success in adding new record
            alertTopEnd('Successfully deleted the pc', icon_success); //alert message
            // Clear the interval timer associated with the occupied PC card
            // displayPC();
            count_pc();
            pcmanagementtable.ajax.reload();
          }
        },
        error: function (error) {
          alertTopEnd(somethingWentWrongContactIT, icon_error);
        },
      });
    }
  });
}

function editPC(ipaddress, pcnum, id, status) {
  $('#PCManagement').modal('toggle');
  // var anotherRole = role === 'User' ? 'Admin' : 'User';

  $('#edit-pcid').val(id);
  $('#editpcnum').val(pcnum);
  $('#editpcip').val(ipaddress);

  // $('#edit-role').empty();
  // $('#edit-role').append(`
  // <option value="${role}">${role}</option>
  // <option value="${anotherRole}">${anotherRole}</option>
  // `);
}
