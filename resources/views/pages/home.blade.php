@extends('layout.app')
@section('title','Dealerku')
@section('content')
<!-- Main Content -->
<div class="container">
    <h3>Report</h3>
    <br>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Daily Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Most Sold Car for today</td>
                            <td>
                                @forelse($get_most_sold_today as $sold_today)
                                    {{$sold_today->car_name}}
                                @empty
                                    -
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td>Sales for today</td>
                            <td>
                                @if($sales_today < $sales_yesterday)
                                {{$sales_today}} <span class="text-danger">({{$today_sales_percentage}}%)</span>
                                @elseif($sales_today > $sales_yesterday)
                                    {{$sales_today}} <span class="text-success">(+{{$today_sales_percentage}}%)</span>
                                @else
                                    0
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Total Sales for today</td>
                            <td>
                                @if($sum_today < $sum_yesterday)
                                    Rp {{number_format($sum_today)}} <span class="text-danger">({{$english_format_number}}%)</span>
                                @elseif($sum_today > $sum_yesterday)
                                    Rp {{number_format($sum_today)}} <span class="text-success">(+{{$english_format_number}}%)</span>
                                @else
                                    Rp 0
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
        <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Weekly Report</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Most Sold Car this week</td>
                            <td>
                                @forelse($get_most_sold_weekly as $sold_week)
                                    {{$sold_week->car_name}}
                                @empty
                                    -
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <td>Sales this week</td>
                            <td>{{$sales_weekly}}</td>
                        </tr>
                        <tr>
                            <td>Total Sales for this Week</td>
                            <td>Rp {{number_format($sum_weekly)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- End Main Content -->
@endsection

@section('js')

@endsection