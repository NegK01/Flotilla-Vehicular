<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Vista General</title>

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

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('layouts.navbar')
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('layouts.sidebar')
        <!--end::Sidebar-->
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <div class="card card-info card-outline shadow">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="bi bi-map-fill me-2"></i> Registrar Nueva Ruta
                            </h3>
                        </div>

                        <form action="{{ route('road.store') }}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="mb-3">
                                    <label for="name" class="form-label fw-bold">Nombre del Viaje</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_point" class="form-label fw-bold">Punto de Partida</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                                            <input type="text" name="start_point" id="start_point"
                                                class="form-control @error('start_point') is-invalid @enderror"
                                                required>
                                        </div>
                                        @error('start_point')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="end_point" class="form-label fw-bold">Punto de Destino</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                            <input type="text" name="end_point" id="end_point"
                                                class="form-control @error('end_point') is-invalid @enderror"
                                                required>
                                        </div>
                                        @error('end_point')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="estimated_distance" class="form-label fw-bold">Distancia Estimada (KM)</label>
                                    <input type="number" step="0.01" name="estimated_distance" id="estimated_distance"
                                        class="form-control @error('estimated_distance') is-invalid @enderror"
                                        required>
                                    @error('estimated_distance')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label fw-bold">Descripción / Notas de Seguridad</label>
                                    <textarea name="description" id="description" rows="3"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Detalles adicionales o advertencias..."></textarea>

                                    @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    Volver
                                </a>
                                <button type="submit" class="btn btn-info text-white">
                                    <i class="bi bi-plus-circle me-1"></i> Guardar Ruta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>