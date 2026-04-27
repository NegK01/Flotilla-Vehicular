<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Viaje</title>

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
                            <h3 class="mb-0">Viajes</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Viajes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row text-center">

                        <h3>Editar viajes</h3>

                        <form action="{{ route('trips.update', $trip['id'] ?? $trip['request_id']) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Actualizar / Finalizar Viaje</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">


                                        <input type="hidden" name="travel_route_id" class="form-control" value="{{ $trip['travel_route_id'] }}">


                                        <div class="col-md-12 mb-3">
                                            <label>Fecha Salida</label>
                                            <input type="datetime-local" name="departure_at" class="form-control"
                                                value="{{ $trip['departure_at'] ? date('Y-m-d\TH:i', strtotime($trip['departure_at'])) : '' }}">
                                        </div>

                                        <hr>
                                        <h5>Datos de Retorno (Cierre de Viaje)</h5>

                                        <div class="col-md-6 mb-3">
                                            <label>Fecha y Hora de Regreso</label>
                                            <input type="datetime-local" name="return_at" class="form-control"
                                                value="{{ $trip['return_at'] ? date('Y-m-d\TH:i', strtotime($trip['return_at'])) : '' }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Kilometraje de Regreso</label>
                                            <input type="number" name="return_mileage" class="form-control"
                                                value="{{ $trip['return_mileage'] }}" placeholder="Debe ser >= {{ $trip['departure_mileage'] }}">
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Observaciones Finales</label>
                                            <textarea name="observations" class="form-control">{{ $trip['observations'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    <a href="{{ route('trips.index') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </form>


                        <!--end::Users List-->
                    </div>

                </div>
                <!--begin::Users List-->

                <!-- Propiedades de las tablas (por si se ocupan)
                        table-striped → filas alternadas (rayas)
                        table-bordered → bordes en toda la tabla
                        table-borderless → sin bordes
                        table-hover → efecto hover en filas
                        table-sm → tabla más compacta-->
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