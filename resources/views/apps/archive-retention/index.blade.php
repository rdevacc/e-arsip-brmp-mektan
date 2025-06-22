@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section archive-retention">
            <div class="pagetitle">
                <h1>Retensi Arsip</h1>
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
                            <a href="{{ route('archive-retention.create') }}" class="btn btn-primary w-100 w-md-auto">Tambah</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-primary">
                                <th>#</th>
                                <th>Nama Retensi Arsip</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ( $archiveRetentions as $archiveRetention )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $archiveRetention->range_value }} Tahun</td>
                                        <td class="d-flex">
                                            <a class="btn btn-warning mx-1" href="{{ route('archive-retention.edit', $archiveRetention->id) }}"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Edit Retensi Arsip">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('archive-retention.delete', $archiveRetention->id) }}" method="POST" class="form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-delete"
                                                    data-id="{{ $archiveRetention->id }}"
                                                    data-url="{{ route('archive-retention.delete', $archiveRetention->id) }}"
                                                    data-bs-toggle="tooltip"
                                                    title="Hapus Retensi Arsip">
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