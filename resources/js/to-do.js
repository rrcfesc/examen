import $ from "jquery";
window.$ = $

import DataTable from 'datatables.net';
window.DataTable = DataTable;

$(function() {
    $('#todoTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/todo-list/data',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'completed', name: 'completed',
                render: function(data, type, row) {
                    return data ? 'si' : 'no';
                },
                className: 'text-center'

            },
            { data: 'created', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});


window.deleteTodo = function (event) {
    const id = event.dataset.id;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(event);
    if (confirm('¿Estás seguro de que deseas eliminar esta tarea?')) {
        $.ajax({
            url: `/todo/${id}`,
            type: 'DELETE',
            data: {
                _token: csrfToken,
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr) {
                alert(xhr.responseJSON.message);
            }
        });
    }
}
