<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use App\Report;
use App\Voucher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {
        $category=Category::all()->count();
        $food=Item::where('category_id',1)->count();
        $drink=Item::where('category_id',2)->count();
        $latestItems=Item::take(5)->latest()->get();
        $lastestCategory=Category::take(4)->latest()->get();
        $totalCustomer=Voucher::count();
        $voucher=Report::take(5)->latest()->get();
        return view('home',compact('category','food','drink','latestItems','lastestCategory','totalCustomer','voucher'));
    }
}
