<div class="navbar bg-base-100 flex justify-between">
    <div>
        <a class="btn btn-ghost text-xl">daisyUI</a>
    </div>
    <div>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost text-xl">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-ghost text-xl">Login</a>
        @endauth
    </div>
</div>
