<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=" {{asset('css/bootstrap.min.css')}} ">
</head>

<body class="bg">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-sm-12 col-md-9 col-lg-6">
            <div class="card shadow p-4">
                <div class="card-header text-center">
                    <h4>INICIO DE SESIÓN</h4>
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="mb-3">
                            <label class="form-label">Ingrese su correo</label>
                            <input type="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ingrese su contraseña</label>
                            <input type="password" class="form-control" required>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-success mt-4 mb-3 w-100">Iniciar</button>
                            <p class="text-center">Aún no tienes cuenta? <a href="{{ url('SignIn')}}" class="text-success"> Registrarse</a></p>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>








    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>