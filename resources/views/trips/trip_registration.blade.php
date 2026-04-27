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

                        <h3>Registrar viajes</h3>

                        <form action="{{ route('trips.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Vehículo Solicitado (ID)</label>
                                    <select name="vehicle_request_id" class="form-select" required>
                                        <option value="">Seleccione un vehículo</option>

                                        @foreach($vehicles as $vehicle)
                                        <option value="{{ $vehicle['id'] }}">
                                            {{ $vehicle['brand'] }} {{ $vehicle['model'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Ruta de Viaje</label>
                                    <select name="travel_route_id" class="form-select" required>
                                        @foreach($routes as $route)
                                        <option value="{{ $route['id'] }}">{{ $route['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>Fecha y Hora de Salida</label>
                                    <input type="datetime-local" name="departure_at" class="form-control" required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Observaciones Iniciales</label>
                                    <textarea name="observations" class="form-control" rows="3">{{ old('observations') }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Salida de Viaje</button>
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