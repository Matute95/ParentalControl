<!DOCTYPE html>
<html lang="en">
<head>
  <title>Protecting you</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

  @yield('css')
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
  <script src="{{ asset('js/jquery.min.js') }}" charset="utf-8"></script>
  
</head>
<body>  
  

  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <div class="container-fluid">
    <a class="navbar-brand" href="#" style="">   <img src="img/controlparental2.png" width="150" > </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('perfil')}}">Perfil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('tokens')}}">Tokens de Usuario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('dispositivos')}}">Dispositivos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('plan')}}">Plan</a>
          </li>
      </ul>
    </div>
    <a class="btn btn-danger navbar-btn" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      <i class="fa fa-fw fa-power-off text-red"></i>
      
    </a>
    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
        @csrf
        <a href="{{route('logout')}}"
        onclick="event.preventDefault();
                    this.closest('form').submit();">Log Out</a>
    </form>
  </div>
</nav>

@yield('content')


@yield('js')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>
