@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" />

<style>
    .custom-dropzone {
        border: 3px dashed #8cbfd4;
        background-color: #f9fcfd;
        padding: 80px 20px;
        text-align: center;
        border-radius: 10px;
        transition: border-color 0.3s ease, background-color 0.3s ease;
        cursor: pointer;
        position: relative;
    }

    .custom-dropzone:hover {
        border-color: #4ea0c9;
        background-color: #f1f7fa;
    }

    .dz-message {
        font-size: 18px;
        color: #6c757d;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        pointer-events: none;
    }

    .dz-message i {
        font-size: 48px;
        color: #4ea0c9;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<main id="main" class="main">
    <section class="section">
        <div class="pagetitle">
            <h1>Upload Arsip</h1>
        </div>

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

        <div class="card p-4">
            <form action="{{ route('import-excel.upload') }}" class="dropzone custom-dropzone" enctype="multipart/form-data">
                @csrf
                <div class="dz-message">
                    <i class="bi bi-cloud-upload"></i>
                    <div>
                        <strong>Klik atau tarik file ke sini</strong><br>
                        <small>Hanya file .xlsx, .csv, atau .xls yang diperbolehkan.</small>
                    </div>
                </div>
            </form>

            <div class="mt-3 text-center d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-primary" id="btnUpload" disabled>
                    Upload Sekarang
                </button>
                <button type="button" class="btn btn-secondary" id="btnRemove" disabled>
                    Hapus File
                </button>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

    <script>
        Dropzone.autoDiscover = false;

        const myDropzone = new Dropzone(".custom-dropzone", {
            url: "{{ route('import-excel.upload') }}",
            paramName: "file",
            maxFilesize: 1,
            acceptedFiles: ".csv,.xlsx,.xls",
            dictDefaultMessage: "Klik atau tarik file ke sini",
            timeout: 50000,
            autoProcessQueue: false,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            init: function () {
                const btnUpload = document.getElementById('btnUpload');
                const btnRemove = document.getElementById('btnRemove');

                this.on("addedfile", function () {
                    btnUpload.disabled = false;
                    btnRemove.disabled = false;
                });

                this.on("removedfile", function () {
                    if (this.files.length === 0) {
                        btnUpload.disabled = true;
                        btnRemove.disabled = true;
                    }
                });

                btnUpload.addEventListener('click', () => {
                    if (this.files.length > 0) {
                        Swal.fire({
                            title: 'Mohon Tunggu',
                            text: 'File sedang diproses...',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        this.processQueue();
                    }
                });

                btnRemove.addEventListener('click', () => {
                    this.removeAllFiles(true);
                });

                this.on("success", function (file, response) {
                    console.log(response);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'File berhasil diupload dan diproses!',
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                });

                this.on("error", function (file, response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat upload. Pastikan file sesuai format!',
                    });
                });
            }
        });
    </script>

@endpush
