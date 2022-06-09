<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF DownLoad</title>

    <style>
        body{
            padding: 30px;
        }
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<table class="table table-striped">
    <thead>
    <tr class="text-center">
        <th>NO</th>
        <th>Date</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Cost</th>
    </tr>
    </thead>
    <tbody>
   @foreach($reports as $report)
       <tr class="text-center">
           <td>{{$loop->iteration}}</td>
           <td>{{$report->date}}</td>
           <td>{{$report->item_name}}</td>
           <td>{{$report->price}}</td>
           <td>{{$report->quantity}}</td>
           <td class="price">{{$report->price * $report->quantity}}</td>

       </tr>
   @endforeach
    <tfoot>
    <tr>
        <td colspan="5" class="text-center">Daily Income</td>
        <td id="total" class="text-center">{{$total}}</td>
    </tr>
    </tfoot>
    </tbody>
</table>

</body>
</html>
