@extends("layouts.app")

@section("content")
    @if($user->admin)
        <h3><span class="small mr-2">administrator:</span></h3>
        <h1 class="mb-5"> {{$user->name}} {{$user->surname}}</h1>
    @else
        <h3><span class="small mr-2">user:</span></h3>
        <h1 class="mb-5">{{$user->name}} {{$user->surname}}</h1>
    @endif
    <div class="row">
        <div class="col-6">
            <dl>
                <dt>Name:</dt>
                <dd>{{$user->name}}</dd>

                <dt>Surname:</dt>
                <dd>{{$user->surname}}</dd>

                <dt>Job:</dt>
                <dd>{{$user->job}}</dd>

                <dt>Wage:</dt>
                <dd>{{$user->wage}}</dd>

                <dt>Mail:</dt>
                <dd>{{$user->email}}</dd>

                <dt>Room:</dt>
                <dd><a href="{{url("/room/".$user->roomRel->id)}}">{{$user->roomRel->name}}</a></dd>
            </dl>
            <br>
            @if(Auth::user()->admin)
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-dark">Update</a>
                <form class="d-inline" method="POST" action="{{route('user.destroy', $user->id)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="delete" />
                    <button type="submit" class="btn btn-primary">Delete</button>
                </form>
            @endif
        </div>
        <div class="col-6">
            <dl>
            <dt>Keys:</dt>
            <dd>
                @if(count($user->keyRel) > 0)
                    @foreach($user->keyRel as $key)
                        @if(Auth::user()->admin)
                            <form method="POST" action="{{route('deleteKey', $key->id)}}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete" />
                                <a href="{{url("/room/".$key->roomRel->id)}}">{{$key->roomRel->name}}</a>
                                <button type="submit" class="btn btn-sm">X</button>
                            </form>
                        @else
                            <div><a href="{{url("/room/".$key->roomRel->id)}}">{{$key->roomRel->name}}</a></div>
                        @endif
                    @endforeach
                @endif
                    <br/>
                @if(Auth::user()->admin)
                    <a href="{{url("/key/create?employee=").$user->id}}" class="btn btn-primary">Add Key</a>
                @endif
            </dd>
            </dl>
        </div>
    </div>
@endsection
