$(function () {
    $('#archives-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('archive-index') }}",
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                width: '10px',
                targets: 0,
            },
            { data: 'work_unit', name: 'work_unit' },
            // { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});