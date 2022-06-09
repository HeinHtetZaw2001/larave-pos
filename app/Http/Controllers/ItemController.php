<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ItemCreate;
use App\Http\Requests\ItemEdit;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Item.index');
    }

    public function ssd(){
        $item=Item::with('getcategory')->get();
            return Datatables::of($item)
                ->editColumn('category_id',function ($each) {
                    return $each->getcategory->name;
                })
                ->editColumn('price',function ($each) {
                    return $each->price.'&nbsp &nbsp MMK' ;
                })
                ->editColumn('created_at',function ($each){
                    return Carbon::parse($each->created_at)->format('D-M-Y');
                })
                ->addColumn('plus-icon',function (){
                    return null;
                })
                ->addColumn('action',function($each){
                    $action_edit= '<a  href="'.route('item.edit',$each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                    $action_del='<a href="#" class="text-danger delete-item" data-id='.$each->id.'><i class="fas fa-trash-alt"></i></a>';

                    return '<div class="action-icon">'.$action_edit.$action_del.'</div>';
                })
                ->rawColumns(['action','price'])
                ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('Item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCreate $request)
    {
       $item=new Item();
       $item->name=$request->name;
       $item->category_id=$request->category_id;
       $item->price=$request->price;
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $img_name=uniqid().'.'.$file->getClientOriginalExtension();
            $dir='/public/item';
            $file->storeAs($dir,$img_name);
        }
        $item->photo=$request->file('photo')? $img_name : null;
        $item->save();
        return redirect()->route('item.index');
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
        $item=Item::findOrFail($id);
        $categories=Category::all();
        return view('Item.edit',compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemEdit $request, $id)
    {
        $item=Item::findOrFail($id);
       $item->name=$request->name;
       $item->price=$request->price;
       $item->category_id=$request->category_id;
       if($request->hasFile('photo')){
           Storage::delete("public/item/" . $item->photo);
           $file=$request->file('photo');
           $imgName=uniqid().'.'.$file->getClientOriginalExtension();
           $dir='/public/item/';
           $file->storeAs($dir,$imgName);
       }
       $item->photo=$request->file('photo')? $imgName : $item->photo;;
       $item->update();
       return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $item=Item::findOrFail($id);
       $item->delete();
       return 'success';
    }
}
