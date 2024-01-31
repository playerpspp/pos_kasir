@include('head')

@include('nav')
<head>
    <title>Dashboard</title>
</head>

<!-- /# row -->
<section id="main-content">
    <div class="row">
     <div class="col-lg-12">
        <div class="card">
            <div class="card-title pr">
                <h4>Apa yang Ingin dilakukan?</h4>
            </div>
            <br>
            <div class="card-body">
                @if (auth::user()->level->level != 'guest' && auth::user()->level->level != 'pekerja')
                <a href="/books/input" class="btn btn-warning btn-box">Mendata Buku baru</a>
                @endif
            </div>
            <br>
            <div class="card-body">
                @if (auth::user()->level->level != 'guest' )
                <a href="/transaction_in/input" class="btn btn-primary btn-box">Mendata Pemasukan Buku</a>
                <a href="/transaction_out/input" class="btn btn-success btn-box">Mendata Penjualan Buku</a>
                @endif

                
            </div>
        </div>
    </div>
</div>
</div> 


@include('foot')