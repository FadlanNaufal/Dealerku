@extends('layout.app')
@section('title','Dealerku')
@section('content')
<!-- Main Content -->
<div class="container">
    <b>Transaction Data</b>
    <hr>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Car Name</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Customer Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction as $trans)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$trans->Car->car_name}}</td>
                    <td>{{$trans->customer_name}}</td>
                    <td>{{$trans->customer_email}}</td>
                    <td>{{$trans->customer_phone}}</td>
                    <td class="text-center">
                        <div class="btn-group">
                            <form action="{{route('transaction.destroy',$trans->id)}}" method="post">
                                @csrf @method('delete')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure want to cancel transaction?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
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