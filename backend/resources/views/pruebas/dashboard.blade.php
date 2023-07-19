@extends('app')


@section('content')

    <div class="container-fluid">
        <h1>HELLOOOOOOOOO</h1>
  </div>
    {{--<div class="navbar1">

        <ul>

            <li>
                <a href="#home" class="dot active" data-scroll="home">
                    <span>Inicio</span>
                </a>
            </li>

            <li>
                <a href="#about" class="dot" data-scroll="about">
                    <span>Dispositivos</span>
                </a>
            </li>

        </ul>

    </div>



    <section class="sec section-info gray-bg" id="home">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-lg-8">
                    <div class="about-text go-to">
                        <h3 class="dark-color">Información Personal</h3>
                        <h6 class="theme-color lead">Cuenta {{$usuario->Plan}}</h6>
                        <div class="row about-list">
                            <div class="col-md-6">
                                <div class="media">
                                    <label style="font-size:15px">Nombre&nbsp;/</label>
                                    <p>{{$usuario->name}}</p>
                                </div>
                                <div class="media">
                                    <label style="font-size:15px">Plan&nbsp;/</label>
                                    <p>{{$plan->name}}</p>
                                </div>
                                <div class="media">
                                    <label style="font-size:15px">Limite&nbsp;/</label>
                                    <p>Fecha fin</p>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <label style="font-size:15px">Correo&nbsp;/</label>
                                    <p>{{$usuario->email}}</p>
                                </div>
                                <div class="media">
                                    <label style="font-size:14px">Telefono&nbsp;/</label>
                                    <p>&nbsp;{{$usuario->telefono}}</p>
                                </div>
                                <div class="media">
                                    <label style="font-size:15px;width: 20%;">Dispositivos&nbsp;/</label>
                                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="about-avatar">
                        <img class="avatar" src="{{ asset('image/avatar7.png') }}" title="" alt="">
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="sec" id="about" style="background-color:#fff;">
        {{-- <span style="text-align:center;align-items:center;height:60px;width:60px;">Dispositivos</span> }}
        @if ($plan->name=="free" && $numDispositivos<2)
            <a href="" class="btn btn-dark" style="height: 3%; margin: 5px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir dispositivo.</a>
        @endif
        @if ($plan->name=="standard" && $numDispositivos<3)
            <a href="" class="btn btn-dark" style="height: 3%; margin: 5px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir dispositivo.</a>
        @endif
        @if ($plan->name=="Premiun" && $numDispositivos<5)
            <a href="" class="btn btn-dark" style="height: 3%; margin: 5px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Añadir dispositivo.</a>
        @endif
        
        
        <section class="slider" style="padding-top:150px;">
            

            <ul id="autoWidth" class="cs-hidden">
                @php
                        $a=0;
                @endphp
                @foreach ($dispositivos as $dispositivo)
                    @php
                        $a=$a+1;
                    @endphp    
                    <!-- slider 1 -->
                <li class="item-a">
                    <!-- box slider -->
                    <div class="box">
                        <!-- slider image -->
                        <div class="slider-img">
                            <img src="{{ asset('image/android.webp') }}" alt="" />
                            <!-- overlayer -->
                            <div class="overlay">
                                <!-- buy boton -->
                                <form action="{{ route('usuario.test', ['id'=>$dispositivo->id]) }}" method="get" >
                                    <button class="btn-btn" type="submit">Ver</button>
                                    
                                </form>
                                
                            </div>
                        </div>

                        <div class="detalle-box">
                            <!-- tipoo -->
                            <div class="type">
                                <a href="#">{{$dispositivo->nombre}}</a>
                                <span>{{$dispositivo->celular}}</span>
                            </div>
                            <!-- price -->
                            {{-- <a href="" class="price">$500</a> }}
                        </div>
                    </div>
                </li>

                @endforeach

            </ul>
        </section>
    </section>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo dispositivo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('usuario.addDisp')}}" method="POST" >
                @csrf
                <div class="mb-3">
                  <label for="nombre" class="form-label">Nombre</label>
                  <input type="text" name="nombre" class="form-control" id="nombre" >
                 
                </div>
                <div class="mb-3">
                  <label for="celular" class="form-label">Celular</label>
                  <input type="text" name="celular" class="form-control" id="celular">
                </div>

                <div class="mb-3">
                    <label for="codigo" class="form-label">Codigo</label>
                    <input type="text" name="codigo" class="form-control" id="codigo">
                  </div>
                
                <button type="submit" class="btn btn-dark">Guardar dispositivo</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>--}}
@stop

@section('css')

    {{--<link rel="stylesheet" href="{{ asset('css/tutor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SecInfo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightslider.css') }}">--}}

@stop

@section('js')
    {{--<script src="{{ asset('js/jquery.min.js') }}" charset="utf-8"></script>
    {{-- <script src="{{ asset('js/jquery-3.6.0.js') }}"></script> }}
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/lightslider.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $(window).on('scroll', function() {

                var link = $('.navbar1 a.dot');
                var top = $(window).scrollTop();

                $('.sec').each(function() {
                    var id = $(this).attr('id');
                    var height = $(this).height();
                    var offset = $(this).offset().top - 150;
                    if (top >= offset && top < offset + height) {
                        link.removeClass('active');
                        $('.navbar1').find('[data-scroll="' + id + '"]').addClass('active');
                    }
                });

            });

        });
    </script>--}}


@stop
  