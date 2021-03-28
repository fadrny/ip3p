<nav class="navbar navbar-dark bg-dark mb-5">
    <div class="container">
        <a href="{{ route('home') }}" class="text-white"><b>DOMŮ</b></a>
        @guest
            <div class="nav-item">
                <a class="btn btn-primary" href="{{ route('login') }}">login</a>
            <div/>
        @else
            <div>
                <span class="float-right d-inline">

                    <form method="POST" action="{{route('logout')}}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary float-right">logout</button>
                    </form>
                </span>
                <div class="float-right nav-link">
                    <a class="link text-white" href="{{ route('user.show', Auth::id()) }}">zobrazit profil</a>
                </div>
            </div>
        @endguest
    </div>
</nav>
