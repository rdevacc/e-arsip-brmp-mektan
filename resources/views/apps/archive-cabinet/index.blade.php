@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section quantity-unit">
            <div class="pagetitle">
                <h1>Lemari Arsip</h1>
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
                            <a href="{{ route('archive-cabinet.create') }}" class="btn btn-primary w-100 w-md-auto">Tambah</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="table-primary">
                            <th>#</th>
                            <th>Nama Lemari Arsip</th>
                            <th>Nama Gedung Arsip</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ( $archiveCabinets as $archiveCabinet )
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $archiveCabinet->name }}</td>
                                    <td>{{ $archiveCabinet->archive_building->name }}</td>
                                    <td class="d-flex">
                                        <a class="btn btn-warning mx-1" href="{{ route('archive-cabinet.edit', $archiveCabinet->id) }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Edit Lemari Arsip">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        <form action="{{ route('archive-cabinet.delete', $archiveCabinet->id) }}" method="POST" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-delete"
                                                data-id="{{ $archiveCabinet->id }}"
                                                data-url="{{ route('archive-cabinet.delete', $archiveCabinet->id) }}"
                                                data-bs-toggle="tooltip"
                                                title="Hapus Lemari Arsip">
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