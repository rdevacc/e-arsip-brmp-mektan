@auth
    <div class="d-flex justify-content-center align-items-center">
        <a class="btn btn-info" href="{{ route('archive-show', $archive->id) }}"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-custom-class="custom-tooltip"
            data-bs-title="Lihat Detail">
            <i class="bi bi-eye"></i>
        </a>
        @canany(['super-admin', 'edit-archive'], $archive)  
            <a class="btn btn-warning mx-1" href="{{ route('archive-edit', $archive->id) }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title="Edit Arsip">
                <i class="bi bi-pencil"></i>
            </a>
            <a class="btn btn-dark mx-1 btn-upload-file"
                href="#"
                data-archive-id="{{ $archive->id }}"
                data-upload-url="{{ route('archive-upload', $archive->id) }}"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                data-bs-custom-class="custom-tooltip"
                data-bs-title="Upload File">
                <i class="bi bi-upload"></i>
            </a>
        @endcanany
        @can('super-admin')
        <form action="{{ route('archive-delete', $archive->id) }}" method="POST" class="form-delete">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-delete"
                data-id="{{ $archive->id }}"
                data-url="{{ route('archive-delete', $archive->id) }}"
                data-bs-toggle="tooltip"
                title="Hapus Arsip">
                <i class="bi bi-trash text-body-secondary"></i>
            </button>
        </form>
        @endcan
    </div>
@endauth
