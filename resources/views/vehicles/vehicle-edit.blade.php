<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Editar Vehículo</title>

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
    <div class="app-wrapper">

        @include('layouts.navbar')
        @include('layouts.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Editar vehículo</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('vehicles.index') }}">Vehículos</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Editar</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Actualizar vehículo</div>
                        </div>

                        <form action="{{ route('vehicles.update', $vehicle['id']) }}"
                            class="needs-validation p-2"
                            enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Placa</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="plate"
                                            value="{{ old('plate', $vehicle['plate']) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Marca</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="brand"
                                            value="{{ old('brand', $vehicle['brand']) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Modelo</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="model"
                                            value="{{ old('model', $vehicle['model']) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Año</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="year"
                                            value="{{ old('year', $vehicle['year']) }}"
                                            required
                                            min="2000"
                                            max="2027">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Tipo de vehículo</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="vehicle_type"
                                            value="{{ old('vehicle_type', $vehicle['vehicle_type']) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Capacidad</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="capacity"
                                            value="{{ old('capacity', $vehicle['capacity']) }}"
                                            min="1"
                                            max="20"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Tipo de combustible</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="fuel_type"
                                            value="{{ old('fuel_type', $vehicle['fuel_type']) }}"
                                            required>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Imagen del vehículo</label>
                                        <input
                                            type="file"
                                            class="form-control"
                                            name="image_path">

                                        @if (!empty($vehicle['image_path']))
                                        <div class="mt-2">
                                            <small class="text-muted">Imagen actual:</small>
                                            <br>
                                            <img src="{{ asset($vehicle['image_path']) }}"
                                                alt="Imagen del vehículo"
                                                class="img-thumbnail mt-1"
                                                style="max-width: 180px; height: auto;">
                                        </div>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Estado</label>
                                        <select name="status" class="form-control" required>
                                            <option value="available"
                                                {{ old('status', $vehicle['status']) == 'available' ? 'selected' : '' }}>
                                                Disponible
                                            </option>

                                            <option value="reserved"
                                                {{ old('status', $vehicle['status']) == 'reserved' ? 'selected' : '' }}>
                                                Reservado
                                            </option>

                                            <option value="maintenance"
                                                {{ old('status', $vehicle['status']) == 'maintenance' ? 'selected' : '' }}>
                                                Mantenimiento
                                            </option>

                                            <option value="out_of_service"
                                                {{ old('status', $vehicle['status']) == 'out_of_service' ? 'selected' : '' }}>
                                                Fuera de servicio
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Kilometraje actual</label>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="current_mileage"
                                            value="{{ old('current_mileage', $vehicle['current_mileage']) }}"
                                            min="0"
                                            required>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer d-flex gap-2">
                                <button class="btn btn-warning" type="submit">
                                    Actualizar vehículo
                                </button>

                                <a href="{{ route('vehicles.index') }}" class="btn btn-secondary">
                                    Cancelar
                                </a>
                            </div>
                        </form>

                        <script>
                            (() => {
                                'use strict';

                                const forms = document.querySelectorAll('.needs-validation');

                                Array.from(forms).forEach((form) => {
                                    form.addEventListener('submit', (event) => {
                                        if (!form.checkValidity()) {
                                            event.preventDefault();
                                            event.stopPropagation();
                                        }

                                        form.classList.add('was-validated');
                                    }, false);
                                });
                            })();
                        </script>
                    </div>

                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>

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
</body>

</html>