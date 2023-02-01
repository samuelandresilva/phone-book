var behavior = function (val) {
    return val.replace(/\D/g, '').length === 13 ? '+999 (00) 00000-0000' : '+999 (00) 0000-00009';
}, options = {
    onKeyPress: function (val, e, field, options) {
        field.mask(behavior.apply({}, arguments), options);
    }
};

$('.phone').mask(behavior, options);

$('.btn-add-people').on('click', e => {
    $('.spin-people').addClass('d-none');
    $('.form-people').removeClass('d-none');

    $('#people_id').val('');
    $('#people_type').val('');
    $('#people_name').val('');
    $('#people_nickname').val('');
    $('#people_inscnum').val('');
    $('#people_obs').val('');

    $('#modal-people').modal('toggle');
});

var table = $('.datatable').DataTable({
    pagingType: "numbers",
    language: {
        //url: '/libs/datatables/js/pt-BR.json' // remove comento to translate to pt-br
    },
    processing: true,
    serverSide: true,
    ajax: '/phone-book/peoples',
    columnDefs: [{
        target: 3,
        visible: false,
        searchable: true,
    }, {
        targets: 4,
        data: null,
        className: 'dt-body-right',
        render: function (data, type, row, meta) {
            return `
                <td>
                    <button type="button" class="btn btn-primary btn-sm" onclick="loadPeopleContacts(${data[0]})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </button>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="editPeople(${data[0]})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="deletePeople(${data[0]})">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                    </button>
                </td>`
        }
    }],
    initComplete: () => {

    }
});

setTimeout(() => $('.loading').fadeOut(), 400);

$('.btn-save-people').on('click', e => {
    $('.spin-people').removeClass('d-none');
    $('.form-people').addClass('d-none');

    let newer = $('#people_id').val() == null || $('#people_id').val() == '';

    const data = {
        id: $('#people_id').val(),
        type: $('#people_type').val(),
        name: $('#people_name').val(),
        nickname: $('#people_nickname').val(),
        inscnum: $('#people_inscnum').val(),
        obs: $('#people_obs').val(),
    };

    jQuery.ajax({
        type: 'POST',
        url: '/phone-book/peoples/save',
        data: data,
        success: (resp, statusText, xhr) => {
            Swal.fire(xhr.statusText).then(e => {
                table.ajax.reload();
                $('#modal-people').modal('toggle');

                if (newer) loadPeopleContacts(resp);
            });
        },
        error: err => {
            Swal.fire(err.statusText);
        },
    });
});

$('.btn_add').on('click', e => {
    let id = $(e.currentTarget).data('id');

    $('.btn_save').data('id', id);
    $('#contacts').modal('toggle');
    $('#add_contact').modal('toggle');
});

$('.btn_save').on('click', e => {
    let id = $(e.currentTarget).data('id');
    const data = {
        people_id: id,
        number: $('#contact_number').val(),
        descr: $('#contact_descr').val(),
    };
    jQuery.ajax({
        type: 'POST',
        url: '/phone-book/contacts/save',
        data: data,
        success: (resp, textStatus, xhr) => {
            console.log(xhr.statusText);
            Swal.fire('Registro salvo com sucesso')
                .then(() => {
                    $('#add_contact').modal('toggle');
                    loadPeopleContacts(id);
                });
        },
    });
});

function editPeople(id) {
    $('.spin-people').removeClass('d-none');
    $('.form-people').addClass('d-none');

    jQuery.ajax({
        type: 'POST',
        url: '/phone-book/peoples/' + id,
        success: (resp, statusCode, xhr) => {
            $('#people_id').val(resp[0].id);
            $('#people_type').val(resp[0].type);
            $('#people_name').val(resp[0].name);
            $('#people_nickname').val(resp[0].nickname);
            $('#people_inscnum').val(resp[0].inscnum);
            $('#people_obs').val(resp[0].obs);

            $('.spin-people').addClass('d-none');
            $('.form-people').removeClass('d-none');
        },
        error: err => {
            $('.spin-people').addClass('d-none');
            Swal.fire(err.statusText);
        },
    });

    $('#modal-people').modal('toggle');
}

function deletePeople(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'POST',
                url: '/phone-book/peoples/delete/' + id,
                success: (resp, statusCode, xhr) => {
                    Swal.fire('Record deleted!').then(() => {
                        table.ajax.reload();
                    });
                },
            });
        }
    });
}

function loadPeopleContacts(people_id) {
    $('.table-contacts tbody').html('');
    $('#contacts').modal('toggle');

    $('.spin').removeClass('d-none');
    $('.table-contacts').addClass('d-none');

    jQuery.ajax({
        type: 'POST',
        url: '/phone-book/contacts/' + people_id,
        success: resp => {
            for (i = 0; i < resp.length; i++) {
                $('.table-contacts tbody').append(`
                    <tr>
                        <td>${resp[i].number}</td>
                        <td>${resp[i].descr}</td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-sm" onclick="deleteContact(${resp[i].id.trim()}, ${resp[i].people_id.trim()})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                `);
            }

            $('.btn_add').data('id', people_id);

            $('.spin').addClass('d-none');
            $('.table-contacts').removeClass('d-none');
        },
    });
}

function deleteContact(id, people_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((result) => {
        if (result.isConfirmed) {
            jQuery.ajax({
                type: 'POST',
                url: '/phone-book/contacts/delete/' + id,
                success: (resp, statusCode, xhr) => {
                    $('#contacts').modal('toggle');
                    Swal.fire('Record deleted!').then(() => loadPeopleContacts(people_id));
                },
            });
        }
    });
}
