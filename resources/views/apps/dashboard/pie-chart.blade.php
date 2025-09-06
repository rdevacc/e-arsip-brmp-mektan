<div class="row g-3">
    <div class="col-12 col-lg-4">
        <div class="card bg-slate">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Total Arsip
                </h5>
                <div class="d-flex justify-content-center text-center">
                    <div style="max-width: 1000px; margin: auto;">
                        <canvas id="archiveChart"></canvas>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row g-1">
                        <!-- Card 1 -->
                        <div class="col-12 col-lg-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <p class="fs-6 fs-lg-7">Dinamis</p>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="fs-6">{{ $dynamicArchivePercentage }} %</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-xl-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <p class="fs-6 fs-lg-7">Statis</p>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h6 class="fs-6">{{ $staticArchivePercentage }} %</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-12 col-xl-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <p class="fs-6 fs-lg-7">Permanen</p>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h6 class="fs-6">{{ $permanentArchivePercentage }} %</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="col-12 col-xl-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <p class="fs-6 fs-lg-7">Vital</p>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h6 class="fs-6">{{ $vitalArchivePercentage }} %</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card bg-slate">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Arsip Dinamis
                </h5>
                <div class="d-flex justify-content-center text-center">
                    <div style="max-width: 1000px; margin: auto;">
                        <canvas id="dynamicArchiveChart"></canvas>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center g-1">
                        <!-- Card 1 -->
                        <div class="col-12 col-lg-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <p class="fs-6 fs-lg-7">Aktif</p>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="fs-6">{{ $dynamicActivePercentage }} %</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-xl-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <p class="fs-6 fs-lg-7">Inaktif</p>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h6 class="fs-6">{{ $dynamicInactivePercentage }} %</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4">
        <div class="card bg-slate">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Arsip Statis
                </h5>
                <div class="d-flex justify-content-center text-center">
                    <div style="max-width: 1000px; margin: auto;">
                        <canvas id="staticArchiveChart"></canvas>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center g-1">
                        <!-- Card 1 -->
                        <div class="col-12 col-lg-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <div class="row">
                                        <p class="fs-6 fs-lg-7">Disimpan</p>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="fs-6">{{ $staticSavedPercentage }} %</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-xl-3">
                            <div class="card info-card total-archive-card">
                                <div class="card-body text-center">
                                    <p class="fs-6 fs-lg-7">Diserahkan</p>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <h6 class="fs-6">{{ $staticSubmittedPercentage }} %</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>