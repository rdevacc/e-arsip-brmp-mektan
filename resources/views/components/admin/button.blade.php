<div class="d-flex">
    {{-- <a class="btn btn-info" href="{{ route('archive-show', $archive->id) }}" data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-custom-class="custom-tooltip" data-bs-title="Lihat Detail">
        <i class="bi bi-eye"></i>
    </a> --}}
    {{-- @canany(['update-kegiatan'], $archive) --}}
    <a class="btn btn-warning mx-1" href="{{ route('archive-edit', $archive->id) }}" data-bs-toggle="tooltip"
        data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Edit Arsip">
        <i class="bi bi-pencil"></i>
    </a>
    {{-- @endcan
    @canany(['delete-kegiatan'], $archive) --}}
    <form action="{{ route('archive-delete', $archive->id) }}" method="POST">
        @method('delete')
        @csrf
        <button class="btn btn-danger"
            onclick="return confirm('Apakah anda ingin menghapus arsip?')"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
            data-bs-title="Hapus Arsip" >
            <i class="bi bi-trash text-body-secondary"></i>
        </button>
    </form>
    {{-- @endcanany --}}
</div>
