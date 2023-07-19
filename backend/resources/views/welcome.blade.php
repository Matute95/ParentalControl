<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Protecting You</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="estilos.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        <!-- Styles -->
       

       
    </head>
    <body class="antialiased">
        <header class="header" >
            <div class="container">
                <a href="wecolme.blade.php">
                    <img src="img/controlparental2.png" width="150" >
                </a>
                <nav >

                        <a href="#inicio">Inicio</a>
                        <a href="#servicio">Servicio</a>
                        <a href="#galeria">Portafolio</a>
                        <a href="#expertos">Especializados</a>
                        <a href="#footer">Contacto</a>
                        @if (Route::has('login'))
                   
                        @auth
                            <a href="{{ url('/dashboard') }}" >Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" >Log in</a>
    
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" >Register</a>
                            @endif
                        @endauth
                   
                @endif
    
            </div>
            
            </nav>
       
            
        </header>
        
        <main>
            <section class="inicio" id="inicio">
                
                <div class="contenedor head">
                    <h1 class="titulo">Controla el movimiento de tus hijos</h1>
                    <p class="copy">Manten a tus hijos vigilados todo el tiempo.</p>
                </div>
            </section>

            <section class="services contenedor" id="servicio">
                <h1 class="subtitulo">Protege a tu niño con nuestros servicios</h1>
                <div class="contenedor-servicio">
                  <img src="img/checklist.svg" alt="">
                    <div class="checklist-servicio">
                        <div class="service">
                            <h3 class="n-service"><span class="number">1</span>Reporte de Actividad</h3>
                            <p>Rastrea la actividad diaria del dispositivo de tu niño</p>
                        </div>
                        <div class="service">
                            <h3 class="n-service"><span class="number">2</span>Localizador</h3>
                            <p>Rastrea la ubicación en tiempo real del niño</p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="gallery" id="galeria">
                <div class="contenedor">
                    <h2 class="subtitulo">Fotos del movil xd</h2>
                    <div class="contenedor-galeria">
                        <img src="img/ubicación.jpg" class="img-galeria" alt="Hola">
                       
                    </div>
                </div>
            </section>
            <div class="imagen-light">
                <img src="img/close.svg" alt="" class="close">
                <img src="" alt="" class="agregar-imagen">
            </div>
          
        </main>
    
        <footer id="footer">
            <div class="contenedor footer-content">
                    <div class="contact-us">
                        <h2 class="brand"></h2>
                        <p></p>
                    </div>
                    <div class="social-media">
                        <a href="./" class="social-media-icon">
                            <i class='bx bxl-facebook'></i>
                        </a>
                        <a href="./" class="social-media-icon">
                            <i class='bx bxl-twitter' ></i>
                        </a>
                        <a href="./" class="social-media-icon">
                            <i class='bx bxl-instagram' ></i>
                        </a>
                    </div>
            </div>
            <div class="line"></div>
        </footer>
     
        <script src="js/lightbox.js"></script>
    </body>
</html>
