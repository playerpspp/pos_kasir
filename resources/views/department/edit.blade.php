@include('head')

@include('nav')

<head>
    <title>Edit Department</title>
</head>

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10">

                    <a onclick="history.back()"><button class="btn btn-primary">
                        <i class="ti-arrow-left"></i>
                    </button></a>

                    <div class="card">
                        <div class="card-title">
                            <h3>EDIT Department {{$department->name}}</h3>
                        </div>

                        <div class="card-body">
                            <div class="basic-form"> 
                                @if($errors->any())
                                {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
                                @endif

                                <form autocomplete="on" action="/departments/update" id="form_input" method="POST">
                                    @csrf

                                    <input type="hidden" id="id" name="id" value="{{ $department->id }}">


                                    <div class="form-group">
                                        <label for="department">Department Name:</label><br>
                                        <input type="text" class="form-control" id="department" name="department" value="{{$department->name}}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="head">Current Head:</label><br>
                                        @if(isset($department->user))
                                        
                                        @foreach ($work as $works)
                                        @if($works->user_id == $department->head_id)

                                        <input type="text" class="form-control" id="head" name="head" placeholder="head" value="{{ $works->name }}" readonly><br>
                                        <div class="form-group">
                                            <input type="hidden" id="head_id" name="head_id" value="{{ $department->head_id }}"></div>

                                            @endif

                                            @endforeach

                                            @else

                                            <input type="text" class="form-control" id="head" name="head" placeholder="head" value="No one" readonly><br>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="worker">New Head:</label><br>
                                            <select type="text" class="form-control" id="worker" name="worker" required>
                                                @if(isset($department->worker))

                                                <option value="{{$department->head_id}}">{{ $department->worker->name }}</option>

                                                @else
                                                <option>Pilih Pekerja Untuk menjadi Head</option>
                                                @endif

                                                @foreach ($work as $works)
                                                <option value="{{$works->user_id}}">{{$works->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <button type="submit" class="btn btn-success" >Submit</button>

                                    </form>
                                </div>
                            </div>
                        </div>

                        @include('foot')