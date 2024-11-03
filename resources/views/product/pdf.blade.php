<table style="margin: 1 auto;" border="1" align="text-center" width="90%">
    <thead>
        <tr>
            <th>no</th>
            <th>name</th>
            <th>code</th>
            <th>amount</th>
            <th>price</th>
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
        </tr>
        @php
        $no++;
        @endphp
        @endforeach
    </tbody>
</table>