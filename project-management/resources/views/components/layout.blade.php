<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
    {{-- <title>@yield('title') - {{ conifig('app.name') }}</title> --}}
    <title>
        @hasSection('template_title')
            @yield('template_title') |
        @endif {{ config('app.name', Lang::get('titles.app')) }}
    </title>
</head>

<body>
    <div id="app">
        <div class="">
            @if (session('auth_user'))
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container">
                    <a class="navbar-brand" href="/">Project Management</a>
                        <div class="navbar-nav ms-auto">
                            <span class="navbar-text me-3">Welcome</span>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"  id="logout" class='btn btn-danger' onclick="return confirm('Are you sure you want to logout?')">Logout</button>
                            </form>
                        </div>
                </div>
            </nav>
            @endif
        </div>
        @yield('content')
    </div>
    @stack('scripts')
</body>

</html>
