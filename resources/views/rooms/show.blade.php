@extends("layouts.app")

@section("content")
    <h3><span class="small mr-2">room:</span></h3>
    <h1>{{$room->name}}</h1>
    <div class="row">
        <div class="col-6">
            <dl>
                <dt>Room number:</dt>
                <dd>{{$room->no}}</dd>

                <dt>Room name:</dt>
                <dd>{{$room->name}}</dd>

                <dt>Phone:</dt>
                @if($room->phone != null)
                    <dd>{{$room->phone}}</dd>
                @endif

                <dt>Users:</dt>
                <dd>
                    @if(count($room->userRel) > 0)
                        @foreach($room->userRel as $user)
                            <a href="{{url("/user/".$user->id)}}">{{$user->surname}} {{$user->name}}</a><br>
                        @endforeach
                    @endif
                </dd>

                <dt>Average wage:</dt>
                <dd>
                    {{round($average)}},-
                </dd>
            </dl>
            <bt/>
            @if(Auth::user()->admin)
                <a href="{{ route('room.edit', $room->id) }}" class="btn btn-dark">Update</a>
                <form class="d-inline" method="POST" action="{{route('room.destroy', $room->id)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete" />
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
            @endif
        </div>
        <div class="col-6">
            <dt>Klíče</dt>
            <dd>
                @if(count($room->keyRel) > 0)
                    @foreach($room->keyRel as $key)
                        <a href="{{url("/user/".$key->userRel->id)}}">{{$key->userRel->surname}} {{$key->userRel->name}}</a><br>
                    @endforeach
                @endif
                <br/>
                @if(Auth::user()->admin)
                    <a href="{{url("/key/create?room=").$room->id}}" class="btn btn-primary">Add Key</a>
                @endif
            </dd>
        </div>
    </div>
@endsection
