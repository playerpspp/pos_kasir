@include('head')

@include('nav')

<head>
    <title>Edit Worker</title>
</head>

<div id="feedback-form">
    <div>
        <h2>EDIT WORKER {{$work->name}}</h2>
        @if($errors->any())
        {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
        @endif
        <form autocomplete="on" action="/workers/update" method="POST">
            @csrf

            <input type="hidden" id="id" name="id" value="{{ $user->id }}">

            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" placeholder="Name" value="{{ $work->name }}" required><br>

            <label for="department">department:</label><br>
            <select type="text" id="department" name="department" value="{{$work->department_id}}" required>
                <option value="{{$work->department_id}}">Choose Level</option>
                @foreach ($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select><br>

            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="username" value="{{ $user->name }}" required><br>
            
            <label for="level">level:</label><br>
            <select type="text" id="level" name="level" value="{{old('level')}}" required>
                <option value="{{ $user->level_id}}">{{ $user->level->level }}</option>
                @foreach ($levels as $level)
                <option value="{{$level->id}}">{{$level->level}}</option>
                @endforeach
            </select><br>

            <label for="email">email</label><br>
            <input type="email" id="email" name="email" value="{{ $user->email }}" readonly><br>

            <br>

            <button type="submit" >Submit</button>

        </form>
    </div>
</div>

@include('foot')