<head>
    <title>Laporan Pemasukan.pdf</title>
    <link rel="icon" href="/images/favicon.png">
</head>
<h3 align="center">Laporan Pemasukan dari tanggal {{ date('Y-m-d H:i:s', strtotime($start)) }}
 sampai {{ date('Y-m-d H:i:s', strtotime($end)) }}
</h3>
<table style="margin: 1 auto;" border="1" align="text-center" width="90%">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Price/product</th>
            <th>Total Price</th>
        </tr>
    </thead>
    @php
    $no = 0;
    $no++;
    @endphp

    <tbody align="center">
        @foreach ($details as $detail)
        <tr>
            <td>{{$no}}</td>
            <td>{{ $detail->products->name }}</td>
            <td>{{ $detail->amount}}</td>
            <td>Rp {{$detail->price}}</td>
            <td>Rp {{ $totalPrices[$detail->id] }}</td>

        </tr>
        @php
        $no++;
        @endphp
        @endforeach
    </tbody>
    
</table>
