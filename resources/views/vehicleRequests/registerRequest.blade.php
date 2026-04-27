<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Solicitar Vehículo</title>

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
                            <h3 class="mb-0">Asignar vehículo</h3>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Solicitar vehículo</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">

                    <div class="card card-success card-outline mb-4">

                        <div class="card-header">
                            <div class="card-title">Nueva solicitud de vehículo</div>
                        </div>

                        <form action="{{ route('request.directstore') }}" class="needs-validation p-2" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Usuarios</label>
                                        <select name="driver_id" class="form-control" required>
                                            <option value="">Seleccione un usuario</option>

                                            @foreach ($users as $user)
                                            <option value="{{ $user['id'] }}">
                                                {{ $user['full_name'] }} {{ $user['id'] }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            Seleccione un usuario
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Vehículo</label>
                                        <select name="vehicle_id" class="form-control" required>
                                            <option value="">Seleccione un vehículo</option>

                                            @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle['id'] }}">
                                                {{ $vehicle['brand'] }} {{ $vehicle['model'] }} - {{ $vehicle['plate'] }}
                                            </option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">
                                            Seleccione un vehículo.
                                        </div>
                                    </div>

                                    <!--<div class="col-md-6">
                                        <label class="form-label">Tipo de solicitud</label>
                                        <select name="request_type" class="form-control" required>
                                            <option value="driver_request">Solicitud de conductor</option>
                                            <option value="direct_assignment">Asignación directa</option>
                                        </select>

                                        <div class="invalid-feedback">
                                            Seleccione un tipo de solicitud.
                                        </div>
                                    </div> -->

                                    <div class="col-md-6">
                                        <label class="form-label">Fecha y hora de inicio</label>
                                        <input
                                            type="datetime-local"
                                            name="start_at"
                                            class="form-control"
                                            required>

                                        <div class="invalid-feedback">
                                            Ingrese la fecha y hora de inicio.
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Fecha y hora de finalización</label>
                                        <input
                                            type="datetime-local"
                                            name="end_at"
                                            class="form-control"
                                            required>

                                        <div class="invalid-feedback">
                                            Ingrese la fecha y hora de finalización.
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Observación</label>
                                        <textarea
                                            name="observation"
                                            class="form-control"
                                            rows="4"
                                            placeholder="Ingrese el motivo o detalle de la solicitud"></textarea>

                                        <div class="invalid-feedback">
                                            Ingrese una observación válida.
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end gap-2">
                                <a href="{{ route('vehicle-requests.index') }}" class="btn btn-secondary">
                                    Cancelar
                                </a>

                                <button class="btn btn-success" type="submit">
                                    Enviar solicitud
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </main>

        @include('layouts.footer')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        crossorigin="anonymous"></script>

    <script src="{{ asset('js/adminlte.js') }}"></script>

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

</body>

</html>