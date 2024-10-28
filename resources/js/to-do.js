import $ from "jquery";
window.$ = $

import DataTable from 'datatables.net';
import languageES from 'datatables.net-plugins/i18n/es-MX';
import 'datatables.net-scroller-dt';

window.DataTable = DataTable;

$(function() {
    $('#todoTable').DataTable({
        dom: 'lrtip',
        language: languageES,
        lengthChange: false,
        processing: true,
        serverSide: true,
        deferRender:    true,
        paging: false,
        scrolling: true,
        ajax: '/todo-list/data',
        createdRow: function(row) {
            $(row).addClass('odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700');
        },
        // pagingType: "scrolling",
        drawCallback: function(settings) {
            const info = this.api().page.info();
        },
        columns: [
            { data: 'id', name: 'id',className: 'text-center px-6 py-4', orderable: false },
            { data: 'title', name: 'title', className: 'text-center px-6 py-4', orderable: false },
            { data: 'description', name: 'description', className: 'text-center px-6 py-4', orderable: false },
            { data: 'completed', name: 'completed',
                render: function(data, type, row) {
                    return data ? 'si' : 'no';
                },
                className: 'text-center', orderable: false

            },
            { data: 'created', name: 'created_at', className: 'text-center px-6 py-4', orderable: false },
            { data: 'action', name: 'action', className: 'text-center px-6 py-4', orderable: false, searchable: false }
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
