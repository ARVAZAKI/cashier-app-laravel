<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        $category = Category::all();
        return view('masteritem',compact('item','category'));
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

        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $this->validate($request,[
            'category_id' => 'required',
            'name' => 'required',
            'prices' => 'required',
            'stock' => 'required'
        ],$messages);
        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'prices' => $request->prices,
            'stock' => $request->stock
        ]);
        return redirect('item');

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
        $item = Item::find($id);
        return view('edititem', compact('item'));
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
        $messages = [
            'required' => ':attribute harus diisi',
        ];
        $this->validate($request,[
            'category_id' => 'required',
            'name' => 'required',
            'prices' => 'required',
            'stock' => 'required'
        ],$messages);
        $item = Item::find($id);
        $item->category_id=$request->category_id;
        $item->name=$request->name;
        $item->prices=$request->prices;
        $item->stock=$request->stock;
        $item->update();
        return redirect('item');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function hapus($id){
        $data=Item::find($id)->delete();
        return redirect('item');
    }

}
