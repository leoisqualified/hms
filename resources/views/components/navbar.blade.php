<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">Hospital System</a>

        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="px-4">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4">Login</a>
                <a href="{{ route('register') }}" class="px-4">Register</a>
            @endauth
        </div>
    </div>
</nav>
