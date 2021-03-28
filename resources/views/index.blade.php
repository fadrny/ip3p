@extends("layouts.app")

@section("content")
    <div class="jumbotron">
        <h1 class="display-4">Vítejte v prohlížeči databáze!</h1>
        <hr class="my-4">
        <p class="lead d-inline">
            <a class="btn btn-primary btn-lg" href="{{route('user.index')}}" role="button">Zobrazit seznam zaměstnanců</a>
        </p>
        <p class="lead d-inline">
            <a class="btn btn-primary btn-lg" href="{{route('room.index')}}" role="button">Zobrazit seznam místností</a>
        </p>
    </div>
@endsection
