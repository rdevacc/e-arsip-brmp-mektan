@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tambah Data Folder Arsip</h5>

                             @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="pb-4">
                                    <div
                                        class="flex w-1/2 bg-green-800 rounded-md p-2 mx-auto text-center justify-center items-center">
                                        <span class="text-slate-100 align-middle">{{ session('success') }}</span>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('archive-folder.create-submit') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="archive_storage_location_id" class="form-label">Lokasi Penyimpanan Arsip <span class="text-danger">*</span></label>
                                        <select name="archive_storage_location_id" id="archive_storage_location_id"
                                            class="form-select @error('archive_storage_location_id') is-invalid @enderror">
                                            <option selected disabled>Pilih Lokasi Penyimpanan Arsip</option>
                                            @foreach ($archiveStorageLocations as $archiveStorageLocation)
                                                <option value="{{ $archiveStorageLocation->id }}" @selected(old('archive_storage_location_id') == $archiveStorageLocation->id)>
                                                    {{ $archiveStorageLocation->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('archive_storage_location_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="name" class="form-label">Nama Folder Arsip <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') ?: '' }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="mt-5 mb-2 me-2 text-end">
                                    <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('archive-folder.index') }}'">Kembali</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection