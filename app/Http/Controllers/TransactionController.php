<?php

namespace App\Http\Controllers;

use App\Car;
use App\Transaction;
use Mail;
use App\Mail\TransactionInvoice;
use Validator;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
        return view('pages.transaction.index',[
            'transaction' => Transaction::all()
        ]);
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
        $car = Car::where('id',$request->car_id)->first();
        $rules = array(
            'customer_email' => 'required|email|max:255',
            'customer_name' => 'required|max:255',
            'customer_phone' => 'required|numeric',
            'car_id' => 'required|numeric',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            $messages = $validator->messages();
            return back()->with('error','Please check the form again');
        }else{
            $transaction = new Transaction();
            $transaction->car_id = $request->car_id;
            $transaction->customer_email = $request->customer_email;
            $transaction->customer_phone = $request->customer_phone;
            $transaction->customer_name = $request->customer_name;
            $transaction->total_price = $car->car_price;
            $transaction->save();

            $car->update([
                'car_stock' => $car->car_stock - 1
            ]);
    
            // Send Email to Customer
            Mail::to($transaction->customer_email)->send(
                new TransactionInvoice($transaction)
            );
    
            return redirect()->route('transaction.index')->with('success','Data Transaction Successfully Added');
        }
            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transaction::where('id',$id)->first();
        $car = Car::where('id',$transaction->car_id)->first();
        
        $car->update([
            'car_stock' => $car->car_stock + 1
        ]);

        $transaction->delete();
        return back()->with('error','Data Successfully Deleted');
    }
}
