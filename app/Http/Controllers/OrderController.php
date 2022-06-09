<?php

namespace App\Http\Controllers;

use App\Item;
use App\Voucher;
use App\VoucherList;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $items=Item::all();
        return view('welcome',compact('items'));
    }
    public function order(Request $request){
        $voucher=New Voucher();
        $voucher->customer_name=$request->customer_name;
        $voucher->invoice_number=$request->invoice_number;
        $voucher->save();
        $lists=$request->voucher_list;
        foreach($lists as $list){
             $item = Item::find($list['item_id']);
            $voucherList = new VoucherList();
            $voucherList->voucher_id = $voucher->id;
            $voucherList->item_id = $list['item_id'];
            $voucherList->quantity = $list['quantity'];
            $voucherList->item_name = $item->name;
            $voucherList->price =$item->price;
            $voucherList->cost = $list['quantity'] * $item->price;
            $voucherList->date=now()->format('Y-m-d');
            $voucherList->save();
        }
        return[
            'status'=>'success',
            'message'=>'Your Order has been CheckOut',
        ];

    }
}
