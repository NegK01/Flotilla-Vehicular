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
                        <div class="card-body p-0">
                            <table class="table table-bordered table-hover text-center mb-0">
                                <thead class="table-dark">
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
                                        <td colspan="7" class="py-4 text-muted">No se encontraron viajes para los criterios seleccionados</td>
                                    </tr>
                                    @endif

                                    @foreach($trips as $trip)
                                    <tr>
                                        <td>{{ $trip['request_id'] }}</td>

                                        <td>
                                            {{ $trip['vehicle_brand'] ?? '' }}
                                            {{ $trip['vehicle_model'] ?? '' }}
                                        </td>

                                        <td>
                                            <span class="badge bg-secondary">
                                                {{-- Cambiado de 'vehicle.plate' a 'vehicle_plate' --}}
                                                {{ $trip['vehicle_plate'] ?? 'N/A' }}
                                            </span>
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse($trip['start_at'])->format('d/m/Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($trip['end_at'])->format('d/m/Y H:i') }}</td>

                                        <td>
                                            @if($trip['request_status'] == 'approved')
                                            <span class="badge bg-success">Aprobado</span>
                                            @elseif($trip['request_status'] == 'rejected')
                                            <span class="badge bg-danger">Rechazado</span>
                                            @elseif($trip['request_status'] == 'cancelled')
                                            <span class="badge bg-warning">Cancelado</span>
                                            @else
                                            <span class="badge bg-info">{{ $trip['request_status'] }}</span>
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