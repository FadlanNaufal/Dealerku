<?php

namespace App\Http\Controllers;

use App\Car;
use App\Transaction;
use Illuminate\Http\Request;

class CarController extends Controller
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
        return view('pages.car.index',[
            'cars'=>Car::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'car_name' => 'required|max:255',
            'car_price' => 'required|numeric',
            'car_stock' => 'required|numeric',
        ]);

        Car::create($validatedData);

        return redirect()->route('car.index')->with('success','Data Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::where('id',$id)->first();
        if($car->car_stock <= 0){
            return back()->with('error','Sorry, Stock of this car is empty');
        }
        return view('pages.transaction.create',[
            'car'=>Car::where('id',$id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.car.edit',[
            'car'=>Car::where('id',$id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $car = Car::where('id',$id)->first();
        $car->car_name = $request->car_name;
        $car->car_price = $request->car_price;
        $car->car_stock = $request->car_stock;
        $car->save();

        return redirect()->route('car.index')->with('success','Data Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        Transaction::where('car_id',$id)->delete();
        $car->delete();
        return back()->with('error','Data Successfully Deleted');
    }
}
