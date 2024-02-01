@include('head')

@include('nav')
<head>
    <title>New {{$departments->name}} Member</title>
</head>

<div id="feedback-form">
    <div>
        <h2>INPUT {{$departments->name}} MEMBER</h2>
        @if($errors->any())
        {!! implode('', $errors->all('<div id=alert-box>:message</div>')) !!}
        @endif

        <form autocomplete="on" action="/departments/members/actinput" id="form_input" method="POST">
            @csrf
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" placeholder="Name" value="{{old('name')}}" required><br>

            <input type="hidden" id="department" name="department" value="{{$departments->id}}" required>


            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" placeholder="username" value="{{old('name')}}" required><br>


            <label for="password">password</label><br>
            <input type="text" id="password" name="password" placeholder="password" value="{{old('password')}}" required><br>

            <label for="level">level:</label><br>
            <select type="text" id="level" name="level" value="{{old('level')}}" required>
                <option>Choose Level</option>
                @foreach ($levels as $level)
                <option value="{{$level->id}}">{{$level->level}}</option>
                @endforeach
            </select><br>


            <label for="email">email</label><br>
            <input type="email" id="email" name="email" placeholder="xx@gmail.com" value="{{old('email')}}" required><br>

            <button type="submit" id="submitBtn" >Submit</button>
        </form>
    </div>
</div>

<script type="text/javascript">
    document.getElementById("submitBtn").addEventListener("click", function(event){
        event.preventDefault();
        this.disabled = true;
        document.getElementById("form_input").submit();});
    </script>

    @include('foot')