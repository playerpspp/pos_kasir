<head>
    <title>Laporan Product.pdf</title>
    <link rel="icon" href="/images/favicon.png">
</head>

<h3 align="center">Laporan Product dari tanggal {{ date('Y-m-d H:i:s', strtotime($start)) }}
 sampai {{ date('Y-m-d H:i:s', strtotime($end)) }}
</h3>
<table style="margin: 1 auto;" border="1" align="text-center" width="90%">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Code</th>
            <th>Stocks</th>
            <th>Current Price</th>
            <th>Bought</th>
            <th>Price/bought</th>
            <th>Sold</th>
            <th>Price/Sold</th>
        </tr>
    </thead>
    @php
    $no = 0;
    $no++;
    @endphp
    <tbody align="center">
        @foreach ($products as $product)
        <tr>
            <td>{{$no}}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->code }}</td>
            <td>{{ $product->amount }}</td>
            <td>Rp {{ $product->price }}</td>

            <td>
                @if ($transIn->has($product->id))
                {{ $transIn[$product->id]->total_amount }}
                @endif
            </td>
            <td>@if ($transIn->has($product->id))
                Rp {{ $transIn[$product->id]->min_price }} - Rp {{ $transIn[$product->id]->max_price }}
                @endif
            </td>
            <td>
                @if ($transOut->has($product->id))
                {{ $transOut[$product->id]->total_amount }}
                @endif
            </td>
            <td>
                @if ($transOut->has($product->id))
                Rp {{ $transOut[$product->id]->min_price }} - Rp {{ $transOut[$product->id]->max_price }}</td>
                @endif

            </tr>
            @php
            $no++;
            @endphp
            @endforeach
        </tbody>
    </table>