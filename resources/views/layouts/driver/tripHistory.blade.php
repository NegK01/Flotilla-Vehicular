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

            <div class="col-lg-6 m-2">
                <div class="card card-outline card-primary h-100 mb-3 ">
                    <div class="card-header">
                        <h3 class="card-title">Accesos rápidos</h3>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <a href="{{ route('users.create') }}" class="btn btn-primary w-100 py-2">
                                    <i class="bi bi-person-plus-fill me-2 "></i>
                                    Historial viajes
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('vehicles.index') }}" class="btn btn-success w-100 py-2">
                                    <i class="bi bi-lightning-fill me-2"></i>
                                    Registrar vehiculo
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="" class="btn btn-primary w-100 py-2">
                                    <i class="bi bi-shuffle me-2 "></i>
                                    Registrar ruta
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="app-content">
                <div class="container-fluid">

                    <table class="table table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vehículo</th>
                                <th>Placa</th>
                                <th>Inicio</th>
                                <th>Fin</th>
                                <th>Estado</th>
                                <th>Observación</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(empty($trips))
                            <tr>
                                <td colspan="7">No hay registros en el historial de viajes</td>
                            </tr>
                            @endif

                            @foreach($trips as $trip)
                            <tr>
                                <td>{{ $trip['id'] }}</td>

                                <td>
                                    {{ $trip['vehicle']['brand'] ?? '' }}
                                    {{ $trip['vehicle']['model'] ?? '' }}
                                    ({{ $trip['vehicle']['year'] ?? '' }})
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $trip['vehicle']['plate'] ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>{{ \Carbon\Carbon::parse($trip['start_at'])->format('d/m/Y H:i') }}</td>

                                <td>{{ \Carbon\Carbon::parse($trip['end_at'])->format('d/m/Y H:i') }}</td>

                                <td>
                                    @if($trip['status'] == 'approved')
                                    <span class="badge bg-success">Completado</span>
                                    @elseif($trip['status'] == 'rejected')
                                    <span class="badge bg-danger">Rechazado</span>
                                    @elseif($trip['status'] == 'cancelled')
                                    <span class="badge bg-warning">Cancelado</span>
                                    @else
                                    <span class="badge bg-info">{{ $trip['status'] }}</span>
                                    @endif
                                </td>

                                <td>
                                    <small class="text-muted">
                                        {{ $trip['observation'] ?? 'Sin observaciones' }}
                                    </small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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