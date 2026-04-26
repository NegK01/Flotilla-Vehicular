<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva Reserva</title>
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-body-tertiary">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-primary card-outline shadow">
                    <div class="card-header">
                        <h3 class="card-title">Confirmar Reserva</h3>
                    </div>
                    <form action="{{ route('driver.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">

                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Fecha y Hora de Inicio</label>
                                <input type="datetime-local" name="start_at" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fecha y Hora de Fin</label>
                                <input type="datetime-local" name="end_at" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Observaciones</label>
                                <textarea name="observation" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary w-100">Confirmar Reserva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>