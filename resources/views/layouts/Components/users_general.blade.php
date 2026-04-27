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
<!--end::Head-->

<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('layouts.navbar')
        <!--end::Header-->

        <!--begin::Sidebar-->
        @include('layouts.sidebar')
        <!--end::Sidebar-->



        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Usuarios</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::App Content Header-->

            <!--begin::App Content-->
            <div class="app-content">
                <div class="container-fluid">

                    <div class="col-lg-6">
                        <div class="card card-outline card-primary h-100 mb-3 ">
                            <div class="card-header">
                                <h3 class="card-title">Accesos rápidos</h3>
                            </div>

                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <a href="{{ route('users.create') }}" class="btn btn-primary w-100 py-2">
                                            <i class="bi bi-person-plus-fill me-2 "></i>
                                            Registrar usuario
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ route('vehicles.index') }}" class="btn btn-success w-100 py-2">
                                            <i class="bi bi-lightning-fill me-2"></i>
                                            Registrar vehiculo
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('road.index')}}" class="btn btn-primary w-100 py-2">
                                            <i class="bi bi-shuffle me-2 "></i>
                                            Rutas
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{route('road.create')}}" class="btn btn-primary w-100 py-2">
                                            <i class="bi bi-shuffle me-2 "></i>
                                            Registrar ruta
                                        </a>
                                    </div>
                                    <div class="col-md-4">
                                        
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!--begin::Users List-->

                    <!-- Propiedades de las tablas (por si se ocupan)
                        table-striped → filas alternadas (rayas)
                        table-bordered → bordes en toda la tabla
                        table-borderless → sin bordes
                        table-hover → efecto hover en filas
                        table-sm → tabla más compacta-->


                    <div class="row text-center">

                        <table class="table table-dark table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre Completo</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!$users)
                                <tr>
                                    <td colspan="5" class="text-center">No hay datos para mostrar</td>
                                </tr>
                                @else
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user['full_name'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['phone'] }}</td>
                                    <td>
                                        @if ($user['role_id'] == 1) Administrador
                                        @elseif ($user['role_id'] == 2) Operador
                                        @elseif ($user['role_id'] == 3) Conductor
                                        @endif
                                    </td>
                                    <td>
                                        @if( !isset($user['deleted_at']) || is_null($user['deleted_at']) )
                                        <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-primary">Editar</a>
                                        <form action="{{ route('users.destroy', $user['id']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                Eliminar
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('users.restore', $user['id']) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success w-100">
                                                Reactivar
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>

                        <div class="card-footer d-flex justify-content-end">
                            @if(Route::is('users.inactive'))
                            <a href="{{ route('users.index') }}" class="btn btn-sm btn-success">
                                Mostrar Activos
                            </a>
                            @else
                            <a href="{{ route('users.inactive') }}" class="btn btn-sm btn-warning">
                                Mostrar Inactivos
                            </a>
                            @endif
                        </div>






                        <!--end::Users List-->
                    </div>
                </div>
                <!--end::App Content-->

                <!--end::App Main-->

                <!--begin::Footer-->

                <!--end::Footer-->

        </main>

        @include('layouts.footer')

    </div>
    <!--end::App Wrapper-->

    <!--begin::Script-->
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
    <!--end::Script-->
</body>
<!--end::Body-->

</html>