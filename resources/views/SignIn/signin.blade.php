<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href=" {{asset('css/bootstrap.min.css')}} ">

</head>

<body class="bg">
    <section class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card col-sm-12 col-md-9 col-lg-6 border-success shadow hover-scale">
            <div class="card-header text-center">
                <h5>Registrarse</h5>
            </div>
            <div class="card-body">
                <form class="w-100 d-flex flex-column align-items-center" action="{{url('http://localhost:8000/api/users')}}" method="post">
                    <label class="col-12 col-md-10 form-label m-3">Nombre Completo
                        <input class="form-control" type="text" name="full_name">
                    </label>
                    <input type="hidden" value="3" name="role_id">

                    <label class="col-12 col-md-10 form-label mb-3">Email
                        <input class="form-control" type="email" name="email">
                    </label>

                    <label class="col-12 col-md-10 form-label mb-3">Telefono
                        <input class="form-control" type="text" name="phone">
                    </label>

                    <div class="d-flex gap-3 col-12 col-md-10 mb-5">
                        <label class="form-label w-50">Contraseña
                            <input class="form-control" type="text" name="password">
                        </label>
                        <label class="form-label w-50">Confirmar contraseña
                            <input class="form-control" type="text" name="password_confirmation">
                        </label>
                    </div>
                    <div class="col-10 d-flex justify-content-center gap-3 mb-4">
                        <button type="submit" class="btn btn-success col-5 ">Registrarse</button>
                        <a class="btn btn-danger col-5" href="{{ url('/')}}">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
</body>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const password = document.querySelector('input[name="password"]').value;
        const confirm = document.querySelector('input[name="password_confirmation"]').value;

        if (password !== confirm) {
            e.preventDefault();
            alert('Las contraseñas no coinciden');
        }
    });
</script>

</html>