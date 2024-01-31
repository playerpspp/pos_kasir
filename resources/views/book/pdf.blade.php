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
        @foreach ($books as $book)
        <tr>
            <td>{{$no}}</td>
            <td>{{ $book->name }}</td>
            <td>{{ $book->code }}</td>
            <td>{{ $book->amount }}</td>
            <td>Rp {{ $book->price }}</td>
        </tr>
        @php
        $no++;
        @endphp
        @endforeach
    </tbody>
</table>