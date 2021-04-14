<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>@yield('title')</title>
  <link href="{{url('dist/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="{{url('dist/css/sb-admin-2.min.css')}}" rel="stylesheet">
  <link href="{{url('dist/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card card-body">
                <p>Congratulation, {{$data->customer_name}}</p>
                <p>Purchase a car {{$data->Car->car_name}} for Rp {{number_format($data->Car->car_price)}} successful, please wait a few days for the car to be delivered</p>
            </div>
        </div>
    </div>
</body>

  <script src="{{url('dist/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('dist/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('dist/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{url('dist/js/sb-admin-2.min.js')}}"></script>
  <script src="{{url('dist/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('dist/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{url('dist/js/demo/datatables-demo.js')}}"></script>

</body>

</html>
