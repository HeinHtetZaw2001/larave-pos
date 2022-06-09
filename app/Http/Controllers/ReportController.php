<?php

namespace App\Http\Controllers;

use App\Report;
use App\VoucherList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports=VoucherList::where('date',now()->format('Y-m-d'))->get();
        $totalQuantity=$reports->groupBy('item_name')->map(function ($each){
            return $each->sum('cost');
        });
        $total=DB::table('voucher_lists')->where('date',now()->format('Y-m-d'))->sum('cost');
       return view('report.index',compact('reports','total','totalQuantity'));
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
       $report=New Report();
       $report->date=$request->report_date;
        $report->total=$request->total;
        $report->save();
        return[
            'status'=>'success',
            'message'=>'Your Order has been CheckOut',
        ];

    }

    public function  OverTable(Request $request){

        $year=$request->year;
        $month=$request->month;
        $date=$request->date;
        $nowdate=$year.'-'.$month.'-'.$date;
        $reports=VoucherList::whereDay('date',$date)->whereMonth('date',$month)->whereYear('date',$year)->get();
        $total=DB::table('voucher_lists')->where('date',$nowdate)->sum('cost');
        $totalQuantity=$reports->groupBy('item_name')->map(function ($each){
            return $each->sum('cost');
        });
        return view('components.dailyreportoverview',compact('reports','total','totalQuantity'))->render();

    }
    public function exportpdf(){
        $reports=VoucherList::where('date',now()->format('Y-m-d'))->get();
        $total=DB::table('voucher_lists')->where('date',now()->format('Y-m-d'))->sum('cost');
        $pdf = PDF::loadView('pdf.daily-report',['reports'=>$reports,'total'=>$total]);
        return $pdf->stream('daily-report.pdf');

    }
    public function daily(){
        $daily=Report::all();
        return view('audit.index');
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
