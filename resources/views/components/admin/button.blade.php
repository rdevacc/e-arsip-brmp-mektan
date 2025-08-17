<div class="d-flex justify-content-end align-items-center">
    <a class="btn btn-info" href="{{ route('archive-show', $archive->id) }}"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        data-bs-custom-class="custom-tooltip"
        data-bs-title="Lihat Detail">
        <i class="bi bi-eye"></i>
    </a>
    {{-- @canany(['update-kegiatan'], $archive) --}}
    <a class="btn btn-warning mx-1" href="{{ route('archive-edit', $archive->id) }}"
        data-bs-toggle="tooltip"
        data-bs-placement="top"
        data-bs-custom-class="custom-tooltip"
        data-bs-title="Edit Arsip">
        <i class="bi bi-pencil"></i>
    </a>
    {{-- @endcan
    @canany(['delete-kegiatan'], $archive) --}}
    {{-- <form action="{{ route('archive-delete', $archive->id) }}" method="POST" class="form-delete">
        @csrf
        @method('delete')
        <button class="btn btn-danger btn-delete"
            onclick="return confirm('Apakah anda ingin menghapus arsip?')"
            data-bs-toggle="tooltip"
            data-bs-placement="top"
            data-bs-custom-class="custom-tooltip"
            data-bs-title="Hapus Arsip" >
            <i class="bi bi-trash text-body-secondary"></i>
        </button>
    </form> --}}
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
    {{-- @endcanany --}}
</div>
