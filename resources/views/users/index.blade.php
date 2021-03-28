@extends("layouts.app")

@section("content")
    <h1 class="text-center">Employees</h1>
    @if(count($users) > 0)
        <table class="table table-light mt-2">
            <thead class="highlight">
            <tr><th>Name</th><th>Job</th><th>Phone</th><th>Room</th></tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td><a href="{{url("/user/".$user->id)}}">{{$user->surname . " " . $user->name}}</a></td>
                    <td>{{$user->job}}</td>
                    <td>{{$user->roomRel->phone}}</td>
                    <td>{{$user->roomRel->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Žádný zaměstnanec</p>
    @endif
    @if(Auth::user()->admin)
    <a href="{{url("/user/create")}}" class="btn btn-dark d-flex justify-content-center">new user</a>
    @endif
@endsection
