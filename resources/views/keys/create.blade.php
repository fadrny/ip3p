@extends("layouts.app")

@section("content")
    <h1>New Key</h1>
    <br/>

    {!! Form::open(['action' => "App\Http\Controllers\KeyController@store", "method" => "POST"]) !!}
    <div>
        <div class="form-check d-inline">
            {{Form::label("User:")}}
            {{Form::select('user', $users, $default)}}
        </div>
        <div class="form-check d-inline"
            {{Form::label("Room:")}}
            {{Form::select('room', $rooms)}}
        </div>
        {{Form::submit("Assign", ["class" => "btn btn-dark d:inline ml-4"])}}
        {!! Form::close() !!}
    </div>

@endsection
