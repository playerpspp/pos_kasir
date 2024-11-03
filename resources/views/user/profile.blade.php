@include('head')

@include('nav')
<head>
    <title>Profile</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-title">
                            <h3>Ubah Profile</h3>

                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form autocomplete="on" action="/profile/actProfile" method="POST"
                                enctype="multipart/form-data">                        
                                @csrf
                                @if($errors->any())
                                {!! implode('', $errors->all('<div style="color: red;">:message</div>')) !!}
                                @endif
                                <!-- <div class="form-group">
                                    <label>Photo Profile</label> <br>
                                    @if(isset(Auth::user()->photo))
                  
                                  <img class="m-r-10 avatar-img" src="{{ asset('storage/images/avatar/'. Auth::user()->photo) }}" alt="" />
                                  @else()
                                  <img class="m-r-10 avatar-img" src="/images/avatar/default.jpg" alt="" />
                                  @endif
                                  <input class="form-control" type="file" id="photo" name="photo">
                              </div> -->

                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username" value="{{$user->name}}" name="username" class="form-control" placeholder="Username">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" id="email" value="{{$user->email}}" name="email" class="form-control" placeholder="Email">
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>
                        </form><br>
                        <h5><a href="/profile/password">Mau ganti password?</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('foot')