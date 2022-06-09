<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategory;
use App\Http\Requests\EditCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }
        public function ssd(){
        $category=Category::query();
            return Datatables::of($category)
                ->editColumn('created_at',function ($each){
                   return Carbon::parse($each->created_at)->format('Y M d');
                })

                ->addColumn('action',function($each){
                        $action_edit= '<a  href="'.route('category.edit',$each->id).'" class="text-warning"><i class="fas fa-user-edit"></i></a>';
                        $action_del='<a href="#" class="text-danger delete-category" data-id='.$each->id.'><i class="fas fa-trash-alt"></i></a>';

                    return '<div class="action-icon">'.$action_edit.$action_del.'</div>';
                })
                ->addColumn('plus-icon',function (){
                    return null;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategory $request)
    {
      $category=New Category();
      $category->name=$request->name;
      $category->save();
      return redirect()->route('category.index');
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

        $category=Category::findOrFail($id);
        return view('category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCategory $request, $id)
    {
        $category=Category::findOrFail($id);
        $category->name=$request->name;
        $category->update();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $category=Category::findOrFail($id);
       $category->delete();
       return  'success';
    }
}
