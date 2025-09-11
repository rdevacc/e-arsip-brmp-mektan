<div class="row g-3">
    <div class="col-12 col-lg-4">
        <div class="card bg-slate">
            <div class="card-body">
                <h5 class="card-title text-center">
                    Total Arsip
                </h5>
                <div class="chart-container d-flex justify-content-center pb-2">
                    <canvas id="chartBar1"></canvas>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center text-center">
                        <div class="col">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Dinamis</p>
                                <p class="fs-6 fs-lg-7">{{ $dynamicArchive }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Statis</p>
                                <p class="fs-6 fs-lg-7">{{ $staticArchive }}</p>
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
                <div class="chart-container d-flex justify-content-center pb-2">
                    <canvas id="chartBar2"></canvas>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center text-center">
                        <div class="col-12 col-lg-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Aktif</p>
                                <p class="fs-6 fs-lg-7">{{ $activeArchive }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Inaktif</p>
                                <p class="fs-6 fs-lg-7">{{ $inactiveArchive }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Permanen</p>
                                <p class="fs-6 fs-lg-7">{{ $permanentArchive }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Vital</p>
                                <p class="fs-6 fs-lg-7">{{ $vitalArchive }}</p>
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
                <div class="chart-container d-flex justify-content-center pb-2">
                    <canvas id="chartBar3"></canvas>
                </div>
                <div class="container-fluid">
                    <div class="row d-flex justify-content-center align-items-center text-center">
                        <div class="col">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Disimpan</p>
                                <p class="fs-6 fs-lg-7">{{ $savedStaticArchive }}</p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-center align-items-center">
                                <p class="fs-6 fs-lg-7 pe-1">Diserahkan</p>
                                <p class="fs-6 fs-lg-7">{{ $submittedStaticArchive }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>