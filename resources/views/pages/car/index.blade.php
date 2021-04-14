@extends('layout.app')
@section('title','Dealerku')
@section('content')
<!-- Main Content -->
<div class="container">
    <b>Car Data</b>
    <hr>
    <a href="{{route('car.create')}}" class="btn btn-primary">Add New</a>
    <br><br>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Car Name</th>
                    <th>Car Price</th>
                    <th>Car Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$car->car_name}}</td>
                    <td>Rp {{number_format($car->car_price)}}</td>
                    <td>{{$car->car_stock}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('car.edit',$car->id)}}" class="btn btn-primary">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{route('car.destroy',$car->id)}}" method="post">
                                @csrf @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{route('car.show',$car->id)}}" class="btn btn-info">
                                <i class="fas fa-dollar-sign"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- End Main Content -->
@endsection

@section('js')

@endsection