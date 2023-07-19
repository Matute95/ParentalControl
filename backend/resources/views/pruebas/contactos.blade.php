@extends('app')


@section('content')
<br>
<div class="container-fluid d-flex justify-content-center aling-items-center">
    <div class="card" style="width: 40%;">
        <a href="" class="btn btn-dark m-1" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir hijo.</a>


        <div class="card-header">
          <h4 class="d-flex justify-content-center"><u><strong>DISPOSITIVOS DE HIJOS</strong></u></h4>
            
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionExample">

                @php
                     $a=0;
                @endphp
                @foreach ($tokens as $token)
                @php
                    $a=$a+1;
                    
                    $hijo=App\Models\Hijo\Hijo::where('id',$token['id_hijo'])->first();
                @endphp
                <div class="accordion-item">
                  <h2 class="accordion-header" id="heading{{$a}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$a}}" aria-expanded="true" aria-controls="collapse{{$a}}">
                      Dispositivo de: {{$hijo->name}} {{$hijo->apellido}}
                    </button>
                  </h2>
                  <div id="collapse{{$a}}" class="accordion-collapse collapse" aria-labelledby="heading{{$a}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <label for="" class="form-label">Nombre y apellido: <strong>{{$hijo->name}} {{$hijo->apellido}}</strong> </label><br>
                        <label for="" class="form-label">Alias: <strong>{{$hijo->alias}}</strong> </label><br>
                        <label for="" class="form-label">Celular: <strong>{{$hijo->celular}}</strong> </label><br>
                        <label for="" class="form-label">Sexo: <strong>{{$hijo->sexo}}</strong> </label><br>
                        <label for="" class="form-label">Edad: <strong>{{$hijo->edad}}</strong> </label><br>
                        <div class="d-flex justify-content-center">
                          <button class="btn btn-primary mr-3">Contactos</button>
                          <button class="btn btn-primary mx-3">Llamadas </button>
                          <button class="btn btn-primary ml-3">Galeria</button>
                        </div>
                    </div>
                  </div>
                </div>
                @endforeach
                
              </div>
        </div>
    </div>

</div>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo dispositivo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{route('crear_hijo')}}" method="POST" >
                @csrf
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" name="nombre" class="form-control" id="nombre" >
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control" id="apellido" >
                </div>
                <div class="mb-3">
                    <label for="alias" class="form-label">Alias</label>
                    <input type="text" name="alias" class="form-control" id="alias" >
                  </div>
                <div class="mb-3">
                <div class="mb-3">
                  <label for="celular" class="form-label">Celular</label>
                  <input type="text" name="celular" class="form-control" id="celular">
                </div>
                <div class="mb-3">
                    <label for="sexo" class="form-label">sexo</label>
                    <input type="text" name="sexo" class="form-control" id="sexo">
                </div>

                <div class="mb-3">
                    <label for="edad" class="form-label">Edad</label>
                    <input type="text" name="edad" class="form-control" id="edad">
                </div>
                
                <button type="submit" class="btn btn-dark">Guardar dispositivo</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@stop

@section('css')
   



@stop

@section('js')
<script src=""></script>

@stop