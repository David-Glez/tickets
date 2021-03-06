<!doctype html>
<html lang="en">

<head>
  <title>Login | Sistema de Tickets</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{!! asset('dist/css/styles.css')!!}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <style>
  .login{
    background: url('./dist/images/fondo.jpeg') no-repeat;
    background-size: 100%;
  }
  </style>  
</head>

<body class="h-screen font-sans login bg-cover">

<div class="container mx-auto h-full flex flex-1 justify-center items-center">
<div class = 'logo-ebp'>
  <img src = "{{url('./dist/images/LOGO EBP CONSULTORES BLANCO.png')}}" alt = 'Image' />
</div>
  <div class="w-full max-w-lg">
    <div class="leading-loose">
      <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" action = "{{route('signin')}}" method = 'post'>
      @csrf
        <p class="text-gray-800 font-medium text-center text-lg font-bold">Login</p>
        <div class="">
          <label class="block text-sm text-gray-00" for="username">Correo electronico</label>
          <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded @error('email') is-invalid @enderror" id="email" name="email" type="email" required="" autocomplete="email" placeholder="Correo electronico" aria-label="username">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mt-2">
          <label class="block text-sm text-gray-600" for="password">Contraseña</label>
          <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded @error('password') is-invalid @enderror" id="password" name="password" type="password" required="" placeholder="*******" aria-label="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

            @if($errors->any())
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first() }}</strong>
                </span>
            @endif
        <div class="mt-4 items-center justify-between">
          <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Iniciar sesión</button>
          <!--<a class="inline-block right-0 align-baseline  font-bold text-sm text-500 hover:text-blue-800" href="#">
            Forgot Password?
          </a>-->
        </div>
        <!--<a class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800" href="#">
          Not registered ?
        </a>-->
      </form>

    </div>
  </div>
</div>
</body>

</html>