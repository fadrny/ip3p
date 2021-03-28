@extends("layouts.app")

@section("content")

    <form method="POST" action="{{route('user.store')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        <label for="surname">Surname</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname">
    </div>
    <div class="form-group">
        <label for="job">Job</label>
        <input type="text" class="form-control" id="job" name="job" placeholder="Enter job">
        <label for="wage">Wage</label>
        <input type="number" class="form-control" id="wage" name="wage" placeholder="Enter wage">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">

        <label for="mistnost">Vychozi mistnost</label>
        <select class="form-control" name="mistnost" id="mistnost">
            @foreach($rooms as $room)
                <option value="{{$room->id}}">{{$room->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" value="1" name="admin" id="admin">
        <label class="form-check-label" for="admin">is admin</label>
    </div>
    <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
