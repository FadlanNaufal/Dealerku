@extends('layout.app')
@section('title','Dealerku')
@section('content')
<!-- Main Content -->
<div class="container">
    <b>Edit Car</b>
    <hr>
    <a href="{{route('car.index')}}" class="btn btn-warning">Back</a>
    <br><br>
    <form action="{{route('car.update',$car->id)}}" method="post" autocomplete="off">
        @csrf @method('put')
        <div class="form-group">
            <label for="">Car Name</label>
            <input type="text" class="form-control" name="car_name" value="{{$car->car_name}}" required>
        </div>
        <div class="form-group">
            <label for="">Car Price</label>
            <input type="number" class="form-control" name="car_price" value="{{$car->car_price}}" required>
        </div>
        <div class="form-group">
            <label for="">Car Stock</label>
            <input type="number" class="form-control" name="car_stock" value="{{$car->car_stock}}" required>
        </div>
        <div class="form-group">
            <button class="btn btn-info">Update</button>
        </div>
    </form>
</div>
<!-- End Main Content -->
@endsection

@section('js')

@endsection