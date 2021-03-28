@extends("layouts.app")

@section("content")
    <form method="POST" action="{{route('room.update', $room->id)}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="string" class="form-control" value="{{$room->name}}" id="name" name="name" placeholder="Enter name">
            <label for="number">Room Number</label>
            <input type="number" class="form-control" value="{{$room->no}}" id="number" name="number" placeholder="Enter room number">
            <label for="phone">Phone Number</label>
            <input type="number" class="form-control" value="{{$room->phone}}" id="phone" name="phone" placeholder="Enter phone number">
        </div>
        <input type="hidden" name="_method" value="PUT" />
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
