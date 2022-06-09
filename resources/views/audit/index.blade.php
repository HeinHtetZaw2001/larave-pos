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
                                    <h5 class="text-center text-muted"> Daily Sell List</h5>
                                </div>
                                <div class="">
                                    <button id="report" class="btn btn-outline-info btn-sm ">Add to Monthly List</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mb-1">
                                        <select name="date" id="" class="form-control select-day ">
                                            <option value="" selected disabled>---Please Choice---</option>
                                            <option value="01" @if(now()->format('d') == '01') selected @endif>1</option>
                                            <option value="02" @if(now()->format('d') == '02') selected @endif>2</option>
                                            <option value="03" @if(now()->format('d') == '03') selected @endif>3</option>
                                            <option value="04" @if(now()->format('d') == '04') selected @endif>4</option>
                                            <option value="05" @if(now()->format('d') == '05') selected @endif>5</option>
                                            <option value="06" @if(now()->format('d') == '06') selected @endif>6</option>
                                            <option value="07" @if(now()->format('d') == '07') selected @endif>7</option>
                                            <option value="08" @if(now()->format('d') == '08') selected @endif>8</option>
                                            <option value="09" @if(now()->format('d') == '09') selected @endif>9</option>
                                            <option value="10" @if(now()->format('d') == '10') selected @endif>10</option>
                                            <option value="11" @if(now()->format('d') == '11') selected @endif>11</option>
                                            <option value="12" @if(now()->format('d') == '12') selected @endif>12</option>
                                            <option value="13" @if(now()->format('d') == '13') selected @endif>13</option>
                                            <option value="14" @if(now()->format('d') == '14') selected @endif>14</option>
                                            <option value="15" @if(now()->format('d') == '15') selected @endif>15</option>
                                            <option value="16" @if(now()->format('d') == '16') selected @endif>16</option>
                                            <option value="17" @if(now()->format('d') == '17') selected @endif>17</option>
                                            <option value="18" @if(now()->format('d') == '18') selected @endif>18</option>
                                            <option value="19" @if(now()->format('d') == '19') selected @endif>19</option>
                                            <option value="20" @if(now()->format('d') == '20') selected @endif>20</option>
                                            <option value="21" @if(now()->format('d') == '21') selected @endif>21</option>
                                            <option value="22" @if(now()->format('d') == '22') selected @endif>22</option>
                                            <option value="23" @if(now()->format('d') == '23') selected @endif>23</option>
                                            <option value="24" @if(now()->format('d') == '24') selected @endif>24</option>
                                            <option value="25" @if(now()->format('d') == '25') selected @endif>25</option>
                                            <option value="26" @if(now()->format('d') == '26') selected @endif>26</option>
                                            <option value="27" @if(now()->format('d') == '27') selected @endif>27</option>
                                            <option value="28" @if(now()->format('d') == '28') selected @endif>28</option>
                                            <option value="29" @if(now()->format('d') == '29') selected @endif>29</option>
                                            <option value="30" @if(now()->format('d') == '30') selected @endif>30</option>
                                            <option value="31" @if(now()->format('d') == '31') selected @endif>31</option>



                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-1">
                                        <select name="month" id="" class="form-control select-month ">
                                            <option value="" selected>---Please Choice---</option>
                                            <option value="01" @if(now()->format('m') == '01') selected @endif>January</option>
                                            <option value="02" @if(now()->format('m') == '02') selected @endif>February</option>
                                            <option value="03" @if(now()->format('m') == '03') selected @endif>March</option>
                                            <option value="04" @if(now()->format('m') == '04') selected @endif>April</option>
                                            <option value="05" @if(now()->format('m') == '05') selected @endif>May</option>
                                            <option value="06" @if(now()->format('m') == '06') selected @endif>June</option>
                                            <option value="07" @if(now()->format('m') == '07') selected @endif>July</option>
                                            <option value="08" @if(now()->format('m') == '08') selected @endif>August</option>
                                            <option value="09" @if(now()->format('m') == '09') selected @endif>September</option>
                                            <option value="10" @if(now()->format('m') == '10') selected @endif>October</option>
                                            <option value="11" @if(now()->format('m') == '11') selected @endif>November</option>
                                            <option value="12" @if(now()->format('m') == '12') selected @endif>December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <select  id="" class="form-control select-year ">
                                            {{--                                <option value="">S</option>--}}
                                            @for($i=0;$i<9;$i++)
                                                <option value="{{now()->addYear($i)->format('Y')}}" @if(now()->format('Y') == now()->addYear($i)->format('Y') ) selected @endif>{{now()->addYear($i)->format('Y')}}</option>
                                            @endfor
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn  btn-m btn-block btn-search btn-primary" onclick="overviewtable()"> Search</button>
                                </div>
                            </div>
                            <div class="table-overview">

                            </div>
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
            let date=document.querySelector('#date').innerText  ;

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
        overviewtable()
        function overviewtable(){
            let month= $('.select-month').val();
            let year= $('.select-year').val();
            let date= $('.select-day').val();
            console.log(year+'-'+month+'-'+date)
            $.ajax({
                url:`/daily-sell-overview/table? date=${date} & month=${month} &year=${year}`,
                type:'GET',
                success:function (res){
                    $('.table-overview').html(res);
                }

            });

        };
    </script>
@endsection
