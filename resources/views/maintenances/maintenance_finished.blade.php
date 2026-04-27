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
                                <li class="breadcrumb-item active" aria-current="page">Finalizar Mantenimiento</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="card card-warning card-outline mb-4">
                                <div class="card-header">
                                    <div class="card-title">Editar Mantenimiento</div>
                                </div>

                                <form action="{{ route('maintenances.update', $maintenance['id']) }}" method="post">
                                    @csrf
                                    @method('PUT')

                                    <div class="card-body">
                                        <div class="row g-3">

                                            <div class="col-md-6">
                                                <label class="form-label">Tipo</label>
                                                <select name="type" class="form-select" disabled>
                                                    <option value="preventive" {{ $maintenance['type'] == 'preventive' ? 'selected' : '' }}>
                                                        Preventivo
                                                    </option>
                                                    <option value="corrective" {{ $maintenance['type'] == 'corrective' ? 'selected' : '' }}>
                                                        Correctivo
                                                    </option>
                                                </select>

                                                <input type="hidden" name="type" value="{{ $maintenance['type'] }}">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Inicio</label>
                                                <input type="datetime-local"
                                                    name="start_at"
                                                    class="form-control"
                                                    min="{{ now()->format('Y-m-d\TH:i') }}"
                                                    value="{{ old('start_at', \Carbon\Carbon::parse($maintenance['start_at'])->format('Y-m-d\TH:i')) }}"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Cierre</label>
                                                <input type="datetime-local"
                                                    name="closed_at"
                                                    class="form-control"
                                                    min="{{ now()->format('Y-m-d\TH:i') }}"
                                                    value="{{ old('start_at', \Carbon\Carbon::parse($maintenance['closed_at'])->format('Y-m-d\TH:i')) }}"
                                                    >
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Estado</label>
                                                <select name="status" class="form-select">
                                                    <option value="open" {{ $maintenance['status'] == 'open' ? 'selected' : '' }}>
                                                        Abierto
                                                    </option>
                                                    <option value="closed" {{ $maintenance['status'] == 'closed' ? 'selected' : '' }}>
                                                        Cerrado
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Costo</label>
                                                <input type="number"
                                                    step="0.01"
                                                    min="0"
                                                    name="cost"
                                                    class="form-control"
                                                    value="{{ old('cost', $maintenance['cost']) }}">
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Descripción</label>
                                                <textarea name="description"
                                                    class="form-control"
                                                    rows="4"
                                                    required>{{ old('description', $maintenance['description']) }}</textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-between">
                                        <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">
                                            Cancelar
                                        </a>

                                        <button type="submit" class="btn btn-warning">
                                            Actualizar
                                        </button>
                                    </div>
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