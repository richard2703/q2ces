<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--ESTA ETIQUETA ES EL ENLACE CON BOOSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <title>Polion</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body class="container ">
    <section class="row align-items-center justify-content-center fondoLogin m-0 p-0">

        <div class="col-8 col-lg-6 col-xl-4  login-box mx-center">
            <img src="{{ asset('img/login/logoQcem2.svg') }}" class="mx-auto d-block mb-5" width="30%">
            <p class="bienvenido mt-3">Bienvenido</p>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="user-box">
                    <input type="text" name="email" required="" class="inputRelleno">
                    <label>Correo</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" required="">
                    <label>Contraseña</label>
                </div>


                <div class="d-flex align-items-center">
                    <div class="align-items-center " style="width: 50%;">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label textLabel" for="flexCheckDefault">
                            Recordar contraseña
                        </label>
                    </div>
                    <div class="align-items-center " style="width: 50%;">
                        <p class="txtOlvide align-items-center mt-4">Olvidé contraseña</p>
                    </div>
                </div>


                <button class="mt-5" type="submit">
                    Entrar
                </button>

            </form>
        </div>

    </section>
</body>




{{-- <body class="antialiased">

     @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif --}}
{{-- <section class="vh-100">
        <div class="login-box">
            <h2>Iniciar sesion</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="user-box">
                    <input type="text" name="email" required="">
                    <label>Correo</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" required="">
                    <label>Contraseña</label>
                </div>
                <button type="submit" style="background-color:transparent;border: none; ">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Enviar
                </button>
            </form>
        </div>
    </section>
</body> --}}


<!--ESTAS 2  ETIQUETAS SON PARA QUE FUNCIONEN LAS ANIMACIONES DE BOOSTRAP-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous">
</script>
</body>

</html>
