@extends('layouts.master')
@section('title','category')

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">

                <div class="col-12 col-md-10  ">
                    <div class="card mb-5">
                        <div class="card-header ">
                           <div class="d-flex align-items-center justify-content-between">
                               <div>
                                   <h5 class="text-center text-muted"> Products for sale today list
                                   </h5>
                               </div>
                               <div class="">
{{--                                   <button id="report" class="btn btn-outline-info btn-sm ">Report to Audit</button>--}}
                                   <a href="{{route('daily.report.pdf')}}" target="_blank" class="btn btn-outline-success btn-sm ">Export  PDF</a>
                               </div>
                           </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-bordered table-responsive-sm">
                                <thead>
                                <tr class="text-center">
                                    <td>No</td>
                                    <td>Date</td>
                                    <td>Name</td>
                                    <td>Unit Price</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($totalQuantity as $key=>$report)
                                    <tr class="text-center">
                                        <td>{{$loop->iteration}}</td>
                                        <td id="date">{{now()->format('Y-M-D')}}</td>
                                        <td>{{$key}}</td>
                                        @php
                                        $unitPrice=\App\VoucherList::where('item_name',$key)->first();
                                        @endphp
                                        <td>{{$unitPrice->price}}</td>
                                        @php
                                            $quantity=\App\VoucherList::where('item_name',$key)->sum('quantity');
                                        @endphp
                                        <td>{{$quantity}}</td>
                                        <td class="price" >{{$unitPrice->price * $quantity}}</td>
                                    </tr>
                                @empty
                                    <p>terasdfasdf</p>
                                @endforelse


                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center">Daily Income</td>
                                    <td id="total" class="text-center">{{$total}}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>

        $("#report").on('click',function(){
            let d=document.querySelector('#total').innerText;
            // let totalPrice= $("#total").text();
            let totalPrice=document.querySelector('#total').innerText;
            let date=document.querySelector('#date').innerText
            // let date=$('#date').text();

            $.ajax({
                url:'/dailyreport ',
                method:'POST',
                data:{
                    report_date :date ,
                    total : totalPrice,

                },
                success:function(res){
                    if(res.status == 'success'){

                        alert("hello")
                    }
                }
            });
        })

    </script>
@endsection
