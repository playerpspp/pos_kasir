@include('head')

@include('nav')
<head>
    <title>Laporan</title>
</head>

<!-- /# row -->
<section id="main-content">
    <div class="row">
       <div class="col-lg-12">
           @if($errors->any())
           {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
           @endif
           <div class="card">
            <div class="card-title pr">
                <h4>Laporan Buku</h4>
            </div>
            <br>
            <div class="card-body">

                <form id="Laporan"  method="post" target="_blank">
                    @csrf
                    <label for="start_date">Start Date:</label>
                    <input required class="form-control" type="datetime-local" id="start_date" name="start_date">
                    <label for="end_date">End Date:</label>
                    <input required class="form-control" type="datetime-local" id="end_date" name="end_date"><br>
                    <button type="button" class="btn btn-danger" onclick="generatePDF()">PDF</button>
                    <button type="button" class="btn btn-success" onclick="generateExcel()">Excel</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="row">
   <div class="col-lg-12">
    <div class="card">
        <div class="card-title pr">
            <h4>Laporan Pemasukan Buku</h4>
        </div>
        <br>
        <div class="card-body">

            <form id="Laporan_in"  method="post" target="_blank">
                @csrf
                <label for="start_date">Start Date:</label>
                <input required class="form-control" type="datetime-local" id="start_date" name="start_date">
                <label for="end_date">End Date:</label>
                <input required class="form-control" type="datetime-local" id="end_date" name="end_date"><br>
                <button type="button" class="btn btn-danger" onclick="generatePDFIn()">PDF</button>
                <button type="button" class="btn btn-success" onclick="generateExcelIn()">Excel</button>
            </form>

        </div>
    </div>
</div>
</div>

<div class="row">
   <div class="col-lg-12">
    <div class="card">
        <div class="card-title pr">
            <h4>Laporan Penjualan Buku</h4>
        </div>
        <br>
        <div class="card-body">

            <form id="Laporan_out"  method="post" target="_blank">
                @csrf
                <label for="start_date">Start Date:</label>
                <input required class="form-control" type="datetime-local" id="start_date" name="start_date">
                <label for="end_date">End Date:</label>
                <input required class="form-control" type="datetime-local" id="end_date" name="end_date"><br>
                <button type="button" class="btn btn-danger" onclick="generatePDFOut()">PDF</button>
                <button type="button" class="btn btn-success" onclick="generateExcelOut()">Excel</button>
            </form>

        </div>
    </div>
</div>
</div>
</div> 

<script>
    //product
  function generatePDF() {
    var form = document.getElementById("Laporan");
    form.action = "/products/pdf";
    form.submit();
}
function generateExcel() {
    var form = document.getElementById("Laporan");
    form.action = "/products/excel";
    form.submit();
}
    //transaction_in
function generatePDFIn() {
    var form = document.getElementById("Laporan_in");
    form.action = "/transaction_in/pdf";
    form.submit();
}
function generateExcelIn() {
    var form = document.getElementById("Laporan_in");
    form.action = "/transaction_in/excel";
    form.submit();
}
    //transaction_out
function generatePDFOut() {
    var form = document.getElementById("Laporan_out");
    form.action = "/transaction_out/pdf";
    form.submit();
}
function generateExcelOut() {
    var form = document.getElementById("Laporan_out");
    form.action = "/transaction_out/excel";
    form.submit();
}
</script>

@include('foot')