@extends("layouts.app")

@section("content")
    <form method="POST" action="{{route('room.store')}}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="string" class="form-control" id="name" name="name" placeholder="Enter name">
            <label for="number">Room Number</label>
            <input type="number" class="form-control" id="number" name="no" placeholder="Enter room number">
            <label for="phone">Phone Number</label>
            <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone number">
        </div>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
@endsection
