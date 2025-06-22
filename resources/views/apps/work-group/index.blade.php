@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section quantity-unit">
            <div class="pagetitle">
                <h1>Kelompok Kerja</h1>
            </div>
             <!-- Session Alert -->
            @if (session('success'))
                <div class="alert alert-primary d-flex align-items-center justify-content-between" role="alert">
                    <div class="d-flex text-center align-middle">
                        {{ session('success') }}
                    </div>
                    <div class="justify-content-end">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <!-- Tombol Tambah di kiri -->
                    <div class="row my-2 d-flex">
                        <div class="col-md-auto mb-2">
                            <a href="{{ route('work-group.create') }}" class="btn btn-primary w-100 w-md-auto">Tambah</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <th>#</th>
                                <th>Nama Kelompok Kerja</th>
                                <th>Nama Unit Kerja</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ( $workGroups as $workGroup )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $workGroup->name }}</td>
                                        <td>{{ $workGroup->work_unit->name }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-warning mx-1" href="{{ route('work-group.edit', $workGroup->id) }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Edit Kelompok Kerja">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('work-group.delete', $workGroup->id) }}" method="POST" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete"
                                                    data-id="{{ $workGroup->id }}"
                                                    data-url="{{ route('work-group.delete', $workGroup->id) }}"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Kelompok Kerja">
                                                    <i class="bi bi-trash text-body-secondary"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection