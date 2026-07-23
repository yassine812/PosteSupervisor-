<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template-no-customizer">
  <head>
    <meta charset="utf-8" />
    <script>
      (function() {
        let isDark = localStorage.getItem('dark-mode') === 'true';
        let htmlEl = document.querySelector('html');
        if (isDark) {
          htmlEl.classList.remove('light-style');
          htmlEl.classList.add('dark-style');
          document.write('<style id="temp-dark-mode-style">body { display: none !important; }</style>');
          
          document.addEventListener('DOMContentLoaded', function() {
            let coreLink = document.querySelector('link[href*="core.css"]');
            let themeLink = document.querySelector('link[href*="theme-default.css"]');
            if (coreLink) coreLink.setAttribute('href', coreLink.getAttribute('href').replace('core.css', 'core-dark.css'));
            if (themeLink) themeLink.setAttribute('href', themeLink.getAttribute('href').replace('theme-default.css', 'theme-default-dark.css'));
            let tempStyle = document.getElementById('temp-dark-mode-style');
            if (tempStyle) tempStyle.remove();
          });
        }
      })();
    </script>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Tableau de bord - Poste Tunisienne</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-poste-tunisienne.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/swiper/swiper.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/cards-advance.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    @if (session('status2'))
    <div class="alert alert-success">{{ session('status2') }}</div>
    @endif


    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{ route('home') }}" class="app-brand-link">
              <span class="app-brand-logo demo" style="height: auto;">
                <img src="{{ asset('assets/img/logo-poste-tunisienne.png') }}" alt="Logo" style="height: 38px; width: auto; object-fit: contain;" />
              </span>
              <span class="app-brand-text demo menu-text fw-bold ms-2" style="font-size: 1.1rem; text-transform: uppercase; letter-spacing: 0.5px;">Poste</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <ul class="menu-inner py-1">
              <li class="menu-item {{ Route::current()->getName() == 'home' ? 'active' : '' }}">
                  <a href="{{ route('home') }}" class="menu-link">
                      <i class="menu-icon tf-icons ti ti-layout- ti-smart-home"></i>
                      <div data-i18n="Tableau de bord">Tableau de bord</div>
                  </a>
              </li>
              <li class="menu-item {{ in_array(Route::current()->getName(), ['user', 'users.create', 'user.edit']) ? 'active' : '' }}"
                >
                  <a href="{{ route('user') }}" class="menu-link">
                      <i class="menu-icon tf-icons ti ti-users"></i>
                      <div data-i18n="Gestion des Fonctionnaires">Gestion des Fonctionnaires</div>
                  </a>
              </li>
              <li class="menu-item {{ in_array(Route::current()->getName(), ['mv','mvs.form', 'mv.editvm']) ? 'active' : '' }}"
                >
                  <a href="{{ route('mv') }}" class="menu-link">
                      <i class="menu-icon tf-icons ti ti-server"></i>
                      <div data-i18n="Gestion des machines virtuelles">Gestion des machines virtuelles</div>
                  </a>
              </li>
          </ul>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item navbar-search-wrapper mb-0">
                  <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                    <i class="ti ti-search ti-md me-2"></i>
                    <span class="d-none d-md-inline-block text-muted">Rechercher (Ctrl+/)</span>
                  </a>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->

                <!--/ Language -->

                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->

                <!-- Quick links  -->

                <!-- Quick links -->

                <!-- Notification -->
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="ti ti-bell ti-md"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notifications</h5>
                        <span class="badge bg-label-primary">0 Nouvelles</span>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex py-4 align-items-center justify-content-center text-muted">
                            <i class="ti ti-bell-off me-2 fs-4"></i> Aucune nouvelle notification
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                      <a
                        href="javascript:void(0);"
                        class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                        Voir toutes les notifications
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      @if(auth()->user()->profile_photo_path)
                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt class="h-auto rounded-circle" style="aspect-ratio: 1; object-fit: cover;" />
                      @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=7367F0&color=fff" alt class="h-auto rounded-circle" />
                      @endif
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="pages-account-settings-account.html">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              @if(auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt class="h-auto rounded-circle" style="aspect-ratio: 1; object-fit: cover;" />
                              @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->firstname . ' ' . auth()->user()->lastname) }}&background=7367F0&color=fff" alt class="h-auto rounded-circle" />
                              @endif
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
                            <small class="text-muted">Administrateur</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('user.admin', ['id' => auth()->user()->id]) }}">

                                                    <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">Mon Profil</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a href="{{ route('logout') }}" class="dropdown-item">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Se déconnecter</span>
                    </a>


                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..." />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl mt-4 mb-0">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-circle-check me-2"></i>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('status1'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-circle-check me-2"></i>
                        {{ session('status1') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('status2'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-circle-check me-2"></i>
                        {{ session('status2') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('update'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="ti ti-circle-check me-2"></i>
                        {{ session('update') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="ti ti-alert-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

            @yield('content')
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank" class="fw-semibold">Pixinvent</a>
                  </div>
                  <div>
                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4" target="_blank"
                      >License</a
                    >
                    <a href="https://1.envato.market/pixinvent_portfolio" target="_blank" class="footer-link me-4"
                      >More Themes</a
                    >

                    <a
                      href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                      target="_blank"
                      class="footer-link me-4"
                      >Documentation</a
                    >

                    <a href="https://pixinvent.ticksy.com/" target="_blank" class="footer-link d-none d-sm-inline-block"
                      >Support</a
                    >
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    @if(auth()->check() && auth()->user()->first_login)
    <!-- Setup Configuration Modal (First Login) -->
    <div class="modal fade" id="setupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="setupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white p-4">
                    <h5 class="modal-title text-white fw-bold d-flex align-items-center" id="setupModalLabel">
                        <i class="ti ti-settings-automation me-2 fs-3"></i> Configuration de la Plateforme
                    </h5>
                </div>
                <div class="modal-body p-4 p-md-5 text-dark">
                    <!-- Stepper Progress Header -->
                    <div class="d-flex justify-content-between mb-4 border-bottom pb-3">
                        <div class="stepper-step active" id="step-header-1">
                            <span class="step-number bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-semibold" style="width: 32px; height: 32px;">1</span>
                            <span class="step-title fw-bold text-primary">Organisation</span>
                        </div>
                        <div class="stepper-step text-muted" id="step-header-2">
                            <span class="step-number bg-light text-muted rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-semibold" style="width: 32px; height: 32px;">2</span>
                            <span class="step-title fw-bold">Préférences</span>
                        </div>
                        <div class="stepper-step text-muted" id="step-header-3">
                            <span class="step-number bg-light text-muted rounded-circle d-inline-flex align-items-center justify-content-center me-2 fw-semibold" style="width: 32px; height: 32px;">3</span>
                            <span class="step-title fw-bold">Terminer</span>
                        </div>
                    </div>

                    <!-- Setup Form -->
                    <form action="{{ route('setup.save') }}" method="POST" enctype="multipart/form-data" id="setupForm">
                        @csrf
                        
                        <!-- Step 1 Content -->
                        <div class="step-content" id="step-content-1">
                            <h4 class="fw-bold mb-3">Informations de l'Organisation</h4>
                            <p class="text-muted small mb-4">Veuillez renseigner le nom et le logo de votre organisation pour personnaliser le dashboard.</p>
                            
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold" for="organization_name">Nom de l'organisation <span class="text-danger">*</span></label>
                                <input type="text" class="form-control text-dark bg-white" id="organization_name" name="organization_name" placeholder="Ex: Poste Tunisienne" required />
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold" for="organization_logo">Logo de l'organisation</label>
                                <input type="file" class="form-control text-dark bg-white" id="organization_logo" name="organization_logo" accept="image/*" />
                                <div class="form-text">Format accepté : JPG/PNG. Taille max : 1Mo.</div>
                            </div>
                        </div>

                        <!-- Step 2 Content -->
                        <div class="step-content d-none" id="step-content-2">
                            <h4 class="fw-bold mb-3">Préférences Régionales</h4>
                            <p class="text-muted small mb-4">Définissez vos préférences régionales par défaut.</p>
                            
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold" for="timezone">Fuseau Horaire</label>
                                <select class="form-select text-dark bg-white" id="timezone" name="timezone">
                                    <option value="Africa/Tunis" selected>Africa/Tunis (UTC+1)</option>
                                    <option value="Africa/Casablanca">Africa/Casablanca (UTC+1)</option>
                                    <option value="Europe/Paris">Europe/Paris (UTC+2)</option>
                                    <option value="UTC">Universal Coordinated Time (UTC)</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label text-dark fw-semibold" for="language">Langue par défaut</label>
                                <select class="form-select text-dark bg-white" id="language" name="language">
                                    <option value="fr" selected>Français</option>
                                    <option value="en">English</option>
                                    <option value="ar">العربية (Arabe)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Step 3 Content -->
                        <div class="step-content d-none" id="step-content-3">
                            <h4 class="fw-bold mb-3 text-success d-flex align-items-center">
                                <i class="ti ti-circle-check-filled me-2 fs-3"></i> Prêt à démarrer !
                            </h4>
                            <p class="text-muted mb-4">Votre configuration initiale est complétée. Nous avons également pré-rempli la base de données avec des fonctionnaires et des machines virtuelles réalistes pour vous aider à démarrer rapidement.</p>
                            
                            <div class="alert alert-label-info d-flex align-items-center mb-0">
                                <i class="ti ti-info-circle me-2 fs-4"></i>
                                <div>Vous pourrez à tout moment modifier ces préférences depuis les paramètres de votre compte.</div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="d-flex justify-content-between align-items-center mt-5 pt-3 border-top">
                            <div>
                                <button type="button" class="btn btn-label-secondary d-none" id="btn-prev">Précédent</button>
                                <button type="button" class="btn btn-link text-muted p-0" id="btn-skip-trigger">Passer pour l'instant</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary" id="btn-next">Suivant <i class="ti ti-arrow-right ms-1"></i></button>
                                <button type="submit" class="btn btn-success d-none" id="btn-submit">Valider et Entrer <i class="ti ti-check ms-1"></i></button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Hidden Skip Form -->
                    <form action="{{ route('setup.skip') }}" method="POST" id="skipForm" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../../assets/vendor/libs/swiper/swiper.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/dashboards-analytics.js"></script>
    @stack('scripts')
  </body>
</html>
