<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::doesntHave('cart')->where('stock', '>' , 0)->get()->sortBy('name');
        $cart = Item::has('cart')->get();
        return view('mastertransaction',[
            'item' => $item,
            'cart' => $cart
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::create([
        "item_id"=>$request->item_id,
        "qty"=>$request->qty
    ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Transaction::findOrFail($id);
        return view('detailtransaksi',compact('detail'));
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
        Cart::findOrFail($id)->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function history(){
        $history = Transaction::all()->sortByDesc('create_at');
        return view('history', compact('history'));
    }

    public function checkout(Request $request)
    {
        $tr = Transaction::create($request->all());

        foreach(Cart::all() as $carts){
            TransactionDetail::create([
                'transaction_id' => Transaction::latest()->first()->id,
                'item_id' => $carts->item_id,
                'quantity' => $carts->qty,
                'subtotal' => $carts->item->prices * $carts->qty
            ]);
        }
            Cart::truncate();
            return redirect(route('transaction.show', Transaction::latest()->first()->id));
    }
}
