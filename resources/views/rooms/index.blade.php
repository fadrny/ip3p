@extends("layouts.app")

@section("content")
    <h1 class="text-center">Rooms</h1>
    @if(count($rooms) > 0)
        <table class="table table-light mt-2">
            <thead class="highlight">
            <th>Name</th>
            <th>no.</th>
            <th>phone</th>
            </thead>
            <tbody>
            @foreach($rooms as $room)
                <tr>
                    <td><a href="{{url("/room/".$room->id)}}">{{$room->name}}</a></td>
                    <td>{{$room->no}}</td>
                    <td>{{$room->phone}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    @if(Auth::user()->admin)
        <a href="{{url("/room/create")}}" class="btn btn-dark d-flex justify-content-center">new room</a>
    @endif
@endsection
