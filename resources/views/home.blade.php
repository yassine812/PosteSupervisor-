@extends('layouts.app')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Visual Hierarchy: Premium Hero Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 text-white shadow-sm overflow-hidden" style="background: linear-gradient(135deg, #7367f0 0%, #a88beb 100%);">
                <div class="card-body p-4 p-md-5 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8 position-relative z-index-2">
                            <span class="badge bg-white text-primary mb-3 px-3 py-2 fw-semibold shadow-xs">POSTE ADMINISTRATION</span>
                            <h2 class="text-white fw-bold mb-2">Bienvenue, Administrateur ! 👋</h2>
                            <p class="text-white opacity-85 mb-4 max-w-md">
                                Vous êtes connecté au portail central de supervision. Suivez en temps réel l'évolution de vos collaborateurs et l'état opérationnel de vos serveurs et machines virtuelles.
                            </p>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('user') }}" class="btn btn-white text-primary shadow-sm fw-semibold">
                                    <i class="ti ti-users me-1"></i> Gérer les Fonctionnaires
                                </a>
                                <a href="{{ route('mv') }}" class="btn btn-label-white fw-semibold">
                                    <i class="ti ti-server me-1"></i> Gérer les VMs
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 text-center d-none d-md-block">
                            <!-- Premium Illustration Placeholder or Icon -->
                            <i class="ti ti-dashboard text-white opacity-20" style="font-size: 160px; line-height: 1;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enriched Stats Cards Grid -->
    <div class="row g-4 mb-4">
        <!-- Fonctionnaires Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card hover-card border-0 shadow-xs h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="d-block text-muted mb-1 fw-medium">Fonctionnaires</span>
                            <h3 class="card-title mb-1 fw-bold text-heading">{{ $usersCount }}</h3>
                            <span class="text-success small fw-semibold d-flex align-items-center">
                                <i class="ti ti-trending-up me-1"></i> +8% ce mois
                            </span>
                        </div>
                        <div class="avatar bg-label-primary rounded p-2">
                            <i class="ti ti-users ti-sm"></i>
                        </div>
                    </div>
                    <!-- Inline Sparkline -->
                    <div class="sparkline-container mt-2">
                        <svg class="w-100" height="40" viewBox="0 0 120 40" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="gradient-primary" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#7367f0" stop-opacity="0.3"></stop>
                                    <stop offset="100%" stop-color="#7367f0" stop-opacity="0.0"></stop>
                                </linearGradient>
                            </defs>
                            <path d="M0 35 Q15 25, 30 20 T60 15 T90 28 T120 10 L120 40 L0 40 Z" fill="url(#gradient-primary)"></path>
                            <path d="M0 35 Q15 25, 30 20 T60 15 T90 28 T120 10" fill="none" stroke="#7367f0" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total VMs Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card hover-card border-0 shadow-xs h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="d-block text-muted mb-1 fw-medium">Machines Virtuelles</span>
                            <h3 class="card-title mb-1 fw-bold text-heading">{{ $mvsCount }}</h3>
                            <span class="text-success small fw-semibold d-flex align-items-center">
                                <i class="ti ti-trending-up me-1"></i> +12% cette semaine
                            </span>
                        </div>
                        <div class="avatar bg-label-success rounded p-2">
                            <i class="ti ti-device-laptop ti-sm"></i>
                        </div>
                    </div>
                    <!-- Inline Sparkline -->
                    <div class="sparkline-container mt-2">
                        <svg class="w-100" height="40" viewBox="0 0 120 40" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="gradient-success" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#28c76f" stop-opacity="0.3"></stop>
                                    <stop offset="100%" stop-color="#28c76f" stop-opacity="0.0"></stop>
                                </linearGradient>
                            </defs>
                            <path d="M0 30 Q20 35, 40 20 T80 10 T120 5 L120 40 L0 40 Z" fill="url(#gradient-success)"></path>
                            <path d="M0 30 Q20 35, 40 20 T80 10 T120 5" fill="none" stroke="#28c76f" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active VMs Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card hover-card border-0 shadow-xs h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="d-block text-muted mb-1 fw-medium">VMs Actives</span>
                            <h3 class="card-title mb-1 fw-bold text-heading">{{ $activeMvsCount }}</h3>
                            <span class="text-muted small fw-medium">
                                En cours d'exécution
                            </span>
                        </div>
                        <div class="avatar bg-label-info rounded p-2">
                            <i class="ti ti-circle-check ti-sm"></i>
                        </div>
                    </div>
                    <!-- Inline Sparkline -->
                    <div class="sparkline-container mt-2">
                        <svg class="w-100" height="40" viewBox="0 0 120 40" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="gradient-info" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#00bad1" stop-opacity="0.3"></stop>
                                    <stop offset="100%" stop-color="#00bad1" stop-opacity="0.0"></stop>
                                </linearGradient>
                            </defs>
                            <path d="M0 25 Q15 28, 30 15 T60 12 T90 20 T120 15 L120 40 L0 40 Z" fill="url(#gradient-info)"></path>
                            <path d="M0 25 Q15 28, 30 15 T60 12 T90 20 T120 15" fill="none" stroke="#00bad1" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inactive VMs Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card hover-card border-0 shadow-xs h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="d-block text-muted mb-1 fw-medium">VMs Inactives</span>
                            <h3 class="card-title mb-1 fw-bold text-heading">{{ $inactiveMvsCount }}</h3>
                            <span class="text-muted small fw-medium">
                                Arrêtées ou suspendues
                            </span>
                        </div>
                        <div class="avatar bg-label-danger rounded p-2">
                            <i class="ti ti-circle-x ti-sm"></i>
                        </div>
                    </div>
                    <!-- Inline Sparkline -->
                    <div class="sparkline-container mt-2">
                        <svg class="w-100" height="40" viewBox="0 0 120 40" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="gradient-danger" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#ea5455" stop-opacity="0.3"></stop>
                                    <stop offset="100%" stop-color="#ea5455" stop-opacity="0.0"></stop>
                                </linearGradient>
                            </defs>
                            <path d="M0 15 Q20 20, 40 25 T80 32 T120 35 L120 40 L0 40 Z" fill="url(#gradient-danger)"></path>
                            <path d="M0 15 Q20 20, 40 25 T80 32 T120 35" fill="none" stroke="#ea5455" stroke-width="2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart: Activity and Evolution Graph -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap border-bottom">
                    <div>
                        <h5 class="card-title mb-1">Activité & Évolution du Parc</h5>
                        <p class="card-subtitle text-muted mb-0 small">Comparatif des ressources (6 derniers mois)</p>
                    </div>
                    <div class="dropdown mt-2 mt-md-0">
                        <button class="btn btn-label-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Semestre actuel
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:void(0);">Semestre actuel</a>
                            <a class="dropdown-item" href="javascript:void(0);">Année entière</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div id="dashboard-chart" style="min-height: 350px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.hover-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.08) !important;
}
.sparkline-container svg {
    border-radius: 4px;
}
.max-w-md {
    max-width: 480px;
}
.opacity-85 {
    opacity: 0.85;
}
</style>



@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    var options = {
        series: [{
            name: 'Fonctionnaires',
            data: [15, 18, 20, 22, 24, {{ $usersCount }}]
        }, {
            name: 'Machines Virtuelles',
            data: [10, 12, 14, 15, 18, {{ $mvsCount }}]
        }],
        chart: {
            height: 350,
            type: 'area',
            parentHeightOffset: 0,
            toolbar: {
                show: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        colors: ['#7367f0', '#28c76f'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [0, 100]
            }
        },
        grid: {
            borderColor: '#e7e7e7',
            xaxis: {
                lines: {
                    show: true
                }
            },
            yaxis: {
                lines: {
                    show: true
                }
            },
            padding: {
                top: -10,
                bottom: 5,
                left: 10,
                right: 10
            }
        },
        markers: {
            size: 5,
            strokeColors: '#fff',
            hover: {
                size: 7
            }
        },
        xaxis: {
            categories: ['Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil'],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                formatter: function (val) {
                    return val.toFixed(0);
                }
            }
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            offsetY: -10,
            markers: {
                width: 10,
                height: 10,
                radius: 12
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#dashboard-chart"), options);
    chart.render();

    // First Login Stepper Modal Trigger
    @if(auth()->user()->first_login)
    var setupModalEl = document.getElementById('setupModal');
    var setupModal = new bootstrap.Modal(setupModalEl, {
        backdrop: 'static',
        keyboard: false
    });
    setupModal.show();

    // Stepper Navigation Logic
    var currentStep = 1;
    var totalSteps = 3;

    var btnNext = document.getElementById('btn-next');
    var btnPrev = document.getElementById('btn-prev');
    var btnSubmit = document.getElementById('btn-submit');
    var btnSkip = document.getElementById('btn-skip-trigger');
    var skipForm = document.getElementById('skipForm');

    function updateStepView() {
        for (var i = 1; i <= totalSteps; i++) {
            var content = document.getElementById('step-content-' + i);
            var header = document.getElementById('step-header-' + i);
            var number = header.querySelector('.step-number');
            var title = header.querySelector('.step-title');

            if (i === currentStep) {
                content.classList.remove('d-none');
                header.classList.remove('text-muted');
                header.classList.add('active');
                number.className = 'step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-semibold';
                number.innerHTML = i;
                if (title) title.classList.add('text-primary', 'fw-bold');
            } else {
                content.classList.add('d-none');
                header.classList.remove('active');
                if (i < currentStep) {
                    header.classList.remove('text-muted');
                    number.className = 'step-number bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-semibold';
                    number.innerHTML = '<i class="ti ti-check ti-xs"></i>';
                    if (title) title.classList.remove('text-primary');
                } else {
                    header.classList.add('text-muted');
                    number.className = 'step-number bg-light text-muted rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-semibold';
                    number.innerHTML = i;
                    if (title) title.classList.remove('text-primary', 'fw-bold');
                }
            }
        }

        if (currentStep === 1) {
            btnPrev.classList.add('d-none');
            btnSkip.classList.remove('d-none');
        } else {
            btnPrev.classList.remove('d-none');
            btnSkip.classList.add('d-none');
        }

        if (currentStep === totalSteps) {
            btnNext.classList.add('d-none');
            btnSubmit.classList.remove('d-none');
        } else {
            btnNext.classList.remove('d-none');
            btnSubmit.classList.add('d-none');
        }
    }

    btnNext.addEventListener('click', function() {
        if (currentStep === 1) {
            var orgName = document.getElementById('organization_name');
            if (!orgName.value.trim()) {
                orgName.classList.add('is-invalid');
                return;
            } else {
                orgName.classList.remove('is-invalid');
            }
        }

        if (currentStep < totalSteps) {
            currentStep++;
            updateStepView();
        }
    });

    btnPrev.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateStepView();
        }
    });

    btnSkip.addEventListener('click', function(e) {
        e.preventDefault();
        skipForm.submit();
    });

    updateStepView();
    @endif
});
</script>
@endpush
