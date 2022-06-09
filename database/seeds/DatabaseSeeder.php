<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $period = \Carbon\CarbonPeriod::create('2022-06-1', '2023-06-30');
        foreach ($period as  $date){
            $dailyVoucher = new \App\Report();
            $dailyVoucher->date = $date->format("Y-m-d");
            $dailyVoucher->total=rand(10000,100000);
            $dailyVoucher->save();
        }
        // Iterate over the period
       foreach ($period as $date) {
           $dailyVoucher = new \App\Report();
           $dailyVoucher->date = $date->format("Y-m-d");
           $dailyVoucher->total=0;
           $dailyVoucher->save();
           for($v=1;$v<rand(10,20);$v++){
               $voucher = new \App\Voucher();
               $voucher->customer_name = Str::random(10);
               $voucher->invoice_number = uniqid();
               $voucher->save();
               $dailyVoucherTotal = 0;

               $totalCost = 0;

               for($i=1;$i<rand(10,50);$i++){
                   $item = \App\Item::where("id",rand(1,7))->first();
                   $quantity = rand(1,15);
                   $cost = $item->price * $quantity;
                   $totalCost += $cost;
                   factory(\App\VoucherList::class)->create([
                       "item_id"=> $item->id,
                       'item_name'=>$item->name,
                       "voucher_id" => $voucher->id,
                       "quantity"=> $quantity,
                       "price"=>$item->price,
                       "cost" => $cost,
                       "date" => $date->format("Y-m-d"),
                   ]);
               }

               $dailyVoucherTotal += $totalCost;
           }
           $dailyVoucher->update(["total"=>$dailyVoucherTotal]);
       }
         \App\Category::create([
         'name'=>'Food'
        ]);
        \App\Category::create([
            'name'=>'Cake'
        ]);
        \App\Category::create([
            'name'=>'BubbleTea'
        ]);
        \App\Category::create([
        'name'=>'Desert'
         ]);
        \App\Category::create([
            'name'=>'juice'
        ]);

        \App\Item::create([
                'name'=>'Chicken Rice',
                'price'=>2200,
                'photo'=>'default.png',
                'category_id'=>1,

        ]);
        \App\Item::create([
            'name'=>'Chocolate Cake',
            'price'=>1200,
            'photo'=>'default.png',
            'category_id'=>2,

        ]);
        \App\Item::create([
        'name'=>'Green Tea Bubble Tea',
        'price'=>1900,
        'photo'=>'default.png',
        'category_id'=>3,

    ]);
        \App\Item::create([
        'name'=>'Pasta',
        'price'=>3000,
        'photo'=>'default.png',
        'category_id'=>1,

    ]);
        \App\Item::create([
        'name'=>'Ice Cream',
        'price'=>1300,
        'photo'=>'default.png',
        'category_id'=>4,

    ]);
        \App\Item::create([
        'name'=>'Blue Berry Juice',
        'price'=>2100,
        'photo'=>'default.png',
        'category_id'=>5,

    ]);
        \App\Item::create([
        'name'=>'Strawberry Juice',
        'price'=>1800,
        'photo'=>'default.png',
        'category_id'=>5,

    ]);
        \App\Item::create([
        'name'=>'Strawberry Cake',
        'price'=>1200,
        'photo'=>'default.png',
        'category_id'=>2,

    ]);

    }
}
