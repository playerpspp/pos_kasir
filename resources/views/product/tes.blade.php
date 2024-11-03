<head>
    <title>Laporan Buku.pdf</title>
    <link rel="icon" href="/images/favicon.png">
</head>

<h3 align="center">Laporan Buku dari tanggal {{ date('Y-m-d H:i:s', strtotime($start)) }}
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
        @foreach ($books as $book)
        <tr>
            <td>{{$no}}</td>
            <td>{{ $book->name }}</td>
            <td>{{ $book->code }}</td>
            <td>{{ $book->amount }}</td>
            <td>Rp {{ $book->price }}</td>

            <td>
                @if ($transIn->has($book->id))
                {{ $transIn[$book->id]->total_amount }}
                @endif
            </td>
            <td>@if ($transIn->has($book->id))
                Rp {{ $transIn[$book->id]->min_price }} - Rp {{ $transIn[$book->id]->max_price }}
                @endif
            </td>
            <td>
                @if ($transOut->has($book->id))
                {{ $transOut[$book->id]->total_amount }}
                @endif
            </td>
            <td>
                @if ($transOut->has($book->id))
                Rp {{ $transOut[$book->id]->min_price }} - Rp {{ $transOut[$book->id]->max_price }}</td>
                @endif

            </tr>
            @php
            $no++;
            @endphp
            @endforeach
        </tbody>
    </table>