@extends('components.layout')

@section('template_title')
    Login
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div id="error-login">
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3><i class="fa fa-sign-in"></i> Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Enter Username">
                            </div>
                            <div class="text-danger" id="error-username">
                                @error('username')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter password">
                            </div>
                            <div class="text-danger" id="error-password">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>
                            <button type="submit" id="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/login-validation.js') }}"></script>
    {{-- @vite('resources/js/login-validation.js') --}}
@endpush
