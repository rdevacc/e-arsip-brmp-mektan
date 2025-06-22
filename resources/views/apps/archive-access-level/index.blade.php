@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section archive-access-level">
            <div class="pagetitle">
                <h1>Level Akses Arsip</h1>
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
                            <a href="{{ route('archive-access-level.create') }}" class="btn btn-primary w-100 w-md-auto">Tambah</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <th>#</th>
                                <th>Nama Level Akses</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ( $archiveAccessLevels as $acl )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $acl->name }}</td>
                                        <td class="d-flex">
                                            <a class="btn btn-warning mx-1" href="{{ route('archive-access-level.edit', $acl->id) }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Edit Level Akses">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('archive-access-level.delete', $acl->id) }}" method="POST" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete"
                                                    data-id="{{ $acl->id }}"
                                                    data-url="{{ route('archive-access-level.delete', $acl->id) }}"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Level Akses">
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