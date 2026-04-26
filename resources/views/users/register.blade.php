<!doctype html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Academy | Registrar Usuario</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />

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
                            <h3 class="mb-0">Registrar Usuario</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Registrar Usuario</li>
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
                                    <div class="card-title">Datos del Nuevo Usuario</div>
                                </div>

                                <form action="{{ route('users.store') }}" method="post" class="needs-validation" novalidate>
                                    @csrf
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="full_name" class="form-label">Nombre Completo</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required />
                                                <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Email</label>
                                                <div class="input-group has-validation">
                                                    <span class="input-group-text">@</span>
                                                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required />
                                                    <div class="invalid-feedback">Ingrese un correo electrónico válido.</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Teléfono</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required />
                                                <div class="invalid-feedback">Ingrese un número telefónico.</div>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label" for="role_id">Rol</label>
                                                <select class="form-select" name="role_id" id="role_id" required>
                                                    <option value="" selected disabled>Seleccione un rol...</option>
                                                    <option value="1">Admin</option>
                                                    <option value="2">Operador</option>
                                                    <option value="3">Driver</option>
                                                </select>
                                                <div class="invalid-feedback">Seleccione un rol para el usuario.</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label for="password" class="form-label">Contraseña</label>
                                                        <input type="password" class="form-control" id="password" name="password" required />
                                                        <div class="invalid-feedback">La contraseña es obligatoria (mín. 8 caracteres).</div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required />
                                                        <div class="invalid-feedback">Confirme su contraseña.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer d-flex justify-content-around">
                                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
                                        <button class="btn btn-info" type="submit">Registrar Usuario</button>
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
        // Validación de Bootstrap
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

        // Configuración de Scrollbars
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined' && window.innerWidth > 992) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true
                    },
                });
            }
        });
    </script>
</body>

</html>