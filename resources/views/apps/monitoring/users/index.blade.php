@extends('layouts.app')

@section('content')
<main id="main" class="main">
    <section class="section quantity-unit">
        <div class="pagetitle">
            <h1>Monitoring Users</h1>
        </div>

        <!-- Tabel Users -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="users-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Last Login</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function() {
    let table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('monitoring.users.data') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'last_login', name: 'last_login' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
        ],
        pageLength: 10
    });

    // Realtime refresh tiap 10 detik
    setInterval(function() {
        table.ajax.reload(null, false);
    }, 10000);
});
</script>
@endpush
