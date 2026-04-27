<!doctype html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registrar Mantenimiento</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
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
                            <h3 class="mb-0">Registrar Mantenimiento</h3>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Registrar Mantenimiento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card card-info card-outline mb-4">
                                <div class="card-header">
                                    <div class="card-title">Datos del Mantenimiento</div>
                                </div>

                                <form action="{{ route('maintenances.store') }}" method="post" class="needs-validation" novalidate>
                                    @csrf

                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label for="vehicle_id" class="form-label">Vehículo</label>
                                                <select class="form-select" name="vehicle_id" id="vehicle_id" required>
                                                    <option value="" selected disabled>Seleccione un vehículo...</option>

                                                    @foreach($vehicles as $vehicle)
                                                    <option value="{{ $vehicle['id'] }}" {{ old('vehicle_id') == $vehicle['id'] ? 'selected' : '' }}>
                                                        {{ $vehicle['brand'] ?? '' }}
                                                        {{ $vehicle['model'] ?? '' }}
                                                        - {{ $vehicle['plate'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">Seleccione un vehículo.</div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="type" class="form-label">Tipo de mantenimiento</label>
                                                <select class="form-select" name="type" id="type" required>
                                                    <option value="" selected disabled>Seleccione un tipo...</option>
                                                    <option value="preventive" {{ old('type') == 'preventive' ? 'selected' : '' }}>Preventivo</option>
                                                    <option value="corrective" {{ old('type') == 'corrective' ? 'selected' : '' }}>Correctivo</option>
                                                </select>
                                                <div class="invalid-feedback">Seleccione el tipo de mantenimiento.</div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="start_at" class="form-label">Fecha y hora de inicio</label>
                                                <input type="datetime-local" class="form-control" id="start_at" name="start_at" value="{{ old('start_at') }}"
                                                    min="{{ now()->format('Y-m-d\TH:i') }}" required />
                                                <div class="invalid-feedback">Ingrese la fecha de inicio.</div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="description" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-around">
                                        <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                                            Cancelar
                                        </a>

                                        <button class="btn btn-info" type="submit">
                                            Registrar Mantenimiento
                                        </button>
                                    </div>

                                    @if ($errors->any())
                                    <div class="alert alert-danger m-3">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('layouts.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
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