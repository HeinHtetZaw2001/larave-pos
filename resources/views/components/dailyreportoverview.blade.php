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
            <td id="date">{{now()->format('Y-m-d')}}</td>
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
{{--    @if(isset($reports->date))--}}
        <tfoot>
        <tr>
            <td colspan="5" class="text-center">Daily Income</td>
            <td id="total" class="text-center">{{$total}}MMK</td>
        </tr>
        </tfoot>
{{--    @else--}}
{{--        <tfoot>--}}
{{--        <tr>--}}
{{--            <td colspan="6" class="text-center">There is No Data</td>--}}
{{--        </tr>--}}
{{--        </tfoot>--}}
{{--    @endif--}}



</table>
<script>

</script>
