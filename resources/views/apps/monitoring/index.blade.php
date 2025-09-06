@extends('layouts.app')

@section('content')
    <main id="main" class="main">
        <section class="section quantity-unit">
            <div class="pagetitle">
                <h1>Monitoring Pengunjung</h1>
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

            <!-- Statistik Pengunjung -->
            <div class="row mt-4 g-3">
                <!-- Total Pengunjung -->
                <div class="col-12 col-lg-6">
                    <div class="card info-card shadow-sm border-0 p-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Pengunjung</h5>
                            <h2 id="total-visitors" class="fw-bold text-primary mb-0">0</h2>
                        </div>
                    </div>
                </div>

                <!-- Pengunjung Hari Ini -->
                <div class="col-12 col-lg-6">
                    <div class="card info-card shadow-sm border-0 p-3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pengunjung Hari Ini</h5>
                            <h2 id="today-visitors" class="fw-bold text-success mb-0">0</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    // === Tracking otomatis setiap user akses halaman ===
    $.post("{{ route('visitor.track') }}", {_token: "{{ csrf_token() }}"});

    // === Fungsi ambil data pengunjung ===
    function loadVisitors() {
        $.get("{{ route('visitor.count') }}", function(data) {
            $('#total-visitors').text(data.total);
        });

        $.get("{{ route('visitor.today') }}", function(data) {
            $('#today-visitors').text(data.today);
        });
    }

    // Panggil pertama kali
    loadVisitors();

    // Update setiap 5 detik
    setInterval(loadVisitors, 5000);
});
</script>
@endpush
