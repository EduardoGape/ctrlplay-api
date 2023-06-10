const apiUrl = '/api/student';
const studentsPerPage = 10;  // A quantidade de estudantes por página
let currentPage = 1;  // A página atual

$(document).ready(function() {
    getAllStudentsSortedByCtrlCash();
})

function getAllStudentsSortedByCtrlCash() {
    // Adiciona os parâmetros de página e limite à URL da requisição
    const url = `${apiUrl}?orderBy=ctrlCash&page=${currentPage}&limit=${studentsPerPage}`;
    
    ajaxRequest(url, 'GET', null, null, function(response) {
        if (response.data) {
            const ol = $('#student-list-ol');
            ol.empty();
            response.data.forEach(student => ol.append(createStudentListItem(student)));

            // Adiciona os botões de paginação
            const pagination = $('.pagination');
            pagination.empty();
            if (currentPage > 1) {
                pagination.append(`<li class="page-item"><a href="#" class="page-link" onclick="changePage(${currentPage - 1})">Previous</a></li>`);
            }
            pagination.append(`<li class="page-item"><a href="#" class="page-link" onclick="changePage(${currentPage + 1})">Next</a></li>`);
        } else {
            console.log("Erro: Resposta não contém o campo 'data'");
        }
    });
}

// Função para mudar a página atual e buscar novamente os estudantes
function changePage(page) {
    currentPage = page;
    getAllStudentsSortedByCtrlCash();
}

function createStudentListItem(student) {
    return `
        <li>
            <mark>${student.name}</mark>
            <small>${student.ctrlCash}</small>
        </li>
    `;
}

function ajaxRequest(url, method, data, successMessage, onSuccess) {
    $.ajax({
        url: url,
        type: method,
        data: data,
        success: function(data) {
            if(successMessage) {
                console.log(successMessage); 
            }
            if(onSuccess) {
                onSuccess(data);
            }
        },
        error: function(jqXHR, textStatus) {
            console.log(`Erro: ${textStatus}, Status: ${jqXHR.status}, Texto: ${jqXHR.statusText}`);
        }
    });
}
