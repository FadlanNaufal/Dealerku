@extends('layout.app')
@section('title','Dealerku')
@section('content')
<!-- Main Content -->
<div class="container">
    <b>Buy New Car</b>
    <hr>
    <a href="{{route('car.index')}}" class="btn btn-warning">Back</a>
    <br><br>
    <form action="{{route('transaction.store')}}" method="post" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="">Car Name</label>
            <input type="hidden" name="car_id" value="{{$car->id}}"> 
            <input type="text" class="form-control" value="{{$car->car_name}}" required readonly>
        </div>
        <div class="form-group">
            <label for="">Customer Name</label>
            <input type="text" class="form-control" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="">Customer Email</label>
            <input type="email" class="form-control" name="customer_email" required>
        </div>
        <div class="form-group">
            <label for="">Customer Phone</label>
            <input type="number" class="form-control" name="customer_phone" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Add Transaction</button>
        </div>
    </form>
</div>
<!-- End Main Content -->
@endsection

@section('js')

@endsection