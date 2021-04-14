@extends('layout.app')
@section('title','Dealerku')
@section('content')
<!-- Main Content -->
<div class="container">
    <b>Add New Car</b>
    <hr>
    <a href="{{route('car.index')}}" class="btn btn-warning">Back</a>
    <br><br>
    <form action="{{route('car.store')}}" method="post" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="">Car Name</label>
            <input type="text" class="form-control" name="car_name" required>
        </div>
        <div class="form-group">
            <label for="">Car Price</label>
            <input type="number" class="form-control" name="car_price" required>
        </div>
        <div class="form-group">
            <label for="">Car Stock</label>
            <input type="number" class="form-control uang" name="car_stock" required>
        </div>
        <div class="form-group">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<!-- End Main Content -->
@endsection

@section('js')
<script type="text/javascript">
            $(document).ready(function(){
                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});
            })
        </script>
@endsection