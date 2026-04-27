<!doctype html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vehículos | Gestión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}" />
</head>
@include('layouts.navbar')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">

        <main class="app-main">


            <div class="app-content">
                <div class="container-fluid">

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4 m-1">

                        @if(!$vehicles || count($vehicles) == 0)
                        <div class="col-12 text-center mt-5">
                            <h3 class="text-muted">No hay vehículos en esta categoría</h3>
                            <i class="bi bi-truck-flatbed display-1 text-secondary"></i>
                        </div>
                        @else
                        @foreach ($vehicles as $vehicle)
                        <div class="col">
                            <div class="card shadow h-100 border-0">
                                <img src="{{ $vehicle['image_url'] ?? asset('img/default-vehicle.png') }}"
                                    class="card-img-top"
                                    style="height: 200px; object-fit: cover;"
                                    alt="Imagen de {{ $vehicle['brand'] }}">

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold mb-3">
                                        {{ $vehicle['brand'] }}
                                        <span class="text-muted fw-light">{{ $vehicle['model'] }}</span>
                                    </h5>

                                    <ul class="list-unstyled small text-muted mb-4">
                                        <li><i class="bi bi-calendar-event me-2"></i><strong>Año:</strong> {{ $vehicle['year'] }}</li>
                                        <li><i class="bi bi-people me-2"></i><strong>Capacidad:</strong> {{ $vehicle['capacity'] }}</li>
                                        <li><i class="bi bi-speedometer2 me-2"></i><strong>Kilometraje:</strong> {{ $vehicle['current_mileage'] }} km</li>
                                    </ul>

                                    <div class="mt-auto">
                                        <a href="{{ route('driver.create', ['vehicle_id' => $vehicle['id']]) }}" class="btn btn-primary w-100">
                                            <i class="bi bi-bookmark-check me-1"></i> Reservar
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
</body>

</html>