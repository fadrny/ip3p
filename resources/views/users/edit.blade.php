@extends("layouts.app")

@section("content")
    <form method="POST" action="{{route('user.update', $user->id)}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email" placeholder="Enter email">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{$user->name}}" id="name" name="name" placeholder="Enter name">
            <label for="surname">Surname</label>
            <input type="text" class="form-control" value="{{$user->surname}}" id="surname" name="surname" placeholder="Enter surname">
        </div>
        <div class="form-group">
            <label for="job">Job</label>
            <input type="text" class="form-control" value="{{$user->job}}" id="job" name="job" placeholder="Enter job">
            <label for="wage">Wage</label>
            <input type="number" class="form-control" value="{{$user->wage}}" id="wage" name="wage" placeholder="Enter wage">
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
        <input type="hidden" name="_method" value="PUT" />
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
