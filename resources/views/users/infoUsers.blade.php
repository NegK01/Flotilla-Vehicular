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
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user['full_name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['phone'] }}</td>
                        @if ($user['role_id'] == 1)
                        <td>Administrador</td>
                        @elseif ($user['role_id'] == 2)
                        <td>Operador</td>
                        @elseif ($user['role_id'] == 3)
                        <td>Conductor</td>
                        @endif
                        <td>
                            <a href="#" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

        </div>


        <!--end::Users List-->
    </div>
</div>
<!--end::App Content-->

<!--end::App Main-->

<!--begin::Footer-->

<!--end::Footer-->