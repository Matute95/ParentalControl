<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Pricing example for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="pricing.css" rel="stylesheet">
  </head>

  <body>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Subscripcion</h1>
      <p class="lead">Escoja uno de nuestros planes para tener acceso a todas las funciones</p>
    </div>
    <div class="container">
      <div class="card-deck mb-3 text-center">
        @foreach($plans as $plan)
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{$plan->name}}</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$plan->metadata->precio}}<small class="text-muted"> /mes</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>{{$plan->metadata->li1}}</li>
              <li>{{$plan->metadata->li2}}</li>
            </ul>
            <form action="{{route('plan')}}" method="POST" >
                @csrf
                <input name="plan" class="form-control" id="plan" value="{{$plan->name}}" hidden="true">
                <input name="precio" class="form-control" id="precio" value="{{$plan->default_price}}" hidden="true">
                <button type="submit" class="btn btn-dark">Subscribirse</button>
              </form>
          </div>
        </div>
        @endforeach
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
