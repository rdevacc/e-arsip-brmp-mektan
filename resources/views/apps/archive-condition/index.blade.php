@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section archive-condition">
            <div class="pagetitle">
                <h1>Kondisi Arsip</h1>
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
                            <a href="{{ route('archive-condition.create') }}" class="btn btn-primary w-100 w-md-auto">Tambah</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="table-primary">
                            <th>#</th>
                            <th>Nama Kondisi Arsip</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ( $ArchiveConditions as $condition )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $condition->name }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-warning mx-1" href="{{ route('archive-condition.edit', $condition->id) }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Edit Kondisi Arsip">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('archive-condition.delete', $condition->id) }}" method="POST" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-delete"
                                                data-id="{{ $condition->id }}"
                                                data-url="{{ route('archive-condition.delete', $condition->id) }}"
                                                data-bs-toggle="tooltip"
                                                title="Hapus Kondisi Arsip">
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
        </section>
    </main>
@endsection