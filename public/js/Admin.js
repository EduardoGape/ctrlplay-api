let adminId;
const apiUrl = '/api/admin';

document.addEventListener("DOMContentLoaded", function() {
    $('#submitButtonAdminRegister').on('click', registerAdmin);
    $('#submitButtonAdminUpdate').on('click', updateAdmin);
    getAllAdmins();
});

function registerAdmin(e) {
    e.preventDefault();
    ajaxRequest(apiUrl, 'POST', { 
        name: $('#name').val(),
        email: $('#email').val(),
        password: $('#password').val()
    }, 'Admin cadastrado com sucesso!');
}

function updateAdmin(e) {
    e.preventDefault();
    ajaxRequest(`${apiUrl}/${adminId}`, 'PUT', {
        name: $('#edit-name').val(),
        email: $('#edit-email').val(),
        password: $('#edit-password').val()
    }, 'Admin atualizado com sucesso!', () => $('#editAdminModal').modal('hide'));
}

function getAdminById(id) {
    ajaxRequest(`${apiUrl}/${id}`, 'GET', null, 'Admin obtido com sucesso!');
}

function getAllAdmins() {
    ajaxRequest(apiUrl, 'GET', null, null, function(data) {
        const tbody = $('#admin-table-body');
        tbody.empty();
        data.forEach(admin => tbody.append(createAdminRow(admin)));
    });
}

function createAdminRow(admin) {
    return `
        <tr>
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox${admin.id}" name="options[]" value="${admin.id}">
                    <label for="checkbox${admin.id}"></label>
                </span>
            </td>
            <td>${admin.name}</td>
            <td>${admin.email}</td>
            <td>
                <a href="#editAdminModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick="deleteAdminById(${admin.id})" >&#xE872;</i></a>
            </td>
        </tr>
    `;
}

function deleteAdminById(id) {
    ajaxRequest(`${apiUrl}/${id}`, 'DELETE', null, 'Admin deletado com sucesso!');
}

function ajaxRequest(url, method, data, successMessage, onSuccess) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(data) {
            if(successMessage) {
                alert(successMessage);
            }
            if(onSuccess) {
                onSuccess(data);
            }
        },
        error: function(jqXHR, textStatus) {
            alert('Erro: ' + textStatus);
        }
    });
}
