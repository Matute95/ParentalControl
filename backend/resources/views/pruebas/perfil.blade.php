@extends('app')


@section('content')

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">{{auth()->user()->name}} {{auth()->user()->apellido}}</span><span class="text-black-50">{{auth()->user()->email}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Nombre</label><h2>{{auth()->user()->name}}</h2>
                    <div class="col-md-6"><label class="labels">Apellido/s</label><h2>{{auth()->user()->apellido}}</h2>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Celular</label><h2>{{auth()->user()->celular}}</h2>
                    <div class="col-md-12"><label class="labels">E-mail</label><h2>{{auth()->user()->email}}</h2>
                    <div class="col-md-12"><label class="labels">Fecha de Nacimiento</label><h2>{{auth()->user()->fecha_nacimiento}}</h2>
                    <div class="col-md-12"><label class="labels">Sexo</label><h2>{{auth()->user()->sexo}}</h2>
                    
                </div>
                
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
@stop

@section('css')

 <style>
    body {
    background: rgb(99, 39, 120)
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
 </style>

@stop

@section('js')
  


@stop
  