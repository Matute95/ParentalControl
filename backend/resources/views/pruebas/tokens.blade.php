@extends('app')


@section('content')

  
   
<div class="card" style="margin: 2%">
    <div class="card-header" style="background-color: rgb(0, 0, 20); color: white;">
        <a class="btn btn-primary" href="{{route('crearToken')}}" role="button">Crear token</a>
    </div>
    <div class="card-body">
        token usuario
        <table class="table" style="padding-left:10%;">
            <thead>
              <tr>
                <th scope="col">#</th>
               {{--  <th scope="col">id</th> --}}
                <th scope="col">Codigo</th>
                <th scope="col">Fecha Creacion</th>
                <th scope="col">Fecha Registro</th>
                <th scope="col">Tiempo restante</th>
              </tr>
            </thead>
            @php
                   $a=0;
            @endphp
            <tbody>
                @foreach ($tokens as $token)
                @php
                    $a=$a+1;
                @endphp

                <tr>
                    <td>{{$a}}</td>
                   {{--  <td>{{$token->id}}</td> --}}
                    <td>{{$token->codigo}}</td>
                    <td>{{$token->fecha_creacion}}</td>
                    @if ($token->fecha_registro!="")
                        <td>{{$token->fecha_registro}}</td>        
                    @else
                        <td>Sin registrar</td>
                    @endif
                    <td><input type="hidden" id="input{{$a}}" value="{{$token->fecha_creacion}}"><strong id="demo{{$a}}"></strong></td>

                </tr>
                @endforeach

              <input type="hidden" id="cont" value="{{$a}}">
            </tbody>
          </table>
    </div>
    
</div>
@stop

@section('css')

@stop

@section('js')


<script>
    $cont=document.getElementById("cont").value
    $i=1;
    while ($cont>=$i) {
        ponerTiempo("demo"+$i)
        $i++;
    }
    function ponerTiempo(id){
         // Set the date we're counting down to
    $fecha=document.getElementById("input"+$i).value
    var fechaCreacion = new Date($fecha);
    fechaCreacion.setMinutes(fechaCreacion.getMinutes() + 5)
    var countDownDate =fechaCreacion.getTime();


     console.log(countDownDate+" asdasdaf");
    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById(id).innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById(id).innerHTML = "Token expirado";
        document.getElementById(id).style.color = "red";
    }

    }, 1000);
    }



</script>
@stop
