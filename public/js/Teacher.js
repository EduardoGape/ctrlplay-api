let TeacherId;
const apiUrl = '/api/teacher';

document.addEventListener("DOMContentLoaded", function() {
    $('#submitButtonTeacherRegister').on('click', registerTeacher);
    $('#submitButtonTeacherUpdate').on('click', updateTeacher);
    $('#deleteSelectedTeachers').on('click', deleteSelectedTeachers);
    $('#searchTeacher').on('input', searchTeachers);
    
    $(document).on('click', '.edit', function() {
        teacherId = $(this).data('id');
    });
    getAllTeachers();
})

function registerTeacher(e) {
    e.preventDefault();
    ajaxRequest(apiUrl, 'POST', { 
        name: $('#name').val(),
        email: $('#email').val(),
        password: $('#password').val()
    }, 'Estudante cadastrado com sucesso!', () => $('#addTeacherModal').modal('hide'));
}

function updateTeacher(e) {
    e.preventDefault();
    ajaxRequest(`${apiUrl}/${TeacherId}`, 'PUT', {
        name: $('#edit-name').val(),
        email: $('#edit-email').val(),
        password: $('#edit-password').val()
    }, 'Estudante atualizado com sucesso!', () => $('#editTeacherModal').modal('hide'));
}

function deleteSelectedTeachers() {
    // Obtém todos os checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    
    // Para cada checkbox marcado, faz uma solicitação para deletar o usuário correspondente
    checkboxes.forEach(checkbox => {
        const teacherId = checkbox.value;
        deleteTeacherById(teacherId);
    });
}

function searchTeachers() {
    const searchTerm = $('#searchTeacher').val();

    // Aqui você faz uma requisição AJAX para o servidor com o termo de pesquisa.
    ajaxRequest(`${apiUrl}?search=${searchTerm}`, 'GET', null, null, function(response) {
        const tbody = $('#Teacher-table-body');
        tbody.empty();
        response.data.forEach(Teacher => tbody.append(createTeacherRow(Teacher)));
        
        // Atualiza a paginação de acordo com os novos resultados.
        updatePagination(response);
    });
}

function getTeacherById(id) {
    ajaxRequest(`${apiUrl}/${id}`, 'GET', null, 'Teacher obtido com sucesso!');
}

function getAllTeachers(page = 1, search = '') {
    let url = `${apiUrl}?page=${page}`;
    if (search) {
        url += `&search=${search}`;
    }
    ajaxRequest(url, 'GET', null, null, function(response) {
        const tbody = $('#Teacher-table-body');
        tbody.empty();
        response.data.forEach(Teacher => tbody.append(createTeacherRow(Teacher)));

        const currentPage = response.current_page;  // A página atual
        const lastPage = response.last_page;  // O número total de páginas
        const nextPag = currentPage < lastPage ? currentPage + 1 : currentPage; // Define a próxima página

        // atualiza o texto com o total de registros e a página atual
        $('.hint-text').html(`Showing <b>${currentPage}</b>-<b>${nextPag}</b> out of <b>${lastPage}</b> entries`);

        // atualiza os links da paginação
        const pagination = $('.pagination');
        pagination.empty();
        if (!response.prev_page_url) {
            pagination.append('<li class="page-item disabled"><a href="#">Previous</a></li>');
        } else {
            pagination.append(`<li class="page-item"><a href="#" class="page-link" onclick="getAllAdmins(${response.current_page - 1})">Previous</a></li>`);
        }
        if (!response.next_page_url) {
            pagination.append('<li class="page-item disabled"><a href="#">Next</a></li>');
        } else {
            pagination.append(`<li class="page-item"><a href="#" class="page-link" onclick="getAllAdmins(${response.current_page + 1})">Next</a></li>`);
        }
    });
}


function createTeacherRow(teacher) {
    return `
        <tr>
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox${teacher.id}" name="options[]" value="${teacher.id}">
                    <label for="checkbox${teacher.id}"></label>
                </span>
            </td>
            <td>${teacher.name}</td>
            <td>${teacher.email}</td>
            <td>
                <a href="#editTeacherModal" class="edit" data-toggle="modal" data-id="${teacher.id}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick="deleteTeacherById(${teacher.id})" >&#xE872;</i></a>
            </td>
        </tr>
    `;
}

function deleteTeacherById(id) {
    ajaxRequest(`${apiUrl}/${id}`, 'DELETE', null, 'Teacher deletado com sucesso!');
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
            console.log(jqXHR.responseText);  // Verifique esta mensagem no console do navegador
            alert('Erro: ' + textStatus);
        }
    });
}
