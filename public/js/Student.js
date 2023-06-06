let studentId;
const apiUrl = '/api/student';

document.addEventListener("DOMContentLoaded", function() {
    $('#submitButtonStudentRegister').on('click', registerStudent);
    $('#submitButtonStudentUpdate').on('click', updateStudent);
    $('#deleteSelectedStudents').on('click', deleteSelectedStudents);
    $('#searchStudent').on('input', searchStudents);
    
    $(document).on('click', '.edit', function() {
        studentId = $(this).data('id');
    });
    getAllStudents();
})

function registerStudent(e) {
    e.preventDefault();
    ajaxRequest(apiUrl, 'POST', { 
        name: $('#name').val(),
        email: $('#email').val(),
        age: $('#age').val(),
        ctrlCash: $('#ctrlCash').val(),
        password: $('#password').val()
    }, 'Estudante cadastrado com sucesso!', () => $('#addStudentModal').modal('hide'));
}

function updateStudent(e) {
    e.preventDefault();
    ajaxRequest(`${apiUrl}/${studentId}`, 'PUT', {
        name: $('#edit-name').val(),
        email: $('#edit-email').val(),
        age: $('#edit-age').val(),
        ctrlCash: $('#edit-ctrlCash').val(),
        password: $('#edit-password').val()
    }, 'Estudante atualizado com sucesso!', () => $('#editStudentModal').modal('hide'));
}

function deleteSelectedStudents() {
    // Obtém todos os checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
    
    // Para cada checkbox marcado, faz uma solicitação para deletar o usuário correspondente
    checkboxes.forEach(checkbox => {
        const studentId = checkbox.value;
        deleteStudentById(studentId);
    });
}

function searchStudents() {
    const searchTerm = $('#searchStudent').val();

    // Aqui você faz uma requisição AJAX para o servidor com o termo de pesquisa.
    ajaxRequest(`${apiUrl}?search=${searchTerm}`, 'GET', null, null, function(response) {
        const tbody = $('#student-table-body');
        tbody.empty();
        response.data.forEach(student => tbody.append(createStudentRow(student)));
        
        // Atualiza a paginação de acordo com os novos resultados.
        updatePagination(response);
    });
}

function getStudentById(id) {
    ajaxRequest(`${apiUrl}/${id}`, 'GET', null, 'Student obtido com sucesso!');
}

function getAllStudents(page = 1, search = '') {
    let url = `${apiUrl}?page=${page}`;
    if (search) {
        url += `&search=${search}`;
    }
    ajaxRequest(url, 'GET', null, null, function(response) {
        const tbody = $('#student-table-body');
        tbody.empty();
        response.data.forEach(student => tbody.append(createStudentRow(student)));

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
            pagination.append(`<li class="page-item"><a href="#" class="page-link" onclick="getAllstudents(${response.current_page - 1})">Previous</a></li>`);
        }
        if (!response.next_page_url) {
            pagination.append('<li class="page-item disabled"><a href="#">Next</a></li>');
        } else {
            pagination.append(`<li class="page-item"><a href="#" class="page-link" onclick="getAllstudents(${response.current_page + 1})">Next</a></li>`);
        }
    });
}


function createStudentRow(student) {
    let ageDate = new Date(student.age);
    let formattedAge = `${ageDate.getUTCFullYear()}-${String(ageDate.getUTCMonth() + 1).padStart(2, '0')}-${String(ageDate.getUTCDate()).padStart(2, '0')}`;
    return `
        <tr>
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox${student.id}" name="options[]" value="${student.id}">
                    <label for="checkbox${student.id}"></label>
                </span>
            </td>
            <td>${student.name}</td>
            <td>${student.email}</td>
            <td>${formattedAge}</td>    <!-- Formatted age -->
            <td>${student.ctrlCash}</td> <!-- Added ctrlCash field -->
            <td>
                <a href="#editStudentModal" class="edit" data-toggle="modal" data-id="${student.id}"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick="deleteStudentById(${student.id})" >&#xE872;</i></a>
            </td>
        </tr>
    `;
}


function deleteStudentById(id) {
    ajaxRequest(`${apiUrl}/${id}`, 'DELETE', null, 'student deletado com sucesso!');
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
