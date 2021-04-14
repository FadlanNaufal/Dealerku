<?php

namespace App\Http\Controllers;

use App\Car;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );

        $sales_yesterday = Transaction::whereDate('created_at', $yesterday)->count();
        $sum_yesterday = Transaction::whereDate('created_at', $yesterday)->sum('total_price');
        
        $sales_today = Transaction::whereDate('created_at', '=', date('Y-m-d'))->count();
        $sales_weekly = Transaction::where('created_at', '>', Carbon::now()->startOfWeek())
        ->where('created_at', '<', Carbon::now()->endOfWeek())->count();

        $sum_today = Transaction::whereDate('created_at', '=', date('Y-m-d'))->sum('total_price');
        $sum_weekly = Transaction::where('created_at', '>', Carbon::now()->startOfWeek())
        ->where('created_at', '<', Carbon::now()->endOfWeek())->sum('total_price');
        
        $compare_sales_today = $sales_today - $sales_yesterday;
        $compare_sum_today = $sum_today - $sum_yesterday;

        if(!empty($compare_sales_today)){
            $today_sales_percentage = $compare_sales_today / $sales_today * 100;
        }else{
            $today_sales_percentage = 0;
        }

        if(!empty($compare_sum_today)){
            $today_sum_percentage = $compare_sum_today / $sum_today * 100;
        }else{
            $today_sum_percentage = 0;
        }


        $english_format_number = number_format($today_sum_percentage, 1, '.', '');

        $get_most_sold_today = DB::select('SELECT *, COUNT(DISTINCT transactions.id) AS total FROM cars LEFT JOIN transactions ON transactions.car_id = cars.id GROUP BY cars.id ORDER BY total DESC LIMIT 1 ');


        $get_most_sold_weekly = DB::select('SELECT  *, COUNT(DISTINCT transactions.id) AS total FROM cars LEFT JOIN transactions ON transactions.car_id = cars.id 
        WHERE yearweek(DATE(transactions.created_at), 1) = yearweek(curdate(), 1) GROUP BY cars.id ORDER BY total DESC LIMIT 1 ');

        
        $test = DB::table('cars')->select('cars.car_name')->addSelect(DB::raw('COUNT(DISTINCT transactions.id) AS total'))->leftJoin('transactions','transactions.car_id','=','cars.id')->groupBy('cars.id')->orderBy('total','desc');

        

        return view('pages.home',compact('sales_today','sum_today','sales_weekly','sum_weekly','today_sales_percentage','sales_yesterday','english_format_number','sum_yesterday','get_most_sold_today','get_most_sold_weekly'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
