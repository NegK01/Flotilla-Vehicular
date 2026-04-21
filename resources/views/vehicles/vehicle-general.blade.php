<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vehiculos</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="{{ asset('css/adminlte.css') }}" as="style" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        crossorigin="anonymous" media="print" onload="this.media = 'all'" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
</head>
<!--end::Head-->

<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('layouts.navbar')
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('layouts.sidebar')
        <!--end::Sidebar-->

        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Lista de Vehiculos</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <a href="{{ route('vehicles.create') }}" class="btn btn-success m-3">Nuevo vehiculo</a>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">

                    <!--begin::Users List-->

                    <!-- Propiedades de las tablas (por si se ocupan)
                        table-striped → filas alternadas (rayas)
                        table-bordered → bordes en toda la tabla
                        table-borderless → sin bordes
                        table-hover → efecto hover en filas
                        table-sm → tabla más compacta-->


                    <div class="row text-center">
                        <div class="row">
                            @foreach ($vehicles as $vehicle)
                            <div class="col-md-4 col-lg-4">
                                <div class="card shadow h-100">
                                    <img src="{{ asset($vehicle['image_path']) }}" 
                                     class="card-img-top img-personalized img-fluid"
                                     style="height: 350px; object-fit: cover;">

                                    <div class="card-body d-flex flex-column gap-2">
                                        <h5 class="card-title mb-2">
                                            {{ $vehicle['brand'] }}
                                            <span class="text-muted">{{ $vehicle['model'] }}</span>
                                        </h5>

                                        <div class="d-flex flex-column small text-muted gap-1">
                                            <span><strong>Año:</strong> {{ $vehicle['year'] }}</span>
                                            <span><strong>Capacidad:</strong> {{ $vehicle['capacity'] }}</span>
                                            <span><strong>Kilometraje:</strong> {{ $vehicle['current_mileage'] }}</span>
                                        </div>

                                    </div>

                                    <div class="card-footer d-flex justify-content-end">
                                        <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Editar</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>


                    <!--end::Users List-->
                </div>
            </div>
            <!--end::App Content-->

            <!--end::App Main-->

            <!--begin::Footer-->

            <!--end::Footer-->

        </main>

        @include('layouts.footer')

    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/adminlte.js') }}"></script>

    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };

        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            const isMobile = window.innerWidth <= 992;

            if (
                sidebarWrapper &&
                OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
                !isMobile
            ) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::Script-->
</body>
<!--end::Body-->

</html>