@include('head')

@include('nav')
<head>
    <title>Ganti Password</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-title">
                            <h3>Ubah Password</h3>

                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form autocomplete="off" action="/profile/actPassword" method="POST">
                                    @csrf
                                    @if($errors->any())
                                    {!! implode('', $errors->all('<div style="color: red;">:message</div>')) !!}
                                    @endif

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label>Password confirm</label>
                                        <input type="password" id="password" name="password_confirmation" class="form-control" placeholder="Password Confirm">
                                    </div>

                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form><br>
                                <h5><a href="/profile/">Mau ganti Profil?</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('foot')