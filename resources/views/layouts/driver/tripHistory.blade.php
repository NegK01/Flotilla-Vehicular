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


<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <!--end::Sidebar-->
    <div class="app-wrapper">
        @include('layouts.navbar')
        <!--begin::Sidebar-->
        @include('layouts.sidebar')
        <main class="app-main">


            <div class="app-content">
                <div class="container-fluid">

                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('driver.historial') }}" method="GET" class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <label for="user_id" class="form-label fw-bold">Seleccionar Usuario</label>
                                    <select name="user_id" id="user_id" class="form-select">
                                        <option value="" selected disabled>Seleccione un chofer...</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user['id'] }}">
                                            {{ $user['full_name'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="start_date" class="form-label fw-bold">Fecha Inicio</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>

                                <div class="col-md-3">
                                    <label for="end_date" class="form-label fw-bold">Fecha Final</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>

                                <div class="col-md-2">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search"></i> Filtrar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h3 class="card-title">Historial Detallado de Viajes</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center mb-0">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Vehículo / Placa</th>
                                            <th>Ruta (Origen - Destino)</th>
                                            <th>Salida - Regreso</th>
                                            <th>KM (Inicio/Fin)</th>
                                            <th>Total KM</th>
                                            <th>Estado / Observación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trips as $trip)
                                        <tr>
                                            <td>{{ $trip['trip_id'] ?? $trip['request_id'] }}</td>

                                            <td>
                                                <div class="fw-bold">{{ $trip['vehicle_brand'] }} {{ $trip['vehicle_model'] }}</div>
                                                <span class="badge bg-secondary">{{ $trip['vehicle_plate'] }}</span>
                                            </td>

                                            <td>
                                                @if(isset($trip['route_name']))
                                                <strong>{{ $trip['route_name'] }}</strong><br>
                                                <small class="text-muted">{{ $trip['route_start_point'] }} → {{ $trip['route_end_point'] }}</small>
                                                @else
                                                <span class="text-muted">N/A</span>
                                                @endif
                                            </td>

                                            <td class="small">
                                                <i class="bi bi-calendar-check"></i> {{ \Carbon\Carbon::parse($trip['departure_at'] ?? $trip['start_at'])->format('d/m/Y H:i') }}<br>
                                                <i class="bi bi-calendar-x"></i> {{ \Carbon\Carbon::parse($trip['return_at'] ?? $trip['end_at'])->format('d/m/Y H:i') }}
                                            </td>

                                            <td>
                                                <small>Ini: {{ $trip['departure_mileage'] ?? '0' }}</small><br>
                                                <small>Fin: {{ $trip['return_mileage'] ?? '-' }}</small>
                                            </td>

                                            <td>
                                                <span class="badge bg-primary fs-6">
                                                    {{ $trip['km_driven'] ?? '0' }} KM
                                                </span>
                                            </td>

                                            <td>
                                                @if(($trip['request_status'] ?? '') == 'approved')
                                                <span class="badge bg-success">Aprobado</span>
                                                @elseif(($trip['request_status'] ?? '') == 'rejected')
                                                <span class="badge bg-danger">Rechazado</span>
                                                @else
                                                <span class="badge bg-info">Completado</span>
                                                @endif
                                                <br>
                                                <small class="text-muted d-block mt-1">
                                                    {{ $trip['observations'] ?? $trip['observation'] ?? 'Sin obs.' }}
                                                </small>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="py-4 text-muted">No se encontraron registros detallados para este chofer</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
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