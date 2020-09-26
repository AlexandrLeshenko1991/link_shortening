<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between container">
    <a class="navbar-brand" href="{{route('link.add')}}">Links</a>

    <div class="collapse navbar-collapse d-flex justify-content-between">
        @auth
            <div class="navbar-nav">
                <a class="nav-link" href="{{route('link.add')}}">Add New Link</a>
                <a class="nav-link" href="{{route('all.links')}}">All links</a>
            </div>
        @endauth

        @guest
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            </div>
        @else
            <div class="navbar-nav">
                <a class="nav-link" href="" onclick='event.preventDefault();document.getElementById("logout-form").submit();'>Logout</a>
            </div>
        @endguest
    </div>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST"
      style="display: none;">
    @csrf
</form>
